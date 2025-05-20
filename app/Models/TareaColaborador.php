<?php 
namespace App\Models;

use CodeIgniter\Model;

class TareaColaborador extends Model{
    protected $table            = 'tarea_colaboradores';
    protected $primaryKey       = 'id'; 
    protected $allowedFields    = ['t_id', 'u_id', 'permiso'];
    protected $useTimestamps    = false;

    public function obtenerColaboradoresPorTarea($tareaId)
    {
        return $this->select('usuario.u_id, usuario.u_user, usuario.u_email')
                    ->join('usuario', 'usuario.u_id = tarea_colaboradores.u_id')
                    ->where('tarea_colaboradores.t_id', $tareaId)
                    ->findAll();
    }

}