@extends('adminlte::page')

@section('title', 'Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Data Mahasiswa Praktik</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <div class="row">

                </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('mahasiswas.update',$mahasiswa->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Nama Mahasiswa</strong>
                                    <input type="text" name="nama_mahasiswa" value="{{ $mahasiswa->nama_mahasiswa }}" class="form-control" placeholder="Nama Mahasiswa">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>NIM</strong>
                                    <input type="text" name="nim" value="{{ $mahasiswa->nim }}" class="form-control" placeholder="NIM (Nomor Induk Mahasiswa)">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Jenis Kelamin</strong>
                                    <select type="text" name="jk" class="form-control" placeholder="Jenis Kelamin">

                                    <?php if ($mahasiswa->jk =='Laki-laki'): ?>
                                            <Option value='Laki-laki' selected>Laki-laki</option>
                                            <Option value='Perempuan'>Perempuan</option>
                                    <?php else: ?>
                                            <Option value='Perempuan' selected>Perempuan</option>
                                            <Option value='Laki-laki'>Laki-laki</option>
                                    <?php endif?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Instansi</strong>
                                    <select type="text" name="univ_id" class="form-control" placeholder="Instansi">
                                            @foreach ($univs as $univ)
                                            <option value="{{ $univ->iduniv }}" @selected($mahasiswa->univ_id==$univ->iduniv)>{{ $univ->univ_name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Fakultas</strong>
                                    <input type="text" name="fakultas" value="{{ $mahasiswa->fakultas }}" class="form-control" placeholder="Fakultas">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Jurusan</strong>
                                    <input type="text" name="jurusan" value="{{ $mahasiswa->jurusan }}" class="form-control" placeholder="Jurusan">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Program Studi</strong>
                                    <input type="text" name="prodi" value="{{ $mahasiswa->prodi }}" class="form-control" placeholder="prodi">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Tingkat Pendidikan</strong>
                                    <input type="text" name="tk_pendidikan" value="{{ $mahasiswa->tk_pendidikan }}" class="form-control" placeholder="Tingkat Pendidikan">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Tanggal Masuk:</strong>
                                    <input type="date" name="tgl_mulai" value="{{ $mahasiswa->tgl_mulai }}" class="form-control" placeholder="Tanggal Masuk">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Tanggal Keluar:</strong>
                                    <input type="date" name="tgl_selesai" value="{{ $mahasiswa->tgl_selesai }}" class="form-control" placeholder="Tanggal Keluar">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Ruangan</strong>
                                    <select type="text" name="ruangan_id" class="form-control" placeholder="Ruangan">
                                            @foreach ($ruangans as $ruangan)
                                            <option value="{{ $ruangan->idruangan }}" @selected($mahasiswa->ruangan_id==$ruangan->idruangan)>{{ $ruangan->ruangan_name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Semester</strong>
                                    <input type="text" name="semester" value="{{ $mahasiswa->semester }}" class="form-control" placeholder="Semester">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Keterangan</strong>
                                    <input type="text" name="keterangan" value="{{ $mahasiswa->keterangan }}" class="form-control" placeholder="Keterangan">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Status Kelulusan</strong>
                                    <select type="text" name="Kelulusan" class="form-control" placeholder="Kelulusan">

                                    <?php if ($mahasiswa->Kelulusan =='Belum Lulus'): ?>
                                            <option value='Belum Lulus' selected>Belum Lulus</option>
                                            <option value='Lulus'>Lulus</option>
                                            <option value='Tidak Lulus'>Tidak Lulus</option>
                                    <?php elseif($mahasiswa->Kelulusan =='Lulus'): ?>
                                            <option value='Belum Lulus'>Belum Lulus</option>
                                            <option value='Lulus'selected>Lulus</option>
                                            <option value='Tidak Lulus'>Tidak Lulus</option>
                                    <?php else: ?>
                                        <option value='Belum Lulus'>Belum Lulus</option>
                                        <option value='Lulus'>Lulus</option>
                                        <option value='Tidak Lulus'selected>Tidak Lulus</option>
                                    <?php endif?>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{route('mahasiswas.index')}}" class="btn btn-default">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
