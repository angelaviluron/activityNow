<?php 
namespace App\Models;

use CodeIgniter\Model;

class Tarea extends Model
{
    protected $table      = 'tarea';              // Nombre de la tabla en la BD
    protected $primaryKey = 't_id';               // Clave primaria

    protected $allowedFields = [
        'u_id',
    't_asunto',
    't_descripcion',
    't_prioridad',
    't_responsable',
    't_estado',
    't_fechaVenc',
    't_fechaRec',
    't_color'
];


    protected $useTimestamps = false;             
    protected $returnType    = 'array';     
    
    
public function updateTarea($id, $datos)
{
    return $this->db->table('tarea')  
                    ->where('t_id', $id) 
                    ->update($datos);    
}

 public function obtenerTareaPorId($id)
    {
        return $this->where('t_id', $id)->first();
    }

}
