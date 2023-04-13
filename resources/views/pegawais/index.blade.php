@extends('adminlte::page')

@section('title', 'List Pegawai')

@section('content_header')
    <h1 class="m-0 text-dark">List Pegawai RS Ernaldi Bahar</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a href="{{route('pegawais.create')}}" class="btn btn-success my-2">
                        <i class="fa fa-plus"></i> Tambah Pegawai
                    </a>
                    <a href="/cetakPegawai" class="btn btn-danger my-2">
                        <i class="far fa-fw fa-file"></i> PDF
                    </a>
                    <table class="table table-hover table-bordered table-stripped" id="pegawaiTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>No. Pegawai</th>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>JK</th>
                            <th>Tk Pddkan</th>
                            <th>Status Pekerjaan</th>
                            <th>Status Jabatan</th>
                            <th>Bidang/Bagian Tempat Bekerja</th>
                            <th style="width:100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pegawais as $pegawai)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$pegawai->no_pegawai}}</td>
                                <td>{{$pegawai->email_address}}</td>
                                <td>{{$pegawai->nama_pegawai}}</td>
                                <td>{{$pegawai->jk}}</td>
                                <td>{{$pegawai->tk_pddkan}}</td>
                                <td>{{$pegawai->status_pekerjaan}}</td>
                                <td>{{$pegawai->status_jabatan}}</td>
                                <td>{{$pegawai->bidang}}</td>
                                <td>
                                    <a href="{{route('pegawais.edit', $pegawai)}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-pencil-square"></i>
                                    </a>
                                    <a href="{{route('pegawais.destroy', $pegawai)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-sm" >
                                        <i class="fa fa-trash" aria-hidden="true"></i>
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
        $('#pegawaiTable').DataTable({
            "responsive": true,
        });

        function notificationBeforeDelete(event, el) {
            event.preventDefault();
            if (confirm('Apakah anda yakin akan menghapus data ? ')) {
                $("#delete-form").attr('action', $(el).attr('href'));
                $("#delete-form").submit();
            }
        }

    </script>
@endpush
