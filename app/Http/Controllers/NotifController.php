<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BEController\Notification;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Notif;
use App\Models\Notiforder;
use Illuminate\Notifications\Notification as NotificationsNotification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class NotifController extends Controller
{
    // public function getNotifications()
    // {
    //     $notifications = Notiforder::latest()->get(); // Mengambil semua notifikasi, diurutkan dari yang terbaru
    //     return view('partials.navbarSA', compact('notifications'));
    // }


    public function index()
    {
        $search = request('search');

        // Menyimpan nilai pencarian dalam session
        Session::put('notif_search', $search);
        $notifs = Notif::latest()->filter(['search' => $search])->paginate(7)->withQueryString();

        // Menambahkan nama file ke setiap notif
        foreach ($notifs as $notif) {
            $notif->audio_basename = basename($notif->audio);
        }
        return view('admin.notif.list', [
            "title" => "Audio & Teks Notif",
            "search" => $search,
            "data_notif" => $notifs,
            
        ]);
    }

    public function indexSuperadmin()
    {
        $search = request('search');

        // Menyimpan nilai pencarian dalam session
        Session::put('notif_search', $search);

        return view('super-admin.notif.list', [
            "title" => "Audio & Teks Notif",
            "search" => $search,
            "data_notif" => Notif::latest()->filter(['search' => $search])->paginate(7)->withQueryString()
        ]);
    }

    public function create(Request $request)
    {
        $data = new Notification;
        $data->addNotif($request);

        return back()->with('success', 'berhasil menambahkan notif');
    }
    public function createAdmin(Request $request)
    {
        $data = new Notification;
        $data->addNotif($request);

        return back()->with('success', 'berhasil menambahkan notif');
    }

    public function update(Request $request, $id){
        $data = new Notification;
        $data->editNotif($request, $id);

        return back()->with('success', 'Berhasil update data');
    }

    public function storeAdmin(Request $request)
    {
        $validatedData = $request->validate([
            'teks' => 'required',
            'audio' => 'required|mimes:mp3',
            'status' => 'required|in:active,non_active',
        ]);

        // Simpan data barang baru ke database
        try {
            Notif::create($validatedData);

            // Menghapus nilai pencarian dari session setelah barang ditambahkan
            Session::forget('notif_search');

            return redirect('/admin/notif')->with('success', 'Data Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            return redirect('/admin/notif')->with('error', 'Data GAGAL Ditambahkan!. ' . $e->getMessage());
        }
    }

    public function updateAdmin(Request $request, $id){
        $data = new Notification;
        $data->editNotif($request, $id);

        return back()->with('success', 'Berhasil update data');
    }

    public function edit()
    {
        // Tampilkan formulir pengeditan
        // ...
    }

    public function destroy($id)
    {
        Notif::destroy($id);
        return back()->with('success', 'Berhasil delete data');
    }
}
