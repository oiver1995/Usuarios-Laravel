<div class="card-body">
    <table id="datatable-usuario" class="table table-bordered table-hover dataTable dtr-inline table-striped collapsed" data-order='[[ 0, "desc" ]]' data-page-length='10'>
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Perfil</th>  
                <th>Fecha Creación</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @if (count($usuario))
                @foreach ($usuario as $value) 
 
                <tr>
                    <td>{{ $value->iusu_id }}</td>
                    <td>{{ $value->vusu_nombre }}</td>
                    <td>{{ $value->vusu_usuario }}</td>
                    <td>{{ $value->vusu_perfil }}</td>
                    <td>{{ $value->dusu_fec_cre }}</td>

                    <td>
                        <button type="button" class="btn btn-info btn-sm" onclick="cargarForm('{{ $value->iusu_id }}', 'actualizar');"><i class="fa fa-edit"></i></button>

                        <button type="button" class="btn btn-danger btn-sm btnEliminarUsuario" iusu_id="{{ $value->iusu_id }}" style="color: white;"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>

                @endforeach

            @else
                <tr>
                    <td id=alingCentro scope="col" colspan=12 class="mensajeError">No se encontraron resultados</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>