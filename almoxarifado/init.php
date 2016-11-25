<?php
$host = "localhost:8889";
$user = "root";
$pass = "root";
$banco = "hprod";
$versao = "3.3.5";


// constantes com as credenciais de acesso ao banco MySQL
define('DB_HOST', $host);
define('DB_USER', $user);
define('DB_PASS', $pass);
define('DB_NAME', $banco);
function dbcon()
{
    @mysql_connect($host, $user, $pass) or die(mysql_error());
    @mysql_select_db($banco) or die(mysql_error());
}
$IPImpressora = "192.168.60.38";

$Ateste = "12345";
$Wteste = "12345";
$Mteste = "1234";

//AQUI EU DECLARO A FUNÇÃO DE CHAMAR PORCENTAGEM
// Y É X% DE Z
function porcentagem_nnx ($parcial, $porcentagem ) {
 return ($parcial / $porcentagem) * 100;
}
    function gerar($sString) {
  if(!empty($sString)) {
    $sByteInicial = "02 ";
    $sTamanhoMensagem = gerarTamanhoString($sString);
    $sMensagem = stringParaHex($sString);
    $sCheckSun = gerarCheckSum($sString);
    $sByteFinal = " 03";

    return $sByteInicial . $sTamanhoMensagem . $sMensagem . $sCheckSun . $sByteFinal;
  } else
    return false;
}

function gerarTamanhoString($sString) {
  $nTamanhoString = strlen($sString);
  $nHex1 = $nTamanhoString % 256;
  $nHex16 = (int) ($nTamanhoString / 256);

  $nHex1 = dechex($nHex1);
  if(strlen($nHex1) === 1)
    $nHex1 = "0".$nHex1;

  $nHex16 = dechex($nHex16);
  if(strlen($nHex16) === 1)
    $nHex16 = "0".$nHex16;

  $sResultado = $nHex1." ".$nHex16;

  return strtoupper($sResultado);
}

function stringParaHex($sString) {
  $sHex = "";
  $vString = str_split($sString); // Transforma a string em um Array
  foreach($vString as $sCharactere)  // Percorre cada charactere da string que agora é um Array
    $sHex .= " ".dechex(ord($sCharactere)); // Transforma esse charactere em ASCII e depois o converte para hexadecimal

    return strtoupper($sHex);  // Converte tudo para letras maiúsculas
}

function gerarCheckSum($sString) {
  $nTamanhoString = strlen($sString);

  $sXor = "";
  $vString = str_split($sString);
  foreach($vString as $sCharactere)
    $sXor ^= ord($sCharactere);

  $sXor ^= $nTamanhoString % 256;
  $sXor ^= $nTamanhoString / 256;

  $nHex1 = $sXor % 16;
  $nHex16 = (int) ($sXor / 16);

  $sResultado = " ".dechex($nHex16) . dechex($nHex1);

  return strtoupper($sResultado);
}

function hex2str($hex){
    $str='';
    for ($i=0; $i < strlen($hex)-1; $i+=2){
    $str .= chr(hexdec(substr($hex,$i,2)));
    }
    return $str;
}

function String2Hex($string){
    $hex='';
    for ($i=0; $i < strlen($string); $i++){
        $hex .= dechex(ord($string[$i]));
    }
    return $hex;
}

// habilita todas as exibições de erros
ini_set('display_errors', true);
error_reporting(E_ALL);

date_default_timezone_set('America/Sao_Paulo');

$cor = "skin-blue";
$Titulo = "Henry Controle de Estoque";
// MENSAGENS DE PROTOCOLO



require_once 'functions.php';
