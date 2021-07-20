<?php

namespace App\Controllers\AdminController;

use App\Models\Admin\Funciones;
use App\Models\Admin\Marcas_modelo;
use App\Models\Admin\Permiso_menu_modelo;
use App\Models\Admin\Status_modelo;
use CodeIgniter\Controller;

class Home extends Controller
{

  protected $helpers = [];
  protected $session;
  protected $datamenu;
  protected $marcas_modelo;
  protected $status_modelo;
  protected $funciones;

  public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
  {
    parent::initController($request, $response, $logger);

    $this->session = \Config\Services::session($config);

    $submenu_web = new Permiso_menu_modelo();
    $this->datamenu['listas_submenu_web'] = $submenu_web->_obtenerSubmenu_web(1);

    $this->marcas_modelo = new Marcas_modelo();
    $this->status_modelo = new Status_modelo();
    $this->funciones = new Funciones();
    $this->session = session();
  }

  public $rutaHeader = 'Admin/Marcos/header.php';
  public $rutaModulo = 'Admin/Modulos/';
  public $rutaFooter = 'Admin/Marcos/footer.php';

  public function principal()
  {
    return redirect()->to(base_url("admin/index"));
  }

  public function index()
  {
    echo view($this->rutaHeader, $this->datamenu);
    echo view($this->rutaModulo . 'index');
    echo view($this->rutaFooter);
  }

  public function clientes()
  {
    echo view($this->rutaHeader, $this->datamenu);
    echo view($this->rutaModulo . 'clientes');
    echo view($this->rutaFooter);
  }


  //usuarios

  public function marcas()
  {
    $lista['lista_marcas'] = $this->marcas_modelo->findAll();
    $lista['lista_status'] = $this->status_modelo->findAll();

    if ($this->request->getVar('id')) {
      $lista['lista_edit_marcas'] = $this->marcas_modelo->where("id", $this->request->getVar('id'))->findAll();
    }

    echo view($this->rutaHeader, $this->datamenu);
    echo view($this->rutaModulo . 'marcas', $lista);
    echo view($this->rutaFooter);
  }

  public function accion_marcas()
  {

    $idMarca = $this->request->getVar("txtId");

    $datos_marca = [
      'nombre' =>  $this->request->getVar('txtNombre'),
      'status' =>  $this->request->getVar('txtStatus'),
      'cve_usuario' =>  "1"
    ];

    if ($idMarca != null) {
      array_merge($datos_marca, array("id" => $idMarca));
    }

    $datos_marca = $this->funciones->_GuardarImagen(
      $this->request->getFile('imgMarca'),
      './public/Admin/img/marcas',
      $datos_marca,
      "imagen"
    );

    $respuesta = null;
    try {
      if ($idMarca != null) {
        $respuesta = $this->marcas_modelo->update($idMarca, $datos_marca);
      } else {
        $respuesta = $this->marcas_modelo->save($datos_marca);
      }
    } catch (\Throwable $th) {
      $respuesta = $this->marcas_modelo->error();
    }

    $respuesta = $this->funciones->_CodigoFunciones($respuesta, $this->marcas_modelo->errors());

    $this->session->setFlashdata('respuesta', $respuesta);
    return redirect()->to(base_url("admin/marcas"));
  }


  public function motivos()
  {
    echo view($this->rutaHeader, $this->datamenu);
    echo view($this->rutaModulo . 'motivos');
    echo view($this->rutaFooter);
  }

  public function sucursales()
  {
    echo view($this->rutaHeader, $this->datamenu);
    echo view($this->rutaModulo . 'sucursales');
    echo view($this->rutaFooter);
  }


  public function usuarios()
  {
    echo view($this->rutaHeader, $this->datamenu);
    echo view($this->rutaModulo . 'usuarios');
    echo view($this->rutaFooter);
  }
}
