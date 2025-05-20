<?php 
namespace App\Models;

use CodeIgniter\Model;

class SubtareaResponsable extends Model{
    protected $table      = 'subtarea_responsables';
   protected $primaryKey       = 'id'; 
    protected $allowedFields    = ['st_id', 'u_id', 'permiso'];
    protected $useTimestamps    = false;
}
