<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioModel extends Model
{
    use HasFactory;

     protected $table = "otv_usuario";

    public $timestamps = false;

    protected $primaryKey = "iusu_id";


    public function listar($query) {

        return UsuarioModel::select('otv_usuario.*')->where('otv_usuario.vusu_nombre', 'LIKE', '%' . $query . '%')->where('otv_usuario.iusu_estado', '=', 1)->orderBy('iusu_id', 'DESC')->get();
    }


    public function registrar($iperf_id, $vusu_nombre, $vusu_ape_pat, $vusu_ape_mat, $vusu_tipo_doc, $vusu_num_doc, $dusu_fec_nac, $vusu_usuario, $vusu_clave, $vusu_usu_cre, $vusu_ip_cre) {

        $usuario = UsuarioModel::where('vusu_usuario', $vusu_usuario)->first();

        if ($usuario) {

            $return["IND_OPERACION"] = 2;
            $return["DES_MENSAJE"] = "El usuario ya se encuentra registrado.";
        }
        else {
            $objeto_usuario = new UsuarioModel;

            $objeto_usuario->iperf_id = $iperf_id;
            $objeto_usuario->vusu_nombre = $vusu_nombre;
            $objeto_usuario->vusu_ape_pat = $vusu_ape_pat;
            $objeto_usuario->vusu_ape_mat = $vusu_ape_mat;
            $objeto_usuario->vusu_tipo_doc = $vusu_tipo_doc;
            $objeto_usuario->vusu_num_doc = $vusu_num_doc;
            $objeto_usuario->dusu_fec_nac = $dusu_fec_nac;
            $objeto_usuario->vusu_usuario = $vusu_usuario;
            $objeto_usuario->vusu_clave = $vusu_clave;
            $objeto_usuario->vusu_usu_cre = $vusu_usu_cre;
            $objeto_usuario->dusu_fec_cre = NOW();
            $objeto_usuario->vusu_ip_cre = $vusu_ip_cre;
            $objeto_usuario->iusu_estado = 1;

            if ($objeto_usuario->save()) {
                $return["IND_OPERACION"] = 1;
                $return["DES_MENSAJE"] = "Usuario registrado correctamente";
            }
            else {
                $return["IND_OPERACION"] = 0;
                $return["DES_MENSAJE"] = "Error al registrar usuario";
            }
        }

        return $return;
    }


    public function buscarUsuarioID($iusu_id) {
        $return = UsuarioModel::find($iusu_id);

        return $return;
    }


    public function actualizar($iusu_id, $iperf_id, $vusu_nombre, $vusu_ape_pat, $vusu_ape_mat, $vusu_tipo_doc, $vusu_num_doc, $dusu_fec_nac, $vusu_usuario, $vusu_clave, $vusu_usu_mod, $vusu_ip_mod) {
        
        $objeto_usuario = UsuarioModel::find($iusu_id);

        $objeto_usuario->iperf_id = $iperf_id;
        $objeto_usuario->vusu_nombre = $vusu_nombre;
        $objeto_usuario->vusu_ape_pat = $vusu_ape_pat;
        $objeto_usuario->vusu_ape_mat = $vusu_ape_mat;
        $objeto_usuario->vusu_tipo_doc = $vusu_tipo_doc;
        $objeto_usuario->vusu_num_doc = $vusu_num_doc;
        $objeto_usuario->dusu_fec_nac = $dusu_fec_nac;
        $objeto_usuario->vusu_usuario = $vusu_usuario;
        $objeto_usuario->vusu_clave = $vusu_clave;
        $objeto_usuario->vusu_usu_mod = $vusu_usu_mod;
        $objeto_usuario->dusu_fec_mod = NOW();
        $objeto_usuario->vusu_ip_mod = $vusu_ip_mod;

        if ($objeto_usuario->save()) {
            $return["IND_OPERACION"] = 1;
            $return["DES_MENSAJE"] = "Usuario actualizado correctamente";
        }
        else {
            $return["IND_OPERACION"] = 0;
            $return["DES_MENSAJE"] = "Error al actualizar usuario";
        }

        return $return;
    }


    public function eliminar($iusu_id, $iusu_estado) {
        
        $objeto_usuario = UsuarioModel::find($iusu_id);
        $objeto_usuario->iusu_estado = $iusu_estado;

        if ($objeto_usuario->save()) {
            $return["IND_OPERACION"] = 1;
            $return["DES_MENSAJE"] = "Usuario eliminado correctamente";
        }
        else {
            $return["IND_OPERACION"] = 0;
            $return["DES_MENSAJE"] = "Error al eliminado usuario";
        }

        return $return;
    }
}
