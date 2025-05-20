<?php
use App\Models\Tarea;

function tieneNotificaciones($usuarioId)
{
    if (!$usuarioId) return false;

    $tareaModel = new Tarea();
    $hoy = date('Y-m-d');

    return $tareaModel
        ->where('u_id', $usuarioId)
        ->where('t_estado !=', 3) // No completadas
        ->where('t_fechaRec IS NOT NULL')
        ->where('t_fechaRec <=', $hoy)
        ->countAllResults() > 0;
}
