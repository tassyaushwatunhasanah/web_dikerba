@extends('adminlte::page')

@section('title', 'List Detail Peserta Pelatihan')

@section('content_header')
    <h1 class="m-0 text-dark">Detail Peserta Kegiatan Pelatihan</h1>
@stop

@section('content')
<!-- Modal Peserta Input -->
<div class="modal fade" id="ihtPesertaModal" data-backdrop="false" data-keyboard="false" tabindex="-1" aria-labelledby="ihtModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ihtModalLabel">Form Peserta IHT</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="/addPeserta">
                    @csrf
                    <div class="mb-3">
                        <label for="namaInput" class="form-label">Nama Peserta</label>
                        <input type="text" class="form-control @error('nama_peserta') is-invalid @enderror" aria-describedby="namaHelp" placeholder="Nama Peserta" name="nama_peserta" value="{{ old('nama_peserta') }}">
                        @error('nama_peserta')
                        <div class="invalid-feedback">
                            {{$message}};
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tempatTugasInput" class="form-label">Tempat Tugas</label>
                        <select type="text" class="form-control @error('tempat_tugas') is-invalid @enderror"  name="tempat_tugas" value="{{ old('tempat_tugas') }}">
                                <option disabled selected value>---Bidang atau Bagian---</option>
                                <option value='Direktur' {{old('tempat_tugas') == 'Direktur' ? "selected" : ""}}>Direktur</option>
                                <option value='Wakil Direktur Umum dan Keuangan' {{old('tempat_tugas') == 'Wakil Direktur Umum dan Keuangan' ? "selected" : ""}}>Wakil Direktur Umum dan Keuangan</option>
                                <option value='Wakil Direktur Medik dan Keperawatan' {{old('tempat_tugas') == 'Wakil Direktur Medik dan Keperawatan' ? "selected" : ""}}>Wakil Direktur Medik dan Keperawatan</option>
                                <option value='Bagian Pengembangan' {{old('tempat_tugas') == 'Bagian Pengembangan' ? "selected" : ""}}>Bagian Pengembangan</option>
                                <option value='Bagian Keuangan' {{old('tempat_tugas') == 'Bagian Keuangan' ? "selected" : ""}}>Bagian Keuangan</option>
                                <option value='Bagian Umum dan SDM' {{old('tempat_tugas') == 'Bagian Umum dan SDM' ? "selected" : ""}}>Bagian Umum dan SDM</option>
                                <option value='Bidang Pelayanan Medik' {{old('tempat_tugas') == 'Bidang Pelayanan Medik' ? "selected" : ""}}>Bidang Pelayanan Medik</option>
                                <option value='Bidang Penunjang Medik' {{old('tempat_tugas') == 'Bidang Penunjang Medik' ? "selected" : ""}}>Bidang Penunjang Medik</option>
                                <option value='Bidang Keperawatan' {{old('tempat_tugas') == 'Bidang Keperawatan' ? "selected" : ""}}>Bidang Keperawatan</option>
                            </select>
                        @error('tempat_tugas')
                        <div class="invalid-feedback">
                            {{$message}};
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="detail_iht_id" value="{{ $detailIht->id }}">
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="iht_id" value="{{ $iht->id }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="simpanBtn">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Narasumber Input -->
<div class="modal fade" id="ihtNarasumberModal" data-backdrop="false" data-keyboard="false" tabindex="-1" aria-labelledby="ihtModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ihtModalLabel">Form Narasumber IHT</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="/addNarasumber">
                    @csrf
                    <div class="mb-3">
                        <label for="namaInput" class="form-label">Nama Narasumber</label>
                        <input type="text" class="form-control @error('nama_narasumber') is-invalid @enderror" aria-describedby="namaHelp" placeholder="Nama Narasumber" name="nama_narasumber" value="{{ old('nama_narasumber') }}">
                        @error('nama_narasumber')
                        <div class="invalid-feedback">
                            {{$message}};
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="instansiInput" class="form-label">Instansi Unit Kerja</label>
                        <input type="text" class="form-control @error('instansi') is-invalid @enderror"  aria-describedby="namaHelp" placeholder="Instansi Unit Kerja" name="instansi" value="{{ old('instansi') }}">
                        @error('instansi')
                        <div class="invalid-feedback">
                            {{$message}};
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="detail_iht_id" value="{{ $detailIht->id }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Peserta Detail Edit-->
<div class="modal fade" id="ihtPesertaEditModal" data-backdrop="false" data-keyboard="false" tabindex="-1" aria-labelledby="ihtPesertaEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ihtPesertaEditLabel">Form Edit Peserta Kegiatan Pelatihan</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('iht.updatePeserta') }}" id="editDetailPesertaForm">
                    @method ('patch')
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{old('id')}}">
                    <div class="mb-3">
                        <label for="namaInput" class="form-label">Nama Peserta</label>
                        <input type="text" class="form-control @error('nama_peserta') is-invalid @enderror" aria-describedby="namaHelp" placeholder="Nama Peserta" id="nama_peserta" name="nama_peserta" value="{{ old('nama_peserta') }}">
                        @error('nama_peserta')
                        <div class="invalid-feedback">
                            {{$message}};
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tempatTugasInput" class="form-label">Tempat Tugas</label>
                        <select type="text" class="form-control @error('tempat_tugas') is-invalid @enderror" id="tempat_tugas" name="tempat_tugas" value="{{ old('tempat_tugas') }}">
                                <option disabled selected value>---Bidang atau Bagian---</option>
                                <option value='Direktur' {{old('tempat_tugas') == 'Direktur' ? "selected" : ""}}>Direktur</option>
                                <option value='Wakil Direktur Umum dan Keuangan' {{old('tempat_tugas') == 'Wakil Direktur Umum dan Keuangan' ? "selected" : ""}}>Wakil Direktur Umum dan Keuangan</option>
                                <option value='Wakil Direktur Medik dan Keperawatan' {{old('tempat_tugas') == 'Wakil Direktur Medik dan Keperawatan' ? "selected" : ""}}>Wakil Direktur Medik dan Keperawatan</option>
                                <option value='Bagian Pengembangan' {{old('tempat_tugas') == 'Bagian Pengembangan' ? "selected" : ""}}>Bagian Pengembangan</option>
                                <option value='Bagian Keuangan' {{old('tempat_tugas') == 'Bagian Keuangan' ? "selected" : ""}}>Bagian Keuangan</option>
                                <option value='Bagian Umum dan SDM' {{old('tempat_tugas') == 'Bagian Umum dan SDM' ? "selected" : ""}}>Bagian Umum dan SDM</option>
                                <option value='Bidang Pelayanan Medik' {{old('tempat_tugas') == 'Bidang Pelayanan Medik' ? "selected" : ""}}>Bidang Pelayanan Medik</option>
                                <option value='Bidang Penunjang Medik' {{old('tempat_tugas') == 'Bidang Penunjang Medik' ? "selected" : ""}}>Bidang Penunjang Medik</option>
                                <option value='Bidang Keperawatan' {{old('tempat_tugas') == 'Bidang Keperawatan' ? "selected" : ""}}>Bidang Keperawatan</option>
                            </select>
                        @error('tempat_tugas')
                        <div class="invalid-feedback">
                            {{$message}};
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="detail_iht_id" value="{{ $detailIht->id }}">
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                         <button type="submit" id="update_data" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Narasumber Detail Edit-->
<div class="modal fade" id="ihtNarasumberEditModal" data-backdrop="false" data-keyboard="false" tabindex="-1" aria-labelledby="ihtNarasumberEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ihtNarasumberEditLabel">Form Edit Narasumber Kegiatan Pelatihan</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('iht.updateNarasumber') }}" id="editDetailNarasumberForm">
                    @method ('patch')
                    @csrf
                    <input type="hidden" id="idNarasumber" name="id" value="{{old('id')}}">
                    <div class="mb-3">
                        <label for="namaInput" class="form-label">Nama Narasumber</label>
                        <input type="text" class="form-control @error('nama_narasumber') is-invalid @enderror" aria-describedby="namaHelp" placeholder="Nama Narasumber" id="nama_narasumber" name="nama_narasumber" value="{{ old('nama_narasumber') }}">
                        @error('nama_narasumber')
                        <div class="invalid-feedback">
                            {{$message}};
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="instansiInput" class="form-label">Instansi Unit Kerja</label>
                        <input type="text" class="form-control @error('instansi') is-invalid @enderror" aria-describedby="instansiHelp" placeholder="Instansi Unit Kerja" id="instansi" name="instansi" value="{{ old('instansi') }}">
                        @error('instansi')
                        <div class="invalid-feedback">
                            {{$message}};
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="detail_iht_id" value="{{ $detailIht->id }}">
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                         <button type="submit" id="update_data" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- Input -->
                <!-- Message if success -->
                @if (session('status'))
                <div class="alert alert-success" style="padding: 10px">
                    {{session('status')}}
                </div>
                @endif
                <?php
                    $connection=mysqli_connect("localhost", "root", "", "web_dikerba");
                    $query="SELECT id FROM peserta_ihts where detail_iht_id = $detailIht->id ORDER BY id";
                    $query_run = mysqli_query($connection, $query);
                    $rowA=mysqli_num_rows($query_run);
                ?>
                <?php
                    $connection=mysqli_connect("localhost", "root", "", "web_dikerba");
                    $query="SELECT id FROM narasumber_ihts where detail_iht_id = $detailIht->id ORDER BY id";
                    $query_run = mysqli_query($connection, $query);
                    $rowB=mysqli_num_rows($query_run);
                ?>
                <!-- Table Peserta -->
                <h4 style="text-align: left;"> Daftar Peserta</h4>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success my-2" id="pesertaBtn">
                    <i class="fa fa-plus"></i> Tambah Peserta
                </button>
                <a href="/cetakPeserta/{{$iht['id']}}/{{$detailIht['id']}}" class="btn btn-danger my-2">
                    <i class="far fa-fw fa-file"></i> PDF
                </a>
                <p style="text-align: left; margin: 12px 0px;">Jumlah peserta: <b>{{ $detailIht->peserta}}</b></p>
                <!-- Show Data Peserta -->
                <table class="table table-hover table-bordered table-stripped"  id="pesertaTable" style= "width: 100%">
                    <thead class="table-light">
                        <tr>
                            <th >No.</th>
                            <th scope="col" class="d-none d-X-block"></th>
                            <th >Nama Peserta</th>
                            <th> Tempat Tugas </th>
                            <th >Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($pesertaIht)>0)
                        @foreach($pesertaIht as $pesertaIht)
                            <tr>
                                <th scope="row"></th>
                                <td class="d-none d-X-block">{{$pesertaIht->id}}</td>
                                <td>{{ $pesertaIht->nama_peserta}}</td>
                                <td>{{ $pesertaIht->tempat_tugas}}</td>
                                <td>
                                    <a href="" class=" btn btn-success editbtn btn-sm" style="margin: 3px 1px;" data-toggle="modal" data-target="#ihtPesertaEditModal"><i class="fa fa-pencil-square"></i></a>
                                    <form action="/deletePeserta/{{$pesertaIht->id}}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" style="bmargin: 3px 1px;" onclick="return confirm('Hapus data?')"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                <!-- Table Narasumber -->
                <br><br>
                <h4 style="text-align: left;"> Daftar Narasumber</h4>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success my-2" id="narasumberBtn">
                    <i class="fa fa-plus"></i> Tambah Narasumber
                </button>
                <p style="text-align: left; margin: 12px 0px;">Jumlah narasumber: <b>{{ $detailIht->narasumber}}</b></p>
                <!-- Show Data Narasumber -->
                <table class="table table-hover table-bordered table-stripped"  id="narasumberTable" style= "width: 100%">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th scope="col" class="d-none d-X-block"></th>
                            <th>Nama Narasumber</th>
                            <th>Instansi Unit Kerja</th>
                            <th >Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($narasumberIht)>0)
                        @foreach($narasumberIht as $narasumberIht)
                            <tr>
                                <th scope="row"></th>
                                <td class="d-none d-X-block">{{$narasumberIht->id}}</td>
                                <td>{{ $narasumberIht->nama_narasumber}}</td>
                                <td>{{ $narasumberIht->instansi}}</td>
                                <td>
                                <a href="" class=" btn btn-success editbtn btn-sm" style="margin: 3px 1px;" data-toggle="modal" data-target="#ihtNarasumberEditModal"><i class="fa fa-pencil-square"></i></a>
                                    <form action="/deleteNarasumber/{{$narasumberIht->id}}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" style="margin: 3px 1px;" onclick="return confirm('Hapus data?')"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>

            <br><br>

            <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

            <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
            <link href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css" rel="stylesheet"/>

            <script type="text/javascript" src="{{ URL::asset('js/vfs_fonts.js') }}"></script>

            <script type="text/javascript">


                $(document).ready(function (){
                    //peserta
                    var table1=$('#pesertaTable').DataTable({
                        "columnDefs": [
                            { "searchable": false,
                                "orderable": false,
                                "targets": [0,3]
                            } //disable first and last column sorting
                        ],
                    });
                    //fixed number first column
                    table1.on( 'order.dt search.dt', function () {
                        table1.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                            cell.innerHTML = i+1;
                            table1.cell(cell).invalidate('dom');//generate to pdf/excel
                        } );
                    } ).draw();
                    //script for edit old value
                    table1.on('click', '.editbtn', function(){
                        $tr=$(this).closest('tr');
                        if ($($tr).hasClass('child')){
                            $tr=$tr.prev('.parent');
                        }
                        var data=table1.row($tr).data();
                        console.log(data);
                        $('#id').val(data[1]);
                        $('#nama_peserta').val(data[2]);
                        $('#tempat_tugas').val(data[3]);

                        $('#editDetailPesertaForm').attr('action'+data[1]);
                        $('#ihtPesertaEditModal').modal('show');
                    });

                    //narasumber
                    var table2=$('#narasumberTable').DataTable({
                        "columnDefs": [
                            { "searchable": false,
                                "orderable": false,
                                "targets": [0,3]
                            } //disable first and last column sorting
                        ],
                    });
                    //fixed number first column
                    table2.on( 'order.dt search.dt', function () {
                        table2.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                            cell.innerHTML = i+1;
                            table2.cell(cell).invalidate('dom');//generate to pdf/excel
                        } );
                    } ).draw();
                    //script for edit old value
                    table2.on('click', '.editbtn', function(){
                        $tr=$(this).closest('tr');
                        if ($($tr).hasClass('child')){
                            $tr=$tr.prev('.parent');
                        }
                        var data=table2.row($tr).data();
                        console.log(data);
                        $('#idNarasumber').val(data[1]);
                        $('#nama_narasumber').val(data[2]);
                        $('#instansi').val(data[3]);

                        $('#editDetailNarasumberForm').attr('action'+data[1]);
                        $('#ihtNarasumberEditModal').modal('show');
                    });
                });
            </script>
            <script type="text/javascript">
                $(function(){
                    $( "#pesertaBtn" ).click(function() {
                        <?php
                        if ($rowA < $detailIht->peserta){
                        ?>
                            $('#ihtPesertaModal').modal('show');
                        <?php
                        }
                        else{
                        ?>
                        alert("Peserta sudah mencapai batas");

                            <?php
                        }
                        ?>

                    });
                });
            </script>
            <script type="text/javascript">
                $(function(){
                    $( "#narasumberBtn" ).click(function() {
                        <?php
                        if ($rowB < $detailIht->narasumber){
                        ?>
                            $('#ihtNarasumberModal').modal('show');
                        <?php
                        }
                        else{
                        ?>
                        alert("Narasumber sudah mencapai batas");
                            <?php
                        }
                        ?>

                    });
                });
            </script>
            </div>
        </div>
    </div>
</div>
@stop
