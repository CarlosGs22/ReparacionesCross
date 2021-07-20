<?php

namespace App\Controllers\AdminController;

use App\Models\Admin\Funciones;
use App\Models\Admin\Marcas_modelo;
use App\Models\Admin\Motivos_modelo;
use App\Models\Admin\Permiso_menu_modelo;
use App\Models\Admin\Status_modelo;
use CodeIgniter\Controller;

class MotivoController extends Controller
{

  protected $helpers = [];
  protected $session;
  protected $datamenu;
  protected $motivos_modelo;
  protected $status_modelo;
  protected $funciones;

  public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
  {
    parent::initController($request, $response, $logger);

    $this->session = \Config\Services::session($config);

    $submenu_web = new Permiso_menu_modelo();
    $this->datamenu['listas_submenu_web'] = $submenu_web->_obtenerSubmenu_web(1);

    $this->motivos_modelo = new Motivos_modelo();
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

    public function motivos()
  {

    $lista['lista_status'] = $this->status_modelo->findAll();
    $lista['lista_motivos'] = $this->motivos_modelo->findAll();

    if ($this->request->getVar('id')) {
      $lista['lista_edit_motivo'] = $this->motivos_modelo->where("id", $this->request->getVar('id'))->findAll();
    }

    echo view($this->rutaHeader, $this->datamenu);
    echo view($this->rutaModulo . 'motivos', $lista);
    echo view($this->rutaFooter);
  }

  public function accion_motivos()
  {

    $idMotivo = $this->request->getVar("txtId");

    $datos_motivo = [
      'motivo' =>  $this->request->getVar('txtNombre'),
      'status' =>  $this->request->getVar('txtStatus'),
      'cve_usuario' =>  "1"
    ];

    if ($idMotivo != null) {
      array_merge($datos_motivo, array("id" => $idMotivo));
    }

    $respuesta = null;
    try {
      if ($idMotivo != null) {
        $respuesta = $this->motivos_modelo->update($idMotivo, $datos_motivo);
      } else {
        $respuesta = $this->motivos_modelo->save($datos_motivo);
      }
    } catch (\Throwable $th) {
      $respuesta = $this->motivos_modelo->error();
    }

    $respuesta = $this->funciones->_CodigoFunciones($respuesta, $this->motivos_modelo->errors());

    $this->session->setFlashdata('respuesta', $respuesta);
    return redirect()->to(base_url("admin/motivos"));
  }


}
