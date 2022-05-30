var table;

setTimeout(()=>{
  table= $("#table-student").DataTable({
    
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
        "url": $("#site-url").val()+"index.php/student/list",
        "type": "POST",
        "dataSrc": 'data'
    },
    "columns": [

      { "data": "num_documento", },
      { "data": "nombres",  },
      { "data": "apellidos",  },
      { "data": "fecha_nacimiento",  },
      { "data": "direccion",  },
      { "data": "telefono",  },
      { "data": "acudiente",  },
      { "data": "nombre",  },
      { 
        "data": "num_documento",
        "render": function ( data, type, row, meta ) {
          return '<button class="w3-btn w3-indigo" onclick=\'app.edit('+data+');app.resetFormEstudiante();app.resetFormAcudiente()\'>Editar</button>';
        }
      },
      { 
        "data": "num_documento",
        "render": function ( data, type, row, meta ) {
          return '<button class="w3-btn w3-red" onclick="app.deleteEstudiante('+data+')">Eliminar</button>';
        }
      },
      


    ],
    
  });

}
,100)



let app = new Vue({
  el:"#window_student",
  data:{
    acudientes:[]
  },
  methods:{
    openTab: function( idTab){
      
      let allTabs = document.querySelectorAll(".tab");
        allTabs.forEach((el, index, parent)=>{
            $(el).addClass("w3-hide")
      })
      $(`#${idTab}`).removeClass("w3-hide")
    
    },
    getFormDataAcudiente:function(){
      let acudiente= {
        num_documento: $("#acu-num_documento").val(),
        nombres: $("#acu-nombres").val(),
        apellidos: $("#acu-apellidos").val(),
        telefono: $("#acu-telefono").val(), 
        direccion: $("#acu-direccion").val(), 
        parentesco: $("#acu-parentesco").val(), 
        tipo_documento_codigo: $("#acu-tipo_documento_codigo").val(),
      }

      return acudiente
    },
    validateAcudiente:function(acudiente){
      let validationRules= {
        num_documento:{
          presence:{
            allowEmpty:false,
            message:"^Debe diligenciar el numero de documento"
          },
          numericality:{
            onlyInteger:false,
            message:"^El tipo de documento debe ser válido"
          }
        },
        nombres:{
          presence:{
            allowEmpty:false,
            message:"^Debe diligenciar el nombre"
          }
        },
        apellidos:{
          presence:{
            allowEmpty:false,
            message:"^Debe diligenciar el apellido"
          }
        },
        telefono:{
          presence:{
            allowEmpty:false,
            message:"^Debe diligenciar el teléfono"
          }
        },
        direccion:{
          presence:{
            allowEmpty:false,
            message:"^Debe diligenciar la dirección"
          }
        },
        parentesco: {
          presence:{
            allowEmpty:false,
            message:"^Debe establecer el parentesco"
          },
        },
        tipo_documento_codigo:{
          presence:{
            allowEmpty:false,
            message:"^Debe establecer el tipo de documento"
          },
        },
      }

      let validate_result = validate(acudiente, validationRules);
      
      if(  validate_result != undefined ){

        let validationMsgs = Object.entries(validate_result).map(el=>el[1].join());
        validationMsgs.map((s)=>toastr.error(s));
        return false;
      }

      return acudiente
    },
    createAcudiente: function(){

      let acudiente = this.getFormDataAcudiente();
      if(this.validateAcudiente( acudiente ) !== false){
        let self = this;
        $.post(
          $("#site-url").val()+"index.php/attendant/create",
          acudiente,
          function(res){
            if(res.success){
              toastr.success(res.message);
              self.getAcudientes();
              self.resetFormAcudiente();
            }
          },
          "json"
        )

      }

    },
    getAcudientes: function(){
      let self = this;
      $.get(
        $("#site-url").val()+"index.php/attendant/get_all",
        function( res ){
          self.acudientes = res.data
        },
        "json"

      )
    },
    getFormDataEstudiante: function(){
      let estudiante = {
        num_documento:$("#es-num_documento").val(), 
        nombres:$("#es-nombres").val(), 
        apellidos:$("#es-apellidos").val(), 
        fecha_nacimiento:$("#es-fecha_nacimiento").val(), 
        direccion:$("#es-direccion").val(), 
        telefono:$("#es-telefono").val(),  
        acudiente_num_documento:$("#es-acudiente_num_documento").val(), 
        tipo_documento_codigo:$("#es-tipo_documento_codigo").val(),
        grupo_codigo:$("#es-grupo_codigo").val()
      }

      return estudiante;
    },
    validateEstudiante: function( estudiante ){
      let validationRules = {
        num_documento:{
          presence:{
            allowEmpty:false,
            message:"^Debe diligenciar el número de documento"
          },
          numericality:{
            onlyInteger:false,
            message:"^El tipo de documento debe ser válido"
          }
        },
        nombres:{
          presence:{
            allowEmpty:false,
            message:"^Debe diligenciar el nombre"
          }
        },
        apellidos:{
          presence:{
            allowEmpty:false,
            message:"^Debe diligenciar el apellido"
          }
        },
        fecha_nacimiento: {
          presence:{
            allowEmpty:false,
            message:"^Debe poner una fecha de nacimiento"
          },
          format: {
            pattern: new RegExp(/\d{4}-\d{2}-\d{2}/, 'g'),
            message: "^La fecha de nacimiento debe ser una fecha válida"
          }
        },
        direccion:{
          presence:{
            allowEmpty:false,
            message:"^Debe diligenciar la dirección"
          }
        },
        telefono:{
          presence:{
            allowEmpty:false,
            message:"^Debe diligenciar un teléfono"
          }
        },
        acudiente_num_documento:{
          presence:{
            allowEmpty:false,
            message:"^Debe colocar un acudiente"
          }
        },
        tipo_documento_codigo:{
          presence:{
            allowEmpty:false,
            message:"^Debe establecer un tipo de documento"
          }
        },
        grupo_codigo:{
          presence:{
            allowEmpty:false,
            message:"^Debe establecer un un grupo"
          }
        },
      };

      let validate_result = validate(estudiante, validationRules);
        
      if(  validate_result != undefined ){

        let validationMsgs = Object.entries(validate_result).map(el=>el[1].join());
        validationMsgs.map((s)=>toastr.error(s));
        return false;
      }

      return estudiante;
    },
    resetFormAcudiente:function(){
      $("#acu-tipo_documento_codigo").val("")
      $("#acu-num_documento").val("")
      $("#acu-nombres").val("")
      $("#acu-apellidos").val("")
      $("#acu-telefono").val("")
      $("#acu-direccion").val("")
      $("#acu-parentesco").val("")

    },
    resetFormEstudiante:function(){

      $("#es-acudiente_num_documento").val("")
      $("#es-tipo_documento_codigo").val("")
      $("#es-num_documento").val("")
      $("#es-nombres").val("")
      $("#es-apellidos").val("")
      $("#es-fecha_nacimiento").val("")
      $("#es-direccion").val("")
      $("#es-telefono").val("")
      $("#es-grupo_codigo").val("")

    },
    createEstudiante: function(){
      let estudiante = this.getFormDataEstudiante();
      if( this.validateEstudiante( estudiante ) ){

        let self = this;
        $.post(
          $("#site-url").val()+"index.php/student/create",
          estudiante,
          function(res){
            if(res.success){
              toastr.success("Estudiante creado creado");
              $("#table-student").DataTable().ajax.reload()
              self.resetFormEstudiante()
            }
          },
          "json"
        )

      }
    },
    deleteEstudiante: function(numdoc){
      $.get(
        $("#site-url").val()+"index.php/student/delete/"+numdoc,
        function(res){

          if( res.success ){
            $("#table-student").DataTable().ajax.reload()
            toastr.info("Registro eliminado");
          }
        },
        "json"
      )
    },
    edit: function(numdoc){
      $('#modal-create').show()
      $.get(
        $("#site-url").val()+"index.php/student/get_by_numdoc/"+numdoc,
        function(res){

          if( res.success ){
            $("#acu-tipo_documento_codigo").val(res.acudiente.tipo_documento_codigo)
            $("#acu-num_documento").val(res.acudiente.num_documento)
            $("#acu-nombres").val(res.acudiente.nombres)
            $("#acu-apellidos").val(res.acudiente.apellidos)
            $("#acu-telefono").val(res.acudiente.telefono)
            $("#acu-direccion").val(res.acudiente.direccion)
            $("#acu-parentesco").val(res.acudiente.parentesco)

            $("#es-acudiente_num_documento").val(res.estudiante.acudiente_num_documento)
            $("#es-tipo_documento_codigo").val(res.estudiante.tipo_documento_codigo)
            $("#es-num_documento").val(res.estudiante.num_documento)
            $("#es-nombres").val(res.estudiante.nombres)
            $("#es-apellidos").val(res.estudiante.apellidos)
            $("#es-fecha_nacimiento").val(res.estudiante.fecha_nacimiento)
            $("#es-direccion").val(res.estudiante.direccion)
            $("#es-telefono").val(res.estudiante.telefono)
            $("#es-grupo_codigo").val(res.estudiante.grupo_codigo)
          }
        },
        "json"
      )  
    }
  },
  mounted:function(){
    this.getAcudientes();
  }
})