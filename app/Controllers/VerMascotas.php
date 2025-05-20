<?php

namespace App\Controllers;
use App\Models\MascotaModel;
use App\Models\Vinculo;

class VerMascotas extends BaseController
{
    public function index(): string
    {
        $mascotaModel = new MascotaModel();
        $mascotas = $mascotaModel->findAll();
        $data['mascotas']=$mascotas;
        $data['header']= view('header'); 
        $data['footer']= view('footer'); 
        return view('mascotas/ver_mascotas',$data);
    }

    public function mascota_de_amo($id = null)
{
    $vinculoModel = new Vinculo();
    $mascotaModel = new MascotaModel();

    $vinculos = $vinculoModel->where('v_a_id', $id)->findAll();

    // Extraer los números de registro de mascotas
    $nrosRegistro = array_column($vinculos, 'v_m_nroRegistro');

    $datos['mascotas'] = [];

    if (!empty($nrosRegistro)) {
        $mascotas = $mascotaModel
            ->whereIn('m_nroRegistro', $nrosRegistro)
            ->findAll();

        // Mapeo de especie por número
        $especies = [
            0 => 'Perro',
            1 => 'Gato',
            2 => 'Ave',
            3 => 'Roedor',
            4 => 'Pez'
        ];

        // Reemplazar los valores de m_especie
        foreach ($mascotas as &$mascota) {
            $codigoEspecie = (int)$mascota['m_especie'];
            $mascota['m_especie'] = $especies[$codigoEspecie] ?? 'Desconocido';
        }

        $datos['mascotas'] = $mascotas;
    }

    $datos['header'] = view('header'); 
    $datos['footer'] = view('footer'); 

    return view("amos/mascota_de_amo", $datos);
}


    
}
