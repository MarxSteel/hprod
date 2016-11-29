<!-- MODAL DE EXEMPLO -->
<div id="novoLaudo" class="modal fade" role="dialog">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header bg-red">
    <button type="button" class="close" data-dismiss="modal">X</button>
     <h4 class="modal-title">Adicionar Pedido de Laudo</h4>
   </div>
   <div class="modal-body">
    <form name="nvl" id="name" method="post" action="" enctype="multipart/form-data">
     <div class="col-xs-4">Código
      <input type="text" name="codigo" required="required" class="form-control">
     </div>
     <div class="col-xs-4">Quantidade Total Recebida:
      <input type="text" name="qntTotal" required="required" class="form-control">
     </div>
     <div class="col-xs-4">Quantidade Enviada para testes:
      <input type="text" name="qntTeste" required="required" class="form-control">
     </div>
     <div class="col-xs-12">Descrição
      <input type="text" name="item" required="required" class="form-control">
     </div>
     <div class="col-xs-12">Observações
      <textarea name="obs" cols="45" rows="3" class="form-control" id="obs"></textarea><hr>
     </div>
     <div class="pull-right"><br />
      <input name="nvl" type="submit" class="btn bg-red btn-flat" id="nvl" value="ADICIONAR"  /> 
      <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">FECHAR</button>
     </div>
    </form>
 	<?php
  	 if(@$_POST["nvl"])
  	 {
      $Cod = $_POST['codigo'];
      $QtTotal = $_POST['qntTotal'];
      $QtTeste = $_POST['qntTeste'];
      $Item = $_POST['item'];
      $DataCadastro = date('d/m/Y - H:i:s');
      $Obs = str_replace("\r\n", "<br/>", strip_tags($_POST["obs"]));
       $InsLaudo = $PDO->query("INSERT INTO laudo (codigo, Item, qtTeste, qtTotal, dataCadastro, usrCad, Obs, Status) VALUES ('$Cod', '$Item', '$QtTeste', '$QtTotal', '$DataCadastro', '$NomeUserLogado', 'Obs', '1')");
       if ($InsLaudo)
       {
        $Ev = "Adicionado novo pedido de teste";
        $InsLog = $PDO->query("INSERT INTO loglaudo (Evento, UserEvento, EventoID, DataCadastro) VALUES ('$Ev', '$NomeUserLogado', '1', '$DataCadastro')");	
        if ($InsLog) 
        {
         echo '<script type="text/JavaScript">alert("Cadastrado com Sucesso");
              location.href="dashboard.php"</script>';
	    }
        else
        {
         echo '<script type="text/javascript">alert("Erro ao salvar Log");</script>';
        }
       }
       else
       {
       echo '<script type="text/javascript">alert("Erro ao Adicionar");</script>';
       }
	  } 
	?>
   </div>
   <div class="modal-footer"></div>
  </div>
 </div>
</div>
<!-- MODAL DE EXEMPLO -->