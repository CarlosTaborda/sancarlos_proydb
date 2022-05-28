<?php
$data["page_title"]="Periodos";
$data["id_window"]="window_period";

$this->load->view("layout/header", $data);
?>

<div class="w3-card w3-container">
  <h3 class="w3-margin">Crear o Editar Periodos</h3>
  <div class="w3-row-padding" style="margin-bottom: 3em;">
    <div class="w3-col m2">
      <p>
        Código
        <input type="number" class="w3-input" v-model="codigo">
      </p>
    </div>
    <div class="w3-col m2">
      <p>
        Nombre
        <input type="text" class="w3-input" v-model="nombre">
      </p>
    </div>
    <div class="w3-col m2">
      <p>
        Fecha de inicio
        <input type="date" class="w3-input" v-model="fecha_inicio">
      </p>
    </div>
    <div class="w3-col m2">
      <p>
        Fecha de finalización
        <input type="date" class="w3-input" v-model="fecha_fin">
      </p>
    </div>
    <div class="w3-col m2">
      <button class="w3-btn w3-teal" style="margin-top: 2.3em" @click="create" >Aceptar</button>
    </div>
  </div>
  
  <div class="w3-row-padding">
    <div class="w3-col m12">
      <table id="table-period">
        <thead>
          <tr class="w3-teal">
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Fecha de Inicio</th>
            <th>Fecha de Finalización</th>
            <th>Editar</th>
            <th>Eliminar</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>

<?php
unset($data);
$data["load_files"] = [
 
  sprintf("<script src='%s' ></script>", base_url("assets/js/periodo.js"))
];
$this->load->view("layout/footer", $data);
?>