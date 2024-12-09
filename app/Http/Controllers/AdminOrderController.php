<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    // Menampilkan daftar pesanan
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    // Menampilkan detail pesanan
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // Mengupdate status pesanan
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Perbarui status pesanan
        if (in_array($request->status, ['pending', 'processed', 'completed'])) {
            $order->status = $request->status;
            $order->save();

            return redirect()->route('admin.orders.index')->with('success', 'Status pesanan berhasil diperbarui.');
        }

        return redirect()->route('admin.orders.index')->with('error', 'Status tidak valid.');
    }
}
