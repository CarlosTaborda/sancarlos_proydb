<?php
$data["page_title"]="Reporte III";
$data["id_window"]="window_report_c";

$this->load->view("layout/header", $data);

?>

<div class="w3-card w3-container" style="padding:1em">

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
            <td><?= $e["grupo_nomb"] ?></td>

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