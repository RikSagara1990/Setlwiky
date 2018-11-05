<?php
    $changecompany = $_GET['company'];
?>
<!DOCTYPE html>
<html>
<head>
	<?php
		require_once "functions/functions.php";
		$title = "СэтлВики - добавление документа";
		require_once "blocks/head.php";
	?>
</head>
<body>
	<?php require_once "blocks/header.php" ?>
	<div id="formadddoc">
		<div id="nameaddbase"><h2>Имя базы и отдел</h2></div>
		<select id="typeadddoc" required title="Тип документа">
			<option value="Act">Акт</option>
			<option value="memorandum">Служебная записка</option>
		</select><br />
		<input placeholder="Введите имя документа:" id="nameadddoc" name="nameadddoc" title="Имя документа"<br />
		<div id="numberCharactersName">Имя документа. Осталось 255 символов</div>
		<input placeholder="Введите ключевые слова:" id="addkaydoc" name="addkaydoc" title="Ключевые слова"<br />
		<div id="numberCharactersName">Ключевые слова. Осталось 255 символов, разделение ключей через пробел</div>
		<textarea name="bodydoc" id="bodydoc"></textarea><br />
		<div id="ibodydoc">Содержание документа</div>
		<input type="button" name="creationdoc" id="creationdoc" value="Создать" />
	<br />
	</div>
		<?php require_once "blocks/footer.php" ?>
</body>
</html>
