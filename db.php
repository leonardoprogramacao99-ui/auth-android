<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");

$host = getenv("MYSQLHOST") ?: "nao-encontrado";
$port = getenv("MYSQLPORT") ?: "nao-encontrado";
$db   = getenv("MYSQLDATABASE") ?: "nao-encontrado";
$user = getenv("MYSQLUSER") ?: "nao-encontrado";
$pass = getenv("MYSQLPASSWORD") ? "ok" : "nao-encontrado";

echo json_encode(["host"=>$host,"port"=>$port,"db"=>$db,"user"=>$user,"pass"=>$pass]);
exit;
