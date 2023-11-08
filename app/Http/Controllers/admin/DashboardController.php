<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlah_user = User::where('role_id', '!=', '1')->count();
        $category = GalleryCategory::first()->count();
        $galery = Gallery::first()->count();
        // dd($category);
        $sekarang = now();
        // dd($sekarang->format('F'));
        $bulan_sebelumnya = $sekarang->subMonth();
        $tanggal_awal = $bulan_sebelumnya->startOfMonth();
        $tanggal_akhir = $bulan_sebelumnya->endOfMonth();

        $jumlah_user_bulan_sebelumnya = User::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->count();

        if ($jumlah_user_bulan_sebelumnya > 0) {
            $persentase_pertumbuhan = (($jumlah_user - $jumlah_user_bulan_sebelumnya) / $jumlah_user_bulan_sebelumnya) * 100;
        } else {
            $persentase_pertumbuhan = 100;
        }

        return view('content.dashboard', [
            'jumlah_user' => $jumlah_user,
            'category' => $category,
            'galery' => $galery,
            'persentase_pertumbuhan' => $persentase_pertumbuhan,
            'bulan_sekarang' => $sekarang->format('F'),
            'bulan_kemarin' => $bulan_sebelumnya->format('F'),
        ]);
    }
}
