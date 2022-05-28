var table;

setTimeout(()=>{
  table= $("#table-period").DataTable({
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
        "url": $("#site-url").val()+"index.php/period/list",
        "type": "POST",
        "dataSrc": 'data'
    },
    "columns": [

      { "data": "codigo", },
      { "data": "nombre",  },
      { "data": "fecha_inicio",  },
      { "data": "fecha_fin",  },
      { 
        "data": "codigo",
        "render": function ( data, type, row, meta ) {
          return '<button class="w3-btn w3-red" onclick="app.deletePeriod('+data+')">Eliminar</button>';
        }
      },
      { 
        "data": "codigo",
        "render": function ( data, type, row, meta ) {
          return '<button class="w3-btn w3-indigo" onclick=\'app.edit('+JSON.stringify(row)+')\'>Editar</button>';
        }
      },


    ],
    
  });

}
,100)


let app = new Vue({
  el:"#window_period",
  data:{
    codigo:"",
    nombre:"",
    fecha_inicio:"",
    fecha_fin:""
  },
  methods:{
    validate:function(){
      let validateRules={
        codigo:{
          presence:{
            allowEmpty:false,
            message:"^El código es necesario"
          },
          numericality:{
            onlyInteger: true,
            message:"^El código debe ser numerico"
          }
        },
        nombre:{
          presence:{
            allowEmpty:false,
            message:"^El nombre es necesario"
          },
        },
        fecha_inicio:{
          presence:{
            allowEmpty:false,
            message:"^La fecha inicial es necesaria"
          },
          format: {
            pattern: new RegExp(/\d{4}-\d{2}-\d{2}/, 'g'),
            message: "^La fecha inicial debe ser una fecha válida"
          }
        },
        fecha_fin:{
          presence:{
            allowEmpty:false,
            message:"^La fecha final es necesaria"
          },
          format: {
            pattern: new RegExp(/\d{4}-\d{2}-\d{2}/, 'g'),
            message: "^La fecha final debe ser una fecha válida"
          }
        }
      }

      let validate_result = validate(this._data, validateRules);
        
      if(  validate_result != undefined ){

        let validationMsgs = Object.entries(validate_result).map(el=>el[1].join());
        validationMsgs.map((s)=>toastr.error(s));
        return false;
      }

      return this._data;
    },
    reset:function(){
      this.codigo=""
      this.nombre=""
      this.fecha_inicio=""
      this.fecha_fin=""
    },
    create: function(){
      let result = this.validate();
      let self = this;

      if(result !== false){
        $.post(
          $("#site-url").val()+"index.php/period/create",
          result,
          function(res){
  
            if( res.success ){
            
              toastr.success(res.message);
              self.reset()
              $("#table-period").DataTable().ajax.reload()
            }
          },
          "json"
        )
      }
    },
    deletePeriod: function(codigo){
      $.get(
        $("#site-url").val()+"index.php/period/delete/"+codigo,
        function(res){

          if( res.success ){
            $("#table-period").DataTable().ajax.reload()
            toastr.info("Registro eliminado");
          }
        },
        "json"
      )
    },
    edit: function(periodo){
      this.codigo = periodo.codigo;
      this.nombre = periodo.nombre;
      this.fecha_inicio = periodo.fecha_inicio;
      this.fecha_fin = periodo.fecha_fin
    }

  }
})