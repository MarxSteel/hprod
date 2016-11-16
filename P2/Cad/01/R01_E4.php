<?php
require("../../../restritos.php");
require_once '../../../init.php';
$Valida = $_GET['Sec'];
$PDO = db_connect();
include_once '../../../QueryUser.php';

  //DECLARANDO ENVIO DE COLABORADOR NA MATRICULA 1
    $Matricula = "03+EU+000+1+I[900000000022[TESTE DE FABRICA[0[1[1";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LiberaREP - Henry Equipamentos e Sistemas</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../../../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../../../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../../../dist/css/skins/_all-skins.min.css">
</head>
<body class="hold-transition skin-blue layout-top-nav">
 <div class="wrapper">
  <header class="main-header">
   <nav class="navbar navbar-static-top">
    <div class="container">
     <div class="navbar-header">
      <span class="logo-lg"><img src="../../../dist/img/logo/henry-top.png" width="200"></span>
     </div>
     <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
       <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <span class="hidden-xs">Olá, <?php echo $Nick; ?></span></a>
       </li>
      </ul>
     </div>
    </div>
   </nav>
  </header>
  <div class="content-wrapper">
   <div class="container">
    <section class="content-header">
     <ol class="breadcrumb">
      <li>CADASTRO DE EQUIPAMENTO: PRISMA SUPER FÁCIL R02</li>
      <li><code>D. ALFANUMÉRICO 16X2 | BIOMETRIA + PROXIMIDADE</code></li>
     </ol>
    </section>
    <?php
    if ($Valida <> '1') {
      echo '<section class="content">';
      echo '<div class="box box-default">';
      echo '<div class="box-header with-border">';
      echo '<h2 class="box-title"><strong> PASSO 4: </strong>ENVIAR CARTÃO MIFARE</h2>';
      echo '</div>';
      echo '<div class="box-body">';
      echo '<div class="alert alert-danger alert-dismissible">';
      echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
      echo '<h4><i class="icon fa fa-ban"></i> Erro!</h4>';
      echo '<h3>Você não seguiu os passos corretos para Cadastro do equipamento. Feche a tela e refaça novamente. </h3><br />';
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '</section>';
    }
    elseif ($Valida == '1') {
      echo '<section class="content">';
      echo '<div class="box box-default">';
      echo '<div class="box-header with-border">';
      echo '<h2 class="box-title"><strong> PASSO 4: </strong>ENVIAR CARTÃO SMARTCARD</h2>';
      echo '</div>';
      echo '<div class="box-body">';
      echo '<h3 class="page-title">Cadastro de Referência</h3>';
      ?>
      <div class='col-xs-4'>
        COLABORADOR:<br />
        NUM. PIS:<br />
        CARTÃO DE TESTE:<br />
        CARTÃO DO RETESTE:
      </div>
      <div class='col-xs-8'>
        TESTE DE FABRICA 3<br />
       <strong><code>900000000022</code></strong><br />
       <strong><code><?php echo $SMARTCARD; ?></code></strong><br />
       <strong><code><?php echo $Mteste; ?></code></strong>
      </div>
      <form name="EnvMif" id="EnvMif" method="post" action="" enctype="multipart/form-data">
       <div class='col-xs-12'><br /><br />
        <input name="EnviaMif" type="submit" class="btn btn-danger btn-block btn-lg" id="EnviaMif" value="ENVIAR CARTÕES SMARTCARD / BARRAS" />
       </div>
     </form>
     <?php
     if(@$_POST["EnviaMif"]){
       $cod_msg = "03+EU+000+1+I[900000000028[TESTE DE FABRICA 3[0[2[" . $SMARTCARD . "}" . $Mteste;
       $cod_asc = gerar($cod_msg);
       $gera_asc = str_replace(" ","",$cod_asc);
       $port    = 3000;
       $msg = hex2str($gera_asc);
       $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
        socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 1, 'usec' => 0));
        socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 1, 'usec' => 0));
         $result = socket_connect($socket, $MeuIP, $port) or die($M006);
        socket_write($socket, $msg, strlen($msg)) or die($M002);
        $msg1 = socket_read($socket,8192);
        socket_close($socket);

       if ($msg1) {
       }
       elseif ($msg1) {
         $cod_msg = "03+EU+000+1+I[900000000029[TESTE DE FABRICA 2[0[2[1}2";
         $cod_asc = gerar($cod_msg);
         $gera_asc = str_replace(" ","",$cod_asc);
         $port    = 3000;
         $msg = hex2str($gera_asc);
         $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
          socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 1, 'usec' => 0));
          socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 1, 'usec' => 0));
           $result = socket_connect($socket, $MeuIP, $port) or die($M006);
          socket_write($socket, $msg, strlen($msg)) or die($M002);
          $msg1 = socket_read($socket,8192);
          socket_close($socket);
          echo '<script type="text/JavaScript">alert("Cartões Cadastrados!");location.href="R01_E5.php?Sec=1"</script>';
          }
         }
        }
        else{

        }
      ?>
       </div>
      </div>
     </div>
    </section>
  </div>
 </div>
<?php
include_once '../../../footer.php'; ?>
</div>
<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../../../bootstrap/js/bootstrap.min.js"></script>
<script src="../../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../../../dist/js/app.min.js"></script>
</body>
</html>
