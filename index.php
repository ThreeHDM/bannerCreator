<?php
if (isset($_POST["submit"])) {
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      $mssgeImg = " File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      $mssgeImg = " File is not an image.";
      $uploadOk = 0;
    }
  }
  // Check if file already exists
  if (file_exists($target_file)) {
    $mssgeExists = " Sorry, file already exists.";
    $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
    $mssgeSize = " Sorry, your file is too large.";
    $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    $mssgeFormat = " Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    $mssgeError = " Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $mssgeSucc = " The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
      $nombreArchivo = basename( $_FILES["fileToUpload"]["name"]);
    } else {
      $mssgeError = " Sorry, there was an error uploading your file.";
    }
  }
} else {
  $mssgeError = " Sorry, there was an error uploading your file.";
} // fin del if que chequea el submit

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/jscolor.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script>

  $(function() {
    $( "#sliderTitulo" ).slider({
      slide: function( event, ui ) {
        $( "#titulo" ).val(ui.value);
        //event.stopPropagation();
        $.post("imagen.php", $("#formulario_banner").serialize() , function(data) {
          $('#ima').html('<img src="' + data + '" />');
        });
      }
    });

    $( "#sliderRotTitulo" ).slider({
      slide: function( event, ui ) {
        $( "#rotTitulo" ).val(ui.value);
        //event.stopPropagation();
        $.post("imagen.php", $("#formulario_banner").serialize() , function(data) {
          $('#ima').html('<img src="' + data + '" />');
        });
      }
    });

    $( "#sliderMargenIzqTitulo" ).slider({
      max: 728,
      slide: function( event, ui ) {
        $( "#margenIzqTitulo" ).val(ui.value);
        //event.stopPropagation();
        $.post("imagen.php", $("#formulario_banner").serialize() , function(data) {
          $('#ima').html('<img src="' + data + '" />');
        });
      }
    });

    $( "#sliderMargenSupTitulo" ).slider({
      max: 280,
      slide: function( event, ui ) {
        $( "#margenSupTitulo" ).val(ui.value);
        //event.stopPropagation();
        $.post("imagen.php", $("#formulario_banner").serialize() , function(data) {
          $('#ima').html('<img src="' + data + '" />');
        });
      }
    });

    $( "#sliderTextMargSup" ).slider({
      max: 280,
      slide: function( event, ui ) {
        $( "#textMargSup" ).val(ui.value);
        //event.stopPropagation();
        $.post("imagen.php", $("#formulario_banner").serialize() , function(data) {
          $('#ima').html('<img src="' + data + '" />');
        });
      }
    });

    $( "#sliderTextMargIzq" ).slider({
      max: 728,
      slide: function( event, ui ) {
        $( "#textMargIzq" ).val(ui.value);
        //event.stopPropagation();
        $.post("imagen.php", $("#formulario_banner").serialize() , function(data) {
          $('#ima').html('<img src="' + data + '" />');
        });
      }
    });

    $( "#sliderTextSize" ).slider({
      slide: function( event, ui ) {
        $( "#textSize" ).val(ui.value);
        //event.stopPropagation();
        $.post("imagen.php", $("#formulario_banner").serialize() , function(data) {
          $('#ima').html('<img src="' + data + '" />');
        });
      }
    });

    $( "#sliderTextWidth" ).slider({
      max: 728,
      slide: function( event, ui ) {
        $( "#textWidth" ).val(ui.value);
        //event.stopPropagation();
        $.post("imagen.php", $("#formulario_banner").serialize() , function(data) {
          $('#ima').html('<img src="' + data + '" />');
        });
      }
    });

    $( "#sliderMargDerLog" ).slider({
      max: 728,
      slide: function( event, ui ) {
        $( "#margDerLog" ).val(ui.value);
        //event.stopPropagation();
        $.post("imagen.php", $("#formulario_banner").serialize() , function(data) {
          $('#ima').html('<img src="' + data + '" />');
        });
      }
    });
    $( "#sliderMargInfLog" ).slider({
      max: 280,
      slide: function( event, ui ) {
        $( "#margInfLog" ).val(ui.value);
        //event.stopPropagation();
        $.post("imagen.php", $("#formulario_banner").serialize() , function(data) {
          $('#ima').html('<img src="' + data + '" />');
        });
      }
    });

    $( "#sliderAnchLog" ).slider({
      max: 300,
      slide: function( event, ui ) {
        $( "#anchLog" ).val(ui.value);
        //event.stopPropagation();
        $.post("imagen.php", $("#formulario_banner").serialize() , function(data) {
          $('#ima').html('<img src="' + data + '" />');
        });
      }
    });

    $( "#sliderAltLog" ).slider({
      max: 280,
      slide: function( event, ui ) {
        $( "#altLog" ).val(ui.value);
        //event.stopPropagation();
        $.post("imagen.php", $("#formulario_banner").serialize() , function(data) {
          $('#ima').html('<img src="' + data + '" />');
        });
      }
    });

    $( "#sliderBorderThick" ).slider({
      max: 15,
      min: 1,
      slide: function( event, ui ) {
        $( "#borderThick" ).val(ui.value);
        //event.stopPropagation();
        $.post("imagen.php", $("#formulario_banner").serialize() , function(data) {
          $('#ima').html('<img src="' + data + '" />');
        });
      }
    });

  });

  </script>
  <style media="screen">

  </style>
