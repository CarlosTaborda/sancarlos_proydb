<?php
$data["page_title"]="Reporte IX";
$data["id_window"]="window_report_b";

$this->load->view("layout/header", $data);

?>

<div 
  style="display: flex;flex-wrap: wrap;justify-content: center;"
>
<?php foreach($data_report as $e): ?>
<div 
  class="char-info" 
  data-group_name="<?= $e["nomb_grupo"] ?>" 
  data-total_students="<?= $e["cant_tot"] ?>" 
  data-perd_students="<?= $e["cant_perd"] ?>"
  style="height:24em; width:14em;margin: 2em 4em;"
>
  <h3 class="w3-center"><?= $e["nomb_grupo"] ?></h3>
  <canvas id="pie-bar"  >

  </canvas>
</div>
<?php endforeach; ?>
</div>
<div class="w3-card w3-container" style="padding:1em">

  
  

  <form class="w3-row-padding" action="<?= site_url("report/reporti") ?>" method="post" >
    <div class="w3-col m4">
      <p>
        Año
        <input type="number" value="<?= date('Y') ?>" class="w3-input" name="anio" required  >
      </p>
    </div>
    <div class="w3-col m2">
      <button class="w3-btn w3-indigo" style="margin-top: 2.2em" >
        Buscar
      </button>
    </div>
  </form>
  <div class="w3-row-padding">
    <div class="w3-col m12">
      <table class="w3-table">
        <thead class="w3-teal">
          <tr>
            <th>Cod. Grupo</th>
            <th>Grupo</th>
            <th class="w3-center">Estudiantes perdiendo</th>
            <th class="w3-center">Total Estudiantes</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($data_report as $e): ?>
          <tr>
            <td ><?= $e["grupo_codigo"] ?></td>
            <td class="data-lbl"><?= $e["nomb_grupo"] ?></td>
            <td class="w3-center"><?= $e["cant_perd"] ?></td>
            <td class="w3-center"><?= $e["cant_tot"] ?></td>

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
  sprintf("<script src='%s' ></script>", base_url("assets/js/report_i.js"))
];
$this->load->view("layout/footer", $data);
?>