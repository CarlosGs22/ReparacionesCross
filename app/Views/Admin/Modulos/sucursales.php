<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<div class="xs-pd-20-10 pd-ltr-20">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <?php
                    $pieces = explode("/", uri_string());
                    ?>
                    <h4><?php echo $pieces[1];  ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a><?php echo $pieces[0]; ?></a></li>
                        <li class="breadcrumb-item"><a><?php echo $pieces[1]; ?></a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card-box mb-30">
                <div class="pb-20 pt-20">
                    <div class="pd-20">
                        <h3 class="text-blue h3">
                            <button type="button" class="btn btn_add_surcusal" data-toggle="modal" data-target="#modal_sucursales" data-bgcolor="#007bb5" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(0, 123, 181);"><i class="fa fa-plus"></i> Nuevo</button>
                            <h3>
                    </div>

                    <div class="row pd-20">

                        <?php if ($lista_sucursales) {
                            foreach ($lista_sucursales as $key => $value) { ?>

                                <div class="col-6 col-lg-3 col-md-4 col-sm-12 mb-30">
                                    <div class="da-card">
                                        <div class="da-card-photo">
                                            <img style="max-height: 330px;" src="<?php echo base_url("public/Admin/img/marcas/IMG_20160829_174136033_HDR.jpg") ?>" alt="">
                                            <div class="da-overlay">
                                                <div class="da-social">
                                                    <ul class="clearfix">
                                                        <li><a href="<?php echo base_url("admin/sucursales?id=" . $value['id']) ?>"><i class="icon-copy fa fa-edit" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="da-card-content">
                                            <h5 class="h5 mb-10">Nombre: <?php echo $value['nombre']; ?></h5>
                                            <p class="mb-0"><i class="icon-copy fa fa-phone" aria-hidden="true"> </i> <?php echo $value['telefono']; ?></p>
                                        </div>
                                    </div>
                                </div>

                        <?php }
                        } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_sucursales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registrar sucursal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?php echo base_url("admin/accion_sucursales") ?>" enctype="multipart/form-data" id="frm_sucursal">
                        <?php if ($lista_edit_sucursales) {
                            $mostrar_modal = 1;
                            $nombre = null;
                            $telefono = null;
                            $calle = null;
                            $numero = null;
                            $colonia = null;
                            $cp = null;
                            $status = null;
                            $id_localidad = null;
                            foreach ($lista_edit_sucursales as $key => $value) {
                                $nombre = $value['nombre'];
                                $telefono = $value['telefono'];
                                $calle = $value['calle'];
                                $numero = $value['numero'];
                                $colonia = $value['colonia'];
                                $cp = $value['cp'];
                                $status = $value['status'];
                                $id_localidad = $value['id_localidad'];
                                $id_sucursal = $value['id'];
                                break;
                            }
                        }




                        ?>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Nombre: *</label>
                                    <input class="form-control" type="text" id="txtNombre" value="<?php echo ($nombre) ? $nombre : ''; ?>" name="txtNombre">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Imagen: *</label>
                                    <input type="file" id="imgSucursal" name="imgSucursal" class="form-control-file form-control height-auto">
                                </div>
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Télefono: *</label>
                                    <input class="form-control" type="text" id="txtTelefono" value="<?php echo ($telefono) ? $telefono : ''; ?>" name="txtTelefono">
                                </div>
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Calle: *</label>
                                    <input class="form-control" type="text" id="txtCalle" value="<?php echo ($calle) ? $calle : ''; ?>" name="txtCalle">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Número: *</label>
                                    <input type="text" id="txtNumero" name="txtNumero" value="<?php echo ($numero) ? $numero : ''; ?>" class="form-control height-auto">
                                </div>
                            </div>

                            <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Colonia: *</label>
                                    <input class="form-control" type="text" id="txtColonia" value="<?php echo ($colonia) ? $colonia : ''; ?>" name="txtColonia">
                                </div>
                            </div>

                            <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>CP: *</label>
                                    <input class="form-control" type="text" id="txtCp" value="<?php echo ($cp) ? $cp : ''; ?>" name="txtCp">
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Status: *</label>
                                    <select name="txtStatus" id="txtStatus" class="form-control">
                                        <option value="0"></option>
                                        <?php if ($lista_status) { ?>
                                            <?php foreach ($lista_status as $key => $value) { ?>
                                                <option value="<?php echo $value['id']; ?>" <?php echo ($value['id'] ==  $status) ? ' selected="selected"' : ''; ?>><?php echo $value['status']; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Estado: *</label>
                                    <select class='form-control' name="txtEstado" id="txtEstado">
                                        <?php
                                        if ($lista_entidad) {
                                            $loca_id = null;
                                            $muni_id = null;
                                            $esta_id = null;
                                            foreach ($lista_entidad as $key => $value) {
                                                $loca_id = $value->loca_id;
                                                $muni_id = $value->muni_id;
                                                $esta_id = $value->esta_id;
                                            }
                                        }

                                        ?>
                                        <option value='0'></option>
                                        <?php if ($lista_estados) { ?>
                                            <?php foreach ($lista_estados as $key => $value) { ?>
                                                <option value="<?php echo $value['id']; ?>" <?php echo ($value['id'] ==  $esta_id) ? ' selected="selected"' : ''; ?>><?php echo $value['nombre']; ?></option>
                                        <?php }
                                        } ?>
                                        </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Municipio: *</label>
                                    <select class='form-control' id="txtMunicipio" name="txtMunicipio">
                                        <option value='0'></option>
                                        <?php if ($lista_municipios) { ?>
                                            <?php foreach ($lista_municipios as $key => $value) { ?>
                                                <option value="<?php echo $value['id']; ?>" <?php echo ($value['id'] ==  $muni_id) ? ' selected="selected"' : ''; ?>><?php echo $value['nombre']; ?></option>
                                        <?php }
                                        } ?>
                               
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Localidad: *</label>
                                    <select class='form-control'  id="txtLocalidad" name="txtLocalidad">
                                        <option value='0'></option>
                                        <?php if ($lista_localidades) { ?>
                                            <?php foreach ($lista_localidades as $key => $value) { ?>
                                                <option value="<?php echo $value['id']; ?>" <?php echo ($value['id'] ==  $muni_id) ? ' selected="selected"' : ''; ?>><?php echo $value['nombre']; ?></option>
                                        <?php }
                                        } ?>
                                         </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col text-center">
                                <input type="hidden" name="txtId" id="txtId" value="<?php echo $id_marca; ?>">
                                <button type="submit" class="btn" data-bgcolor="#00b489" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(0, 180, 137);"><i class="fa fa-save"></i> Guardar</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>



<script>
    $(function() {
        var idSucursal = <?php echo ($mostrar_modal == 1) ? $mostrar_modal : '"0"'; ?>;
        if (idSucursal == '1') {
            $("#modal_sucursales").modal('show');
        }

        $(".btn_add_sucursal").click(function() {
            $("#frm_sucursal input").val("");
            $("#txtStatus").val("1");
        });

        $("#txtEstado").on("change",function(){
            document.location.href = '<?php echo base_url("admin/sucursales?id_estado=")?>' + $(this).val();
        });

        $("#txtMunicipio").on("change",function(){
            document.location.href = '<?php echo base_url("admin/sucursales?id_municipio=")?>' + $(this).val();
        });

    });
</script>