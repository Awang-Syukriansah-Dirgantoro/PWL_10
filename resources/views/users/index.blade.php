@extends('users.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
            </div>
            <div class="float-right my-2">
                <a class="btn btn-success" href="{{ route('mahasiswa.create') }}"> Input Mahasiswa</a>
            </div>
        </div>
    </div>
    <form method="post" action="{{ url('cari') }}" id="myForm">
        @csrf
        <div class="form-group">
            <label for="Nama">Cari</label>
            <input type="text" name="cari" class="form-control" id="Nama" aria-describedby="Nama"
                placeholder="Cari Berdasarkan Nama">
        </div>
        <button type="submit" class="btn btn-success mt-3">
            cari
        </button>
    </form>
    <br>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>Nim</th>
            <th>Nama</th>
            <th>Foto</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>No_Handphone</th>
            <th>E-mail</th>
            <th>Tanggal_Lahir</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($mahasiswas as $Mahasiswa)
            <tr>
                <td>{{ $Mahasiswa->Nim }}</td>
                <td>{{ $Mahasiswa->Nama }}</td>
                <td><img width="100px" src="{{ asset('storage/' . $Mahasiswa->featured_image) }}"></td>
                <td>{{ $Mahasiswa->kelas->Nama_Kelas }}</td>
                <td>{{ $Mahasiswa->Jurusan }}</td>
                <td>{{ $Mahasiswa->No_Handphone }}</td>
                <td>{{ $Mahasiswa->E_mail }}</td>
                <td>{{ $Mahasiswa->Tanggal_Lahir }}</td>
                <td>
                    <form action="{{ route('mahasiswa.destroy', $Mahasiswa->Nim) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('mahasiswa.show', $Mahasiswa->Nim) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('mahasiswa.edit', $Mahasiswa->Nim) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <a class="btn btn-warning" href="{{ route('mahasiswa.nilai', $Mahasiswa->Nim) }}">Nilai</a>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
