var table;

setTimeout(()=>{
  table= $("#table-area").DataTable({
    "info": false,
    "responsive": true, 
    "lengthChange": true, 
    "autoWidth": false,
    "ordering": false,
    "serverSide": true,
    "pagingType": "simple",
    language: {
      url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
    },
    "ajax": {
        "url": $("#site-url").val()+"index.php/area/list",
        "type": "POST",
        "dataSrc": 'data'
    },
    "columns": [

      { "data": "codigo", },
      { "data": "nombre",  },
      { 
        "data": "num_documento",
        "render": function ( data, type, row, meta ) {
          return '<button class="w3-btn w3-red" onclick="app.delete('+data+')">Eliminar</button>';
        }
      },
      { 
        "data": "num_documento",
        "render": function ( data, type, row, meta ) {
          return '<button class="w3-btn w3-indigo" onclick=\'app.edit('+JSON.stringify(row)+')\'>Editar</button>';
        }
      },


    ],
    
  });

}
,100)


let app = new Vue({
  el:"#window_area",
  methods:{
    validate: function(){

      let areaData={
        codigo:$("#codigo").val(),
        nombre:$("#nombre").val(),

      }

      let validateRules={
        codigo:{
          presence: {
            allowEmpty:false,
            message:"^Debe colocar un código"
          },
          numericality: {
            onlyInteger: true,
            message:"^Debe establecer un código válido"
          }
        },
        nombre:{
          presence: {
            allowEmpty:false,
            message:"^Debe colocar un nombre"
          }
        },
      }

      let validate_result = validate(areaData, validateRules);
        
        if(  validate_result != undefined ){
  
          let validationMsgs = Object.entries(validate_result).map(el=>el[1].join());
          validationMsgs.map((s)=>toastr.error(s));
          return false;
        }
  
        return areaData;
    },
    reset_form:function(){
      $("#codigo").val("")
      $("#nombre").val("")
    },
    create:function(){
      let self = this

      let result = this.validate();
      if( result !== false ){
        $.post(
          $("#site-url").val()+"index.php/area/create",
          result,
          function(res){
            if(res.success){
              toastr.success(res.message);
              $("#table-area").DataTable().ajax.reload()
              self.reset_form();
            }
          },
          "json"
        );
      }
    },
    delete: function( codigo ){
      $.get(
        $("#site-url").val()+"index.php/area/delete/"+codigo,
        function(res){

          if( res.success ){
            $("#table-area").DataTable().ajax.reload()
            toastr.info("Registro eliminado");
          }
        },
        "json"
      )
    },
    edit: function(area){
      $("#codigo").val(area.codigo)
      $("#nombre").val(area.nombre)
    }
  }
})