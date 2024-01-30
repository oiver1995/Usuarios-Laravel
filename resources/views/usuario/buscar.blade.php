@extends('layout.template')

@section('contenido')

<script type="text/javascript" src="{{ asset('js/usuario/index.js') }}"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5 class="m-0">Lista de usuarios</h5>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Ajustes</a></li>
            <li class="breadcrumb-item active">usuarios</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <form id="frmUsuarioBuscar" name="frmUsuarioBuscar" action="#" onsubmit="return false">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="buscar" id="buscar" autocomplete="off" placeholder="Ingrese ...">
                    </div>

                    <div class="col-md-4">
                        <label class="control-label"></label>
                        <a class="btn btn-success" title="Buscar Usuario" onClick="cargarGrilla();"><i class="fa fa-search"></i></a>
                        <a class="btn btn-primary" title="Registrar Usuario" onclick="cargarForm(0, 'registrar');"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </form>
        </div>

        <div id="grillaCapa"></div>
    </div>
</div>

<div id="childModal" class="modal animated fadeIn" tabindex="1"></div> 

<script type="text/javascript">
    cargarGrilla();

    $("#buscar").keypress(function(event) {
        // Verifica si la tecla presionada es "Enter" (código 13)
        if (event.which === 13) {
            // Llama a la función de búsqueda al presionar "Enter"
            cargarGrilla();
        }
    });
</script>

@endsection

