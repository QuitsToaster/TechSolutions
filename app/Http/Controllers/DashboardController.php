<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Part;

class DashboardController extends Controller
{
    public function index()
    {
        $todayAppointments = Appointment::with('customer')
            ->whereDate('appointment_date', today())
            ->orderBy('appointment_time')
            ->get();

        $pendingRepairs = Appointment::whereIn('status', [
            'pending',
            'confirmed',
            'in_progress',
        ])->count();

        $readyRepairs = Appointment::where('status', 'completed')->count();

        $lowStockParts = Part::whereColumn(
            'stock_quantity',
            '<=',
            'minimum_stock'
        )->count();

        $outOfStockParts = Part::where(
            'stock_quantity',
            0
        )->count();

        return view('dashboard', compact(
            'todayAppointments',
            'pendingRepairs',
            'readyRepairs',
            'lowStockParts',
            'outOfStockParts'
        ));
    }
}