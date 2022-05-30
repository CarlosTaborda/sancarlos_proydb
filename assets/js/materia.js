var table;

setTimeout(()=>{
  table= $("#table-courses").DataTable({
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
    "buttons": ["copy", "csv", "excel", "pdf"],
    "ajax": {
        "url": $("#site-url").val()+"index.php/course/list",
        "type": "POST",
        "dataSrc": 'data'
    },
    "columns": [

      { "data": "codigo", },
      { "data": "nombre",  },
      { "data": "hrs_semana",  },
      { "data": "area_nombre"  },
      { 
        "data": "codigo",
        "render": function ( data, type, row, meta ) {
          return '<button class="w3-btn w3-red" onclick="app.delete('+data+')">Eliminar</button>';
        }
      },
      { 
        "data": "codigo",
        "render": function ( data, type, row, meta ) {
          return '<button class="w3-btn w3-indigo" onclick=\'app.edit('+JSON.stringify(row)+')\'>Editar</button>';
        }
      },


    ],
    initComplete: function () {
   
    }
  });

}
,100)


let app = new Vue({
    el:"#window_course",
    data:{
      codigo:"",
      nombre:"",
      hrs_semana:"",
      area:""
    },
    methods:{
      validate: function(){
        let courseData ={
          codigo :this.codigo,
          nombre :this.nombre,
          hrs_semana : this.hrs_semana,
          area : this.area
        };
  
        let validateRules ={
          codigo: {
            presence: true,
            numericality: {
              onlyInteger: true,
              message:"^Debe establecer un código válido"
            }
          },
          nombre: {
            presence: {
              allowEmpty:false,
              message:"^Debe colocar un nombre"
            }
          },
          hrs_semana: {
            presence: true,
            numericality: {
              onlyInteger: true,
              message:"^Debe establecer un numero de horas válido"
            }
          },
          area:{
            presence: {
              allowEmpty:false,
              message:"^Debe seleccionar un area"
            }
          }
        }
  
        let validate_result = validate(courseData, validateRules);
        
        if(  validate_result != undefined ){
  
          let validationMsgs = Object.entries(validate_result).map(el=>el[1].join());
          validationMsgs.map((s)=>toastr.error(s));
          return false;
        }
  
        return courseData;
      },
      reset_form:function(){
        this.codigo="";
        this.nombre="";
        this.hrs_semana="";
        this.area="";
      },
      create:function(){
        let self = this;
        let result = this.validate();
        if( result !== false ){
          $.post(
            $("#site-url").val()+"index.php/course/create",
            result,
            function(res){

              if(res.success){
                toastr.success(res.message);
                $("#table-courses").DataTable().ajax.reload()
                self.reset_form();
              }
  
            },
            "json"
          )
        }
        
      },
      delete: function(codigo){

        $.get(
          $("#site-url").val()+"index.php/course/delete/"+codigo,
          function(res){

            if( res.success ){
              $("#table-courses").DataTable().ajax.reload()
            }
          },
          "json"
        )
      },
      edit:function(course){
        this.codigo = course.codigo
        this.nombre = course.nombre
        this.hrs_semana = course.hrs_semana
        this.area = course.area_codigo
      }
    }
});