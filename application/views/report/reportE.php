<?php
$data["page_title"]="Reporte V";
$data["id_window"]="window_report_e";

$this->load->view("layout/header", $data);

?>

<div class="w3-card w3-container" style="padding:1em">
  <form class="w3-row-padding" method="POST">  
    <div class="w3-col m4">
      <p>
        Grupo:
        <select value="" class="w3-input" name="grupo" >
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
    <div class="w3-col m3">
      <p>
        Documento
        <input type="text" disabled class="w3-input" value="<?= !empty($data_report[0])?$data_report[0]['tipo_documento_codigo'].' '.$data_report[0]['num_documento']:"" ?>">
      </p>
    </div>
    <div class="w3-col m3">
      <p>
        Nombres
        <input type="text" disabled class="w3-input" value="<?= !empty($data_report[0])? $data_report[0]['nombres'] : "" ?>">
      </p>
    </div>
    <div class="w3-col m3">
      <p>
        Apellidos
        <input type="text" value="<?=  !empty($data_report[0])? $data_report[0]['apellidos'] : "" ?>" disabled class="w3-input">
      </p>
    </div>
    <div class="w3-col m3">
      <p>
        Profesión
        <input type="text" value="<?= !empty($data_report[0])? $data_report[0]['profesion'] : "" ?>" disabled class="w3-input">
      </p>
    </div>
  </div>
  <div class="w3-row-padding">
    <div class="w3-col m12">
      <table class="w3-table">
        <thead class="w3-teal">
          <tr>
            <th>Grupo</th>
            <th>Año</th>
            <th>Materia</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($data_report as $e): ?>
          <tr>
            <td><?= $e["gru_nombre"] ?></td>
            <td><?= $e["anio"] ?></td>
            <td><?= $e["mat_nombre"] ?></td>


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
  sprintf("<script src='%s' ></script>", base_url("assets/js/report_e.js"))
];
$this->load->view("layout/footer", $data);
?>