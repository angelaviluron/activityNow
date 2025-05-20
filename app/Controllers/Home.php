<?php


namespace App\Controllers;

class Home extends BaseController
{
    public function __construct() {
        helper('form'); 
        helper('notificaciones');

    }
    public function index()
{
    $usuarioId = session()->get('u_id');
    $tieneNotificaciones = tieneNotificaciones($usuarioId);

    $datos = [
        'tieneNotificaciones' => $tieneNotificaciones,
        'header' => view('header', ['tieneNotificaciones' => $tieneNotificaciones]),
        'footer' => view('footer')
    ];

    return view('inicio', $datos);
}

   
}

