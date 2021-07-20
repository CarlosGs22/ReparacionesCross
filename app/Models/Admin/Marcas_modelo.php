<?php
namespace App\Models\Admin;
use CodeIgniter\Model;


class Marcas_modelo extends Model
{

public $table = 'marca';

public $primaryKey = 'id';

protected $allowedFields = ['nombre', 'imagen','status','cve_usuario'];

protected $validationRules    = [
    'nombre' => 'required'
];

protected $validationMessages = [
    'nombre'=> [
        'is_unique' => 'Sorry. That email has already been taken. Please choose another.'
    ]
];


}
