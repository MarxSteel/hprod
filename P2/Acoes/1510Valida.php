<?php 
$DadosREP = $PDO->prepare("SELECT * FROM cadastro_1510 WHERE NumREP='$NumeroREP'");
$DadosREP->execute();
$QryREP = $DadosREP->fetch();
$Modelo = $QryREP['Modelo'];
$DataCadastro = $QryREP['DataCadastro'];
$HoraCadastro = $QryREP['HoraCadastro'];
$DataRetorna = $QryREP['DataRetorna'];
$HoraRetorna = $QryREP['HoraRetorna'];
$DataLiberado = $QryREP['DataLiberaReteste'];
$HoraLiberado = $QryREP['HoraLiberaReteste'];
$RespTeste = $QryREP['UserCadastro'];
$RespReteste = $QryREP['UserReteste'];
$Status = $QryREP['Status'];

//CHAMANDO OS DADOS DE LEITORA DO EQUIPAMENTO
$ChBio = $QryREP['LBio'];
$ChProx = $QryREP['LProx'];
$ChSmart = $QryREP['LMif'];
$ChBarras = $QryREP['LBar'];
$Descricao = $QryREP['Observa'];




//CONCATENANDO DATA DE REPROVAÇÃO COM HORA DE REPROVAÇÃO
$Reprovado = $DataRetorna;

//CONCATENANDO DATA DE MONTAGEM COM HORA DE MONTAGEM
$DataMontagem = $DataCadastro . ' ' . $HoraCadastro;

//CONCATENANDO DATA DE LIBERAÇÃO COM HORA DE LIBERAÇÃO
$Liberado = $DataLiberado . ' ' . $HoraLiberado;
//VALIDANDO LEITORA DE BIOMETRIA
  if ($ChBio == "01") {
    $Biometria = "512Kb - 300 Digitais";
  }
  elseif ($ChBio == "02") {
    $Biometria = "4MB - 9.600 Digitais";
  }
  elseif ($ChBio == "03") {
  	$Biometria = "8MB - 15.000 Digitais";
  }
  elseif ($ChBio == "04") {
  	$Biometria = "1MB - 1.900 Digitais - CAPACITIVA";
  }
  elseif ($ChBio == "05") {
  	$Biometria = "4MB - 9.600 Digitais - CAPACITIVA";
  }
  elseif ($ChBio == "06") {
  	$Biometria = "4MB - 9.600 Digitais - Dedo Vivo";
  }
  elseif ($ChBio == "07") {
  	$Biometria = "1.000 Digitais - FINCHOS";
  }  
  elseif ($ChBio == "99") {
  $Biometria = "Sem Biometria"; 
}
  else{
  	$Biometria = "Sem Biometria";	
  }

//VALIDANDO LEITORA DE PROXIMIDADE
  if ($ChProx == "01") {
  	$Proximidade = "WIEGAND";

  }
  elseif ($ChProx == "02") {
  	$Proximidade = "ABATRACK";
  }
  elseif ($ChProx == "03") {
  	$Proximidade = "INDALA";
  }
  elseif ($ChProx == "04") {
  	$Proximidade = "HID";
  }
  elseif ($ChProx == "05") {
  	$Proximidade = "ACURA";
  }
  elseif ($ChProx == "06") {
  	$Proximidade == "PHID";
  }
  else{
  	$Proximidade = "Sem Proximidade";
  }

//VALIDANDO O SMART CARD
  if ($ChSmart == "9") {
	$SmartCard = "SIM";
  }
  else{
	$SmartCard = "NÃO";
  }


//VALIDANDO O SMART CARD
  if ($ChBarras == "9") {
	$Barras = "SIM";
  }
  else{
	$Barras = "NÃO";
  }

  ?>