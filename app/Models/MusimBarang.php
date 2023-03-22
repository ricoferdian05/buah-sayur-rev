<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MusimBarang extends Model
{
    use HasFactory;

    protected $table = 'musim_barang';
    protected $primaryKey = 'id';
    protected $keyType = 'integer';

    public function getMusim()
    {
        $musim = DB::table('musim_barang')
            ->join('data_barang', 'musim_barang.id_barang', '=', 'data_barang.id')
            ->join('bulan', 'musim_barang.id_bulan', '=', 'bulan.id')
            ->select('musim_barang.id', 'data_barang.nama_barang', 'bulan.bulan')
            ->get();

        return $musim;
    }
}
