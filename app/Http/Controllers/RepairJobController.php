<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\RepairJob;
use App\Models\RepairJobStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepairJobController extends Controller
{
    /**
     * Display a listing of repair jobs.
     */
    public function index()
    {
        $repairJobs = RepairJob::with('customer')
            ->latest()
            ->paginate(15);

        return view('repair-jobs.index', compact('repairJobs'));
    }

    /**
     * Display a specific repair job.
     */
    public function show(RepairJob $repairJob)
    {
        $repairJob->load([
            'customer',
            'appointment',
            'parts.product',
            'statusHistories.changedBy',
        ]);

        return view('repair-jobs.show', compact('repairJob'));
    }

    /**
 * Update repair job details.
 */
public function update(Request $request, RepairJob $repairJob)
{
    $validated = $request->validate([
        'device_type' => [
            'required',
            'string',
            'max:255',
        ],

        'brand' => [
            'nullable',
            'string',
            'max:255',
        ],

        'model' => [
            'nullable',
            'string',
            'max:255',
        ],

        'serial_number' => [
            'nullable',
            'string',
            'max:255',
        ],

        'imei' => [
            'nullable',
            'string',
            'max:255',
        ],

        'problem_reported' => [
            'required',
            'string',
        ],

        'diagnosis' => [
            'nullable',
            'string',
        ],

        'repair_notes' => [
            'nullable',
            'string',
        ],

        'priority' => [
            'required',
            'in:low,normal,high,urgent',
        ],

        'estimated_cost' => [
            'required',
            'numeric',
            'min:0',
        ],

        'labor_cost' => [
            'required',
            'numeric',
            'min:0',
        ],

        'parts_cost' => [
            'required',
            'numeric',
            'min:0',
        ],

        'discount' => [
            'required',
            'numeric',
            'min:0',
        ],

        'final_cost' => [
            'required',
            'numeric',
            'min:0',
        ],

        'date_received' => [
            'required',
            'date',
        ],

        'expected_completion_date' => [
            'nullable',
            'date',
            'after_or_equal:date_received',
        ],
    ]);

    /*
     * Prevent the final cost from being lower
     * than the amount already paid.
     */
    if ((float) $validated['final_cost'] < (float) $repairJob->amount_paid) {
        return back()
            ->withInput()
            ->withErrors([
                'final_cost' =>
                    'Final cost cannot be lower than the amount already paid (₱' .
                    number_format($repairJob->amount_paid, 2) .
                    ').',
            ]);
    }

    /*
     * Update repair job.
     */
    $repairJob->update([
        'device_type' => $validated['device_type'],
        'brand' => $validated['brand'] ?? null,
        'model' => $validated['model'] ?? null,
        'serial_number' => $validated['serial_number'] ?? null,
        'imei' => $validated['imei'] ?? null,

        'problem_reported' => $validated['problem_reported'],
        'diagnosis' => $validated['diagnosis'] ?? null,
        'repair_notes' => $validated['repair_notes'] ?? null,

        'priority' => $validated['priority'],

        'estimated_cost' => $validated['estimated_cost'],
        'labor_cost' => $validated['labor_cost'],
        'parts_cost' => $validated['parts_cost'],
        'discount' => $validated['discount'],
        'final_cost' => $validated['final_cost'],

        'date_received' => $validated['date_received'],
        'expected_completion_date' =>
            $validated['expected_completion_date'] ?? null,
    ]);

    /*
     * Keep the related appointment payment status
     * synchronized when applicable.
     */
    if ($repairJob->appointment) {

        $repairJob->appointment->update([
            'payment_status' =>
                (float) $repairJob->amount_paid >=
                (float) $repairJob->final_cost
                    ? 'paid'
                    : 'unpaid',
        ]);
    }

    return redirect()
        ->route('repair-jobs.show', $repairJob)
        ->with(
            'success',
            'Repair job details updated successfully.'
        );
}

    /**
     * Convert an appointment into a repair job.
     */
    public function convertFromAppointment(Appointment $appointment)
    {
        // Prevent the same appointment from being converted twice.
        $existingRepairJob = RepairJob::where(
            'appointment_id',
            $appointment->id
        )->first();

        if ($existingRepairJob) {
            return redirect()
                ->route('repair-jobs.show', $existingRepairJob)
                ->with(
                    'info',
                    'This appointment has already been converted to a repair job.'
                );
        }

        // Make sure the appointment has a customer.
        if (!$appointment->customer_id) {
            return back()->with(
                'error',
                'This appointment cannot be converted because it has no customer.'
            );
        }

        $repairJob = DB::transaction(function () use ($appointment) {

            /*
             * Generate a unique repair job number.
             */
            $jobNumber = $this->generateJobNumber();

            $repairJob = RepairJob::create([
                'job_number' => $jobNumber,

                'customer_id' => $appointment->customer_id,
                'appointment_id' => $appointment->id,

                'device_type' => $appointment->device_type,
                'brand' => null,
                'model' => $appointment->device_model,

                'serial_number' => null,
                'imei' => null,

                'problem_reported' => $appointment->problem_description
                    ?: 'No problem description provided.',

                'diagnosis' => null,
                'repair_notes' => $appointment->notes,

                'status' => 'pending',
                'priority' => 'normal',

                'estimated_cost' => $appointment->estimated_cost ?? 0,

                'labor_cost' => 0,
                'parts_cost' => 0,
                'discount' => 0,
                'final_cost' => $appointment->estimated_cost ?? 0,
                'amount_paid' => 0,

                'date_received' => now()->toDateString(),

                'expected_completion_date' => null,
                'completed_at' => null,
                'released_at' => null,
            ]);

            /*
             * Create initial status history.
             */
            RepairJobStatusHistory::create([
                'repair_job_id' => $repairJob->id,
                'old_status' => null,
                'new_status' => 'pending',
                'remarks' => 'Repair job created from appointment.',
                'changed_by' => auth()->id(),
            ]);

            return $repairJob;
        });

        return redirect()
            ->route('repair-jobs.show', $repairJob)
            ->with(
                'success',
                "Appointment successfully converted to Repair Job {$repairJob->job_number}."
            );
    }

    /**
     * Generate a unique repair job number.
     */
    private function generateJobNumber(): string
    {
        do {
            $jobNumber = 'RJ-' . now()->format('Ymd') . '-' .
                str_pad(
                    (string) random_int(1, 9999),
                    4,
                    '0',
                    STR_PAD_LEFT
                );
        } while (RepairJob::where('job_number', $jobNumber)->exists());

        return $jobNumber;
    }

    /**
     * Update repair job status.
     */
    public function updateStatus(
        Request $request,
        RepairJob $repairJob
    ) {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:pending,diagnosing,waiting_for_parts,repairing,ready_for_pickup,released,on_hold,cancelled',
            ],

            'remarks' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $newStatus = $validated['status'];
        $oldStatus = $repairJob->status;

        /*
         * Don't create another history record
         * if the status hasn't changed.
         */
        if ($oldStatus === $newStatus) {
            return back()->with(
                'error',
                'The repair job is already in this status.'
            );
        }

        DB::transaction(function () use (
            $repairJob,
            $oldStatus,
            $newStatus,
            $validated
        ) {

            /*
             * Update repair job status.
             */
            $repairJob->status = $newStatus;

            /*
             * Automatically set completed_at
             * when repair is ready for pickup.
             */
            if ($newStatus === 'ready_for_pickup') {
                $repairJob->completed_at = now();
            }

            /*
             * Automatically set released_at
             * when the unit is released.
             */
            if ($newStatus === 'released') {
                $repairJob->released_at = now();
            }

            /*
             * If moved away from ready for pickup,
             * clear completed_at.
             */
            if (
                $oldStatus === 'ready_for_pickup' &&
                $newStatus !== 'ready_for_pickup'
            ) {
                $repairJob->completed_at = null;
            }

            /*
             * If moved away from released,
             * clear released_at.
             */
            if (
                $oldStatus === 'released' &&
                $newStatus !== 'released'
            ) {
                $repairJob->released_at = null;
            }

            $repairJob->save();

            /*
             * Create status history.
             */
            RepairJobStatusHistory::create([
                'repair_job_id' => $repairJob->id,
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
                'remarks' => $validated['remarks'] ?? null,
                'changed_by' => auth()->id(),
            ]);
        });

        return back()->with(
            'success',
            'Repair job status updated successfully.'
        );
    }

        /**
         * Record a payment for a released repair job.
         *
         * Allows:
         * - Partial payment
         * - Full payment
         * - Multiple payments until the balance reaches zero
         */
        public function markAsPaid(
            Request $request,
            RepairJob $repairJob
        ) {
            /*
            * Payment is only allowed when the repair
            * job has been released.
            */
            if ($repairJob->status !== 'released') {
                return back()->with(
                    'error',
                    'Payment can only be recorded after the repair job has been released.'
                );
            }

            /*
            * Prevent additional payments if the repair
            * job is already fully paid.
            */
            if ((float) $repairJob->balance <= 0) {
                return back()->with(
                    'info',
                    'This repair job is already fully paid.'
                );
            }

            /*
            * Validate the payment amount.
            *
            * The customer cannot pay more than
            * the remaining balance.
            */
            $validated = $request->validate([
                'payment_amount' => [
                    'required',
                    'numeric',
                    'min:0.01',
                    'max:' . $repairJob->balance,
                ],
            ]);

            $paymentAmount = (float) $validated['payment_amount'];

            DB::transaction(function () use (
                $repairJob,
                $paymentAmount
            ) {

                /*
                * Add the new payment to the existing
                * amount already paid.
                */
                $newAmountPaid =
                    (float) $repairJob->amount_paid + $paymentAmount;

                /*
                * Make sure the amount paid never
                * exceeds the final cost.
                */
                $newAmountPaid = min(
                    $newAmountPaid,
                    (float) $repairJob->final_cost
                );

                $repairJob->amount_paid = $newAmountPaid;

                $repairJob->save();


                /*
                * Determine whether the repair is now
                * fully paid or still has a balance.
                */
                $remainingBalance =
                    max(
                        0,
                        (float) $repairJob->final_cost -
                        (float) $repairJob->amount_paid
                    );


                /*
                * If fully paid, mark the related
                * appointment as paid.
                */
                if ($remainingBalance <= 0) {

                    if ($repairJob->appointment) {

                        $repairJob->appointment->update([
                            'payment_status' => 'paid',
                        ]);

                    }

                }


                /*
                * Create payment activity in the
                * repair job status history.
                */
                $paymentStatus =
                    $remainingBalance <= 0
                        ? 'Payment completed.'
                        : 'Partial payment recorded.';

                RepairJobStatusHistory::create([
                    'repair_job_id' => $repairJob->id,

                    'old_status' => $repairJob->status,

                    'new_status' => $repairJob->status,

                    'remarks' =>
                        $paymentStatus .
                        ' Payment received: ₱' .
                        number_format($paymentAmount, 2) .
                        '. Total paid: ₱' .
                        number_format($repairJob->amount_paid, 2) .
                        '. Remaining balance: ₱' .
                        number_format($remainingBalance, 2) . '.',

                    'changed_by' => auth()->id(),
                ]);
            });


            /*
            * Show an appropriate success message.
            */
            $repairJob->refresh();

            if ((float) $repairJob->balance <= 0) {

                return back()->with(
                    'success',
                    'Payment recorded successfully. The repair job is now fully paid.'
                );

            }


            return back()->with(
                'success',
                'Partial payment recorded successfully. Remaining balance: ₱' .
                number_format($repairJob->balance, 2) . '.'
            );
        }


}