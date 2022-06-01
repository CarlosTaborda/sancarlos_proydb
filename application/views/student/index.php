<?php
$data["page_title"]="Estudiantes";
$data["id_window"]="window_student";

$this->load->view("layout/header", $data);
?>

<div class="w3-card w3-container">

  <div class="w3-container" style="margin: 1.5em 0em;">
    <button class="w3-right w3-btn w3-teal" onclick="$('#modal-create').show();app.resetFormEstudiante();app.resetFormAcudiente()">Crear</button>
  </div>

  <div class="w3-row-padding">
    <div class="w3-col m12">
      <div class="w3-responsive">
        <table id="table-student" >
          <thead class="w3-teal">
            <tr>
              <td>Núm. Documento</td>
              <td>Nombres</td>
              <td>Apellidos</td>
              <td>Fech. Nacimiento</td>
              <td>Dirección</td>
              <td>Teléfono</td>
              <td>Acudiente</td>
              <td>Grupo</td>
              <td>Editar</td>
              <td>Eliminar</td>
            </tr>
          </thead>
        </table>
      </div>
      
    </div>
  </div>
</div>


<div id="modal-create" class="w3-modal">
  <div class="w3-modal-content w3-card-4 w3-animate-zoom">
   <header class="w3-container w3-teal"> 
    <span onclick="document.getElementById('modal-create').style.display='none'" 
    class="w3-button w3-teal w3-xlarge w3-display-topright">&times;</span>
    <h2>Crear/Editar Estudiante</h2>
   </header>
 
    <div class="w3-bar w3-border-bottom">
      <button class="tablink w3-bar-item w3-button w3-indigo" @click="openTab( 'attendant')">Acudiente</button>
      <button class="tablink w3-bar-item w3-button w3-indigo" @click="openTab( 'create')">Estudiante</button>
    </div>

    <div id="attendant" class="w3-container tab ">

      <h3 class="w3-margin">Acudiente</h3>
      <div class="w3-row-padding">
        <div class="w3-col m3 s6">
          <p>
            Tipo de Documento
            <select name="" id="acu-tipo_documento_codigo" class="w3-input">
              <option>--seleccione--</option>
              <?php foreach( $doc_types as $dt): ?>
              <option value="<?= $dt['codigo'] ?>"><?= $dt['descripcion'] ?></option>
              <?php endforeach; ?>
            </select>
          </p>
        </div>
        <div class="w3-col m3 s6">
          <p>
            Número de Documento
            <input name="" type="text" id="acu-num_documento" class="w3-input"/>
          </p>
        </div>
        <div class="w3-col m3 s6">
          <p>
            Nombres
            <input name="" type="text" id="acu-nombres" class="w3-input"/>
          </p>
        </div>
        <div class="w3-col m3 s6">
          <p>
            Apellidos
            <input name="" type="text" id="acu-apellidos" class="w3-input"/>
          </p>
        </div>
      </div>
      <div class="w3-row-padding">
        <div class="w3-col m4 s6">
          <p>
            Teléfono
            <input name="" type="text" id="acu-telefono" class="w3-input"/>
          </p>
        </div>
        <div class="w3-col m4 s6">
          <p>
            Dirección
            <input name="" type="text" id="acu-direccion" class="w3-input"/>
          </p>
        </div>
        <div class="w3-col m4 s12">
          <p>
            Parentesco
            <input name="" type="text" id="acu-parentesco" class="w3-input"/>
          </p>
        </div>

      </div>
      <div class="w3-container" style="margin: 1.5em 0em;">
        <button @click="createAcudiente" class="w3-right w3-btn w3-amber">Aceptar</button>
      </div>
    </div>
 
    <div id="create" class="w3-container tab w3-hide">
      <h3 class="w3-margin">Estudiante</h3>
      <div class="w3-row-padding">
        <div class="w3-col m9">
          <p>
            Acudiente
            <select name="" id="es-acudiente_num_documento" class="w3-input">
              <option value="">-- seleccione --</option>
              <option v-for="(a, index) in acudientes" :value="a.num_documento" >{{ a.nombres+' '+a.apellidos }}</option>
            </select>
          </p>
        </div>

        <div class="w3-col m3" style="margin-top: 2.6em;">
          <label for="es-estado">
            <input id="es-estado" class="w3-check" type="checkbox" checked="checked">
            Activo
          </label>
        </div>
      </div>
      <div class="w3-row-padding">
        <div class="w3-col m3 s6">
          <p>
            Tipo de Documento
            <select name="" id="es-tipo_documento_codigo" class="w3-input">
              <option>--seleccione--</option>
              <?php foreach( $doc_types as $dt): ?>
              <option value="<?= $dt['codigo'] ?>"><?= $dt['descripcion'] ?></option>
              <?php endforeach; ?>
            </select>
          </p>
        </div>
        <div class="w3-col m3 s6">
          <p>
            Número de Documento
            <input name="" type="text" id="es-num_documento" class="w3-input"/>
          </p>
        </div>
        <div class="w3-col m3 s6">
          <p>
            Nombres
            <input name="" type="text" id="es-nombres" class="w3-input"/>
          </p>
        </div>
        <div class="w3-col m3 s6">
          <p>
            Apellidos
            <input name="" type="text" id="es-apellidos" class="w3-input"/>
          </p>
        </div>
      </div>

      <div class="w3-row-padding">
        <div class="w3-col m3 s6">
          <p>
            Fecha de nacimiento
            <input type="date" id="es-fecha_nacimiento" class="w3-input"/>
          </p>
        </div>
        <div class="w3-col m3 s6">
          <p>
            Dirección
            <input name="" type="address" id="es-direccion" class="w3-input"/>
          </p>
        </div>
        <div class="w3-col m3 s6">
          <p>
            Teléfono
            <input name="" type="tel" id="es-telefono" class="w3-input"/>
          </p>
        </div>
        <div class="w3-col m3 s6">
          <p>
            Grupo
            <select class="w3-input" id="es-grupo_codigo">
              <option>--seleccione--</option>
              <?php foreach( $groups as $g): ?>
              <option value="<?= $g['codigo'] ?>"><?= $g['nombre'] ?></option>
              <?php endforeach; ?>
            </select>
          </p>
        </div>
      </div>

      <div class="w3-container" style="margin: 1.5em 0em;">
        <button @click="createEstudiante" class="w3-right w3-btn w3-amber">Aceptar</button>
      </div>
    </div>
 
    
 
    <div class="w3-container w3-light-grey w3-padding">
      <button class="w3-button w3-right w3-white w3-border" 
      onclick="document.getElementById('modal-create').style.display='none'">Cerrar</button>
    </div>
  </div>
</div>

<?php
unset($data);
$data["load_files"] = [
  sprintf("<script src='%s' ></script>", base_url("assets/js/estudiante.js"))
];
$this->load->view("layout/footer", $data);
?>