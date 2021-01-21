<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "tb_billing";

    public function transaksi(){
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }
}
