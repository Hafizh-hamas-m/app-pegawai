<?php

namespace App\Http\Controllers;

use App\Models\Employee; 
use Illuminate\Http\Request;
// Hapus baris Route::resource(...) di sini

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::paginate(5);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        // Validasi Data
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees,email',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|string|max:50', 
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')
                         ->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    // Tambahkan method resource lainnya (show, edit, update, destroy) di bawah ini
}