<!DOCTYPE html>
<html>
<head>
	<?php
		require_once "functions/functions.php";
		$title = "СэтлВики - добавление документа";
		require_once "blocks/head.php";
	?>
	<script src="tinymce/js/tinymce/tinymce.min.js"></script>
	<script>
		tinymce.init({
			selector:'#bodydoc',
			branding: false,
			language: 'ru',
			width: 1200,
			plugins:  [
			  'advlist', 'anchor', 'autolink', 'autoresize', 'autosave', 'bbcode', 'charmap', 'code', 'codesample',
			  'colorpicker', 'compat3x', 'contextmenu', 'directionality', 'emoticons', 'help', 'fullpage',
			  'fullscreen', 'hr', 'image', 'imagetools', 'importcss', 'insertdatetime', 'legacyoutput', 'link',
			  'lists', 'media', 'nonbreaking', 'noneditable', 'pagebreak', 'paste', 'preview', 'print', 'save',
			  'searchreplace', 'spellchecker', 'tabfocus', 'table', 'template', 'textcolor', 'textpattern', 'toc',
			  'visualblocks', 'visualchars', 'wordcount',
		  ],
		});

		$(document).ready (function () {
			$('#createdoc').click (function () {
				$('#messageShow').hide ();
				var typeadddoc = $("select#typeadddoc").val ();
				var nameadddoc = $("#nameadddoc").val ();
				var addkaydoc = $("#addkaydoc").val ();
				var bodydoc = $("#bodydoc").val ();
				var fail = "";
				if (typeadddoc == "none") fail = "Выбирите тип документа";
				else if (nameadddoc.length < 5)
					fail = "Имя документа не менее 5 символов";
				else if (addkaydoc.length < 3)
					fail = "Ключевые слова не введены, перечесление разделяются запятой ";
				if (fail !="") {
					$('#messageShow').html (fail);
					$('#messageShow').show ();
					return false;
				}
			});
		});
	</script>
</head>
<body>
	<?php require_once "blocks/header.php" ?>
	<div id="formadddoc">
		<div id="nameaddbase"><h2>Имя базы и отдел</h2></div>
		<select id="typeadddoc" required title="Тип документа" name="typeadddoc">
			<option value="none">Выберите тип документа</option>
			<option value="act">Акт</option>
			<option value="memorandum">Служебная записка</option>
		</select><br />
		<input placeholder="Введите имя документа:" id="nameadddoc" name="nameadddoc" title="Имя документа"<br />
		<input placeholder="Введите ключевые слова (через запятую):" id="addkaydoc" name="addkaydoc" title="Ключевые слова"<br />
		<div id="containerbodydoc">
			<textarea name="bodydoc" id="bodydoc"></textarea><br />
		</div>
		<div id="messageShow"></div>
		<input type="button" name="createdoc" id="createdoc" value="Создать" />
	<br />
	</div>
		<?php require_once "blocks/footer.php" ?>
</body>
</html>
