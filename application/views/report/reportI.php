<?php
$data["page_title"]="Reporte IX";
$data["id_window"]="window_report_b";

$this->load->view("layout/header", $data);

?>
<div style="height: 12em; margin:2em 0em">
  <canvas id="pie-bar" >

  </canvas>
</div>

<div class="w3-card w3-container" style="padding:1em">
  
  <div class="w3-row-padding">
    <div class="w3-col m12">
      <table class="w3-table">
        <thead class="w3-teal">
          <tr>
            <th>Cod. Grupo</th>
            <th>Grupo</th>
            <th>Estudiantes perdiendo</th>
            <th>Total Estudiante</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($data_report as $e): ?>
          <tr>
            <td ><?= $e["grupo_codigo"] ?></td>
            <td class="data-lbl"><?= $e["nomb_grupo"] ?></td>
            <td><?= $e["cant_perd"] ?></td>
            <td><?= $e["cant_tot"] ?></td>

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
  sprintf("<script src='%s' ></script>",'https://cdn.jsdelivr.net/gh/google/palette.js@master/palette.js'),

  sprintf("<script src='%s' ></script>", base_url("assets/js/report_d.js"))
];
$this->load->view("layout/footer", $data);
?>