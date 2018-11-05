<header>
   <div class="title">
   <a href="http://setlwiky/"><h1 id=maintitle>SETLWIKI</h1></a>
   <nav class = "navmain" role='navigator'>
         <?php
         require_once "functions/getdata_for_header.php";

         //Получаем подготовленный массив с данными
         $company_for_menu  = get_company($mysqli);
         //Создаем древовидное меню
         $tree = getTree($company_for_menu);
         //Получаем HTML разметку
          $companies_menu = showCat($tree);
         //Выводим на экран
         echo '<ul><li><a href="index.php?basa=myDepartament" class="logo" title="База ващего отдела"><img class="imagelogo" src="img/myDepartament.png"/></a></li>'
             . $companies_menu .
             '<li><a onclick="openwindowsconfiguration(); return false;" class="logo" title="Настройки"><img class="imagelogo" src="img/configuration.png"/></a></li></ul>';
         ?>
   </nav>

   <script type="text/javascript">
      $(".logo, .logo2").click(function() {
         var choseeIDnavmain = $(this).attr("id");
         var choseeClassnavmain = $(this).attr("class");
         $(".navmain").find(".activenavmain").removeClass("activenavmain");
         $(".navsecond").find(".activenavmain").removeClass("activenavmain");
         if (choseeClassnavmain == "logo") {
            $(".logo[id=" + choseeIDnavmain + "]").addClass("activenavmain");}
         if (choseeClassnavmain == "logo2") {
            $(".logo2[id=" + choseeIDnavmain + "]").addClass("activenavmain");
            $(".logo2[id=" + choseeIDnavmain + "]").parents("li").addClass("activenavmain");
         }
      });

      function openwindowsconfiguration() {
      var windowaddcompany = window.open("configuration.php","",'width= 500,height=500,scrollbars=0,top=150,left='+(window.screen. width/2-250));
      };
   </script>


</header>
