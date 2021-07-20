
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
                            <button type="button" class="btn btn_add_motivo" data-toggle="modal" data-target="#modal_motivos" data-bgcolor="#007bb5" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(0, 123, 181);"><i class="fa fa-plus"></i> Nuevo</button>
                            <h3>
                    </div>
                    <div class="row pd-20">
                        <?php if ($lista_motivos) {
                            foreach ($lista_motivos as $key => $value) { ?>
                                <div class="col-6 col-sm-6 col-md-3 col-lg-3 mb-30">
                                    <div class="card card-box">
                                        <h5 class="card-header weight-500">Estado: <?php echo ($value['status'] == '1') ? 'Activo' : 'Inactivo'; ?></h5>
                                        <div class="card-body text-center">
                                            <h5 class="card-title "><?php echo $value['motivo']; ?></h5>
                                            <a href="<?php echo base_url("admin/motivos?id=" . $value['id']) ?>" class="btn" data-bgcolor="#f46f30" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(244, 111, 48);"><i class="fa fa-edit"></i>Editar</a>
                                        </div>
                                        <div class="card-footer text-muted">
                                            Creación: <?php echo $value['cve_fecha']; ?>
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
</div>

<div class="modal fade" id="modal_motivos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar motivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo base_url("admin/accion_motivos") ?>" enctype="multipart/form-data" id="frm_motivo">
                    <?php if ($lista_edit_motivo) {
                        $mostrar_modal = 1;
                        $nombre = null;
                        $status = null;
                        $id_marca = null;
                        foreach ($lista_edit_motivo as $key => $value) {
                            $nombre = $value['motivo'];
                            $status = $value['status'];
                            $id_marca = $value['id'];
                            break;
                        }
                    } ?>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Nombre: *</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" id="txtNombre" value="<?php echo ($nombre) ? $nombre : ''; ?>" name="txtNombre">
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

<script>
    $(function() {
        var idMarca = <?php echo ($mostrar_modal == 1) ? $mostrar_modal : '"0"'; ?>;
        if (idMarca == '1') {
            $("#modal_motivos").modal('show');
        }

        $(".btn_add_motivo").click(function() {
            $("#frm_motivo input").val("");
            $("#txtStatus").val("1");
        });

    });
</script>