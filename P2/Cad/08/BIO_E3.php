<?php
require("../../../restritos.php");
require_once '../../../init.php';
$PDO = db_connect();
include_once '../../../QueryUser.php';
$Valida = $_GET['Sec'];

  // PROTOCOLO                           
  $empregador = "01+EE+000+1]10278563000108]]TESTE FABRICA]SAO PAULO";
   date_default_timezone_set('America/Sao_Paulo');
   $ProtocoloData = date('d/m/y');
   $ProtocoloHora = date('H:i:s');
  
  $enviaHora = "05+EH+000+" . $ProtocoloData . " " . $ProtocoloHora . "]00/00/00]00/00/00";
  $EnviaLogin = "07+EC+000+SENHA_MENU[987654";

   $ErroEnvioEmpregador = ' <div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-alert"></i> Atenção!</h4>
    Não foi possível enviar o empregador, o relógio não está na rede.</div>';

   $ErroEnvioDataHora = ' <div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-alert"></i> Atenção!</h4>
    Não foi possível enviar o empregador, o relógio não está na rede.</div>';
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
  <?php
    if ($Valida <> '44252') {
      echo '<section class="content">';
      echo '<div class="box box-default">';
      echo '<div class="box-header with-border">';
      echo '<h2 class="box-title"><strong> PASSO 3: </strong>CADASTRO DE CARTÃO</h2>';
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
    elseif ($Valida == '44252') {
      echo '<section class="content">';
      echo '<div class="box box-default">';
      echo '<div class="box-header with-border">';
      echo '<h2 class="box-title"><strong> PASSO 3: </strong>ENVIANDO MATRÍCULA PARA TESTE</h2>';
      echo '</div>';
      echo '<div class="box-body">';
      echo '<h3 class="page-title">Cadastro de Referênncia</h3>';
      echo 'Colaborador: <code>TESTE DE FABRICA</code></br >';
      ?>
          <div class='col-xs-4'>
            COLABORADOR:<br />
            NUM. PIS:<br />
            CARTÃO DE TESTE:<br />
            CARTÃO DO RETESTE:
          </div>
          <div class='col-xs-8'>
            TESTE DE FABRICA W<br />
           <strong><code>900000000022</code></strong><br />
           <strong><code>1</code></strong><br />
           <strong><code>2</code></strong>
          </div>
          <form name="enviaWiegand" id="EnviaWiegand" method="post" action="" enctype="multipart/form-data">
           <div class='col-xs-12'><br /><br />
            <input name="EnviaW" type="submit" class="btn btn-danger btn-block btn-lg" id="EnviaW" value="CADASTRAR MATRICULA" />
           </div>
          </form>
          <?php
          if(@$_POST["EnviaW"]){
           $cod_msg = "03+EU+00+1+I[900000000023[TESTE DE FABRICA 01[0[2[1}2";
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

           if ($msg1 == "03+EU+00") {
            echo '<script type="text/JavaScript">alert("Cartão Cadastrado!");location.href="BIO_E4.php?Sec=1337"</script>';
           }
           elseif ($msg1 <> "03+EU+00") {
            echo '<script type="text/JavaScript">alert("Cartão Cadastrado!");location.href="BIO_E4.php?Sec=1337"</script>';
           }
          }
        }
        else
        {
        }
          ?>
      </div>
     </div>
    </section>
      </div><!-- /.container -->
     </div><!-- /.content-wrapper -->
     <footer class="main-footer"><?php include_once '../../../footer.php'; ?></footer>
   </div><!-- ./wrapper -->
    <script src="../../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="../../../bootstrap/js/bootstrap.min.js"></script>
    <script src="../../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="../../../plugins/fastclick/fastclick.min.js"></script>
    <script src="../../../dist/js/app.min.js"></script>
    <script src="../../../dist/js/demo.js"></script>
  </body>
</html>