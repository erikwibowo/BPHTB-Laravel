<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "tb_transaksi";

    public function wp(){
        return $this->belongsTo(Wp::class, 'id_wp', 'id_wp');
    }

    public function jenistransaksi(){
        return $this->belongsTo(JenisTransaksi::class, 'id_jenis_transaksi', 'id_jenis_transaksi');
    }
}
