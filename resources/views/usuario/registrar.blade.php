<!-- Scrollable modal -->
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ $titulo }} Usuario</h5>
            <button type="button" class="btn-close" onclick="cerrarModal();"></button>
        </div>

        <div class="modal-body">
            <form method="POST" id="frmUsuario{{ $titulo }}" enctype="multipart/form-data" data-parsley-validate="true">

                @csrf

                <input type="hidden" class="form-control form-control-sm" id="iusu_id" name="iusu_id" value="<?php if(isset($usuario)) echo $usuario->iusu_id ?>">
                <input type="hidden" class="form-control form-control-sm" id="flag_img" name="flag_img">
                <input type="hidden" class="form-control form-control-sm" id="flag_cv" name="flag_cv">

                <div class="row">
                    <div class="col-md-6">
                        <label for="vusu_nombre">Nombre</label>
                        <input type="text" class="form-control form-control-sm" id="vusu_nombre" name="vusu_nombre" value="<?php if(isset($usuario)) echo $usuario->vusu_nombre ?>" placeholder="Ingrese ..." required>
                    </div>

                    <div class="col-md-6">
                        <label for="vusu_ape_pat">Apellido Paterno</label>  
                        <input type="text" class="form-control form-control-sm" id="vusu_ape_pat" name="vusu_ape_pat" value="<?php if(isset($usuario)) echo $usuario->vusu_ape_pat ?>" required/>
                    </div>  
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="vusu_ape_mat">Apellido Materno</label>
                        <input type="text" class="form-control form-control-sm" id="vusu_ape_mat" name="vusu_ape_mat" value="<?php if(isset($usuario)) echo $usuario->vusu_ape_mat ?>">
                    </div>

                    <div class="col-md-6">
                        <label for="dusu_fec_nac">Fecha Nacimiento</label>  
                        <input type="date" class="form-control form-control-sm" id="dusu_fec_nac" name="dusu_fec_nac" value="<?php if(isset($usuario)) echo $usuario->dusu_fec_nac ?>" required/>
                    </div>  
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="vusu_tipo_doc">Tipo Documento</label>  
                        <select class="form-control form-control-sm" id="vusu_tipo_doc" name="vusu_tipo_doc" required>
                            <option value="">Seleccione</option>
                            <option value="DNI" <?php if(isset($usuario)) { echo $usuario->vusu_tipo_doc == "DNI"? "selected":""; } ?>>DNI</option>
                            <option value="RUC" <?php if(isset($usuario)) { echo $usuario->vusu_tipo_doc == "RUC"? "selected":""; } ?>>RUC</option>
                            <option value="CE" <?php if(isset($usuario)) { echo $usuario->vusu_tipo_doc == "CE"? "selected":""; } ?>>CE</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="vusu_num_doc">Nro.Documento</label>  
                        <input type="text" class="form-control form-control-sm" id="vusu_num_doc" name="vusu_num_doc" value="<?php if(isset($usuario)) echo $usuario->vusu_num_doc ?>" required/>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <label for="vusu_usuario">Usuario</label>
                        <input type="text" class="form-control form-control-sm" id="vusu_usuario" name="vusu_usuario" value="<?php if(isset($usuario)) echo $usuario->vusu_usuario ?>" required>
                    </div>

                    <div class="col-md-4">
                        <label for="vusu_clave">Contraseña</label>
                        <input type="password" class="form-control form-control-sm" id="vusu_clave" name="vusu_clave">
                    </div>

                    <div class="col-md-4">
                        <label for="iperf_id">Perfil</label>
                        <select class="form-control form-control-sm" id="iperf_id" name="iperf_id" required>
                            <option value="" selected="true">Seleccione</option>

                            <?php if(count($lstPerfil) > 0) {
                                  foreach($lstPerfil as $perfil):
                            ?>
                            <option <?php if(isset($usuario)) { echo $usuario->iperf_id == $perfil->iperf_id? "selected":""; } ?> value="<?php echo $perfil->iperf_id ?>"><?php echo $perfil->vperf_nombre ?></option>
                            <?php
                                  endforeach;
                            }?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="cargarImg">Imágen</label>
                        <div class="img-style">
                            <?php
                                if (isset($usuario)) {

                                    if ($usuario->vusu_ruta_img != "") {

                                        $rutaImg = $usuario->vusu_ruta_img;
                                        $array_img = explode("/", $rutaImg);

                                        $imagen = $array_img[3];
                                    } else {
                                        $rutaImg = asset('upload/gestion-procesos/usuarios/foto-perfil/icono-user.png');
                                        $imagen = "icono-user.png";
                                    }
                                } else {
                                    $rutaImg = asset('upload/gestion-procesos/usuarios/foto-perfil/icono-user.png');
                                    $imagen = "icono-user.png";
                                }
                            ?>

                            <img class="kv-preview-data file-preview-image" id="prevImg" src="{{ $rutaImg }}" alt="Foto de perfil">

                        </div>

                        <div class="input-group input-group-xs">
                            <input type="text" class="form-control form-control-sm" id="cargarImg" name="cargarImg" readonly="readonly" value="<?php echo $imagen; ?>" placeholder="Cargar Imágen ...">

                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    <i class="fa fa-upload"></i>
                                    <input class="file-upload-input" type="file" id="fileImg" name="fileImg" accept="image/*">
                                </span>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="cargarCV">CV</label>
                        <div class="input-group input-group-xs">
                            <?php //$array_cv = explode("/", $usuario->vusu_ruta_cv); ?>
                            <input type="text" class="form-control form-control-sm" id="cargarCV" name="cargarCV" readonly="readonly" value="<?php //echo $array_cv[3]; ?>" placeholder="Cargar CV ...">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    <i class="fa fa-upload"></i>
                                    <input type="file" id="fileCV" name="fileCV" accept="image/*">
                                </span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-light" onclick="cerrarModal();">Cerrar</button>
        </div>
    </div>
