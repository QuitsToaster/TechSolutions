<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Part;
use App\Models\RepairJob;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Today's Appointments
        |--------------------------------------------------------------------------
        */

        $todayAppointments = Appointment::with('customer')
            ->whereDate('appointment_date', today())
            ->orderBy('appointment_time')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Repair Job Statistics
        |--------------------------------------------------------------------------
        */

        $activeRepairStatuses = [
            'pending',
            'diagnosing',
            'waiting_for_parts',
            'repairing',
            'on_hold',
        ];

        $activeRepairs = RepairJob::whereIn(
            'status',
            $activeRepairStatuses
        )->count();

        $readyRepairs = RepairJob::where(
            'status',
            'ready_for_pickup'
        )->count();

        $pendingRepairs = RepairJob::where(
            'status',
            'pending'
        )->count();

        $diagnosingRepairs = RepairJob::where(
            'status',
            'diagnosing'
        )->count();

        $waitingForParts = RepairJob::where(
            'status',
            'waiting_for_parts'
        )->count();

        $repairingRepairs = RepairJob::where(
            'status',
            'repairing'
        )->count();

        $onHoldRepairs = RepairJob::where(
            'status',
            'on_hold'
        )->count();

        $releasedRepairs = RepairJob::where(
            'status',
            'released'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | Inventory Statistics
        |--------------------------------------------------------------------------
        */

        $lowStockParts = Part::whereColumn(
            'stock_quantity',
            '<=',
            'minimum_stock'
        )
            ->where('stock_quantity', '>', 0)
            ->count();

        $outOfStockParts = Part::where(
            'stock_quantity',
            '<=',
            0
        )->count();

        /*
        |--------------------------------------------------------------------------
        | Order Statistics
        |--------------------------------------------------------------------------
        */

        $totalOrders = Order::count();

        /*
        |--------------------------------------------------------------------------
        | Financial Statistics
        |--------------------------------------------------------------------------
        */

        $monthlyRevenue = RepairJob::where(
            'status',
            'released'
        )
            ->whereMonth('released_at', now()->month)
            ->whereYear('released_at', now()->year)
            ->sum('final_cost');


        $outstandingBalance = RepairJob::whereNotIn('status', [
            'cancelled',
        ])
            ->select(
                DB::raw(
                    'COALESCE(SUM(GREATEST(final_cost - amount_paid, 0)), 0) as balance'
                )
            )
            ->value('balance');


        /*
        |--------------------------------------------------------------------------
        | Recent Repair Jobs
        |--------------------------------------------------------------------------
        */

        $recentRepairJobs = RepairJob::with('customer')
            ->latest()
            ->take(6)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Ready for Pickup
        |--------------------------------------------------------------------------
        */

        $readyForPickupJobs = RepairJob::with('customer')
            ->where(
                'status',
                'ready_for_pickup'
            )
            ->orderByDesc('updated_at')
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Low Stock Items
        |--------------------------------------------------------------------------
        */

        $lowStockItems = Part::whereColumn(
            'stock_quantity',
            '<=',
            'minimum_stock'
        )
            ->orderBy('stock_quantity')
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        return view('dashboard', compact(
            'todayAppointments',

            'activeRepairs',
            'pendingRepairs',
            'diagnosingRepairs',
            'waitingForParts',
            'repairingRepairs',
            'onHoldRepairs',
            'readyRepairs',
            'releasedRepairs',

            'lowStockParts',
            'outOfStockParts',

            'totalOrders',

            'monthlyRevenue',
            'outstandingBalance',

            'recentRepairJobs',
            'readyForPickupJobs',
            'lowStockItems'
        ));
    }
}