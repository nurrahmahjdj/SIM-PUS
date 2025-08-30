<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KaryaIlmiah extends Model
{
    use HasFactory;

    protected $table = 'karya_ilmiahs';

    protected $guarded = [
        'id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rumpun()
    {
        return $this->belongsTo(Rumpun::class, 'rumpun_id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['subjek'] ?? false, function ($query, $search) {
            return $query->where('judul', 'like', '%' . $search . '%')
                ->orWhere('abstrak', 'like', '%' . $search . '%');
        });

        $query->when($filters['tahun'] ?? false, function ($query, $search) {
            return $query->where(DB::raw('YEAR(created_at)'), 'like', $search);
        });

        $query->when($filters['rumpun'] ?? false, function ($query, $rumpun) {
                return $query->whereHas('rumpun', function ($query) use ($rumpun) {
                    $query->where('nama', $rumpun);
                });
            },
        );

        $query->when($filters['penulis'] ?? false, function ($query, $search) {
            return $query->where('penulis', 'like', '%' . $search . '%');
        });

        $query->when($filters['tipe'] ?? false, function ($query, $search) {
            return $query->where('tipe', 'like', $search);
        });

        $query->when($filters['status'] ?? false, function ($query, $search) {
            return $query->where('status', 'like', $search);
        });

        $query->when($filters['start_date'] ?? false, function ($query, $search) {
            return $query->where('created_at', '>=', $search);
        });

        $query->when($filters['end_date'] ?? false, function ($query, $search) {
            return $query->where('created_at', '<=', $search);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
