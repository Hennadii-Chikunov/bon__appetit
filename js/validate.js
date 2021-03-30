"use strict"

document.addEventListener('DOMContentLoaded', function () {
   
   // получаем input file в переменную
  const formImage = document.getElementById('formImage');
  // получаем див для превью в переменную
  const formPreview = document.getElementById('formPreview');
  // слушаем изменения в инпут файле
  formImage.addEventListener('change', () => {
      uploadFile(formImage.files[0]);
  });

  function uploadFile(file) {
      // проверяем тип файла
      if (!['image/jpeg', 'image/png', 'image/gif'].includes(file.type)) {
          alert('Разрешены только изображения . ');
          formImage.value = '';
          return;
      }
      // проверяем размер файла (<2 МБ)
      if (file.size > 2 * 1024 * 1024) {
          alert('Файл должен быть менее 2 МБ. Прости');
          return; 
      }

      // выводим превью картинки
       var reader = new FileReader();
       reader.onload= function (e) {
           formPreview.innerHTML = `<img src="${e.target.result}" alt="Фото">`;
       };
       reader.onerror = function (e) {
           alert('Ошибка');
       };
       reader.readAsDataURL(file);
   } 
});






