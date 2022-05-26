<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="<?= base_url("assets/img/favicon.ico") ?>" type="image/x-icon">
  <link rel="icon" href="<?= base_url("assets/img/favicon.ico") ?>" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url("assets/css/w3.css"); ?>">
    <link rel="stylesheet" href="<?= base_url("assets/plugins/toastr/toastr.min.css") ?>">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="<?= base_url("assets/plugins/toastr/toastr.min.js") ?>"></script>
    <title>Inicio de sesión</title>
</head>
<body>
  <div id="login-window" >
    <form class="w3-card w3-container" style="max-width: 50em;margin: auto;margin-top: 10%;">
      <p>      
        <label class="w3-text-grey">Usuario</label>
        <input class="w3-input w3-border" type="text" required="">
      </p>
      <p>      
        <label class="w3-text-grey">Contraseña</label>
        <input class="w3-input w3-border" type="password" required="">
      </p>
      <div class="w3-center">
        <button class="w3-btn  w3-indigo" >Ingresar</button>
      </div>

      <p>
        <a class="w3-right w3-text-indigo" @click="showModalWindow">Crear Usuario</a>
      </p>
    </form>
    <div id="create-user-modal" class="w3-modal" style="display: none;">
      <div class="w3-modal-content w3-animate-opacity w3-card-4">
        <header class="w3-container w3-indigo"> 
          <span onclick="document.getElementById('modfade').style.display='none'" class="w3-button w3-large w3-display-topright">×</span>
          <h2>Crear Usuario</h2>
        </header>
        <div class="w3-container">
          <div class="w3-row-padding">
            <div class="w3-third">
              <p>
                Usuario
                <input type="text" class="w3-input" id="usuario">
              </p>
            </div>
            <div class="w3-third">
              <p>
                Nombres
                <input type="text" class="w3-input" id="nombre">
              </p>
            </div>
            <div class="w3-third">
              <p>
                Apellidos
                <input type="text" class="w3-input" id="apellido">
              </p>
            </div>
          </div>
          <div class="w3-row-padding">
            <div class="w3-third">
              <p>
                Contraseña
                <input type="password" id="contrasena" class="w3-input">
              </p>
            </div>
            <div class="w3-third">
              <p>
                Confirmar Contraseña
                <input type="password" id="confirm-contra" class="w3-input">
              </p>
            </div>
            <div class="w3-third">
              <p>
                Fecha de nacimiento
                <input type="date" id="fecha_nacimiento"  class="w3-input">
              </p>
            </div>
          </div>
          <div class="w3-row-padding">
            <div class="w3-half">
              <p>
                Email
                <input type="email" id="email" class="w3-input">
              </p>
            </div>
            <div class="w3-half">
              <p>
                Direccion
                <input type="address" id="direccion" class="w3-input">
              </p>
            </div>
            
          </div>

          <div class="w3-row-padding">
            <div class="w3-half">
              <p>
                Tipo de documento
                <select class="w3-input" id="tipo_documento">
                  <option>--seleccione--</option>
                <?php foreach( $doc_types as $dt): ?>
                  <option value="<?= $dt['codigo'] ?>"><?= $dt['descripcion'] ?></option>
                <?php endforeach; ?>
                </select>
              </p>
            </div>
            <div class="w3-half">
              <p>
                Número de documento
                <input type="text" id="num_documento" class="w3-input">
              </p>
            </div>
          </div>

          <p>
            <button class="w3-btn w3-teal w3-right" @click="createUser()" >Crear</button>
          </p>
        </div>

      </div>
    </div>
  </div>

  <script src="<?= base_url("assets/plugins/vue.js"); ?>" ></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
  <script src="<?= base_url("assets/js/login.js"); ?>" ></script>

</body>
</html>