<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilModel extends Model
{
    use HasFactory;

    protected $table = 'otv_perfil';

    protected $primaryKey = 'iperf_id';


    public function listarPerfil()
    {
        return PerfilModel::all();;
    }
}