</div>


<script type="text/javascript">
    $("#fileImg").change(function(e){

        INI_LOAD();

        var imagen = this.files[0];

        //VALIDAMOS QUE LA IMAGEN SEA JPG O PNG
        if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
            $("#fileImg").val("");
            FIN_LOAD();
            Swal.fire({
                icon: "warning",
                title: "Error al subir la imagen",
                text: "¡La imagen debe estar en formato JPG o PNG!",
                //confirmButtonColor: "rgb(253, 98, 94)",
                confirmButtonText: "OK"
            });
        } 
        else if(imagen["size"] > 5000000){
            $("#fileImg").val("");
            FIN_LOAD();

            Swal.fire({
                icon: "warning",
                title: "Error al subir la imagen",
                text: "¡La imagen no debe pesar más de 2MB!",
                //confirmButtonColor: "rgb(253, 98, 94)",
                confirmButtonText: "OK"
            }); 
        } 
        else{ 
            //CASO DE EXITO
            var datosImagen = new FileReader;

            datosImagen.readAsDataURL(imagen);

            $(datosImagen).on("load", function(event){
                FIN_LOAD();

                var rutaImagen = event.target.result;
                var filename = e.target.value.split( '\\' ).pop();
                
                $("#flag_img").val(0);
                $('#cargarImg').val(filename);
                $("#prevImg").attr("src", rutaImagen);
            });
        }
    });


    $("#fileCV").change(function(e){

        INI_LOAD();

        var file = this.files[0];

        //VALIDAMOS QUE EL FILE SEA PDF O DOCX
        if(file["type"] != "application/pdf" && file["type"] != "application/vnd.openxmlformats-officedocument.wordprocessingml.document"){
            $("#fileCV").val("");
            FIN_LOAD();

            Swal.fire({
                icon: "warning",
                title: "Error al subir el archivo",
                text: "¡El archivo debe estar en formato PDF o DOC!",
                confirmButtonText: "OK"
            });
        } 
        else if(file["size"] > 50000000){
            $("#fileCV").val("");
            FIN_LOAD();

            Swal.fire({
                icon: "warning",
                title: "Error al subir archivo",
                text: "¡El archivo no debe pesar más de 2MB!",
                confirmButtonText: "OK"
            }); 
        } 
        else{ 
            //CASO DE EXITO
            var datosImagen = new FileReader;

            datosImagen.readAsDataURL(file);

            $(datosImagen).on("load", function(event){
                FIN_LOAD();

                var rutaImagen = event.target.result;
                var filename = e.target.value.split( '\\' ).pop();

                $("#flag_cv").val(0);
                $('#cargarCV').val(filename);
            });
        }
    });


    $( document ).ready(function() {
        var imagen = $("#cargarImg").val()
        var curriculum = $("#cargarCV").val();

        console.log(imagen)

        if (imagen.length == 0) {
            $("#flag_img").val(0);
        }
        else {
            $("#flag_img").val(1);
        }

        if (curriculum.length == 0) {
            $("#flag_cv").val(0);
        }
        else {
            $("#flag_cv").val(1);
        }
    });


    $("#frmUsuarioRegistrar").on('submit', function(event) {
        event.preventDefault();
        //registrarUsuario();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({  
            type: 'POST',
            beforeSend : function() {
                INI_LOAD();
            },
            url: "/usuario/registrar",
            data: new FormData($('#frmUsuarioRegistrar')[0]),
            cache:false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(json){
                FIN_LOAD();
                if(json.IND_OPERACION == 1){
                    $("#childModal").hide();
                    Swal.fire({
                        icon: "success",
                        title: "Usuario",
                        text: json.DES_MENSAJE,
                        showCancelButton: false,
                        confirmButtonColor: "#73c2ff",
                        cancelButtonColor : "#f5a1a6",
                        confirmButtonText : "OK",
                    }).then(function(result){
                        if (result.value) {
                            cargarGrilla();
                        }
                    });
                }
                else if (json.IND_OPERACION == 2) {
                    Swal.fire({
                        icon: "warning",
                        title: "Usuario!",
                        text: json.DES_MENSAJE,
                        showCancelButton: false,
                        confirmButtonColor: "#73c2ff",
                        cancelButtonColor : "#f5a1a6",
                        confirmButtonText : "OK",
                    });
                }
                else{
                    Swal.fire({
                        icon: "error",
                        title: "Usuario",
                        text: json.DES_MENSAJE,
                        showCancelButton: false,
                        confirmButtonColor: "#73c2ff",
                        cancelButtonColor : "#f5a1a6",
                        confirmButtonText : "Cerrar",
                    }).then(function(result){
                        if (result.value) {
                            cargarGrilla();
                        }
                    });
                }
            },
            error: function () {
                FIN_LOAD();
            },
            complete: function() {
                FIN_LOAD();
            },
        });
        return false;
    });


    $("#frmUsuarioActualizar").on('submit', function(event) {
        event.preventDefault();
        //registrarUsuario();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({  
            type: 'POST',
            beforeSend : function() {
                INI_LOAD();
            },
            url: "/usuario/actualizar",
            data: new FormData(this),
            cache:false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(json){
                FIN_LOAD();
                if(json.IND_OPERACION == 1){
                    $("#childModal").hide();
                    Swal.fire({
                        icon: "success",
                        title: "Usuario",
                        text: json.DES_MENSAJE,
                        showCancelButton: false,
                        confirmButtonColor: "#73c2ff",
                        cancelButtonColor : "#f5a1a6",
                        confirmButtonText : "OK",
                    }).then(function(result){
                        if (result.value) {
                            cargarGrilla();
                        }
                    });
                }
                else{
                    Swal.fire({
                        icon: "error",
                        title: "Usuario",
                        text: json.DES_MENSAJE,
                        showCancelButton: false,
                        confirmButtonColor: "#73c2ff",
                        cancelButtonColor : "#f5a1a6",
                        confirmButtonText : "Cerrar",
                    }).then(function(result){
                        if (result.value) {
                            cargarGrilla();
                        }
                    });
                }
            },
            error: function () {
                FIN_LOAD();
            },
            complete: function() {
                FIN_LOAD();
            },
        });
        return false;
    });
</script>