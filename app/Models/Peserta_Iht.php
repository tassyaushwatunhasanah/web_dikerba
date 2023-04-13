<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta_Iht extends Model
{
    use HasFactory;
    protected $table='peserta_ihts';
    protected $fillable=['peserta_id', 'nama_peserta', 'tempat_tugas'];
    public function iht(){
        return $this->belongsTo(Iht::class, 'peserta_id');
    }
}
