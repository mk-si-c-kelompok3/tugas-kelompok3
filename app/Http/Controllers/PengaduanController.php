<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index()
    {
        $data = Pengaduan::latest()->get();
        return view('pengaduan.index', compact('data'));
    }

    public function create()
    {
        return view('pengaduan.create');
    }

    public function store(Request $r)
    {
        $r->validate([
            'nama'  => 'required',
            'judul' => 'required',
            'isi'   => 'required',
        ]);

        Pengaduan::create($r->only('nama', 'kontak', 'judul', 'isi'));

        return redirect()->route('pengaduan.index')
            ->with('ok', 'Pengaduan terkirim. Terima kasih!');
    }

    // ubah status sederhana
    public function update(Request $r, Pengaduan $pengaduan)
    {
        $r->validate(['status' => 'required|in:baru,diproses,selesai']);
        $pengaduan->update(['status' => $r->status]);
        return back()->with('ok', 'Status diperbarui.');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        $pengaduan->delete();
        return back()->with('ok', 'Data dihapus.');
    }
}
