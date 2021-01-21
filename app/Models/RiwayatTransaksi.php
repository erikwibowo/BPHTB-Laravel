<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatTransaksi extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "tb_riwayat_transaksi";

    public function wp(){
        return $this->belongsTo(Wp::class, 'id_wp', 'id_wp');
    }

    public function admin(){
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
    
    public function ppat(){
        return $this->belongsTo(Ppat::class, 'id_ppat', 'id_ppat');
    }
}
