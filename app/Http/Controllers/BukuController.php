<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('q');

        $buku = Buku::cari($keyword)
            ->orderBy('judul')
            ->paginate(10)
            ->withQueryString();

        return view('buku.index', compact('buku', 'keyword'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('cover-buku', 'public');
        }

        Buku::create($validated);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function show(Buku $buku)
    {
        return view('buku.show', compact('buku'));
    }

    public function edit(Buku $buku)
    {
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, Buku $buku)
    {
        $validated = $this->validateData($request, $buku->id);

        if ($request->hasFile('cover')) {
            if ($buku->cover) {
                Storage::disk('public')->delete($buku->cover);
            }
            $validated['cover'] = $request->file('cover')->store('cover-buku', 'public');
        }

        $buku->update($validated);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        if ($buku->cover) {
            Storage::disk('public')->delete($buku->cover);
        }

        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
    }

    /**
     * Tampilkan QR Code & Barcode untuk satu buku (Level 3).
     */
    public function kode(Buku $buku)
    {
        return view('buku.kode', compact('buku'));
    }

    private function validateData(Request $request, $id = null): array
    {
        return $request->validate([
            'kode_buku' => ['required', 'string', 'max:50', 'unique:buku,kode_buku,'.$id],
            'judul' => ['required', 'string', 'max:255'],
            'penulis' => ['nullable', 'string', 'max:255'],
            'penerbit' => ['nullable', 'string', 'max:255'],
            'tahun' => ['nullable', 'integer', 'min:1900', 'max:'.(date('Y') + 1)],
            'stok' => ['required', 'integer', 'min:0'],
            'cover' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'kode_buku.unique' => 'Kode buku sudah digunakan.',
            'cover.image' => 'File cover harus berupa gambar.',
            'cover.max' => 'Ukuran cover maksimal 2MB.',
        ]);
    }
}
