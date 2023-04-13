<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Mahasiswa Praktik</title>
    <style>
        table {
            width: 100%;
            margin-bottom: 52px;
            color: #475569;
            font-size: 12px;
        }
        table thead th {
            vertical-align: bottom;
            border-bottom: 1px solid #dee2e6;
            text-align: center;
            padding-bottom: 5px;
            color: #475569;
        }
    </style>
</head>
<body class="A4">
    <section class="sheet padding-10mm">
        <h1 style="color: #475569; text-align: center;">Laporan Mahasiswa Praktik</h1>

        <table border="1" cellpadding="5" cellspacing="1" class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Instansi</th>
                    <th scope="col">Tingkat Pendidikan</th>
                    <th scope="col">Tanggal Masuk</th>
                    <th scope="col">Tanggal Keluar</th>
                    <th scope="col">Ruangan</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Status Kelulusan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswas as $mahasiswa)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $mahasiswa->nama_mahasiswa }}</td>
                    <td>{{ $mahasiswa->nim }}</td>
                    <td>{{ $mahasiswa->jk }}</td>
                    <td>{{ $mahasiswa->univ->univ_name }}</td>
                    <td>{{ $mahasiswa->tk_pendidikan }}</td>
                    <td>{{ date('d M Y', strtotime($mahasiswa->tgl_mulai)) }}</td>
                    <td>{{ date('d M Y', strtotime($mahasiswa->tgl_selesai)) }}</td>
                    <td>{{ $mahasiswa->ruangan->ruangan_name }}</td>
                    <td>{{ $mahasiswa->keterangan }}</td>
                    <td>{{ $mahasiswa->Kelulusan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table border="1" cellpadding="5" cellspacing="1" class="table">
            <thead>
                <tr>
                    <th>Instansi</th>
                    <th>Fakultas</th>
                    <th>Jurusan</th>
                    <th>Program Studi</th>
                    <th>Tingkat pendidikan</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Jumlah</th>
                    <th>Ruangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mhs as $key => $mh)
                <tr>
                    <td>{{ $key }}</td>
                    <td>
                        @foreach ($mh as $m)
                            <span>{{ $m->fakul->fakul_name }}</span><br/>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($mh as $m)
                            <span>{{ $m->jurusan->jurusan_name }}</span><br/>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($mh as $m)
                            <span>{{ $m->prodi->prodi_name }}</span><br/>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($mh as $m)
                            <span>{{ $m->tingkatpendidikan->tkpendidikan_name }}</span><br/>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($mh as $m)
                            <span>{{ $m->tgl_mulai }}</span><br/>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($mh as $m)
                            <span>{{ $m->tgl_selesai }}</span><br/>
                        @endforeach
                    </td>
                    <td>{{ $mh->count() }}</td>
                    <td>
                        @foreach ($mh as $m)
                            <span>{{ $m->ruangan->ruangan_name }}</span><br/>
                        @endforeach
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</body>
</html>
