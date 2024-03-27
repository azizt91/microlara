<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RouterosAPI;
use RealRashid\SweetAlert\Facades\Alert;

class IPBindingController extends Controller
{

    public function index()
{
    $host = session()->get('host');
    $username = session()->get('username');
    $password = session()->get('password');
    $API = new RouterosAPI();
    $API->debug = false;

    if ($API->connect($host, $username, $password)) {
        $ipBindings = $API->comm('/ip/hotspot/ip-binding/print');
        $API->disconnect();

        return view('ip_binding', ['ipBindings' => $ipBindings]);
    } else {
        return "Failed to connect to MikroTik Router.";
    }
}

    

    public function enable($id)
    {
        $host = session()->get('host');
        $username = session()->get('username');
        $password = session()->get('password');
        $API = new RouterosAPI();
        $API->debug = false;

        // Lakukan koneksi ke perangkat MikroTik
        if ($API->connect($host, $username, $password)) {
            // Mengaktifkan IP Binding dengan ID tertentu
            $API->write('/ip/hotspot/ip-binding/enable', false);
            $API->write('=.id=' . $id);
            $API->read();
            $API->disconnect();

            return redirect()->back()->with('success', 'IP Binding has been enabled successfully.');
        } else {
            return "Failed to connect to MikroTik Router.";
        }
    }

    public function disable($id)
    {
        $host = session()->get('host');
        $username = session()->get('username');
        $password = session()->get('password');
        $API = new RouterosAPI();
        $API->debug = false;

        // Lakukan koneksi ke perangkat MikroTik
        if ($API->connect($host, $username, $password)) {
            // Menonaktifkan IP Binding dengan ID tertentu
            $API->write('/ip/hotspot/ip-binding/disable', false);
            $API->write('=.id=' . $id);
            $API->read();
            $API->disconnect();

            return redirect()->back()->with('success', 'IP Binding has been disabled successfully.');
        } else {
            return "Failed to connect to MikroTik Router.";
        }
    }

    public function connect(Request $request)
{
    $request->validate([
        'host' => 'required',
        'username' => 'required',
        'password' => 'required',
    ]);

    $host = $request->post('host');
    $username = $request->post('username');
    $password = $request->post('password');
    $keepPassword = $request->has('keep_password');

    $API = new RouterosAPI();
    $API->debug = false;

    if ($API->connect($host, $username, $password)) {
        // Simpan data ke dalam session
        $request->session()->put([
            'host' => $host,
            'username' => $username,
            'password' => $password,
            'connected' => true,
        ]);

        // Jika "Keep Password" dicentang, simpan juga statusnya
        if ($keepPassword) {
            $request->session()->put('keep_password', true);
        } else {
            // Jika tidak dicentang, hapus status "Keep Password" dari session
            $request->session()->forget('keep_password');
        }

        // Redirect ke halaman netwatch
        return redirect('/ip-binding');
    } else {
        // Jika koneksi gagal, kembalikan ke halaman login dengan pesan error
        return redirect('/login')->with('error', 'Failed to connect to MikroTik Router.');
    }
}




public function disconnect(Request $request)
{
    // Hapus semua data terkait login dari session
    $request->session()->forget(['host', 'username', 'password', 'keep_password']);

    // Set status connected ke false
    $request->session()->put('connected', false);

    return redirect('/home');
}

}

