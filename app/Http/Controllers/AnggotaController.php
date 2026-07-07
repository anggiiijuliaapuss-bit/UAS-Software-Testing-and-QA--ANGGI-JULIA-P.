<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('q');

        $anggota = Anggota::when($keyword, function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('nama', 'like', "%{$keyword}%")
                        ->orWhere('kode_anggota', 'like', "%{$keyword}%")
                        ->orWhere('email', 'like', "%{$keyword}%")
                        ->orWhere('no_hp', 'like', "%{$keyword}%");
                });
            })
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view('anggota.index', compact('anggota', 'keyword'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        Anggota::create($validated);

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function edit(Anggota $anggotum)
    {
        return view('anggota.edit', ['anggota' => $anggotum]);
    }

    public function update(Request $request, Anggota $anggotum)
    {
        $validated = $this->validateData($request, $anggotum->id);

        $anggotum->update($validated);

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(Anggota $anggotum)
    {
        if ($anggotum->peminjamanAktif()->exists()) {
            return back()->with('error', 'Anggota tidak dapat dihapus karena masih memiliki peminjaman aktif.');
        }

        $anggotum->delete();

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus.');
    }

    private function validateData(Request $request, $id = null): array
    {
        return $request->validate([
            'kode_anggota' => ['required', 'string', 'max:50', 'unique:anggota,kode_anggota,'.$id],
            // Nama: wajib diisi, hanya boleh huruf alfabet dan spasi (tidak boleh angka/karakter khusus)
            'nama' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'alamat' => ['nullable', 'string'],
            // No HP: wajib diisi, harus diawali 08 atau +62, total panjang 10-13 digit
            'no_hp' => ['required', 'string', 'regex:/^(\+62|08)[0-9]{8,11}$/', 'unique:anggota,no_hp,'.$id],
            // Email: wajib diisi, harus format email valid (otomatis mengandung '@')
            'email' => ['required', 'email', 'max:255', 'unique:anggota,email,'.$id],
            'tgl_daftar' => ['nullable', 'date'],
        ], [
            'kode_anggota.unique' => 'Kode anggota sudah digunakan.',
            'nama.regex' => 'Nama lengkap hanya boleh berisi huruf dan spasi, tidak boleh mengandung angka atau karakter khusus.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.regex' => 'Nomor HP harus diawali 08 atau +62 dan berjumlah 10-13 digit.',
            'no_hp.unique' => 'Nomor HP sudah terdaftar.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid, pastikan menggunakan tanda @.',
            'email.unique' => 'Email sudah terdaftar.',
        ]);
    }
}
