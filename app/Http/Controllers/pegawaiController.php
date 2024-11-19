<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class pegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::paginate();
        return view(
            'Pegawai.pegawai', compact(
                'data'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'level' => 'required'
        ]);

        $save = new User();
        $save->name = $request->name;
        $save->email = $request->email;
        $save->password = Hash::make($request->password);
        $save->level = $request->level;
        $save->save();

        return redirect()->back()->with(
            'message',
            'Data Pegawai' .$request->name. 'Berhasil ditambahkan'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::find($id);
        return view('Pegawai.editPegawai', compact(
            'data'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'password' => 'nullable|min:8',
            'level' => 'nullable',
        ], [
            'name.required' => 'Data wajib diisi',
            'email.email' => 'Format email tidak sesuai!!!',
            'email.unique' => 'Password minimal 8 karakter',
        ]);

        $update = User::find($id);
        $update->name = $request->name;

        if ($request->filled('email') && $request->email != $update->email) {
            $request->validate([
                'email' => 'unique:users,email',
            ],[
                'email.unique' => 'Email Sudah terdaftar'
            ]);
            $update->email = $request->email;
        }

        if ($request->filled('password')) {
            $update->password = $request->password;
        }

        if ($request->filled('level')) {
            $update->level = $request->level;
        }

        $update->save();

        return redirect('/pegawai')->with(
            'message',
            'Data '. $request->name. ' Berhasil di Perbaharui'
        );
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hapus = User::find($id);
        $hapus->delete();

        return redirect()->back()->with(
            'message',
            'Data ' . $hapus->name . 'berhasil dihapus!'
        );
    }
}
