<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\CoffeeForm;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // GET: Ambil semua data
        return response()->json(Order::with('coffeeForm')->get(), 200);
    }

    public function store(Request $request)
    {
        // POST: Tambah data baru
        $data = $request->validate([
            'coffee_form_id' => 'required|exists:coffee_forms,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
        ]);

        $order = Order::create($data);
        return response()->json(['message' => 'Order created', 'data' => $order], 201);
    }

    public function show($id)
    {
        // GET: Ambil data berdasarkan ID
        $order = Order::with('coffeeForm')->find($id);
        if (!$order) {
            return response()->json(['error' => 'Data not found'], 404);
        }
        return response()->json($order, 200);
    }

    public function update(Request $request, $id)
    {
        // PUT: Perbarui data
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['error' => 'Data not found'], 404);
        }

        $data = $request->validate([
            'coffee_form_id' => 'sometimes|exists:coffee_forms,id',
            'quantity' => 'sometimes|integer|min:1',
            'total_price' => 'sometimes|numeric|min:0',
        ]);

        $order->update($data);
        return response()->json(['message' => 'Order updated', 'data' => $order], 200);
    }

    public function destroy($id)
    {
        // DELETE: Hapus data
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['error' => 'Data not found'], 404);
        }

        $order->delete();
        return response()->json(['message' => 'Order deleted'], 200);
    }
}
