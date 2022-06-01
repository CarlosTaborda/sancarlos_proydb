<?php
$data["page_title"]="Licencia";
$data["id_window"]="window_license";

$this->load->view("layout/header", $data);
?>

<div class="w3-card w3-container" >
  <h3 class="w3-margin">Crear o Editar Licencias</h3>
  <div class="w3-row-padding" style="">
    <div class="w3-col m4 s6">
      <p>
        Docente
        <input type="hidden" name="" id="id_licencia">
        <select class="w3-input" id="docente_num_documento">
          <option>--seleccione--</option>
          <?php foreach( $teachers as $t): ?>
            <option value="<?= $t['num_documento'] ?>"><?= $t['nombres']." ".$t['apellidos'] ?></option>
          <?php endforeach; ?>
        </select>
      </p>
    </div>
    <div class="w3-col m4 s6">
      <p>
        Fech. Inicial
        <input class="w3-input" id="fecha_inicio" type="date"/>
      </p>
    </div>
    <div class="w3-col m4 s6">
      <p>
        Fech. Final
        <input class="w3-input" id="fecha_fin" type="date"/>
      </p>
    </div>

  </div>

  <div class="w3-row-padding">
    <div class="w3-col s12">
      <p>
        Descripción
        <textarea name="" id="descripcion"  class="w3-input"></textarea>
      </p>
    </div>
    <div class="w3-col s12">
      <div class="w3-container" style="margin: 0.5em 0em;">
        <button @click="create" class="w3-right w3-btn w3-teal">Aceptar</button>
      </div>
    </div>
  </div>

  <div class="w3-container">
    <table id="table-licencia"  >
      <thead class="w3-teal">
        <tr>
          <th>Documento</th>
          <th>Docente</th>
          <th>Fech. inicio</th>
          <th>Fech. Fin</th>
          <th>Descripcion</th>
          <th>Editar</th>
          <th>Eliminar</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<?php
unset($data);
$data["load_files"] = [
 
  sprintf("<script src='%s' ></script>", base_url("assets/js/licencia.js"))
];
$this->load->view("layout/footer", $data);
?>