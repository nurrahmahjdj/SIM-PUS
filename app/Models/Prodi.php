<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodis';

    protected $guarded = [
        'id',
    ];

    public function rumpun()
    {
        return $this->belongsTo(Rumpun::class, 'rumpun_id');
    }
}
