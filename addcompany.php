<?php
 $changecompany = $_GET['company'];
?>
<!DOCTYPE html>
<html>
<head>
	<?php
		require_once "functions/functions.php";
		$title = "Добавление компании";
		require_once "blocks/head.php";
		$extensions = array('png'); //какие типы файлов разрешается загружать
		$upload_dir = 'pngcompany';  // папка для загрузки (создать на сервере)
	?>
	<script src="/js/getXmlHttp.js"></script>
</head>
<body>
<?php
if ($changecompany != "") {
      $arrayCompany = getCompany($changecompany);
      $icon = '<span><img class="showlogo" src="' .$arrayCompany['icon'] .'" ></span>';

}
?>
	<div id=addCompany>

		<form enctype="multipart/form-data" name="form_addCompany" method="post" action="addcompany.php" onsubmit="return validate()">
		<br />
		<h3>Имя компании:</h3>
		<input type="text" placeholder="введите имя:" name="newcompanytitle" title="на русском" value=<?php echo $arrayCompany['title']; ?> onblur="check ('newcompanytitle', this.value)"/><br />
		<span style="color:red" id="titleerror"></span>
		<h3>Ключ (индификатор для работы программы):</h3>
		<input type="text" placeholder="на английском:" pattern=[\x1F-\xBF]* name="newcompanyid" title="на английском"  value=<?php echo $arrayCompany['idcompany']; ?> onblur="check('newcompanyid', this.value)"/><br />
		<span style="color:red" id="errorid"></span>
		<h3>Логотип(только формат PNG):</h3>
		<input type="file" accept="image/png" name="loadlogo" id="loadlogo"/><br />
			<div class="row">
				<span id="output"><?php echo $icon; ?></span>
			</div>
		<span style="color:red" id="error"></span>
		<div id="changebuttons">
			<a class="left" href="configuration.php">Отмена</a>
			<input class="right" class="mainbutton" type="submit" name="createcomp" id="createcomp" value="Добавить компанию"/>
		</div>
		</form>
	</div>


<script src="/js/addcompany.js">
    document.getElementById('loadlogo').addEventListener('change', handleFileSelect, false);
    // если есть выбранные элементы в leadlogo вызывает функцию   handleFileSelect
</script>

	<?php

	if(isset($_POST['createcomp'])){
		$titlecompany = strip_tags($_POST['newcompanytitle']);
		$idcompany = strip_tags($_POST['newcompanyid']);
		if(file_exists($_FILES['loadlogo']['tmp_name'])){
			//если загружен файл(существует ли массив)
			$message = uploadHandlePng(8, $extensions, $upload_dir, $idcompany);
			if(!empty($message['error'])) {
				echo "<script>alert(\"{$message['error']}\")</script>";
				exit();
			}
			else $imageway = $message['destination'];
		}
		connectDB ();
		if (!empty($imageway)) {
			$mysqli->query("INSERT INTO `Companies` (`idcompany`, `title`, `icon`) VALUES ('$idcompany', '$titlecompany', '$imageway');");}
		else $mysqli->query("INSERT INTO `Companies` (`idcompany`, `title`) VALUES ('$idcompany', '$titlecompany');");
		closeDB();
		echo "<script>alert(\"Компания успешно добавленна!\");
		opener.location = ''+opener.location;
		window.close();
		</script>";
	}
	?>
</body>
</html>
