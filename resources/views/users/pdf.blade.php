@extends('users.layout')
@section('content')
<div class="row">
    <div class="col-12 text-center">
        <h3><strong>KARTU HASIL STUDI (KHS)</strong></h3>
    </div>
    <div class="col-12 my-4">
        <br>
        <br>
        <p class="m-0"><strong>Nama:</strong> {{ $mahasiswa->Nama }}</p>
        <p class="m-0"><strong>NIM:</strong> {{ $mahasiswa->Nim }}</p>
        <p class="m-0"><strong>Kelas:</strong> {{ $mahasiswa->kelas->Nama_Kelas }}</p>
    </div>
    <div class="col-12">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <table class="table table-bordered">
            <tr>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Semester</th>
                <th>Nilai</th>
            </tr>
            @foreach ($mahasiswa->matakuliah as $matakuliah)
                <tr>
                    <td>{{ $matakuliah->Nama_Matkul }}</td>
                    <td>{{ $matakuliah->Sks }}</td>
                    <td>{{ $matakuliah->Semester }}</td>
                    <td>{{ $matakuliah->pivot->Nilai }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
