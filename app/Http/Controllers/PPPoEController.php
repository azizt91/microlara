<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RouterosAPI;

class PPPoEController extends Controller
{
    public function indexPPPoE()
    {
        $host = session()->get('host');
        $username = session()->get('username');
        $password = session()->get('password');
        $API = new RouterosAPI();
        $API->debug = false;

        if ($API->connect($host, $username, $password)) {
            $pppoeSecrets = $API->comm('/ppp/secret/print');

            $API->disconnect();

            $data = [
                'pppoeSecrets' => $pppoeSecrets,
            ];

            
            // Tampilkan halaman dengan data PPPoE
            return view('pppoe', $data);
        } else {
            return redirect('failed');
        }
    }

public function enablePPPoE($id)
{
    $host = session()->get('host');
    $username = session()->get('username');
    $password = session()->get('password');
    $API = new RouterosAPI();
    $API->debug = false;

    // Lakukan koneksi ke perangkat MikroTik
    if ($API->connect($host, $username, $password)) {
        // Mengaktifkan PPPoE dengan ID tertentu
        $API->write('/ppp/secret/enable', false);
        $API->write('=.id=' . $id);
        $API->read();
        $API->disconnect();

        return redirect()->back()->with('success', 'PPPoE user has been enabled successfully.');
    } else {
        return "Failed to connect to MikroTik Router.";
    }
}

public function disablePPPoE($id)
{
    $host = session()->get('host');
    $username = session()->get('username');
    $password = session()->get('password');
    $API = new RouterosAPI();
    $API->debug = false;

    // Lakukan koneksi ke perangkat MikroTik
    if ($API->connect($host, $username, $password)) {
        // Menonaktifkan PPPoE dengan ID tertentu
        $API->write('/ppp/secret/disable', false);
        $API->write('=.id=' . $id);
        $API->read();
        $API->disconnect();

        return redirect()->back()->with('success', 'PPPoE user has been disabled successfully.');
    } else {
        return "Failed to connect to MikroTik Router.";
    }
}

}
