<?php
namespace App\Models\Admin;
use CodeIgniter\Model;


class Motivos_modelo extends Model
{

public $table = 'motivo';

public $primaryKey = 'id';

protected $allowedFields = ['id', 'motivo','status','cve_fecha','cve_usuario'];

protected $validationRules    = [
    'motivo' => 'required'
];

protected $validationMessages = [
    'nombre'=> [
        'is_unique' => 'Sorry. That email has already been taken. Please choose another.'
    ]
];


}
