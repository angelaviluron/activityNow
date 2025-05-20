<?php 
namespace App\Models;

use CodeIgniter\Model;

class Usuario extends Model{
    protected $table      = 'usuario';
   
    protected $primaryKey = 'u_id';
    protected $allowedFields = ['u_nombre', 'u_apellido', 'u_user', 'u_email', 'u_pwd'];

    protected $useTimestamps = false;        
    protected $dateFormat = 'datetime'; 

}
