<?php

namespace App\Http\Controllers;

use App\Models\CoffeeForm;
use Illuminate\Http\Request;

class CoffeeFormController extends Controller
{
    public function index()
    {
        // GET: Ambil semua data
        return response()->json(CoffeeForm::all(), 200);
    }

    public function show($id)
    {
        // GET: Ambil data berdasarkan ID
        $coffeeForm = CoffeeForm::find($id);
        if (!$coffeeForm) {
            return response()->json(['error' => 'Data not found'], 404);
        }
        return response()->json($coffeeForm, 200);
    }

    public function store(Request $request)
    {
        // POST: Tambah data baru
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|string|max:20',
            'guests' => 'required|integer|min:1',
        ]);

        $coffeeForm = CoffeeForm::create($data);
        return response()->json(['message' => 'Booking created', 'data' => $coffeeForm], 201);
    }

    public function update(Request $request, $id)
    {
        // PUT: Perbarui data
        $coffeeForm = CoffeeForm::find($id);
        if (!$coffeeForm) {
            return response()->json(['error' => 'Data not found'], 404);
        }

        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'number' => 'sometimes|required|string|max:20',
            'guests' => 'sometimes|required|integer|min:1',
        ]);

        $coffeeForm->update($data);
        return response()->json(['message' => 'Booking updated', 'data' => $coffeeForm], 200);
    }

    public function destroy($id)
    {
        // DELETE: Hapus data
        $coffeeForm = CoffeeForm::find($id);
        if (!$coffeeForm) {
            return response()->json(['error' => 'Data not found'], 404);
        }

        $coffeeForm->delete();
        return response()->json(['message' => 'Booking deleted'], 200);
    }
}
