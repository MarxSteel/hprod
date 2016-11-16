<?php
//CHAMANDO MANUAIS
$PenU1510 = "SELECT * FROM cadastro_1510 WHERE Status='2' AND UserCadastro='$NomeUserLogado' ORDER BY ID DESC";
$P1510 = $PDO->prepare($PenU1510);
$P1510->execute();
?>
<table id="PU1510" class="table table-hover table-striped table-responsive" cellspacing="0" width="100%">
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
  <?php while ($PU1510 = $P1510->fetch(PDO::FETCH_ASSOC)): 
   echo '<tr>';
   echo '<td>' . $PU1510["ID"] . '</td>';
   echo '<td><span class="badge bg-blue">' . $PU1510["Modelo"] . '</span></td>';
   echo '<td>' . $PU1510["NumREP"] . '</td>';
   echo '<td>' . $PU1510["DataCadastro"] . '</td>';   
   echo '<td>';
    echo '<a class="btn btn-info btn-xs" href="javascript:abrir(';
    echo "'Acoes/1510Detalhe.php?ID=" . $PU1510['NumREP'] . "');";
    echo '"><i class="fa fa-search"> VISUALIZAR </i></a>&nbsp;';
    echo '<a class="btn btn-default btn-xs" href="javascript:abrir(';
    echo "'Acoes/1510Devolve.php?ID=" . $PU1510['NumREP'] . "');";
    echo '"><i class="fa fa-refresh"> DEVOLVER </i></a>&nbsp;';
    echo "</td>";
   echo '</tr>';
   endwhile;
  ?>
 </tbody>
</table>