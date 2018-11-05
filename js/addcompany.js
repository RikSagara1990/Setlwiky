   function check(object, value) {
      var xmlhttp = getXmlHttp(); // Создаём объект XMLHTTP
      xmlhttp.open('POST', 'functions/check.php', true); // Открываем асинхронное соединение
      xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Отправляем тип содержимого
      switch (object) {
         case "newcompanytitle" : var call = "newcompanytitle="; var varerror = "titleerror"; break;
         case "newcompanyid" : var call = "newcompanyid="; var varerror = "errorid"; break;
      }
      xmlhttp.send(call + encodeURIComponent(value)); // Отправляем POST-запрос
      xmlhttp.onreadystatechange = function() { // Ждём ответа от сервера
         if (xmlhttp.readyState == 4) { // Ответ пришёл
           if(xmlhttp.status == 200) { // Сервер вернул код 200 (что хорошо)
             if (xmlhttp.responseText) document.getElementById(varerror).innerHTML ="*Такое значение уже существует!";
             else document.getElementById(varerror).innerHTML ="";
           }
         }
       };
     }


   function validate(){
      var newcompanytitle=document.forms['form_addCompany']['newcompanytitle'].value;
      var newcompanyid=document.forms['form_addCompany']['newcompanyid'].value;
      if (newcompanytitle.length==0){
         document.getElementById('titleerror').innerHTML='*Поле "Имя компании" не заполнено';
         return false;
      }
      if (newcompanyid.length==0){
         document.getElementById('errorid').innerHTML='*Поле "Ключ" не заполнено';
         return false;
      }
      if (document.getElementById("titleerror").innerHTML !="" ||
          document.getElementById("errorid").innerHTML !="") {
         return false;
      }

   }

   function handleFileSelect(evt) {
      var file = evt.target.files;// Список объектов
      var f = file[0];
      // Обрабатывать только файлы изображений..
      if (!f.type.match('png.*')) {
         alert("Загружайте только PNG файлы пожалуйста!");
      }
      var reader = new FileReader();  //загружает в переменную файл
      // Закрытие для захвата информации о файле.
         reader.onload = (function(theFile) {   //обработчик события
            return function(e) {
               // Отрисовка миниатюр.
               var span = document.createElement('span');
               span.innerHTML = ['<img class="showlogo" title="', escape(theFile.name), '" src="', e.target.result, '" />'].join('');
               document.getElementById('output').innerHTML = "";
               document.getElementById('output').insertBefore(span, null);
            };
      })(f);
      // Чтение в файле изображения в виде URL-адреса данных.
      reader.readAsDataURL(f);
   }


