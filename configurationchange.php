<!DOCTYPE html>
<html>
<head>
	<?php
		require_once "functions/functions.php";
		$title = "Конфигурация";
		require_once "blocks/head.php";
		require_once "functions/getdata_for_header.php";
	?>
</head>
<body>

	<div id=configurationchangecompany>
      <br />
		<h3>Выбор компании:</h3>
		<?php
			//Получаем подготовленный массив с данными
			$company_for_menu  = get_company($mysqli);
			//Создаем древовидное меню
			$tree = getTree($company_for_menu);
			//Шаблон для вывода меню в виде дерева
			 function tplMenuSelect($category, $parent){
			    if ($category['parent'] =="none"){
			      $menu = '<option value="'. $category['idcompany']. '">'. $category['title'] .'</option>';
                     }
			    else {
				 	$menu = '<option value="'. $category['idcompany']. '">--'.$parent .$category['title'] .'</option>';
			    }

			      if(isset($category['childs'])){
			          $parent .= $category['title']. ' \\ ';
			         $menu .= showCatSelect($category['childs'], $parent);
			      }

			   return $menu;
			 }
			 //Рекурсивно считываем наш шаблон
			function showCatSelect($data, $pnameparent = NULL){
			  $string = '';
			  foreach($data as $item){
				  $string .= tplMenuSelect($item,$pnameparent);
			  }
			  return $string;
		  	}
			  $companies_menu = showCatSelect($tree);

			echo '<div style="min-width: 480px; margin:0 auto; overflow-x:auto;" ><select size="10" id="selectcompany">' . $companies_menu . '</select></div>';
		?>
		<div id="changebuttons">
            <?php
            echo '<a class="right" id="ok" onclick="getValue()">Ок</a>';
            ?>
			<a class="left" id="cancel" href="configuration.php">Отмена</a>
		</div>
	</div>
    <script type="text/javascript">
        function getValue() {
            var select = document.getElementById("selectcompany");
            // Получаем наш список
            var value = select.value;
            // Получаем значение выделенного элемента
            location.href="addcompany.php?company=" + value;
        }
    </script>
</body>
</html>
