<?php
$data["page_title"]="Reporte II";
$data["id_window"]="window_report_b";

$this->load->view("layout/header", $data);

?>

<div class="w3-card w3-container" style="padding:1em">
  <form class="w3-row-padding" method="POST">  
    <div class="w3-col m4">
      <p>
        Grupo:
        <select value="" class="w3-input" name="grupo_codigo" >
          <?php foreach($groups as $g): ?>
          <option value="<?= $g["codigo"] ?>"><?= $g["nombre"] ?></option>
          <?php endforeach; ?>

        </select>
      </p>
    </div>

    <div class="w3-col m2">
      <button class="w3-btn w3-indigo" style="margin-top: 2.2em;">
        Aceptar
      </button>
    </div>
  </form>
  <div class="w3-row-padding">
    <div class="w3-col m12">
      <table class="w3-table">
        <thead class="w3-teal">
          <tr>
            <th>Documento</th>
            <th>Apellido</th>
            <th>Nombre</th>
            <th>Fech. Nacimiento</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Grupo</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($data_report as $e): ?>
          <tr>
            <td><?= $e["num_documento"] ?></td>
            <td><?= $e["apellidos"] ?></td>
            <td><?= $e["nombres"] ?></td>
            <td><?= $e["fecha_nacimiento"] ?></td>
            <td><?= $e["direccion"] ?></td>
            <td><?= $e["telefono"] ?></td>
            <td><?= $e["grupo_nombre"] ?></td>

          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php
unset($data);
$data["load_files"] = [
  sprintf("<script src='%s' ></script>",'https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js'),
  sprintf("<script src='%s' ></script>", base_url("assets/js/report_b.js"))
];
$this->load->view("layout/footer", $data);
?>