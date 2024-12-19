<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    // Menampilkan daftar pesanan dengan filter urutan dan notifikasi
    public function indexAdmin(Request $request)
    {
        // Ambil nilai filter (default: descending)
        $sortOrder = $request->input('sort', 'desc');

        // Ambil semua pesanan dan urutkan berdasarkan tanggal pembelian
        $orders = Order::orderBy('tanggal_pembelian', $sortOrder)->get();

        // Menghitung jumlah pesanan baru (status pending)
        $newOrderCount = Order::where('status', 'pending')->count();

        // Set session notifikasi jika ada pesanan baru
        if ($newOrderCount > 0) {
            session()->put('new_order_count', $newOrderCount);
        } else {
            session()->forget('new_order_count');
        }

        return view('admin.orders.index', compact('orders', 'sortOrder'));
    }

    // Menampilkan detail pesanan tertentu
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // Mengupdate status pesanan
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Validasi status yang diizinkan
        if (in_array($request->status, ['pending', 'processed', 'completed'])) {
            $order->status = $request->status;
            $order->save();

            return redirect()->route('admin.orders.index')->with('success', 'Status pesanan berhasil diperbarui.');
        }

        return redirect()->route('admin.orders.index')->with('error', 'Status tidak valid.');
    }

    // Menampilkan daftar pesanan untuk admin (update)
    public function index(Request $request)
    {
        // Ambil nilai filter urutan (default: descending untuk pesanan terbaru)
        $sortOrder = $request->input('sort', 'desc');

        // Ambil semua pesanan dan urutkan berdasarkan tanggal pembelian
        $orders = Order::orderBy('tanggal_pembelian', $sortOrder)->get();

        return view('admin.orders.index', compact('orders', 'sortOrder'));
    }
}
