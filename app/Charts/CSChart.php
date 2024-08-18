<?php

namespace App\Charts;

use App\Models\Order;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class CSChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
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
        return $this->chart->barChart()
            ->setHeight(600)
            ->addData('Jumlah Terjual', [$jan, $feb, $mar, $apr, $mei, $jun, $jul, $ags, $sep, $okt, $nov, $des])
            ->setXAxis(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']);
    }
    public function buildJuragan($juragan): \ArielMejiaDev\LarapexCharts\BarChart
    {

        $jan = Order::orderanSelesai()->join('juragans', 'orders.juragan', '=', 'juragans.id')->where('juragans.name_juragan', $juragan)
            ->whereMonth('order_date', '01')->count();
        $feb = Order::orderanSelesai()->join('juragans', 'orders.juragan', '=', 'juragans.id')->where('juragans.name_juragan', $juragan)
            ->whereMonth('order_date', '02')->count();
        $mar = Order::orderanSelesai()->join('juragans', 'orders.juragan', '=', 'juragans.id')->where('juragans.name_juragan', $juragan)
            ->whereMonth('order_date', '03')->count();
        $apr = Order::orderanSelesai()->join('juragans', 'orders.juragan', '=', 'juragans.id')->where('juragans.name_juragan', $juragan)
            ->whereMonth('order_date', '04')->count();
        $mei = Order::orderanSelesai()->join('juragans', 'orders.juragan', '=', 'juragans.id')->where('juragans.name_juragan', $juragan)
            ->whereMonth('order_date', '05')->count();
        $jun = Order::orderanSelesai()->join('juragans', 'orders.juragan', '=', 'juragans.id')->where('juragans.name_juragan', $juragan)
            ->whereMonth('order_date', '06')->count();
        $jul = Order::orderanSelesai()->join('juragans', 'orders.juragan', '=', 'juragans.id')->where('juragans.name_juragan', $juragan)
            ->whereMonth('order_date', '07')->count();
        $ags = Order::orderanSelesai()->join('juragans', 'orders.juragan', '=', 'juragans.id')->where('juragans.name_juragan', $juragan)
            ->whereMonth('order_date', '08')->count();
        $sep = Order::orderanSelesai()->join('juragans', 'orders.juragan', '=', 'juragans.id')->where('juragans.name_juragan', $juragan)
            ->whereMonth('order_date', '09')->count();
        $okt = Order::orderanSelesai()->join('juragans', 'orders.juragan', '=', 'juragans.id')->where('juragans.name_juragan', $juragan)
            ->whereMonth('order_date', '10')->count();
        $nov = Order::orderanSelesai()->join('juragans', 'orders.juragan', '=', 'juragans.id')->where('juragans.name_juragan', $juragan)
            ->whereMonth('order_date', '11')->count();
        $des = Order::orderanSelesai()->join('juragans', 'orders.juragan', '=', 'juragans.id')->where('juragans.name_juragan', $juragan)
            ->whereMonth('order_date', '12')->count();

        return $this->chart->barChart()
            // ->setTitle('San Francisco vs Boston.')
            // ->setSubtitle('Wins during season 2021.')
            // ->addData('San Francisco', [6, 9, 3, 4, 10, 8])

            ->setHeight(600)
            ->addData('Jumlah Terjual', [$jan, $feb, $mar, $apr, $mei, $jun, $jul, $ags, $sep, $okt, $nov, $des])
            ->setXAxis(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']);
    }
}
