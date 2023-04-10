@extends('adminlte::page')

@section('title', 'List User')

@section('content_header')
    <h1 class="m-0 text-dark">List Orientasi</h1>
@stop

@section('content')
@push('scripts')
<!-- Scripts -->
@endpush
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-primary" href="{{ route('orientasis.create') }}"> Tambah</a>
                    <a class="btn btn-danger" href="{{ route('cetakorientasi') }}" target="_blank">PDF</a>
                    <a class="btn btn-success" href="{{ route('orientasis.create') }}"> Excel</a>
                    <br>
                <br>
                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tgl Mulai</th>
                            <th>Tgl Selesai</th>
                            <th>Pendidikan</th>
                            @if(auth()->user()->role=='admin')
                            <th>Created_at</th>
                            <th>Updated_at</th>
                            @endif
                            <th width="280px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orientasis as $key => $orientasi)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $orientasi->name }}</td>
                                <td>{{ date('d M Y', strtotime($orientasi->tgl_orientasi)) }}</td>
                                <td>{{ date('d M Y', strtotime($orientasi->tgl_selesaiorientasi)) }}</td>
                                <td>{{ $orientasi->pendidikan }}</td>
                                @if(auth()->user()->role=='admin')
                                <td>{{ $orientasi->created_at }}</td>
                                @endif
                                @if(auth()->user()->role=='admin')
                                <td>{{ $orientasi->updated_at }}</td>
                                @endif
                                <td>
                                <a class="btn btn-info btn-xs" href="{{ route('orientasis.show',$orientasi->id) }}">Show</a>
                                <a class="btn btn-primary btn-xs" href="{{ route('orientasis.edit',$orientasi->id) }}">Edit</a>
                                <a href="{{route('orientasis.destroy', $orientasi->id)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
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
    @stack('scripts')
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
