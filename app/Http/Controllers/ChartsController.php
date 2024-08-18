<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Charts\CSChart;
use App\Models\Juragan;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Notiforder;
use Illuminate\Http\Request;
use App\Charts\PenjualanCharts;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Charts\PenjualanChartsDonut;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BEController\ChartsProcess;

class ChartsController extends Controller
{

    public function index(CSChart $chart)
    {
        $gambar = Auth::guard('employee')->user()->profile_image;

        $customers = Customer::all();
        $getData = new ChartsProcess;
        $getData->getTotalPenjualan();
        $getData->leaderboard();

        $status = Order::pluck('status')->first();

        $getData = new ChartsProcess;
        $getData->getTotalPenjualan();
        $getData->leaderboard();
        $data = $this->tahuns();
        $juragans = $data['juragans'];
        $chart = $chart->build();

        return view('customer-service.charts.charts', [
                "title" => "charts",
                "gambar" => $gambar,
            "chart" => $chart,
            "juragans" => $juragans,
            "customers" => $customers,
            'status' => $status,
        ]);
    }

    public function juragancs(CSChart $chart, $juragan)
    {
        $gambar = Auth::guard('employee')->user()->profile_image;
        $namajurgan=$juragan;
        $chart = $chart->buildJuragan($juragan);
        $status = Order::pluck('status')->first();
        $data = $this->tahuns();
        $juragans = $data['juragans'];

        return view('customer-service.charts.chartJuragan', [
            "title" => "data juragan",
            "gambar" => $gambar,
            "chart" => $chart,
            "juragans" => $juragans,
            'status' => $status,
            'namajuragan'=>$namajurgan,
        ]);
    }

    public function filterByJuragan(Request $request)
    {
        $getData = new ChartsProcess;
        $getData->getOrderanByJuragan($request);
        $getData->leaderboard();

        return view('customer-service.charts.charts');
    }

    public function filterByStatus(Request $request)
    {
        $getData = new ChartsProcess;
        $getData->getOrderanByStatus($request);
        $data = $getData->leaderboard();

        return view('customer-service.charts.charts', [
            "data" => $data
        ]);
    }

