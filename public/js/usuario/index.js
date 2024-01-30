function cargarGrilla() {

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    type: 'POST',
    beforeSend : function(){
      INI_LOAD();
    },
    url: "/usuario/buscar",
    data: $('#frmUsuarioBuscar').serialize(),
    dataType: 'html',
    success: function(html) {
      FIN_LOAD();
      
      $('#grillaCapa').html(html);

      $('#datatable-usuario').DataTable({
        "destroy":true,
        "deferRender":true,
        "retrieve":true,
        "processing":true,
        "searching": false,
        "lengthChange": false,
        "bInfo": false,
        "responsive": true,
        
        "language": {
          "sProcessing":   "Procesando...",
          "sLengthMenu":   "Mostrar _MENU_ registros",
          "sZeroRecords":  "No se encontraron resultados",
          "sEmptyTable":   "Ningún dato disponible en esta tabla",
          "sInfo":         "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
          "sInfoEmpty":    "Mostrando registros del 0 al 0 de un total de 0",
          "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix":  "",
          "sSearch":       "Buscar:",
          "sUrl":          "",
          "sInfoThousands":  ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
              "sFirst":      "Primero",
              "sLast":       "Último",
              "sNext":       "Siguiente",
              "sPrevious":   "Anterior"
          },
          "oAria": {
              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
        },
      });
    },
    complete: function() {
      FIN_LOAD();
    },
    error: function(xhr, status, error) {
      alert(xhr.responseText);
      INI_LOAD();
    }
  });
}


function cargarForm(iusu_id, accion) {

  $("#childModal").html("");

  $.ajax({  
    type: 'GET',
    beforeSend : function() {
    INI_LOAD(); 
    },
    url: '/usuario/'+accion,
    data:{ iusu_id:iusu_id },
    dataType: 'html',
    success: function(html) {
      $("#childModal").html(html);

      FIN_LOAD();    
    },
    error: function (xhr, status, error) {
      alert(error);
      FIN_LOAD();   
    },
    complete: function() {
              
      $('#childModal').show();
    },
  });
}


$(document).on("click", ".btnEliminarUsuario", function(){
    
  var iusu_id = $(this).attr("iusu_id");
  var iusu_estado = 0;

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  Swal.fire({
    icon: "question",
    title: "Eliminar?",
    text: "¿Está seguro que desea eliminar este usuario?",
    icon: "question",
    showCancelButton: true,
    confirmButtonColor: "#73c2ff",
    cancelButtonColor : "#f5a1a6",
    confirmButtonText : "<i class='fa fa-thumbs-up'> Si</i>",
    cancelButtonText : "<i class='fa fa-thumbs-down'> No</i>"
  }).then(function(result){
    if(result.value){
      $.ajax({
        url: "/usuario/eliminar",
        method: "POST",
        data : { iusu_id:iusu_id, iusu_estado:iusu_estado },
        dataType: "json",
        cache: false,
        success: function(json){
          FIN_LOAD();
          if(json.IND_OPERACION == 1){
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
              confirmButtonText : "OK",
            }).then(function(result){
              if(result.value) {
                cargarGrilla();
              }
            });
          }
        }
      }); 
    }
  });
});