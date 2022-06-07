<?php
$data["page_title"]="Reporte X";
$data["id_window"]="window_report_j";

$this->load->view("layout/header", $data);

?>


<div class="w3-card w3-container" style="padding:1em">

  <div class="w3-row-padding">
    <div class="w3-col m12 w3-center">
      <table class="w3-table" style="max-width: 40em;margin: auto;">
        <thead class="w3-teal">
          <tr>
            <th>Grupo</th>
            <th class="w3-center">Cant. Estudiantes</th>
            <th class="w3-center">Cant. Estudiantes retirados</th>

          </tr>
        </thead>
        <tbody>
          <?php foreach($data_report as $e): ?>
          <tr>
            <td ><?= $e["gru_nombre"] ?></td>
            <td class="w3-center"><?= $e["cant_estudiantes"] ?></td>
            <td class="w3-center"><?= $e["cant_inactivos"] ?></td>

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
  sprintf("<script src='%s' ></script>", base_url("assets/js/report_j.js"))
];
$this->load->view("layout/footer", $data);
?>