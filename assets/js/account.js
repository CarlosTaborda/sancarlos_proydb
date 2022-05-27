let app = new Vue({
  el:"#window_user",
  methods:{
    deleteUser:function(){

      let numdoc=$("#num_documento").val();
      if( confirm("¿Esta segurx que desea eliminar este usuario?(esta acción no se puede deshacer)") ){
        $.get(
          $("#site-url").val()+"index.php/users/delete/"+numdoc,
          function(res){
  
            if( res.success ){
            
              toastr.success("Usuario eliminado");
              setTimeout(
                ()=>window.location.replace($("#site-url").val()+"index.php/Users/logout"),
              1500);
            }
          },
          "json"
        ).fail(()=>toastr.error("No se pudo eliminar el usuario"))
      }

    },
    updateUser: function(){
      let userData = {
        num_documento: $("#num_documento").val(),
        usuario: $("#usuario").val(),
        nombres: $("#nombres").val(),
        apellidos: $("#apellidos").val(),
        contrasena: $("#contrasena").val(),
        conf_contrasena: $("#conf_contrasena").val(),
        fecha_nacimiento: $("#fecha_nacimiento").val(),
        email: $("#email").val(),
        direccion: $("#direccion").val(),
        tipo_documento_codigo: $("#tipo_documento").val()
      }

      let validateRules = {
        usuario: {
          presence:{
            allowEmpty:false,
            message:"^Debe establecer un usuario"
          },
        },
        nombres: {
          presence:{
            allowEmpty:false,
            message:"^Debe establecer un nombre"
          },
        },
        apellidos: {
          presence:{
            allowEmpty:false,
            message:"^Debe establecer un apellido"
          },
        },
        contrasena: {
          presence:{
            allowEmpty:false,
            message:"^Debe establecer una contraseña"
          },
        },
        conf_contrasena: {
          presence:{
            allowEmpty:false,
            message:"^Debe confirmar una contraseña"
          },
        },
        fecha_nacimiento: {
          presence:{
            allowEmpty:false,
            message:"^Debe poner una fecha"
          },
        },
        email: {
          presence:{
            allowEmpty:false,
            message:"^Debe establecer un email"
          },
          email: {
            message: "^El email debe ser valido"
          }
        },
        direccion: {
          presence:{
            allowEmpty:false,
            message:"^Debe establecer la direccion"
          },
        },
        tipo_documento_codigo: {
          presence:{
            allowEmpty:false,
            message:"^Debe establecer el tipo de documento"
          },
        },
        num_documento: {
          numericality:{
            onlyInteger:false,
            message:"^El tipo de documento debe ser válido"
          }
          
        },
        
      } 

      let validate_result = validate(userData, validateRules);
      
      if(  validate_result != undefined ){

        let validationMsgs = Object.entries(validate_result).map(el=>el[1].join());
        validationMsgs.map((s)=>toastr.error(s));
        return false;
      }
      if(userData.contrasena != userData.conf_contrasena){
        toastr.error("Las contraseñas deben ser identicas");
        return false;
      }

      userData.profesion = $("#profesion").val()
      userData.eps = $("#eps").val()
      userData.pension = $("#pension").val()

      $.post(
        $("#site-url").val()+"index.php/Users/edit",
        userData,
        function(res){
          if(res.success){
            toastr.success("Usuario: "+res.user[1]+" editado");
            setTimeout(()=>location.reload(), 1500)
          }
        },
        "json"
      )
    }
  }
})