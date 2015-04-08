<?php
header('Content-Type: text/html; charset=utf-8');
include_once("helperPHP.php");
$arrayNames = array();
$arrayNames[] = array("name" =>"ác");
$arrayNames[] = array("name" =>"bb");
$arrayNames[] = array("name" =>"ab");
$arrayNames[] = array("name" =>"ñ");
$arrayNames[] = array("name" =>"n");

uasort($arrayNames,"uasortCallback");
var_dump($arrayNames);
/*fin del archivo*/