<?php
//CHAMANDO MANUAIS
$PenUAcc = "SELECT * FROM cadastro_acesso WHERE Status='1' ORDER BY ID DESC";
$PAcc = $PDO->prepare($PenUAcc);
$PAcc->execute();
?>
<table id="RetesteAcesso" class="table table-hover table-striped table-responsive" cellspacing="0" width="100%">
 <thead>
  <tr>
   <td width="5%">ID</td>
   <td width="20%">Modelo</td>
   <td width="30%">N&uacute;mero de S&eacute;rie</td>
   <td width="25%">Data de Cadastro</td>
   <td width="20%"></td>
  </tr>
 </thead>
 <tbody>
  <?php while ($PUACC = $PAcc->fetch(PDO::FETCH_ASSOC)): 
   echo '<tr>';
   echo '<td>' . $PUACC["ID"] . '</td>';
   echo '<td><span class="badge bg-blue">' . $PUACC["Modelo"] . '</span></td>';
   echo '<td>' . $PUACC["NumSerie"] . '</td>';
   echo '<td>' . $PUACC["DataCadastro"] . '</td>';   
   echo '<td>';
    echo '<a class="btn btn-info btn-xs" href="javascript:abrir(';
    echo "'Acoes/AcessoDetalhe.php?ID=" . $PUACC['NumSerie'] . "');";
    echo '"><i class="fa fa-search"> VISUALIZAR </i></a>&nbsp;';
    echo '<a class="btn btn-success btn-xs" href="javascript:abrir(';
    echo "'Acoes/AcessoLibera.php?ID=" . $PUACC['NumSerie'] . "');";
    echo '"><i class="fa fa-thumbs-up"> Liberar</i></a>&nbsp;';
    echo '<a class="btn btn-danger btn-xs" href="javascript:abrir(';
    echo "'Acoes/AcessoReprova.php?ID=" . $PUACC['NumSerie'] . "');";
    echo '"><i class="fa fa-thumbs-down"> Reprovar</i></a>&nbsp;';
    echo "</td>";
   echo '</tr>';
   endwhile;
  ?>
 </tbody>
</table>