    public function tahuns()
    {
        $years = Order::select(DB::raw('YEAR(order_date) as year'))
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->pluck('year');
        $juragans = Order::select('juragans.name_juragan')
            ->join('juragans', 'orders.juragan', '=', 'juragans.id')
            ->groupBy('name_juragan')
            ->pluck('name_juragan');


        return ['years' => $years, 'juragans' => $juragans];
    }
    public function terlarisTahun($year)
    {
        $tahunnya=$year;
        $data = $this->tahuns();
        $years = $data['years'];
        $diagram = new PenjualanCharts;
        $donat = new PenjualanChartsDonut;
        $diagramChart = $diagram->buildTahun($year);
        $donatChart = $donat->buildTahun($year);
        $totalPendapatan = Order::orderanSelesai()

            ->whereYear('order_date', $year)
            ->sum('paid_amount');
        $totalPendapatanFormatted = 'Rp ' . number_format($totalPendapatan, 0, ',', '.');
        $hargaTertinggi = Order::orderanSelesai()

            ->whereYear('order_date', $year)
            ->max('paid_amount');
        $hargaTertinggiFormatted = 'Rp ' . number_format($hargaTertinggi, 0, ',', '.');

        $tokoTerlaris = Order::orderanSelesai()
            ->join('juragans', 'orders.juragan', '=', 'juragans.id')
            ->select(
                'juragans.name_juragan as juragan',
                DB::raw('COUNT(orders.juragan) as total_penjualan'),
                DB::raw('MAX(orders.order_date) as tanggal_terlama'),
                DB::raw('MIN(orders.order_date) as tanggal_terbaru')
            )
            ->whereYear('orders.order_date', $year)
            ->groupBy('name_juragan')
            ->orderByDesc('total_penjualan')
            ->first();

        $produkTerlaris = Order::orderanSelesai()
            ->join('barangs', 'orders.id_produk', '=', 'barangs.id')
            ->select(
                'orders.id_produk',
                'orders.order_date',
                'barangs.kd_produk',
                DB::raw('SUM(orders.quantity) as total_terjual'),
                'barangs.nama',
                DB::raw('MAX(orders.order_date) as tanggal_terlama'),
                DB::raw('MIN(orders.order_date) as tanggal_terbaru'),
                DB::raw('DATE_FORMAT(orders.order_date, "%Y") as produk_terlaris_tahun')
            )
            ->whereYear('orders.order_date', $year)
            ->groupBy('orders.id_produk', 'orders.order_date', 'barangs.kd_produk', 'barangs.nama', 'produk_terlaris_tahun')
            ->orderByDesc('total_terjual')
            ->first();
        $tokoTerlarisTotal = Order::orderanSelesai()
            ->join('juragans', 'orders.juragan', '=', 'juragans.id')
            ->select(
                'juragans.name_juragan as juragan',
                DB::raw('COUNT(orders.id) as total_penjualan'),
                DB::raw('MAX(orders.order_date) as tanggal_terlama'),
                DB::raw('MIN(orders.order_date) as tanggal_terbaru')
            )
            ->whereYear('orders.order_date', $year)
            ->groupBy('juragan')
            ->orderByDesc('total_penjualan')
            ->first();

        $totalOrderan = Order::selectRaw('COUNT(*) as total_orderan')
            ->orderanSelesai()

            ->whereYear('order_date', $year)
            ->first();

        return view('super-admin.charts.chartTahun', [
            "tahunnya"=>$tahunnya,
            "total" => $totalOrderan,
            "title" => "Charts Per Tahun",
            "diagram" => $diagramChart,
            "donat" => $donatChart,
            "totalPendapatan" => $hargaTertinggiFormatted,
            "hargaTertinggi" => $totalPendapatanFormatted,
            "produkTerlaris" => $produkTerlaris,
            'tokoTerlaris' => $tokoTerlaris,
            'tokoTerlarisTotal' => $tokoTerlarisTotal,
            'years' => $years,
        ]);
    }
    // admin
    public function terlarisTahunA($year)
    {
        $tahunnya=$year;
        $data = $this->tahuns();
        $years = $data['years'];
        $diagram = new PenjualanCharts;
        $donat = new PenjualanChartsDonut;
        $diagramChart = $diagram->buildTahun($year);
        $donatChart = $donat->buildTahun($year);
        $totalPendapatan = Order::orderanSelesai()

            ->whereYear('order_date', $year)
            ->sum('paid_amount');
        $totalPendapatanFormatted = 'Rp ' . number_format($totalPendapatan, 0, ',', '.');
        $hargaTertinggi = Order::orderanSelesai()

            ->whereYear('order_date', $year)
            ->max('paid_amount');
        $hargaTertinggiFormatted = 'Rp ' . number_format($hargaTertinggi, 0, ',', '.');

        $tokoTerlaris = Order::orderanSelesai()
            ->join('juragans', 'orders.juragan', '=', 'juragans.id')
            ->select(
                'juragans.name_juragan as juragan',
                DB::raw('COUNT(orders.juragan) as total_penjualan'),
                DB::raw('MAX(orders.order_date) as tanggal_terlama'),
                DB::raw('MIN(orders.order_date) as tanggal_terbaru')
            )
            ->whereYear('orders.order_date', $year)
            ->groupBy('name_juragan')
            ->orderByDesc('total_penjualan')
            ->first();

        $produkTerlaris = Order::orderanSelesai()
            ->join('barangs', 'orders.id_produk', '=', 'barangs.id')
            ->select(
                'orders.id_produk',
                'orders.order_date',
                'barangs.kd_produk',
                DB::raw('SUM(orders.quantity) as total_terjual'),
                'barangs.nama',
                DB::raw('MAX(orders.order_date) as tanggal_terlama'),
                DB::raw('MIN(orders.order_date) as tanggal_terbaru'),
                DB::raw('DATE_FORMAT(orders.order_date, "%Y") as produk_terlaris_tahun')
            )
            ->whereYear('orders.order_date', $year)
            ->groupBy('orders.id_produk', 'orders.order_date', 'barangs.kd_produk', 'barangs.nama', 'produk_terlaris_tahun')
            ->orderByDesc('total_terjual')
            ->first();
        $tokoTerlarisTotal = Order::orderanSelesai()
            ->join('juragans', 'orders.juragan', '=', 'juragans.id')
            ->select(
                'juragans.name_juragan as juragan',
                DB::raw('COUNT(orders.id) as total_penjualan'),
                DB::raw('MAX(orders.order_date) as tanggal_terlama'),
                DB::raw('MIN(orders.order_date) as tanggal_terbaru')
            )
            ->whereYear('orders.order_date', $year)
            ->groupBy('juragan')
            ->orderByDesc('total_penjualan')
            ->first();

        $totalOrderan = Order::selectRaw('COUNT(*) as total_orderan')
            ->orderanSelesai()

            ->whereYear('order_date', $year)
            ->first();

        return view('admin.charts.chartTahunA', [
            "tahunnya"=>$tahunnya,
            "total" => $totalOrderan,
            "title" => "Charts Per Tahun",
            "diagram" => $diagramChart,
            "donat" => $donatChart,
            "totalPendapatan" => $hargaTertinggiFormatted,
            "hargaTertinggi" => $totalPendapatanFormatted,
            "produkTerlaris" => $produkTerlaris,
            'tokoTerlaris' => $tokoTerlaris,
            'tokoTerlarisTotal' => $tokoTerlarisTotal,
            'years' => $years,
        ]);
    }
    //
    public function terlaris()
    {
        $produkTerlaris = Order::orderanSelesai()
            ->join('barang_order', 'orders.id', '=', 'barang_order.id_order')
            ->join('barangs', 'barang_order.id_produk', '=', 'barangs.id')
            ->select(
                'barang_order.id_produk',
                DB::raw('SUM(barang_order.quantity) as total_terjual'),
                'barangs.kd_produk',
                'barangs.nama',
                DB::raw('MAX(orders.order_date) as tanggal_terlama'),
                DB::raw('MIN(orders.order_date) as tanggal_terbaru')
            )
            ->groupBy('barang_order.id_produk', 'barangs.kd_produk', 'barangs.nama')
            ->orderByDesc('total_terjual')
            ->first();

        $tokoTerlaris = Order::orderanSelesai()
            ->join('juragans', 'orders.juragan', '=', 'juragans.id')
            ->select(
                'juragans.name_juragan as juragan',
                DB::raw('COUNT(orders.juragan) as total_penjualan'),
                DB::raw('MAX(orders.order_date) as tanggal_terlama'),
                DB::raw('MIN(orders.order_date) as tanggal_terbaru')
            )
            ->groupBy('name_juragan')
            ->orderByDesc('total_penjualan')
            ->first();
        $tokoTerlarisTotal = Order::orderanSelesai()
            ->join('juragans', 'orders.juragan', '=', 'juragans.id')
            ->select(
                'juragans.name_juragan as juragan',
                DB::raw('COUNT(orders.id) as total_penjualan'),
                DB::raw('MAX(orders.order_date) as tanggal_terlama'),
                DB::raw('MIN(orders.order_date) as tanggal_terbaru')
            )
            ->groupBy('juragans.name_juragan')
            ->orderByDesc('total_penjualan')
            // ->take(5
            ->first();

        $totalOrderan = Order::selectRaw('COUNT(*) as total_orderan')
            ->orderanSelesai()

            ->first();

        return [
            'produkTerlaris' => $produkTerlaris,
            'tokoTerlaris' => $tokoTerlaris,
            'tokoTerlarisTotal' => $tokoTerlarisTotal,
            'totalOrderan' => $totalOrderan,
        ];
    }

