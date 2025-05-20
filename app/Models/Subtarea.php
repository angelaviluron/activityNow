<?php 
namespace App\Models;

use CodeIgniter\Model;

class Subtarea extends Model
{
    protected $table = 'subtarea';           // Nombre de la tabla
    protected $primaryKey = 'st_id';          // Clave primaria

    protected $useTimestamps = false;         // No usamos created_at ni updated_at

    protected $allowedFields = [              // Campos permitidos para insertar/actualizar
        't_id',
        'u_id',
        'st_asunto',
        'st_descripcion',
        'st_estado',
        'st_prioridad',
        'st_fechaVenc',
        'st_comentario',
        'st_responsable'
    ];
}
