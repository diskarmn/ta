<?php

namespace App\Charts;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class PenjualanChartsDonut
{
    protected $chart;

    public function __construct()
    {
        $this->chart = new LarapexChart;
    }

    public function build()
    {
        $total_orderan_per_juragan = Order::orderanSelesai()
            ->select('juragan', DB::raw('COUNT(*) as total_orderan'))
            ->groupBy('juragan')
            ->pluck('total_orderan', 'juragan')
            ->toArray();
        $juragans = Order::orderanSelesai()
            ->join('juragans', 'orders.juragan', '=', 'juragans.id')
            ->select('juragans.name_juragan')
            ->distinct()
            ->pluck('name_juragan')
            ->toArray();




        // Ekstrak nilai 'value' dari setiap elemen array dalam $dataDonatChart
        return $this->chart->donutChart()
            ->setTitle('Data Penjualan Toko')
            ->addData(array_values($total_orderan_per_juragan))
            ->setLabels($juragans);
    }
    //
    public function buildTahun($year)
    {
        $total_orderan_per_juragan = Order::orderanSelesai()
            ->whereYear('order_date', $year)
            ->select('juragan', DB::raw('COUNT(*) as total_orderan'))
            ->groupBy('juragan')
            ->pluck('total_orderan', 'juragan')
            ->toArray();

        $juragans = Order::orderanSelesai()
            ->whereYear('order_date', $year)
            ->join('juragans', 'orders.juragan', '=', 'juragans.id')
            ->select('juragans.name_juragan')
            ->distinct()
            ->pluck('name_juragan')
            ->toArray();




        // Ekstrak nilai 'value' dari setiap elemen array dalam $dataDonatChart
        return $this->chart->donutChart()
            ->setTitle('Data Penjualan Toko')
            ->addData(array_values($total_orderan_per_juragan))
            ->setLabels($juragans);
    }
}
