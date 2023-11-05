<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlah_user = User::where('role_id', '!=', '1')->count();

        $sekarang = now();
        $bulan_sebelumnya = $sekarang->subMonth();
        $tanggal_awal = $bulan_sebelumnya->startOfMonth();
        $tanggal_akhir = $bulan_sebelumnya->endOfMonth();

        $jumlah_user_bulan_sebelumnya = User::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->count();

        if ($jumlah_user_bulan_sebelumnya > 0) {
            $persentase_pertumbuhan = (($jumlah_user - $jumlah_user_bulan_sebelumnya) / $jumlah_user_bulan_sebelumnya) * 100;
        } else {
            $persentase_pertumbuhan = 0;
        }

        return view('content.dashboard', [
            'jumlah_user' => $jumlah_user,
            'persentase_pertumbuhan' => $persentase_pertumbuhan,
            'bulan_sekarang' => $tanggal_akhir->format('F'),
            'bulan_kemarin' => $tanggal_awal->format('F'),
        ]);
    }
}
