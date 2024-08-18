<?php

namespace App\Charts;

use App\Models\Order;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Http\Controllers\BEController\ChartsProcess;

class PenjualanCharts
{
    protected $chart;

    public function __construct()
    {
        $this->chart = new LarapexChart;
    }


    public function build()
    {
        $jan = Order::orderanSelesai()->whereMonth('order_date', '01')->count();
        $feb = Order::orderanSelesai()->whereMonth('order_date', '02')->count();
        $mar = Order::orderanSelesai()->whereMonth('order_date', '03')->count();
        $apr = Order::orderanSelesai()->whereMonth('order_date', '04')->count();
        $mei = Order::orderanSelesai()->whereMonth('order_date', '05')->count();
        $jun = Order::orderanSelesai()->whereMonth('order_date', '06')->count();
        $jul = Order::orderanSelesai()->whereMonth('order_date', '07')->count();
        $ags = Order::orderanSelesai()->whereMonth('order_date', '08')->count();
        $sep = Order::orderanSelesai()->whereMonth('order_date', '09')->count();
        $okt = Order::orderanSelesai()->whereMonth('order_date', '010')->count();
        $nov = Order::orderanSelesai()->whereMonth('order_date', '011')->count();
        $des = Order::orderanSelesai()->whereMonth('order_date', '012')->count();
        return $this->chart->areaChart()
            ->addData('Jumlah Terjual', [$jan, $feb, $mar, $apr, $mei, $jun, $jul, $ags, $sep, $okt, $nov, $des])
            ->setXAxis(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']);
    }
    //
    public function buildTahun($year)
    {
        $jan=Order::orderanSelesai()->whereYear('order_date', $year)->whereMonth('order_date', '01')->count();
        $feb=Order::orderanSelesai()->whereYear('order_date', $year)->whereMonth('order_date', '02')->count();
        $mar=Order::orderanSelesai()->whereYear('order_date', $year)->whereMonth('order_date', '03')->count();
        $apr=Order::orderanSelesai()->whereYear('order_date', $year)->whereMonth('order_date', '04')->count();
        $mei=Order::orderanSelesai()->whereYear('order_date', $year)->whereMonth('order_date', '05')->count();
        $jun=Order::orderanSelesai()->whereYear('order_date', $year)->whereMonth('order_date', '06')->count();
        $jul=Order::orderanSelesai()->whereYear('order_date', $year)->whereMonth('order_date', '07')->count();
        $ags=Order::orderanSelesai()->whereYear('order_date', $year)->whereMonth('order_date', '08')->count();
        $sep=Order::orderanSelesai()->whereYear('order_date', $year)->whereMonth('order_date', '09')->count();
        $okt=Order::orderanSelesai()->whereYear('order_date', $year)->whereMonth('order_date', '10')->count();
        $nov=Order::orderanSelesai()->whereYear('order_date', $year)->whereMonth('order_date', '11')->count();
        $des=Order::orderanSelesai()->whereYear('order_date', $year)->whereMonth('order_date', '12')->count();

                return $this->chart->areaChart()
                ->addData('Jumlah Terjual', [$jan, $feb, $mar, $apr, $mei, $jun, $jul, $ags, $sep, $okt, $nov, $des])
                ->setXAxis(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']);
    }
}
