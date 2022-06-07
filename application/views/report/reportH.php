<?php
$data["page_title"]="Reporte VIII";
$data["id_window"]="window_report_h";

$this->load->view("layout/header", $data);

?>





<div class="w3-card w3-container" style="padding:1em">

  <form class="w3-row-padding" action="<?= site_url("report/reporth") ?>" method="post" >
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
            <th>Documento</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Grupo</th>
            <th class="w3-center">Cant. Materias Perdidas</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($data_report as $e): ?>
          <tr>
            <td ><?= $e["num_documento"] ?></td>
            <td class="data-lbl"><?= $e["nombres"] ?></td>
            <td><?= $e["apellidos"] ?></td>
            <td ><?= $e["nomb_grupo"] ?></td>
            <td class="w3-center" ><?= $e["cant_mat_perd"] ?></td>

          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php

$this->load->view("layout/footer");
?>