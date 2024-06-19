<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FinancialOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Ambil waktu sekarang di zona waktu Makassar
        $now = Carbon::now('Asia/Makassar');

        // Hitung pendapatan bulan ini
        $currentMonthIncome = Order::where('status', 'completed')
            ->whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->sum('gross_amount');

        // Hitung pendapatan hari ini
        $todayIncome = Order::where('status', 'completed')
            ->whereDate('created_at', $now->toDateString())
            ->sum('gross_amount');

        // Hitung jumlah pesanan hari ini
        $todayOrdersCount = Order::where('status', 'completed')
            ->whereDate('created_at', $now->toDateString())
            ->count();

        return [
            Stat::make('Pendapatan bulan ini', 'Rp ' . number_format($currentMonthIncome)),
            Stat::make('Pendapatan hari ini', 'Rp ' . number_format($todayIncome)),
            Stat::make('Pesanan hari ini', $todayOrdersCount),
        ];
    }
}
