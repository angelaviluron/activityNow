<?php 
namespace App\Models;

use CodeIgniter\Model;

class Amo extends Model{
    protected $table      = 'amo';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'a_id';
    protected $allowedFields=['a_nombre', 'a_apellido','a_dir','a_tel'];
}