    public function indexAdmin()
    {
        $penjualanChart = new ChartsProcess;
        $status = Order::pluck('status')->first();
        $penjualan = $penjualanChart->indexChartsAdmin();
        $diagram = new PenjualanCharts;
        $donat = new PenjualanChartsDonut;
        $diagramChart = $diagram->build();
        $donatChart = $donat->build();
        $tokoTerlaris = $this->terlaris()['tokoTerlaris'];
        $totalOrderan = $this->terlaris()['totalOrderan'];
        $produkTerlaris = $this->terlaris()['produkTerlaris'];
        $tokoTerlarisTotal = $this->terlaris()['tokoTerlarisTotal'];
        $data = $this->tahuns();
        $years = $data['years'];
        $notifications=Notiforder::all();
        return view('admin.charts.charts', [
            "total" => $totalOrderan,
            "title" => "Charts",
            "diagram" => $diagramChart,
            "donat" => $donatChart,
            "penjualan" => $penjualan,
            "produkTerlaris" => $produkTerlaris,
            'tokoTerlaris' => $tokoTerlaris,
            'tokoTerlarisTotal' => $tokoTerlarisTotal,
            'years' => $years,
            'status' => $status,
            'notifications'=>$notifications
        ]);
    }

    public function indexSA()
    {
        // $penjualanChart = new ChartsProcess;
        // $penjualan = $penjualanChart->indexChartsAdmin();
        $totalPendapatan = Order::where('status', 'orderan_selesai')->sum('paid_amount');
        $hargaTertinggi = Order::where('status', 'orderan_selesai')->max('paid_amount');
        $status = Order::where('status', 'orderan_selesai')->first();
        $diagram = new PenjualanCharts;
        $donat = new PenjualanChartsDonut;
        $diagramChart = $diagram->build();
        $donatChart = $donat->build();
        $tokoTerlaris = $this->terlaris()['tokoTerlaris'];
        $totalOrderan = $this->terlaris()['totalOrderan'];
        $produkTerlaris = $this->terlaris()['produkTerlaris'];
        $tokoTerlarisTotal = $this->terlaris()['tokoTerlarisTotal'];
        $data = $this->tahuns();
        $years = $data['years'];

        return view('super-admin.charts.charts', [
            "total" => $totalOrderan,
            "title" => "Charts",
            "diagram" => $diagramChart,
            "donat" => $donatChart,
            // "penjualan" => $penjualan,
            'totalPendapatan'=>$totalPendapatan,
            'hargaTertinggi'=>$hargaTertinggi,
            "produkTerlaris" => $produkTerlaris,
            'tokoTerlaris' => $tokoTerlaris,
            'tokoTerlarisTotal' => $tokoTerlarisTotal,
            'years' => $years,
            'status' => $status

        ]);
    }
    public function filterByTahun(Request $request)
    {
        $user = auth()->user();
        $role = $user->role;
        $view = $this->rolecharts($role);

        $tahun = $request->input('tahun');



        return view($view, [
            'title' => 'Charts Tahun',

        ]);
    }

