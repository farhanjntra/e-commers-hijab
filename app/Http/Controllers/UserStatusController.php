<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserStatusController extends Controller
{
    /**
     * Menampilkan daftar status pesanan untuk user yang sedang login.
     */
    public function index(Request $request)
    {
        // Ambil nilai filter urutan (default: descending untuk pesanan terbaru)
        $sortOrder = $request->input('sort', 'desc');

        // Ambil pesanan berdasarkan pengguna yang sedang login
        $orders = Order::where('nama_pembeli', Auth::user()->name)
                       ->orderBy('created_at', $sortOrder)
                       ->get();

        // Arahkan ke view user
        return view('user.status.index', compact('orders', 'sortOrder'));
    }
}
