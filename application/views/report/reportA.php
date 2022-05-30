<?php
$data["page_title"]="Reporte I";
$data["id_window"]="window_report_a";

$this->load->view("layout/header", $data);

?>

<!-- DATA GRAPH -->
<?php foreach($data_report as $d): ?>
<input class="data" value="<?= $d["num_estudiantes"] ?>" data-lblname="<?= $d["nombre"] ?>"  type="hidden"  />
<?php endforeach; ?>
<!-- ./DATA GRAPH -->

<div style="height: 12em">
  <canvas id="graph-bar" >

  </canvas>
</div>



<div class="w3-card w3-container" style="padding:1em">
  <div class="w3-row-padding">
    <div class="w3-col m12">
      <table class="w3-table">
        <thead class="w3-teal">
          <tr>
            <th>Codigo</th>
            <th>Nombre</th>
            <th># de estudiantes</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($data_report as $d): ?>
          <tr>
            <td><?= $d["codigo"] ?></td>
            <td><?= $d["nombre"] ?></td>
            <td><?= $d["num_estudiantes"] ?></td>
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
  sprintf("<script src='%s' ></script>", base_url("assets/js/report_a.js"))
];
$this->load->view("layout/footer", $data);
?>