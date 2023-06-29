<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class InfoTender extends Model
{
    protected $primaryKey = 'id_infoTender';
    use HasFactory;
    use Sortable;
    public $sortable = ['id_infoTender', 'nama_infoTender', 'harga_infoTender', 'syarat_infoTender', 'status', 'created_at', 'updated_at'];

    public function peserta()
    {
        return $this->hasMany(PendaftaranUser::class, 'id_infoTender', 'id_infoTender');
    }
    public function pesertaAcc()
    {
        return $this->hasMany(Perusahaan::class, 'id_infoTender', 'id_infoTender');
    }
}
