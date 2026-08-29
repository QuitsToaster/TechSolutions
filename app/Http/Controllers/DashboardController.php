<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Part;
use App\Models\RepairJob;
use App\Models\Order;

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

        /*
        * Monthly Revenue
        *
        * Only actual payments from released repairs
        * released during the current month are included.
        */
        $monthlyRevenue = RepairJob::where(
            'status',
            'released'
        )
            ->whereMonth('released_at', now()->month)
            ->whereYear('released_at', now()->year)
            ->sum('amount_paid');


        /*
        * Repair Jobs Included in Monthly Revenue
        *
        * These are the actual repair jobs contributing
        * to the Revenue This Month figure.
        */
        $monthlyRevenueJobs = RepairJob::with('customer')
            ->where(
                'status',
                'released'
            )
            ->whereMonth('released_at', now()->month)
            ->whereYear('released_at', now()->year)
            ->where('amount_paid', '>', 0)
            ->orderByDesc('released_at')
            ->get();


        /*
        * Outstanding Balance
        *
        * Get all non-cancelled repair jobs that still
        * have an unpaid balance.
        */
        $outstandingBalanceJobs = RepairJob::with('customer')
            ->whereNotIn('status', [
                'cancelled',
            ])
            ->get()
            ->filter(function ($repairJob) {
                return $repairJob->balance > 0;
            })
            ->sortByDesc('updated_at')
            ->values();


        /*
        * Total Outstanding Balance
        */
        $outstandingBalance = $outstandingBalanceJobs->sum(
            function ($repairJob) {
                return $repairJob->balance;
            }
        );







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

            'monthlyRevenueJobs',
            'outstandingBalanceJobs',

            'recentRepairJobs',
            'readyForPickupJobs',
            'lowStockItems'
        ));
    }
}