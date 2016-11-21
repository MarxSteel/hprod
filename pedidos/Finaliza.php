<?php
require("../restritos.php"); 
require_once '../init.php';
$PDO = db_connect();
 $query = $PDO->prepare("SELECT * FROM login WHERE login='$login'");
 $query->execute();
  $row = $query->fetch();
  $Nick = $row['Nome'];
$Numero = $_GET['ID']; 
$Data = date('d/m/Y H:i:s');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LiberaREP - Henry Equipamentos e Sistemas</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
</head>
<body class="hold-transition skin-blue layout-top-nav">
 <div class="wrapper">
  <header class="main-header">
   <nav class="navbar navbar-static-top">
    <div class="container">
     <div class="navbar-header">
      <span class="logo-lg"><img src="../dist/img/logo/logoWhite.png" width="200"></span>
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
    <section class="content">
     <div class="box box-default">
     <div class="box-header with-border">
     </div>
     <div class="box-body">
     <div class="col-xs-12"> 
      <h4>TEM CERTEZA DE QUE DESEJA FINALIZAR?</h4>
     </div>
      <div class="col-xs-12">
      <form name="cadastrar_anuncio" id="name" method="post" action="" enctype="multipart/form-data">
       <table width="400" border="0" align="center">
        <tr>
         <div class="col-xs-12"><br />
           <input name="enviar" type="submit" class="btn bg-orange btn-lg btn-block" id="enviar" value="Finalizar"  />
         </div>
        </tr>
       </table>
      </form>
      <?php 
      if(@$_POST["enviar"]){
       $executa = $PDO->query("UPDATE pedido SET Status='F', UserFinaliza='$Nick', DataFinaliza='$Data' WHERE id='$Numero' ");
        if($executa)
               {
        echo '<script type="text/javascript">alert("Liberado Com Sucesso!");</script>';
                   echo '<script type="text/javascript">window.close();</script>';


          }
          else{
          echo '<script type="text/javascript">alert("NÃO FOI POSSÍVEL LIBERAR EQUIPAMENTO");</script>';
                     echo '<script type="text/javascript">window.close();</script>';

          }
      }
      ?>
      </div>
      </div>
     </div>
    </section>
  </div>
 </div>
<?php 
include_once '../footer.php'; ?>
</div>
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../dist/js/app.min.js"></script>
</body>
</html>
