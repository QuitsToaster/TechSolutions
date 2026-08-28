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
                ->with('info', 'This appointment has already been converted to a repair job.');
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
             *
             * Example:
             * RJ-20260828-0001
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
             * Create the initial status history.
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
}