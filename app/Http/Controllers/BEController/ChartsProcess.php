<?php

namespace App\Http\Controllers\BEController;

use App\Models\Order;
use App\Models\Juragan;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ChartsProcess extends Controller
{
    public function indexChartsAdmin()
    {
        // $totalPendapatan = Order::orderanSelesai()->excludeStatusGagal()->sum('paid_amount');
        // $totalBarangTerjual = Order::orderanSelesai()->excludeStatusGagal()->sum('quantity');
        // $hargaTertinggi = Order::orderanSelesai()->excludeStatusGagal()->max('paid_amount');

        // $totalOrderan = Order::selectRaw('COUNT(*) as total_orderan')
        //     ->orderanSelesai()
        //     ->excludeStatusGagal()
        //     ->orderBy('total_orderan')
        //     ->get();
        // $totalBarangTerjual = Order::orderanSelesai()->sum('quantity');

        // $totalOrderan = Order::selectRaw('COUNT(*) as total_orderan')
        //     ->orderanSelesai()
        //     ->get();
        $totalPendapatan = Order::where('status', 'orderan_selesai')->sum('paid_amount');
        $hargaTertinggi = Order::where('status', 'orderan_selesai')->max('paid_amount');
        return [
            'totalPendapatan' => $totalPendapatan,
            'hargaTertinggi' => $hargaTertinggi,
        ];
    }

    public function totalOrderanSA()
    {
        $totalOrderan = Order::selectRaw('DATE_FORMAT(order_date, "%m") as bulan, COUNT(*) as total_orderan')
            ->orderanSelesai()
            // ->excludeStatusGagal()
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get();

        return compact('totalOrderan');
    }

    public function indexChartsSA()
    {
        $data = $this->indexChartsAdmin();

        return response()->json($data);
    }

    public function getTotalPenjualan()
    {
        $totalOrderan = Order::selectRaw('DATE_FORMAT(order_date, "%m") as bulan, COUNT(*) as total_orderan')
            ->orderanSelesai()
            // ->excludeStatusGagal()
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get();

        if ($totalOrderan->isNotEmpty()) {
            return response()->json([
                'success' => $totalOrderan->isNotEmpty(),
                'data' => $totalOrderan,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada data orderan.',
            ]);
        }
    }

    public function getOrderanByJuragan(Request $request)
    {
        // Mengambil juragan berdasarkan nama yang diinput oleh user
        $juragan = Juragan::where('name_juragan', $request->input('juragan'))->first();

        // Memeriksa apakah juragan ditemukan
        if (!$juragan) {
            return response()->json(['error' => 'Juragan tidak ditemukan'], 404);
        }

        // Mengambil total orderan berdasarkan id juragan
        $totalOrderan = Order::selectRaw('DATE_FORMAT(order_date, "%m") as bulan, COUNT(*) as total_orderan')
            ->where('juragan', $juragan->id)
            ->orderanSelesai()
            // ->excludeStatusGagal()
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get();

        if ($totalOrderan) {
            return response()->json([
                'success' => $totalOrderan->isNotEmpty(),
                'total_order' => $totalOrderan
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada data orderan untuk juragan ini.'
            ]);
        }
    }

    public function getOrderanByStatus(Request $request)
    {
        $status = $request->input('status');

        $totalOrderan = Order::selectRaw('DATE_FORMAT(order_date, "%m") as bulan, COUNT(*) as total_orderan')
            ->where('status', $status)
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get();

        if ($totalOrderan) {
            return response()->json([
                'success' => $totalOrderan->isNotEmpty(),
                'total_order' => $totalOrderan
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada data orderan dengan status ini.'
            ]);
        }
    }

    public function leaderboard()
    {
        $leaderboard = Employee::where('role', 'cs')
            ->join('orders', 'employees.id', '=', 'orders.served_by')
            ->select('employees.name', DB::raw('SUM(orders.total_quantity) as total_barang_terjual'))
            ->groupBy('employees.id', 'employees.name')
            ->orderByDesc('total_barang_terjual')
            ->get();

        if ($leaderboard !== null) {
            return response()->json($leaderboard);
        } else {
            return response()->json(['success' => false, 'message' => 'CS tidak ditemukan.']);
        }
    }
}
