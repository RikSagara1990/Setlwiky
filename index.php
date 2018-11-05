<?php
	$changebasa = $_GET['basa'];
?>
<!DOCTYPE html>
<html>
<head>
	<?php
		require_once "functions/functions.php";
		$title = "СэтлВики";
		require_once "blocks/head.php";
	?>
</head>
<body>
	<?php require_once "blocks/header.php" ?>
	<div class="content">
		<?php require_once "blocks/leftcontent.php" ?>
		<div class="centercontent">
			<br />
				<?php
				if ($changebasa == "")
				{
					echo "<h2 id='titledocx'> Добро пожаловать на ресурс SetlWiki созданный для архива документов холдинга SetlGroup </h2>
					<br/>
					<p id='tegdocx'>Ресурс создан для сортировки и быстрого поиска документов, также организована настройка доступа к документам</p>";
				}
				if ($changebasa != "") {
					$basa = getBase ($changebasa, 10);
					if ($basa == "0") {
							echo "<p>База еще не создана</p>";
						}
					if ($basa != "0") {
						for ($i = 0; $i < count($basa); $i++) {
							echo "<div class=\"article\">";
						echo ' <img src="img/articles/'.$basa[$i]["GlobalNumber"].'.jpg" alt="Статья '.$basa[$i]["GlobalNumber"].'" title="Cтатья '.$basa[$i]["GlobalNumber"].'" />

						 <h2>'.$basa[$i]["Name"].'</h2>
						 <p>'.$basa[$i]["Body"].'</p>
						 <a href="/article.php?id='.$basa[$i]["GlobalNumber"].'">
							<div class="more">Далее</div>
						 </a>
					  </div>';
			  		}
				}
				}
				?>


		</div>
		<?php require_once "blocks/rightcontent.php" ?>
	</div>
		<?php require_once "blocks/footer.php" ?>
</body>
</html>
