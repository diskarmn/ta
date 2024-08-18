<?php

namespace App\Http\Controllers\BEController;

use Carbon\Carbon;
use App\Models\Notif;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class Notification extends Controller
{
    public function addNotif(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'teks' => 'required',
            'audio' => 'required|file|max:100000',
            'status' => 'required|in:active,non_active',
        ], [
            'aduio.file' => 'Audio harus dengan format file: mp3, wav.'
        ]);
        //Jika validasi gagal, kembalikan response dengan pesan error
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $audio = $request->file('audio');
        $audioName = $audio->getClientOriginalName();
        $path = public_path('notif/audio/');

        // Pindahkan file audio ke direktori yang tepat
        $audio->move($path, $audioName);

        // Ubah path file audio dalam $validatedData
        $data = $request->all();
        $data['audio'] = 'notif/audio/' . $audioName;

        $notiff = new Notif;
        $notiff->teks = $data['teks'];
        $notiff->status = $data['status'];
        $notiff->audio = $data['audio'];

        if ($notiff->save()) {
            return response()->json(['success' => 'Berhasil membuat notif', 'data' => $notiff], 200);
        } else {
            // Jika gagal menyimpan notifikasi, kembalikan pesan kesalahan
            return response()->json(['error' => 'Gagal membuat notifikasi'], 500);
        }
    }

    public function editNotif(Request $request, $id)
    {
        // Cari notifikasi berdasarkan ID
        $notif = Notif::find($id);
        if (!$notif) {
            return response()->json(['error' => 'Notifikasi tidak ditemukan'], 404);
        }
    
        // Validasi input
        $validator = Validator::make($request->all(), [
            'teks' => 'required',
            'audio' => 'nullable|file|max:100000', // Audio boleh tidak di-update
            'status' => 'required|in:active,non_active',
        ], [
            'audio.file' => 'Audio harus dengan format file: mp3, wav.'
        ]);
    
        // Jika validasi gagal, kembalikan response dengan pesan error
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
    
        // Update teks dan status
        $notif->teks = $request->input('teks');
        $notif->status = $request->input('status');
    
        // Cek jika file audio di-upload
        if ($request->hasFile('audio')) {
            $audio = $request->file('audio');
            $audioName = $audio->getClientOriginalName();
            $path = public_path('notif/audio/');
    
            // Pindahkan file audio ke direktori yang tepat
            $audio->move($path, $audioName);
    
            // Update path file audio
            $notif->audio = 'notif/audio/' . $audioName;
        }
        // dd($request->all());
        // Simpan perubahan notifikasi
        if ($notif->save()) {
            return response()->json(['success' => 'Notifikasi berhasil diperbarui', 'data' => $notif], 200);
        } else {
            // Jika gagal menyimpan perubahan, kembalikan pesan kesalahan
            return response()->json(['error' => 'Gagal memperbarui notifikasi'], 500);
        }
    }
    
    // public function create(Request $request)
    // {
    //     // Validasi data yang diterima dari form
    //     $validator = Validator::make($request->all(), [
    //         'teks' => 'required',
    //         'audio' => 'required|file|max:100000',
    //         'status' => 'required|in:active,non_active',
    //       z
    //         'id_employee' => 'required|exists:employees,id',
    //     ], [
    //         'audio.file' => 'Audio harus dengan format file: mp3, wav.',
    //     ]);

    //     //Jika validasi gagal, kembalikan response dengan pesan error
    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()], 422);
    //     }

    //     //Data yang diterima dari request
    //     $data = $request->all();
    //     $getaudio = $data['audio'];
    //     $gettype = $getaudio->getClientMimeType();

    //     // Simpan file audio sesuai dengan kode yang diberikan
    //     $audio = $request->file('audio');
    //     $mp3 = $audio->getClientOriginalName();
    //     $path = public_path('notif/audio/');
    //     // $extension = $audio->guessExtension();

    //     if ($gettype !== 'audio/mpeg' && $gettype !== 'wav') {
    //         // Jika ekstensi file tidak sesuai, kembalikan respons dengan pesan kesalahan
    //         return response()->json(['error' => ['audio' => ['Audio harus dengan format file: mp3, wav.']]], 422);
    //     }


    //     // Buat direktori jika belum ada
    //     if (!File::exists($path)) {
    //         File::makeDirectory($path, 0777, true, true);
    //     }

    //     // Pindahkan file audio ke direktori yang tepat
    //     $audio->move($path, $mp3);

    //     // Ubah path file audio dalam $validatedData
    //     $data['audio'] = 'notif/audio/' . $mp3;


    //     //Mengambil data employee berdasarkan ID yang diberikan dalam data yang divalidasi.
    //     $employee = Employee::findOrFail($data['id_employee']);

    //     // Memanggil fungsi getJuragansForEmployee untuk mendapatkan daftar "juragan" untuk employee yang ditemukan sebelumnya
    //     $juragans = $this->getJuragansForEmployee($employee);

    //     // Cek apakah order milik cs atau juragan
    //     if (!$this->isOrderBelongsToEmployee($data['id_order'], $juragans)) {

    //         //Jika orderan tidak relevan dengan cs atau juragan
    //         return response()->json(['error' => 'Orderan bukan milik cs atau juragan.'], 401);
    //     }

    //     $notiff = new Notif;
    //     $notiff->teks = $data['teks'];
    //     $notiff->id_employee = $employee->id;
    //     $notiff->status = $data['status'];
    //     $notiff->audio = $mp3;
    //     $notiff->id_order = $data['id_order'];
    //     $notiff->id_employee = $data['id_employee'];

    //     // Jika notifikasi berhasil disimpan, kembalikan respons sukses
    //     if ($notiff->save()) {
    //         return response()->json(['success' => 'Berhasil membuat notif', 'data' => $notiff], 200);
    //     } else {
    //         // Jika gagal menyimpan notifikasi, kembalikan pesan kesalahan
    //         return response()->json(['error' => 'Gagal membuat notifikasi'], 500);
    //     }
    // }

    private function getJuragansForEmployee($employee)
    {
        //Menggunakan relasi model user untuk mendapatkan juragan yang terhubung dengan employee
        return $employee->juragans;
    }
    private function isOrderBelongsToEmployee($orderId, $juragans)
    {
        $order = Order::find($orderId);
        if (!$order) {
            //Jika order tidak ditemukan
            return response()->json(['error' => 'Order tidak ditemukan'], 404);
        }
        if ($juragans === null) {
            //Jika $juragan null
            return response()->json(['error' => 'Juragan tidak ditemukan'], 404);
        }

        $orderJuraganIds = [];
        if ($order->juragans) {
            foreach ($order->juragans as $juragan) {
                $orderJuraganIds[] = $juragan->id;
            }
        }

        //Cek apakah order terhubung dengan juragan yang dimiliki employee
        foreach ($juragans as $juragan) {
            if (in_array($juragan->id, $orderJuraganIds)) {
                return true;
            }
        }

        return false;
    }

    public function markAsRead(Request $request, $id)
    {
        $notification = Notif::find($id);

        //Pastikan id notif ditemukan
        if (!$notification) {
            return response()->json(['error' => 'Notifikasi tidak ditemukan'], 404);
        }

        // Dapatkan objek employee dengan request
        $employee = $request->employee;

        // Cek role admin atau cs
        if ($employee && ($employee->isAdmin() || $employee->isCs())) {
            // Tandai notifikasi sebagai terbaca
            $notification->markAsRead();
        }

        return response()->json(['success' => 'Notifikasi berhasil ditandai sebagai terbaca'], 200);
    }

    public function destroy(Notif $notif, Request $request)
    {
        $employee = $request->user();

        //Memastikan role sebagai superadmin
        if ($employee && $employee->role !== 'superadmin') {
            abort(403, 'Tidak sah');
        }

        // Memeriksa apakah waktu sekarang sudah melewati batas waktu 3 bulan terakhir
        $lastDestroyDate = Carbon::parse($notif->deleted_at)->subMonths(3);
        if ($lastDestroyDate->isAfter(now())) {
            abort(403, 'Destroy dilakukan 3 bulan sekali');
        }

        try {
            //Jika role adalah superadmin, notif dapat dihapus
            $notif->delete();
            $response = ['success' => true, 'message' => 'Data Berhasil Dihapus'];
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => 'Data GAGAL Dihapus! ' . $e->getMessage()];
        }

        if (request()->expectsJson()) {
            return response()->json($response);
        } else {
            if ($response['success']) {
                return redirect('/admin/notif')->with('success', $response['message']);
            } else {
                return redirect('/admin/notif')->with('error', $response['message']);
            }
        }
    }

    public function index($id = null)
    {
        //Cek jika parameter 'id' dimunculkan
        if ($id !== null) {
            $notifications = Notif::find($id);

            //Cek jika notification dengan 'id' yang diminta sesuai
            if ($notifications) {
                return response()->json([
                    'notification' => $notifications
                ]);
            } else {
                return response()->json(['error' => 'Notifikasi tidak ditemukan'], 404);
            }
        }

        //Jika id tidak dimunculkan maka show all data
        $notifications = Notif::all();
        // return response()->json($data);
        return response()->json([
            'notifications' => $notifications,
        ]);
    }
}
