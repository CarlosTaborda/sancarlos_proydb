<?php
$data["page_title"]="Areas";
$data["id_window"]="window_area";

$this->load->view("layout/header", $data);
?>

<div class="w3-card w3-container" >
  <h3 class="w3-margin">Crear o Editar Áreas</h3>
  <div class="w3-row-padding" style="margin-bottom: 3em;">
    <div class="w3-col m2 s6">
      <p>
        Código
        <input class="w3-input" id="codigo"/>
      </p>
    </div>
    <div class="w3-col m2 s6">
      <p>
        Nombre
        <input class="w3-input" id="nombre"/>
      </p>
    </div>
    <div class="w3-col m2 s12">
      <button class="w3-btn w3-teal" style="margin-top: 2.2em;" @click="create">Aceptar</button>
    </div>
  </div>

  <div class="w3-container">
    <table id="table-area"  >
      <thead class="w3-teal">
        <tr>
          <th>Código</th>
          <th>Nombre</th>
          <th>Eliminar</th>
          <th>Editar</th>

        </tr>
      </thead>
    </table>
  </div>
</div>

<?php
unset($data);
$data["load_files"] = [
 
  sprintf("<script src='%s' ></script>", base_url("assets/js/area.js"))
];
$this->load->view("layout/footer", $data);
?>