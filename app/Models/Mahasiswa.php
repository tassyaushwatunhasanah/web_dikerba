<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswas';

    protected $primaryKey = 'id';

    protected $fillable = [
        'univ_id',
        'ruangan_id',
        'nim',
        'nama_mahasiswa',
        'jk',
        'tk_pendidikan',
        'fakultas',
        'jurusan',
        'prodi',
        'semester',
        'tgl_mulai',
        'tgl_selesai',
        'keterangan',
        'Kelulusan',

    ];

    public function univ()
    {
        return $this->belongsTo(Univ::class, 'univ_id', 'iduniv');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'idruangan');
    }
}