    protected function rolecharts($role)
    {
        switch ($role) {
            case 'superAdmin':
                return 'super-admin.charts.charts';
            case 'admin':
                return 'admin.charts.charts';
            case 'cs':
                return 'customer-service.charts.charts';
            default:
                return 'errors.unknown-role';
        }
    }
    //tahun
    // public function indexSAtahun()
    // {
    //     $penjualanChart = new ChartsProcess;
    //     $penjualan = $penjualanChart->indexChartsAdmin();
    //     $diagram = new PenjualanCharts;
    //     $donat = new PenjualanChartsDonut;
    //     $diagramChart = $diagram->buildTahun();
    //     $donatChart = $donat->build();
    //     $tokoTerlaris = $this->terlaris()['tokoTerlaris'];
    //     $totalOrderan = $this->terlaris()['totalOrderan'];
    //     $produkTerlaris = $this->terlaris()['produkTerlaris'];
    //     $tokoTerlarisTotal = $this->terlaris()['tokoTerlarisTotal'];

    //     return view('super-admin.charts.chartTahun', [
    //         "total" => $totalOrderan,
    //         "title" => "Charts",
    //         "diagram" => $diagramChart,
    //         "donat" => $donatChart,
    //         "penjualan" => $penjualan,
    //         "produkTerlaris" => $produkTerlaris,
    //         'tokoTerlaris' => $tokoTerlaris,
    //         'tokoTerlarisTotal' => $tokoTerlarisTotal,

    //     ]);
    // }
}
