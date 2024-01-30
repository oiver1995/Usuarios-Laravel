<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsuarioModel;
use App\Models\PerfilModel;

class UsuarioController extends Controller
{
    protected $usuario;

    public function __construct(UsuarioModel $usuario, PerfilModel $perfil){
        $this->usuario = $usuario;

        $this->perfil = $perfil;
    }
 
 
    public function index(){
    }


    private function getPublicIp() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }


    public function buscar(Request $request){

        if ($request->isMethod('post')) {

            $buscar = $request->buscar;

            $usuario = $this->usuario->listar($buscar);

            return view('usuario.listar', ['usuario' => $usuario]);
        }

        return view('usuario.buscar');
    }
 

    public function registrar(Request $request){
        
        if ($request->isMethod('post')) {

            $iperf_id = $request->iperf_id;
            $vusu_nombre = $request->vusu_nombre;
            $vusu_ape_pat = $request->vusu_ape_pat;
            $vusu_ape_mat = $request->vusu_ape_mat;
            $vusu_tipo_doc = $request->vusu_tipo_doc;
            $vusu_num_doc = $request->vusu_num_doc;
            $dusu_fec_nac = $request->dusu_fec_nac;
            $vusu_usuario = $request->vusu_usuario;
            $vusu_clave = bcrypt($request->vusu_clave);
            $vusu_perfil = $request->vusu_perfil;

            $vusu_usu_cre = "admin";
            $vusu_ip_cre = $this->getPublicIp();
     
            $rpta = $this->usuario->registrar($iperf_id, $vusu_nombre, $vusu_ape_pat, $vusu_ape_mat, $vusu_tipo_doc, $vusu_num_doc, $dusu_fec_nac, $vusu_usuario, $vusu_clave, $vusu_usu_cre, $vusu_ip_cre);

            echo json_encode($rpta);
            return;
        }

        $titulo = "Registrar";

        $lstPerfil = $this->perfil->listarPerfil();

        return view('usuario.registrar', ['titulo' => $titulo, 'lstPerfil' => $lstPerfil]);
    }


    public function actualizar(Request $request) {

        $iusu_id = $request->iusu_id;
        
        if ($request->isMethod('post')) {
            
            $iperf_id = $request->iperf_id;
            $vusu_nombre = $request->vusu_nombre;
            $vusu_ape_pat = $request->vusu_ape_pat;
            $vusu_ape_mat = $request->vusu_ape_mat;
            $vusu_tipo_doc = $request->vusu_tipo_doc;
            $vusu_num_doc = $request->vusu_num_doc;
            $dusu_fec_nac = $request->dusu_fec_nac;
            $vusu_usuario = $request->vusu_usuario;
            $vusu_clave = bcrypt($request->vusu_clave);

            $vusu_usu_mod = "admin";
            $vusu_ip_mod = $this->getPublicIp();
     
            $rpta = $this->usuario->actualizar($iusu_id, $iperf_id, $vusu_nombre, $vusu_ape_pat, $vusu_ape_mat, $vusu_tipo_doc, $vusu_num_doc, $dusu_fec_nac, $vusu_usuario, $vusu_clave, $vusu_usu_mod, $vusu_ip_mod);

            echo json_encode($rpta);
            return;
        }

        $titulo = "Actualizar";

        $usuario = $this->usuario->buscarUsuarioID($iusu_id);

        $lstPerfil = $this->perfil->listarPerfil();

        return view('usuario.registrar', ['titulo' => $titulo, 'usuario' => $usuario, 'lstPerfil' => $lstPerfil]);
    }


    public function eliminar(){
        $iusu_id = $_POST["iusu_id"];
        $iusu_estado = $_POST["iusu_estado"];

        $rpta = $this->usuario->eliminar($iusu_id, $iusu_estado);

        echo json_encode($rpta);
        return;
    }
}