</head>
<body>

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 text-center">
        <br>
        <div id="ima">
          <h1>Su banner aparecerá aquí</h1>
        </div>
      </div>
    </div>
  </div>

  <br>
  <div class="container">
    <div class="row text-center">
      <div class="col-xs-12">
        <button class="tablinks" onclick="openTab(event, 'titulo_tab')" id="defaultOpen">Titulo</button>
        <button class="tablinks" onclick="openTab(event, 'texto_tab')">Texto</button>
        <button class="tablinks" onclick="openTab(event, 'borde_tab')">Borde</button>
        <button class="tablinks" onclick="openTab(event, 'logo_tab')">Logo</button>
      </div>
    </div> <!-- row -->
  </div> <!-- container -->
  <br>
  <br>
  <form id="formulario_banner">
    <div id="titulo_tab" class="container tabcontent">
      <div class="row">
        <div class="col-xs-3">
          <div class="form-group">
            <label for="">Titulo</label>
            <input class="alltext" type="text" name="texto_t" value="Titulo">
          </div>
        </div>
          <div class="col-xs-3">
            <label for="fuente_t">Fuente</label>
            <select class="all" name="fuente_t">
              <?php

              $fuentes = scandir("fonts", 1);

              $indir_f = array_filter($fuentes, function($item) {
                return $item[0] !== '.';
              });


              foreach ($indir_f as $fuente) {

                ?>

                <option value="<?php echo $fuente; ?>"><?php echo $fuente; ?></option>

                <?php
              }

              ?>

            </select>
        </div>
        <div class="col-xs-3">
          <div class="form-group">
            <label for="">Color Titulo</label>
            <br>
            <input class="all" name="color_titulo" type="hidden" id="color1_value" value="000000">
            <button class="jscolor {valueElement: 'color1_value'}">Elige un color</button>
            <br>
            <br>
          </div>
        </div>
        <div class="col-xs-3">
          <div class="form-group">
            <label>Tamaño del Banner</label>
            <select name="size" class="all">
              <option value="1" selected>468x60 Banner</option>
              <option value="2">728x90 Leaderboard</option>
              <option value="3">234x60 Half Banner</option>
              <option value="4">336x280 Large Rectangle</option>
            </select>
          </div>
        </div>
      </div> <!-- row -->

      <div class="row">
        <div class="col-xs-3">
          <div class="form-group">
            <label>Margen Izquierdo Título</label>
            <div id="sliderMargenIzqTitulo"></div>
            <br>
            <input class="all alltext" id='margenIzqTitulo' type="number" name="marginlef_tit" value="25">
          </div>
        </div>
        <div class="col-xs-3">
          <div class="form-group">
            <label>Margen superior Título</label>
            <div id="sliderMargenSupTitulo"></div>
            <br>
            <input class="all alltext" id="margenSupTitulo" type="number" name="margintop_tit" value="51">
          </div>
        </div>
        <div class="col-xs-3">
          <div class="form-group">
            <label>Tamaño Título</label>
            <div id="sliderTitulo"></div>
            <br>
            <input class="all alltext" style="width: 100%;" id="titulo" type="number" name="size_tit" value="48">
          </div>
        </div>
        <div class="col-xs-3">
          <div class="form-group">
            <label>Rotación titulo</label>
            <div id="sliderRotTitulo"></div>
            <br>
            <input class="all alltext" style="width: 100%;" id="rotTitulo" type="number" name="rotacion_t" value="0">
          </div>
        </div>
      </div> <!-- row -->
    </div> <!-- container -->

    <div id="texto_tab" class="container tabcontent">
      <div class="row">
        <div class="col-xs-3">
          <div class="form-group">
            <label for="">Texto</label>
            <textarea class="alltext" style="height: 60px; width: 100%; "name="texto" rows="8" cols="80">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</textarea>
          </div>
        </div>
        <div class="col-xs-3">
          <div class="form-group">
            <label for="">Color Texto</label>
            <br>
            <input class="all" name="color_detalle" type="hidden" id="color2_value" value="000000">
            <button class="jscolor {valueElement: 'color2_value'}">Elige un color</button>
          </div>
        </div>
        <div class="col-xs-3">
          <label for="fuente_det">Fuente</label>
          <select class="all" name="fuente_det">
            <?php

            $f = scandir("fonts", 1);

            $indir_fd = array_filter($f, function($item) {
              return $item[0] !== '.';
            });


            foreach ($indir_fd as $fuented) {

              ?>

              <option value="<?php echo $fuented; ?>"><?php echo $fuented; ?></option>

              <?php
            }

            ?>

          </select>
        </div>
        <div class="col-xs-3">
          <p>Opcion Texto</p>
        </div>
      </div><!-- row -->
      <div class="row">

      <div class="col-xs-3">
        <div class="form-group">
          <label>Margen izquierdo Texto</label>
          <div id="sliderTextMargIzq"></div>
          <br>
          <input class="all alltext" id="textMargIzq" type="number" name="textox" value="100">
        </div>
      </div>
      <div class="col-xs-3">
        <div class="form-group">
          <label>Margen superior Texto</label>
          <div id="sliderTextMargSup"></div>
          <br>
          <input class="all alltext" id="textMargSup" type="number" name="textoy" value="15">
        </div>
      </div>
      <div class="col-xs-3">
        <label>Ancho Texto</label>
        <div id="sliderTextWidth"></div>
        <br>
        <input class="all alltext" id="textWidth" type="number" name="ancho_det" value="200">
      </div>
      <div class="col-xs-3">
        <div class="form-group">
          <label>Tamaño Texto</label>
          <div id="sliderTextSize"></div>
          <br>
          <input class="all alltext" id="textSize" type="number" name="size_det" value="12">
        </div>
      </div>
        </div><!-- row -->
      </div><!-- container -->


    <div id="borde_tab" class="container tabcontent">
      <div  class="row">
        <div class="col-xs-2">
            <label for="borde">Borde</label>
            <input class="all" type="radio" name="border" value="0" checked> No
            <input class="all" type="radio" name="border" value="1"> Si
        </div>
        <div class="col-xs-2">
          <label for="">Color Borde</label>
          <input class="all" name="color_borde" type="hidden" id="color3_value" value="000000">
          <button class="jscolor {valueElement: 'color3_value'}">Elige un color</button>
        </div>
        <div class="col-xs-2">
          <label>Grosor</label>
          <div id="sliderBorderThick"></div>
          <br>
          <input class="all alltext" id="borderThick" type="number" name="border_thick" value="1">
        </div>
        <div class="col-xs-2">
          <p>Opciones de Borde</p>

        </div>
        <div class="col-xs-2">
          <p>Opciones de Borde</p>

        </div>
        <div class="col-xs-2">
          <p>Opciones de Borde</p>

        </div>

      </div>
    </div>

      <div id="logo_tab" class="container tabcontent">
        <div class="row">
          <div class="col-xs-2">
            <label for="logo">Elige un logo que ya hayas cargado</label>
            <select class="all" name="logo">
              <?php

              $archivos = scandir("uploads", 1);

              $indir = array_filter($archivos, function($item) {
                return $item[0] !== '.';
              });


              foreach ($indir as $archivo) {

                ?>

                <option value="<?php echo $archivo; ?>"><?php echo $archivo; ?></option>

                <?php
              }

              ?>

            </select>
          </div>
          <div class="col-xs-2">
            <label>Margen Derecho Logo</label>
            <div id="sliderMargDerLog"></div>
            <br>
            <input class="all alltext" id="margDerLog" type="number" name="logo_margen_dcho" value="0">
          </div>
          <div class="col-xs-2">
            <label>Margen Inferior Logo</label>
            <div id="sliderMargInfLog"></div>
            <br>
            <input class="all alltext" id="margInfLog" type="number" name="logo_margen_inf" value="0">
          </div>
          <div class="col-xs-2">
            <label>Ancho del Logo</label>
            <div id="sliderAnchLog"></div>
            <br>
            <input class="all alltext" id="anchLog" type="number" name="resizeWidth" value="100">
          </div>
          <div class="col-xs-2">
            <label>Alto del Logo</label>
            <div id="sliderAltLog"></div>
            <br>
            <input class="all alltext" id="altLog" type="number" name="resizeHeight" value="100">
          </div>
          <div class="col-xs-2">
            <label for="logo_opt"> Mostrar Logo</label>
            <input class="all" type="radio" name="logo_opt" value="0" checked> No
            <input class="all" type="radio" name="logo_opt" value="1"> Si
          </div>
        </div>
      </div>

      <div class="container">

        <div class="row">
          <div class="col-xs-4">
            <!-- <input type="submit" value="Enviar cambios" class="enviar"> -->
          </div>
          <div class="col-xs-4">
          </div>
          <div class="col-xs-4">
            <!-- <form class="form-inline" action="index.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="">Selecciona una imagen para subir:</label>
                <input type="file" name="fileToUpload" id="fileToUpload">
              </div>
              <input type="submit" value="Subir" name="submit" class="btn btn-default">
            </form>
            <p><?php
            if (isset($mssgeImg)) {
              echo $mssgeImg;
            }
            if (isset($mssgeExists)) {
              echo $mssgeExists;
            }
            if (isset($mssgeSize)) {
              echo $mssgeSize;
            }
            if (isset($mssgeFormat)) {
              echo $mssgeFormat;
            }
            if (isset($mssgeError)) {
              echo $mssgeError;
            }
            if (isset($mssgeSucc)) {
              echo $mssgeSucc;
            }
            ?></p> -->

          </div>
        </div>

    </div> <!-- container -->
  </form>



  <script type="text/javascript">
  /*
  $('.enviar').click(function(e) {
  e.preventDefault();
  e.stopPropagation();
  $.post("imagen.php", $("#formulario_banner").serialize() , function(data) {

  $('#ima').html('<img src="' + data + '" />');
  //$('#ima').append(data);
  //console.log(data);

});
});
*/


$('.all').change(function(e) {
  e.stopPropagation();
  $.post("imagen.php", $("#formulario_banner").serialize() , function(data) {
    $('#ima').html('<img src="' + data + '" />');
    //$('#ima').append(data);
    //console.log(data);

  });
});

$('.alltext').keyup(function(e) {
  //e.stopPropagation();
  $.post("imagen.php", $("#formulario_banner").serialize() , function(data) {

    $('#ima').html('<img src="' + data + '" />');
    //$('#ima').append(data);
    //console.log(data);

  });
});

function openTab(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

document.getElementById("defaultOpen").click();

</script>

</body>
</html>
