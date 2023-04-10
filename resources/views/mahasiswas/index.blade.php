@extends('adminlte::page')

@section('title', 'Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Data Mahasiswa Praktik</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a class="btn btn-primary" href="{{ route('mahasiswas.create') }}"> Tambah</a>
                    <a class="btn btn-danger" href="{{ route('cetakmahasiswa') }}" target="_blank">PDF</a>
                    <a class="btn btn-success" href="{{ route('mahasiswas.create') }}"> Excel</a>
                    <br><br>

                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Instansi</th>
                            <th>Nama Mahasiswa</th>
                            <th>Tanggal Masuk</th>
                            <th>Tanggal Keluar</th>
                            <th>Nama Ruangan</th>
                            <th>Keterangan</th>
                            <th>Kelulusan</th>
                            @if(auth()->user()->role=='admin')
                            <th>Created_at</th>
                            <th>Updated_at</th>
                            @endif
                            <th width="280px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $mahasiswa)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $mahasiswa->univ_name }}</td>
                                <td>{{ $mahasiswa->nama_mahasiswa }}</td>
                                <td>{{ date('d M Y', strtotime($mahasiswa->tgl_mulai)) }}</td>
                                <td>{{ date('d M Y', strtotime($mahasiswa->tgl_selesai)) }}</td>
                                <td>{{ $mahasiswa->ruangan_name }}</td>
                                <td>{{ $mahasiswa->keterangan }}</td>
                                <td>{{ $mahasiswa->Kelulusan }}</td>
                                @if(auth()->user()->role=='admin')
                                <td>{{ $mahasiswa->created_at }}</td>
                                @endif
                                @if(auth()->user()->role=='admin')
                                <td>{{ $mahasiswa->updated_at }}</td>
                                @endif
                                <td>
                                <a class="btn btn-info btn-xs" href="{{ route('mahasiswas.show',$mahasiswa->id) }}">Show</a>
                                <a class="btn btn-primary btn-xs" href="{{ route('mahasiswas.edit',$mahasiswa->id) }}">Edit</a>
                                <a href="{{route('mahasiswas.destroy', $mahasiswa->id)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
                                    Delete
                                </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <form action="" id="delete-form" method="post">
        @method('delete')
        @csrf
    </form>
    <script>
        var table=$('#example2').DataTable({
            "responsive": true,
        });
        //fixed number first column
        table.on('order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
        table.cell(cell).invalidate('dom');//generate to pdf/excel
         } );
            } ).draw();
        function notificationBeforeDelete(event, el) {
            event.preventDefault();
            if (confirm('Apakah anda yakin akan menghapus data ? ')) {
                $("#delete-form").attr('action', $(el).attr('href'));
                $("#delete-form").submit();
            }
        }

    </script>
@endpush



