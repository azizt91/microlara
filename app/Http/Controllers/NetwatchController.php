<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RouterosAPI;

class NetwatchController extends Controller
{
    public function netwatch()
    {
        $host = session()->get('host');
        $username = session()->get('username');
        $password = session()->get('password');
        $API = new RouterosAPI();
        $API->debug = false;

        if ($API->connect($host, $username, $password)) {

            $netwatch = $API->comm('/tool/netwatch/print');
            $hotspotactive = $API->comm('/ip/hotspot/active/print');
            $resource = $API->comm('/system/resource/print');
            $secret = $API->comm('/ppp/secret/print');
            $secretactive = $API->comm('/ppp/active/print');
            $interface = $API->comm('/interface/ethernet/print');
            $routerboard = $API->comm('/system/routerboard/print');
            $identity = $API->comm('/system/identity/print');

            $statusUpCount = 0;
            $statusDownCount = 0;

            // Hitung jumlah status up dan down
            foreach ($netwatch as $data) {
                if ($data['status'] == 'up') {
                    $statusUpCount++;
                } elseif ($data['status'] == 'down') {
                    $statusDownCount++;
                }
            }

            $data = [
                'netwatchData' => $netwatch,
                'totalsecret' => count($secret),
                'totalhotspot' => count($hotspotactive),
                'hotspotactive' => count($hotspotactive),
                'secretactive' => count($secretactive),
                'cpu' => $resource[0]['cpu-load'],
                'uptime' => $resource[0]['uptime'],
                'version' => $resource[0]['version'],
                'interface' => $interface,
                'boardname' => $resource[0]['board-name'],
                'freememory' => $resource[0]['free-memory'],
                'freehdd' => $resource[0]['free-hdd-space'],
                'model' => $routerboard[0]['model'],
                'identity' => $identity[0]['name'],
                'statusUpCount' => $statusUpCount,
                'statusDownCount' => $statusDownCount,
            ];

            // Tampilkan halaman dengan data netwatch
            return view('netwatch', $data);
        } else {
            return redirect('failed');
        }
    }


}
