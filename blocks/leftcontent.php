<div class="leftcontent" align="center">
   <nav class = "navsecond">
         <ul>
         <li class="navsecondli" id="1">Приказы</li>
         <li class="navsecondli" id="2">Инструкции</li>
         <li class="navsecondli" id="3">Регламенты</li>
         <li class="navsecondli" id="4">Техническая информация</li>
         <li class="navsecondli" id="5">Служебные записки</li>
         <li class="navsecondli" id="6">Акты</li>
      </ul>
   </nav>
      <script type="text/javascript">
         $(".navsecondli").click(function() {
            if  ( $(".logo , .logo2").hasClass("activenavmain")) {
               var choseeIDnavsecondli = $(this).attr("id");
               $(".navsecond").find(".activenavmain").removeClass("activenavmain");
               $(".navsecondli[id=" + choseeIDnavsecondli + "]").addClass("activenavmain");
            }
            else
                {alert("Выберите компанию!");}
             })

      </script>
</div>
