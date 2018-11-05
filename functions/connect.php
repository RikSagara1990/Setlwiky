<?php
// $mysqli = false;
function connectDB () {
   global $mysqli;
   $mysqli = new mysqli ("localhost", "WikyUse", "Rjk,f\$f120", "SetlWiky");
   $mysqli->query("SET NAMES 'utf-8'");

   if(!$mysqli)
   {
      exit(mysql_eror());
   }
}
// открываем базу данных
function closeDB () {
   global $mysqli;
   $mysqli->close ();
}
// закрываем базу данных
?>
