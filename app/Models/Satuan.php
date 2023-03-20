<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Satuan extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'satuan';
    protected $guarded = ['id'];

    public function barang()
    {
        return $this->hasMany(Barang::class);
    }

    public function barangpedagang()
    {
        return $this->hasMany(BarangPedagang::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_satuan'
            ]
        ];
    }
}
