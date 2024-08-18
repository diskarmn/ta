<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notif;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

class NotifteksviewController extends Controller
{
    public function index()
    {
        $data_notif = Notif::latest()->paginate(7);
        

        return response()->json(['data' => $data_notif]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'teks' => 'required',
            'audio' => 'required|mimes:mp3,wav,ogg,aac|max:7240',
            'status' => 'required|in:active,non_active',
        ]);
    
        $audioo = $request->file('audio');
        $au = $audioo->getClientOriginalName(); // Nama file asli
        $path = public_path('assets/audio/'); // Path untuk menyimpan file
        $audioo->move($path, $au); // Pindahkan file ke folder yang ditentukan
    
        $audioteks = new Notif;
        $audioteks->teks = $validatedData['teks'];
        $audioteks->audio = $path . $au; // Simpan path lengkap file audio
        $audioteks->status = $validatedData['status'];
        $audioteks->save();
    
        return response()->json($audioteks);
    }

    public function edit($id)
    {
        try {
            // Ambil data notifikasi dari database
            $notif = Notif::findOrFail($id);
    
            // Pastikan data notifikasi ditemukan
            if (!$notif) {
                return response()->json(['error' => 'Notifikasi tidak ditemukan'], 404);
            }
    
            // Kembalikan data notifikasi
            return view('admin.notif.list', compact('notif'));
        } catch (\Exception $e) {
            // Handle error jika terjadi kesalahan saat mencari atau mengambil data notifikasi
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
    

    public function update(Request $request, $id)
    {
        try {
            // Validasi dan perbarui data notifikasi
            $validatedData = $request->validate([
                'teks' => 'required',
                'audio' => 'required|mimes:mp3',
                'status' => 'required|in:active,non_active',
            ]);

            // Update data di database
            $notif = Notif::find($id);
            $notif->teks = $validatedData['teks'];
            $notif->status = $validatedData['status'];

            // Jika terdapat file audio baru, upload dan perbarui path audio
            if ($request->hasFile('audio')) {
                $audioPath = $request->file('audio')->store('audio');
                $notif->audio = $audioPath;
            }

            $notif->save();

            // Hapus nilai pencarian dari session setelah mengupdate notifikasi
            Session::forget('notif_search');

            return response()->json(['message' => 'Data Berhasil Diubah!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data GAGAL Diubah!. ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            // Cari notifikasi berdasarkan ID
            $notif = Notif::findOrFail($id);
            
            // Hapus notifikasi dari database
            $notif->delete();

            // Hapus nilai pencarian dari session setelah menghapus notifikasi
            Session::forget('notif_search');

            return response()->json(['message' => 'Data Berhasil Dihapus!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data GAGAL Dihapus!. ' . $e->getMessage()], 500);
        }
    }
}
