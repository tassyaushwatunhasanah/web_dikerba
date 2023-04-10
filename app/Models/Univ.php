<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Univ extends Model
{
    use HasFactory;

    protected $primaryKey = 'iduniv';

    protected $fillable = [
        'univ_name',
    ];

    public function univ()
    {
        return $this->hasMany(Univ::class);
    }
}
