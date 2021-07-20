<?php

namespace App\Controllers\AdminController;

use App\Models\Admin\Estados_modelo;
use App\Models\Admin\Funciones;
use App\Models\Admin\Localidades_modelo;
use App\Models\Admin\Municipios_modelo;
use App\Models\Admin\Permiso_menu_modelo;
use App\Models\Admin\Status_modelo;
use App\Models\Admin\Sucursal_modelo;
use CodeIgniter\Controller;

class SucursalController extends Controller
{

  protected $helpers = [];
  protected $session;
  protected $datamenu;
  protected $sucursales_modelo;
  protected $localidades_modelo;
  protected $status_modelo;
  protected $funciones;

  public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
  {
    parent::initController($request, $response, $logger);

    $this->session = \Config\Services::session($config);

    $submenu_web = new Permiso_menu_modelo();
    $this->datamenu['listas_submenu_web'] = $submenu_web->_obtenerSubmenu_web(1);

    $this->sucursales_modelo = new Sucursal_modelo();
    $this->status_modelo = new Status_modelo();
    $this->localidades_modelo = new Localidades_modelo();
    $this->funciones = new Funciones();
    $this->session = session();
  }

  public $rutaHeader = 'Admin/Marcos/header.php';
  public $rutaModulo = 'Admin/Modulos/';
  public $rutaFooter = 'Admin/Marcos/footer.php';


  public function sucursales()
  {
    $estados = new Estados_modelo();
    $municipios = new Municipios_modelo();
    $localidades = new Localidades_modelo();

    $lista['lista_sucursales'] = $this->sucursales_modelo->findAll();
    $lista['lista_status'] = $this->status_modelo->findAll();
    
    $lista['lista_estados'] = $estados->findAll();
    
    if ($this->request->getVar('id')) {
      $lista['lista_edit_sucursales'] = $this->sucursales_modelo->where("id", $this->request->getVar('id'))->findAll();
      $lista['lista_entidad'] = $this->sucursales_modelo->_obtenerEntidad($lista['lista_edit_sucursales'][0]["id_localidad"]);
    }

    if($this->request->getVar('id_estado')){
      $lista['lista_municipios'] = $municipios->select("id,nombre")->where("estado_id",$this->request->getVar('id_estado'))->findAll();
    }

    if($this->request->getVar('id_municipio')){
      $lista['lista_localidades'] = $localidades->where("municipio_id",$this->request->getVar('id_municipio'))->findAll();
      
    }

    echo view($this->rutaHeader, $this->datamenu);
    echo view($this->rutaModulo . 'sucursales', $lista);
    echo view($this->rutaFooter);
  }

  public function accion_sucursales()
  {

    $idSucursal = $this->request->getVar("txtId");

    $datos_sucursal = [
      'nombre' =>  $this->request->getVar('txtNombre'),
      'telefono' =>  $this->request->getVar('txtTelefono'),
      'calle' =>  $this->request->getVar('txtCalle'),
      'numero' =>  $this->request->getVar('txtNumero'),
      'colonia' =>  $this->request->getVar('txtColonia'),
      'cp' =>  $this->request->getVar('txtCp'),
      'status' =>  $this->request->getVar('txtStatus'),
      'cve_usuario' =>  "1",
      'id_localidad' =>  $this->request->getVar('txtLocalidad')
    ];

    if ($idSucursal != null) {
      array_merge($datos_sucursal, array("id" => $idSucursal));
    }

    $datos_sucursal = $this->funciones->_GuardarImagen(
      $this->request->getFile('imgSucursal'),
      './public/Admin/img/marcas',
      $datos_sucursal,
      "imagen"
    );

    $respuesta = null;
    try {
      if ($idSucursal != null) {
        $respuesta = $this->sucursales_modelo->update($idSucursal, $datos_sucursal);
      } else {
        $respuesta = $this->sucursales_modelo->save($datos_sucursal);
      }
    } catch (\Throwable $th) {
      $respuesta = $this->sucursales_modelo->error();
    }

    $respuesta = $this->funciones->_CodigoFunciones($respuesta, $this->sucursales_modelo->errors());

    $this->session->setFlashdata('respuesta', $respuesta);
    return redirect()->to(base_url("admin/sucursales"));
  }

  
}
