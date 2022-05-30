<?php
$data["page_title"]="Mis datos";
$data["id_window"]="window_user";

$this->load->view("layout/header", $data);
?>

<div class="w3-card w3-container">
  <h3 class="w3-margin">Editar mi información</h3>
  <div class="w3-row-padding">
    <div class="w3-col s3">
      <p>
        Usuario
        <input type="text" class="w3-input" value="<?= $user["usuario"] ?>" id="usuario">
      </p>
    </div>
    <div class="w3-col s3">
      <p>
        Nombres
        <input type="text" class="w3-input" value="<?= $user["nombres"] ?>" id="nombres">
      </p>
    </div>
    <div class="w3-col s3">
      <p>
        Apellidos
        <input type="text" class="w3-input" value="<?= $user["apellidos"] ?>" id="apellidos">
      </p>
    </div>
    <div class="w3-col s3">
      <p>
        Fecha de nacimiento
        <input type="date"   class="w3-input" value="<?= $user["fecha_nacimiento"] ?>"  id="fecha_nacimiento">
      </p>
    </div>
  </div>
  <div class="w3-row-padding">
    <div class="w3-col s3">
      <p>
        Tipo de documento
        <select name="" id="tipo_documento" disabled class="w3-input">
          <option>--seleccione--</option>
          <?php foreach( $doc_types as $dt): ?>
          <option value="<?= $dt['codigo'] ?>" <?= $user["tipo_documento_codigo"] == $dt['codigo'] ? "selected": "" ?> ><?= $dt['descripcion'] ?></option>
          <?php endforeach; ?>
        </select>
      </p>
    </div>
    <div class="w3-col s3">
      <p>
        Número de documento
        <input type="text" value="<?= $user["num_documento"] ?>" readonly id="num_documento" class="w3-input">
      </p>
    </div>
    <div class="w3-col s3">
      <p>
        Contraseña
        <input type="password"  id="contrasena" class="w3-input" value="<?= $user["contrasena"] ?>">
      </p>
    </div>
    <div class="w3-col s3">
      <p>
        Confirmar contraseña
        <input type="password"  id="conf_contrasena" class="w3-input" value="<?= $user["contrasena"] ?>">
      </p>
    </div>
  </div>

  <div class="w3-row-padding">
    <div class="w3-col m6">
      <p>
        Email
        <input type="email" value="<?= $user["email"] ?>"  id="email" class="w3-input">
      </p>
    </div>
    <div class="w3-col m6">
      <p>
        Dirección
        <input type="address" value="<?= $user["direccion"] ?>" id="direccion" class="w3-input">
      </p>
    </div>    
  </div>

  <?php if( $user["is_teacher"] ): ?>
  <div class="w3-row-padding">
    <div class="w3-col m12">
      <p>
        Profesión
        <input type="address" value="<?= $user["profesion"] ?>" id="profesion" class="w3-input">
      </p>
    </div>
  </div>
  <?php else: ?>
  <div class="w3-row-padding">
    <div class="w3-col m6">
      <p>
        EPS
        <input type="text" value="<?= $user["eps"] ?>" class="w3-input" id="eps">
      </p>
    </div>
    <div class="w3-col m6">
      <p>
        Pensión
        <input type="text" value="<?= $user["fondo_pensional"] ?>" class="w3-input" id="pension">
      </p>
    </div>
  </div>
  <?php endif; ?>


  <div class="w3-container" style="margin-bottom: 1.5em;">
    <button class="w3-btn w3-right w3-red" @click="deleteUser">Borrar</button>
    <button class="w3-btn w3-right w3-teal" @click="updateUser" style="margin-right: 1em;">Editar</button>
  </div>
</div>

<?php
unset($data);
$data["load_files"] = [
 
  sprintf("<script src='%s' ></script>", base_url("assets/js/account.js"))
];
$this->load->view("layout/footer", $data);
?>