<?php
$data["page_title"]="Informes";
$data["id_window"]="window_report";

$this->load->view("layout/header", $data);
?>

<div class="w3-card w3-container" style="min-height: 60vh;">
    <div class="w3-row-padding">
        <div class="w3-col s4">
            <h3 class="w3-margin">
                Informes simples
            </h3>
        </div>
        <div class="w3-col s4">
            <h3 class="w3-margin">
                Informes Intermedios
            </h3>
        </div>
        <div class="w3-col s4">
            <h3 class="w3-margin">
                Informes Complejos
            </h3>
        </div>
    </div>
    <div class="w3-row-padding" style="margin-bottom: 0.5em;">
        <div class="w3-col m4">
            <a class="w3-btn w3-teal" href="<?= site_url("report/reporta") ?>" >Cant. Estudiantes por Grupo
            <span class="material-icons">
            leaderboard
            </span>
            </a>
        </div>
        <div class="w3-col m4">
            <a class="w3-btn w3-orange" href="<?= site_url("report/reportd") ?>" >
                Profesores con mas horas licencia
                <span class="material-icons">
                leaderboard
                </span>
            </a>
            
        </div>
        <div class="w3-col m4">
            <a class="w3-btn w3-red" href="<?= site_url("report/reporth") ?>" >Estudiantes 3 o mas materias perdidas</a>
        </div>
    </div>
    <div class="w3-row-padding" style="margin-bottom: 0.5em;">
        <div class="w3-col m4">
            <a class="w3-btn w3-teal" href="<?= site_url("report/reportb") ?>" > List. Estudiantes por Grupo</a>
        </div>
        <div class="w3-col m4">
            <button class="w3-btn w3-orange" >2</button>
        </div>
        <div class="w3-col m4">
            <a class="w3-btn w3-red" href="<?= site_url("report/reporti") ?>" >
                Cant. Estudiantes perdiendo el año por grupo
                <span class="material-icons">
                leaderboard
                </span>
            </a>
        </div>
    </div>
    <div class="w3-row-padding" style="margin-bottom: 0.5em;">
        <div class="w3-col m4">
            <a href="<?=site_url('report/reportc')?>" class="w3-btn w3-teal" >Estudiantes Inactivos</a>
        </div>
        <div class="w3-col m4">
            <button class="w3-btn w3-orange" >3</button>
        </div>
        <div class="w3-col m4">
            <button class="w3-btn w3-red" >3</button>
        </div>
    </div>
    <div class="w3-row-padding" style="margin-bottom: 0.5em;">
        <div class="w3-col m4"></div>
        <div class="w3-col m4" style="margin-left: 33.33%;">
            <button class="w3-btn w3-orange"  >4</button>
        </div>
        <div class="w3-col m4"></div>
    </div>
</div>

<?php
unset($data);
$data["load_files"] = [
  sprintf("<script src='%s' ></script>", base_url("assets/js/informe.js"))
];
$this->load->view("layout/footer", $data);
?>