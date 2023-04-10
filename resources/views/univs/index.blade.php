@extends('adminlte::page')

@section('title', 'Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Data Instansi</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a class="btn btn-primary" href="{{ route('univs.create') }}"> Tambah</a>
                    <br><br>

                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Instansi</th>
                            @if(auth()->user()->role=='admin')
                            <th>Created_at</th>
                            <th>Updated_at</th>
                            @endif
                            <th width="280px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($univs as $key => $univ)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $univ->univ_name }}</td>
                                @if(auth()->user()->role=='admin')
                                <td>{{ $univ->created_at }}</td>
                                @endif
                                @if(auth()->user()->role=='admin')
                                <td>{{ $univ->updated_at }}</td>
                                @endif
                                <td>
                                <a href="{{ route('univs.edit', $univ->iduniv) }}" class="btn btn-primary btn-xs">Edit</a>
                                <a href="{{route('univs.destroy', $univ->iduniv)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
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



