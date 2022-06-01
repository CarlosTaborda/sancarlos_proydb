var table;

setTimeout(()=>{
  table= $("#table-licencia").DataTable({
    
    "info": false,
    "responsive": true, 
    "lengthChange": true, 
    "autoWidth": false,
    "ordering": false,
    pageLength: 10,
    "serverSide": true,
    "pagingType": "simple",
    language: {
      url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
    },
    "ajax": {
        "url": $("#site-url").val()+"index.php/license/list",
        "type": "POST",
        "dataSrc": 'data'
    },
    "columns": [

      { 
        "data": "docente_num_documento", 
        "render": function ( data, type, row, meta ) {
          return `${row.tipo_documento_codigo}${data}`;
        }
      },
      { 
        "data": "nombres", 
        "render": function ( data, type, row, meta ) {
          return `${data} ${row.apellidos}`;
        }
      },
      { 
        "data": "fecha_inicio",
      },
      { 
        "data": "fecha_fin",
      },
      { 
        "data": "descripcion",
      },

      { 
        "data": "docente_num_documento",
        "render": function ( data, type, row, meta ) {
          return '<button class="w3-btn w3-indigo" onclick=\'app.edit('+JSON.stringify(row)+')\'>Editar</button>';
        }
      },
      { 
        "data": "id_licencia",
        "render": function ( data, type, row, meta ) {
          return '<button class="w3-btn w3-red" onclick="app.deleteLicense('+data+')">Eliminar</button>';
        }
      },
      


    ],
    
  });

}
,100)


let app= new Vue({
  el:"#window_license",
  data:{

  },
  methods:{
    getLicenseData: function(){
      let license={
        docente_num_documento: $("#docente_num_documento").val(),
        id_licencia: $("#id_licencia").val(),
        fecha_inicio: $("#fecha_inicio").val(),
        fecha_fin: $("#fecha_fin").val(),
        descripcion: $("#descripcion").val(),
      }

      return license;
    },
    validate: function( license){
      let validationRules = {
        docente_num_documento:{
          presence:{
            allowEmpty:false,
            message:"^Debe diligenciar el docente"
          }
        },
        fecha_inicio:{
          presence:{
            allowEmpty:false,
            message:"^Debe poner una fecha de inicio"
          },
          format: {
            pattern: new RegExp(/\d{4}-\d{2}-\d{2}/, 'g'),
            message: "^La fecha de inicio debe ser una fecha válida"
          }
        },
        fecha_fin:{
          presence:{
            allowEmpty:false,
            message:"^Debe poner una fecha final"
          },
          format: {
            pattern: new RegExp(/\d{4}-\d{2}-\d{2}/, 'g'),
            message: "^La fecha final debe ser una fecha válida"
          }
        },
        descripcion:{
          presence:{
            allowEmpty:false,
            message:"^Debe escribir una descripcion"
          }
        }
      }

      let validate_result = validate(license, validationRules);
        
      if(  validate_result != undefined ){

        let validationMsgs = Object.entries(validate_result).map(el=>el[1].join());
        validationMsgs.map((s)=>toastr.error(s));
        return false;
      }

      return license;
    },
    deleteLicense: function(idLicense){
      $.get(
        $("#site-url").val()+"index.php/license/delete/"+idLicense,
        function(res){

          if( res.success ){
            $("#table-licencia").DataTable().ajax.reload()
            toastr.info("Registro eliminado");
          }
        },
        "json"
      )
    },
    reset_form:function(){
      $("#docente_num_documento").val("")
      $("#id_licencia").val("")
      $("#fecha_inicio").val("")
      $("#fecha_fin").val("")
      $("#descripcion").val("")
    },
    create: function(){
      let self = this;
      let license = this.getLicenseData();
      if( this.validate( license ) !== false ){
        
        $.post(
          $("#site-url").val()+"index.php/license/create",
          license,
          function(res){
            if(res.success){
              toastr.success(res.message);
              $("#table-licencia").DataTable().ajax.reload()
              self.reset_form();
            }
          },
          "json"
        );

      }
    },
    edit:function(license){

      $("#docente_num_documento").val(license.docente_num_documento)
      $("#id_licencia").val(license.id_licencia)
      $("#fecha_inicio").val(license.fecha_inicio)
      $("#fecha_fin").val(license.fecha_fin)
      $("#descripcion").val(license.descripcion)
    }
  }
})