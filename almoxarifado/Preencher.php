<?php
 require("restritos.php"); 
 require_once 'init.php';
 $PDO = db_connect();
require_once 'QueryUser.php';
   $id = $_GET['ID'];

   $dFor = $PDO->prepare("SELECT * FROM laudo WHERE id='$id'");
   $dFor->execute();
    $campo = $dFor->fetch();
    $Nome = $campo['Item'];
    $Codigo = $campo['codigo'];
    $QntTeste = $campo['qtTeste'];
    $QntTotal = $campo['qtTotal'];
    $UserCadastro = $campo['usrCad'];
    $Observa = $campo['obs'];
    $DataCadastrado = $campo['dataCadastro'];

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Language" content="pt-br">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $Titulo; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<style type="text/css">
.texto {
word-wrap: break-word;
}
</style>
</head>
<body class="hold-transition <?php echo $cor; ?> layout-top-nav">
<div class="wrapper">
 <header class="main-header">
  <nav class="navbar navbar-static-top">
   <div class="container">
    <div class="navbar-header">
     <img src="dist/img/logo/logoWhite.png" width="150" />
    </div>
    <div class="navbar-custom-menu">
     <ul class="nav navbar-nav">
      <li class="dropdown user user-menu">
       <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <span class="hidden-xs">Olá, <?php echo $NomeUserLogado; ?></span>
       </a>
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
     <div class="box-body">
      <form name="lau" id="name" method="post" action="" enctype="multipart/form-data">
       <div class="col-xs-4">Status 
        <select class="form-control" name="status" required="required">
         <option value="" selected="selected">SELECIONE</option>
         <option value="4">REPROVADO</option>
         <option value="3">APROVADO</option>
        </select>
       </div>
       <div class="col-xs-8">Selecionar Arquivo
        <input type="file" name="fileUpload" class="form-control" required="required">
       </div>
       <div class="col-xs-12">Observações
        <textarea name="obs" cols="45" rows="3" class="form-control" id="obs"></textarea><hr>
       </div>
       <div class="pull-right"><br />
        <input name="lau" type="submit" class="btn bg-red btn-flat" id="lau" value="ADICIONAR LAUDO"  /> 
       </div>  
      </form>
      <?php
       if(@$_POST["lau"])
       {
        $Cod = $_POST['status'];
        $Desc = str_replace("\r\n", "<br/>", strip_tags($_POST["obs"]));
        $DataHoje = date('d/m/Y H:i:s');
        $ext = strtolower(substr($_FILES['fileUpload']['name'],-4)); //Pegando extensão do arquivo
        $DataName = date("Y.m.d-H.i.s"); //Definindo um novo nome para o arquivo
        $NovoNome = md5($DataName) . $ext;
        $dir = 'laudos/'; //Diretório para uploads
        move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir.$NovoNome); //Fazer upload do arquivo
         $AddLaudo = $PDO->query("UPDATE laudo SET Status='$Cod', usrLaudo='$NomeUserLogado', DataLaudo='$DataHoje', ObsLaudo='Desc', Laudo='$NovoNome' WHERE id='$id'");             
         
         if ($AddLaudo)
          {
            if ($Cod === "4") {
              $TipoLaudo = "REPROVADO";
            } elseif ($Cod === "5") {
              $TipoLaudo = "APROVADO";
            }
            else{

            }
            
          $Ev = "Atualizado Laudo, Status: " . $TipoLaudo;
        $InsLog = $PDO->query("INSERT INTO loglaudo (Evento, UserEvento, EventoID, DataCadastro) VALUES ('$Ev', '$NomeUserLogado', '3', '$DataRecebe')"); 
        if ($InsLog) 
        {
         echo '<script type="text/JavaScript">alert("Atualizado com Sucesso");</script>';
         echo '<script type="text/javascript">window.close();</script>';
        }
        else
        {
         echo '<script type="text/javascript">alert("Erro ao salvar Log");</script>';
        }
       }






         if ($AddLaudo) {
          echo '<script type="text/javascript">alert("Laudo Adicionado");</script>';
          echo '<script type="text/javascript">window.close();</script>';

         }


       }


      
      ?>

     </div>
    </div>
   </section>
  </div>
 </div>
<?php include_once '../footer.php'; ?>
</div>
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="plugins/fastclick/fastclick.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="dist/js/demo.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
</body>
</html>