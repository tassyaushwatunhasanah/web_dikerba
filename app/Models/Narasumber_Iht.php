<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Narasumber_Iht extends Model
{
    use HasFactory;
    protected $table='narasumber_ihts';
    protected $fillable=['narasumber_id', 'nama_narasumber', 'instansi'];
    public function iht(){
        return $this->belongsTo(Iht::class, 'narasumber_id');
    }
}
