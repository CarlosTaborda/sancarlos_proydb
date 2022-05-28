<?php
$data["page_title"]="Materias";
$data["id_window"]="window_course";

$this->load->view("layout/header", $data);
?>

<div class="w3-card w3-container" >
  <h3 class="w3-margin">Crear o Editar Materias</h3>
  <div class="w3-row-padding" style="margin-bottom: 4em;">
    <div class="w3-col m2 s6">
      <p>
        Código
        <input type="number" class="w3-input" v-model="codigo" />
      </p>
    </div>
    <div class="w3-col m3 s6">
      <p>
        Nombre
        <input type="text" class="w3-input" v-model="nombre" />
      </p>
    </div>
    <div class="w3-col m2 s4" >
      <p>
        Horas por semana
        <input type="number" class="w3-input" v-model="hrs_semana" />
      </p>
    </div>
    <div class="w3-col m3 s4">
      <p>
        Área
        <select class="w3-input" v-model="area">
          <option value="">--seleccione--</option>
          <?php foreach( $areas as $a): ?>
            <option value="<?= $a['codigo'] ?>"><?= $a['nombre'] ?></option>
          <?php endforeach; ?>
        </select>
      </p>
    </div>
    <div class="w3-col m2 s4">
      <button class="w3-btn w3-teal" style="margin-top: 2.4em;" @click="create">Aceptar</button>
    </div>
  </div>

  <div class="w3-container">
    <table id="table-courses"  >
      <thead class="w3-teal">
        <tr>
          <th>Código</th>
          <th>Nombre</th>
          <th>Hrs Semana</th>
          <th>Área</th>
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
 
  sprintf("<script src='%s' ></script>", base_url("assets/js/materia.js"))
];
$this->load->view("layout/footer", $data);
?>