<?php namespace App\Models;

use CodeIgniter\Model;

class ColaboradoresModel extends Model
{
    protected $table      = 'colaboraciones'; // Asegurate que esta sea tu tabla
    protected $primaryKey = 'c_id';

    protected $allowedFields = ['c_tarea_id', 'c_usuario_id', 'c_tipo'];

    // ✅ Método para obtener los colaboradores de una tarea
    public function obtenerColaboradoresPorTarea($tareaId)
    {
        return $this->select('usuarios.u_id, usuarios.u_user, usuarios.u_email')
                    ->join('usuarios', 'usuarios.u_id = colaboraciones.c_usuario_id')
                    ->where('colaboraciones.c_tarea_id', $tareaId)
                    ->findAll();
    }
}
