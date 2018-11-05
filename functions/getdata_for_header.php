<?php

 //Получаем массив нашего меню из БД в виде массива
   function get_company($mysqli){
      global $mysqli;
      connectDB();


      $array_for_menu = $mysqli->query("SELECT * FROM `Companies`");

      closeDB();


   //Создаем масив где ключ массива является ID меню
      $company_for_menu = array();
      while($row = $array_for_menu->fetch_assoc()){
           $company_for_menu[$row['idcompany']] = $row;
      }
      return $company_for_menu;
   }

//Функция построения дерева из массива от Tommy Lacroix
 function getTree($dataset) {
   $tree = array();

   foreach ($dataset as $id => &$node) {
      //перебор массива(массив id=ключь массива $node=значение & - изменять на прямую)
      //Если нет вложений
      if ($node['parent'] =="none"){
         //если у элемента свойсто parent = none
         $tree[$id] = &$node;
         //записываем в массив $tree
      }else{
         //Если есть потомки то перебераем массив
              $dataset[$node['parent']]['childs'][$id] = &$node;
              //$dataset[$node['parent']] = элемент массива где  значение массива=parent(значение в данной этерации) которое создает значение childs(массив) = элементом данной эттерации.
      }
   }
   return $tree;
 }



//Шаблон для вывода меню в виде дерева
 function tplMenu($category){
   if ($category['parent'] =="none"){
      $menu = '<li>
         <a href="index.php?basa='. $category['idcompany'].'" class="logo" id="'. $category['idcompany'].'" title="'. $category['title'] .'">
         <img class="imagelogo" src="'. $category['icon'].'"/></a>';
      }
   else{
      $menu = '<li>
         <a href="index.php?basa='. $category['idcompany'].'" class="logo2" id="'. $category['idcompany'].'">'. $category['title'] .'</a>';
   }

      if(isset($category['childs'])){
         $menu .= '<ul>'. showCat($category['childs']) .'</ul>';
      }
   $menu .= '</li>';

   return $menu;
 }


/**
* Рекурсивно считываем наш шаблон
**/
 function showCat($data){
   $string = '';
   foreach($data as $item){
      $string .= tplMenu($item);
   }
   return $string;
 }


?>
