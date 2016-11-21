<?php
//CHAMANDO MANUAIS
$PenUAcc = "SELECT * FROM cadastro_acesso ORDER BY ID DESC";
$PAcc = $PDO->prepare($PenUAcc);
$PAcc->execute();
?>
<table id="GeralAcesso" class="table table-hover table-striped table-responsive" cellspacing="0" width="100%">
 <thead>
  <tr>
   <td>ID</td>
   <td>MODELO</td>
   <td>STATUS</td>
   <td>N&Uacute;MERO DE S&Eacute;RIE</td>
   <td>DATA DE CADASTRO</td>
   <td></td>
  </tr>
 </thead>
 <tbody>
  <?php while ($PUACC = $PAcc->fetch(PDO::FETCH_ASSOC)): 
   echo '<tr>';
   echo '<td>' . $PUACC["ID"] . '</td>';
   echo '<td><span class="badge bg-blue">' . $PUACC["Modelo"] . '</span></td>';
   $StatusModelo = $PUACC["Status"];
    if ($StatusModelo === "1") 
    {
     echo '<td><span class="badge bg-orange">EM RETESTE</span></td>';
    }
    elseif ($StatusModelo === "2") 
    {
     echo '<td><span class="badge bg-red">REPROVADO</span></td>';
    }
    elseif ($StatusModelo === "3") 
    {
     echo '<td><span class="badge bg-green">FINALIZADO</span></td>';
    }
    else { }
   echo '<td>' . $PUACC["NumSerie"] . '</td>';
   echo '<td>' . $PUACC["DataCadastro"] . '</td>';   
   echo '<td>';
    echo '<a class="btn btn-info btn-xs" href="javascript:abrir(';
    echo "'Acoes/AcessoDetalhe.php?ID=" . $PUACC['NumSerie'] . "');";
    echo '"><i class="fa fa-search"> VISUALIZAR </i></a>';
    echo "</td>";
   echo '</tr>';
   endwhile;
  ?>
 </tbody>
</table>