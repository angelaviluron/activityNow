<?php namespace App\Models;
use CodeIgniter\Model;
class MascotaModel extends Model{
    protected $table='mascota'; protected $primaryKey ='m_nroRegistro';
    protected $useAutoIncrement=true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['m_nombre', 'm_raza', 'm_especie', 'm_nacimiento', 'm_fechaBaja'];
    protected $useTimestamps = false;  // Dates
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $validationRules = [];  // Validation
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;
}