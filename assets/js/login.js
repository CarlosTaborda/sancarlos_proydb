let app = new Vue({
  el:"#login-window",
  data:{
    user_type:"teacher"
  },
  methods:{
    showModalWindow:function(){
      document.getElementById('create-user-modal').style.display='block'
      
    },
    validarUsuario: function(){
      let data = {
        usuario: $("#usuario").val(),
        nombre: $("#nombre").val(),
        apellido: $("#apellido").val(),
        contrasena: $("#contrasena").val(),
        conf_contrasena: $("#confirm-contra").val(),
        fech_nacimiento: $("#fecha_nacimiento").val(),
        email: $("#email").val(),
        direccion: $("#direccion").val(),
        tipo_documento: $("#tipo_documento").val(),
        num_documento: $("#num_documento").val(),
      }
      let validateRules = {
        usuario: {
          presence:{
            allowEmpty:false,
            message:"^Debe establecer un usuario"
          },
        },
        nombre: {
          presence:{
            allowEmpty:false,
            message:"^Debe establecer un nombre"
          },
        },
        apellido: {
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
        fech_nacimiento: {
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
        tipo_documento: {
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

      let validate_result = validate(data, validateRules);
      
      if(  validate_result != undefined ){

        let validationMsgs = Object.entries(validate_result).map(el=>el[1].join());
        validationMsgs.map((s)=>toastr.error(s));
        return false;
      }
      if(data.contrasena != data.conf_contrasena){
        toastr.error("Las contraseñas deben ser identicas");
        return false;
      }
      return data;
    },
    createUser: function(){
      let valid = this.validarUsuario();
      if(valid !== false){

        valid.user_type = this.user_type;
        valid.profession = $("#profession").val()
        valid.eps = $("#eps").val()
        valid.pension = $("#pension").val()


        $.post(
          $("#site-url").val()+"index.php/Users/create",
          valid,
          function(res){
            if(res.success){
              toastr.success("Usuario: "+res.user[1]+" creado");
              $("#create-user-modal").hide();
            }
          },
          "json"
        )
      }   
    },
    login: function (){
      let loginData = {
        username: $("#username-log").val(),
        password: $("#password-log").val()
      }

      let validateRules = {
        username: {
          presence:{
            allowEmpty:false,
            message:"^Debe establecer el usuario"
          },
        },
        password: {
          presence:{
            allowEmpty:false,
            message:"^Debe establecer la contraseña"
          },
        },
      }

      let validate_result = validate(loginData, validateRules);
      
      if(  validate_result != undefined ){

        let validationMsgs = Object.entries(validate_result).map(el=>el[1].join());
        validationMsgs.map((s)=>toastr.error(s));
        return false;
      }

      $.post(
        $("#site-url").val()+"index.php/Users/auth",
        loginData,
        function(res){
          if(!res.success)
            toastr.error("No se pudo iniciar sesion, revise sus datos")
          else{
            toastr.success("Exito, se ha iniciado sesión");
            setTimeout(() => {
              window.location.replace($("#site-url").val()+"index.php/Users/home");
            }, 1500);
          }
        },
        "json"
      )
    }
  }
})