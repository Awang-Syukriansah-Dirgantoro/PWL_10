<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\Mahasiswa_MataKuliah;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fungsi eloquent menampilkan data menggunakan pagination
        $mahasiswas = Mahasiswa::with('kelas')->get(); // Mengambil semua isi tabel
        $posts = Mahasiswa::orderBy('Nim', 'desc')->paginate(5);
        //dd($mahasiswas);
        return view('users.index', compact('mahasiswas'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function create()
    {
        $kelas = Kelas::all();
        return view('users.create', ['kelas' => $kelas]);
    }
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
            'image' => 'required',
        ]);

        $image_name = '';

        if ($request->hasFile('image')) {
            $image_name = $request->file('image')->store('images', 'public');
        }
        //dd($image_name);

        $kelas = Kelas::find($request->get('Kelas'));

        $mahasiswa = new Mahasiswa();
        $mahasiswa->Nim = $request->get('Nim');
        $mahasiswa->Nama = $request->get('Nama');
        $mahasiswa->Jurusan = $request->get('Jurusan');
        $mahasiswa->No_Handphone = $request->get('No_Handphone');
        $mahasiswa->E_mail = $request->get('E_mail');
        $mahasiswa->Tanggal_Lahir = $request->get('Tanggal_Lahir');
        $mahasiswa->featured_image = $image_name;
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }
    public function show($Nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $Mahasiswa = Mahasiswa::with('kelas')->where('Nim', $Nim)->first();
        return view('users.detail', compact('Mahasiswa'));
    }
    public function edit($Nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $Mahasiswa = Mahasiswa::with('kelas')->where('Nim', $Nim)->first();
        $kelas = Kelas::all();
        return view('users.edit', compact('Mahasiswa', 'kelas'));
    }
    public function update(Request $request, $Nim)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
        ]);

        $kelas = Kelas::find($request->get('Kelas'));

        $mahasiswa = Mahasiswa::find($Nim);
        $mahasiswa->Nim = $request->get('Nim');
        $mahasiswa->Nama = $request->get('Nama');
        $mahasiswa->Jurusan = $request->get('Jurusan');
        $mahasiswa->No_Handphone = $request->get('No_Handphone');
        $mahasiswa->E_mail = $request->get('E_mail');
        $mahasiswa->Tanggal_Lahir = $request->get('Tanggal_Lahir');
        $mahasiswa->kelas()->associate($kelas);
        if ($mahasiswa->featured_image && file_exists(storage_path('app/public/' . $mahasiswa->featured_image))) {
            Storage::delete('public/' . $mahasiswa->featured_image);
        }
        $image_name = $request->file('image')->store('images', 'public');
        $mahasiswa->featured_image = $image_name;
        $mahasiswa->save();

        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Diupdate');
    }
    public function destroy($Nim)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiswa::find($Nim)->delete();
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Dihapus');
    }
    public function cari(Request $request)
    {
        $object = $request->cari;
        $mahasiswas = Mahasiswa::where('Nama', 'like', $object . '%')->get();
        return view('users.cari', compact('mahasiswas'));
    }
    public function nilai($Nim)
    {
        $mahasiswa = Mahasiswa::with('kelas', 'matakuliah')->find($Nim);
        return view('users.nilai', compact('mahasiswa'));
    }
};
