<?php
$data["page_title"]="Reporte IV";
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
            <th>Documento</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Profesión</th>
            <th>Cant. Dias</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($data_report as $e): ?>
          <tr>
            <td ><?= $e["num_documento"] ?></td>
            <td class="data-lbl"><?= $e["nombres"] ?></td>
            <td><?= $e["apellidos"] ?></td>
            <td><?= $e["profesion"] ?></td>
            <td class="data-vl" ><?= $e["numdias"] ?></td>

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