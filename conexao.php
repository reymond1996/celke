<?php
$host = "localhost";
$user ="root";
$pass ="usbw";
$dbname ="celke";
$port =3306;
//conecxao com a porta
$conn = new PDO("mysql:host=$host;port=$port;dbname=".$dbname,$user,$pass);
?>