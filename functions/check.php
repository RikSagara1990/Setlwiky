<?php
   require_once "functions.php";
   $titlecompany = strip_tags($_POST["newcompanytitle"]);
   $companyid = strip_tags($_POST["newcompanyid"]);

   if(!empty($companyid)) {$line = "idcompany"; $value = $companyid; $parent = "none";};
   if(!empty($titlecompany)) {$line = "title"; $value = $titlecompany; $parent = "none";};


   connectDB();
   $array = $mysqli->query("SELECT `$line` FROM `Companies` WHERE `$line` = '$value' AND `parent` = '$parent'");
   closeDB();
   echo $array->num_rows != 0;


?>
