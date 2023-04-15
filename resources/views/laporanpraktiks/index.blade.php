@extends('adminlte::page')

@section('title', 'Laporan Mahasiswa Praktik | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Laporan Data Mahasiswa Praktik</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('cetaklaporanpraktik') }}" method="post">
                        @csrf

                        <a class="btn btn-primary" href="{{ route('laporanpraktiks.create') }}"> Tambah</a>
                        @foreach ($laporanpraktiks as $laporanpraktik)
                        <input type="text" name="laporanpraktiks[]" value="{{ $laporanpraktik->id }}" hidden>
                        @endforeach

                        <button class="btn btn-danger" type="submit" formtarget="_blank">PDF</button>
                        <a class="btn btn-success" href="{{ route('laporanpraktiks.create') }}"> Excel</a>
                    </form>
                    <br>
                    <form action="{{ route('laporanpraktiks.index') }}" method="GET">
                        &nbsp; <span  class="date-label">From: </span><input class="date_range_filter date" type="date"  name="start_date"/>
                        &nbsp; <span  class="date-label">To: <input class="date_range_filter date" type="date" name="end_date" />

                        <button class="btn btn-primary btn-xs" type="submit">submit</button>
                    </form>
                    <br><br>
                    <table class="table table-hover table-bordered table-stripped table-responsive" id="example2">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Instansi</th>
                            <th>Fakultas</th>
                            <th>Jurusan</th>
                            <th>Program Studi</th>
                            <th>Tingkat Pendidikan</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Kelulusan</th>
                            @if(auth()->user()->role=='admin')
                            <th>Dibuat</th>
                            <th>Diperbaharui</th>
                            @endif
                            <th width="280px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($laporanpraktiks as $key => $laporanpraktik)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $laporanpraktik->univ->univ_name }}</td>
                                <td>{{ $laporanpraktik->fakul->fakul_name }}</td>
                                <td>{{ $laporanpraktik->jurusan->jurusan_name }}</td>
                                <td>{{ $laporanpraktik->prodi->prodi_name }}</td>
                                <td>{{ $laporanpraktik->tingkatpendidikan->tkpendidikan_name }}</td>
                                <td>{{ date('d M Y', strtotime($laporanpraktik->tgl_mulai)) }}</td>
                                <td>{{ date('d M Y', strtotime($laporanpraktik->tgl_selesai)) }}</td>
                                <td>{{ $laporanpraktik->jumlah }}</td>
                                <td>{{ $laporanpraktik->keterangan }}</td>
                                <td>{{ $laporanpraktik->Kelulusan }}</td>
                                @if(auth()->user()->role=='admin')
                                <td>{{ date('d M Y', strtotime($laporanpraktik->created_at)) }}</td>
                                @endif
                                @if(auth()->user()->role=='admin')
                                <td>{{ date('d M Y', strtotime($laporanpraktik->updated_at)) }}</td>
                                @endif
                                <td>
                                <a class="btn btn-primary btn-xs" href="{{ route('laporanpraktiks.edit',$laporanpraktik->id) }}">Edit</a>
                                <a href="{{route('laporanpraktiks.destroy', $laporanpraktik->id)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
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



