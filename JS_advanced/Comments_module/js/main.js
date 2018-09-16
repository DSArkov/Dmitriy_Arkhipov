'use strict';

$(document).ready(function() {
  //Получаем элемент контейнера для отзывов.
  let $elementCommentsDiv = $('.commentsDiv');

  //id последнего комментария, для добавления нового с id += 1.
  let lastCommentId = 0;

  //Делаем ajax запрос для получения списка отзывов из json файла.
  $.ajax({
    type: 'GET',
    url: 'json/review.list.json',
    dataType: 'json',
    //Перебираем массив и в случае успеха, с помощью конструктора создаем новый отзыв,
    //передавая ему необходимые параметры.
    success: function(data) {
      let $commentsData = $('<div/>', {
        class: 'comments_data'
      });

      for (let i = 0; i < data.comments.length; i++) {
        lastCommentId = data.comments[i].id_comment;

        new Comment(data.comments[i].id_comment,
          data.comments[i].username,
          data.comments[i].text,
          data.comments[i].confirmed,
          $elementCommentsDiv);
      }
    },
    //Если ошибка - выводим сообщение в консоль.
    error: function(error) {
      console.error('Ошибка при получении содержимого корзины: ', error);
    }
  });

  //Добавляем обработчик события для добавления нового отзыва.
  $('#commentForm').on('submit', function() {
    //Отменяем действие по умолчанию.
    event.preventDefault();
    //Выбираем поле для имени.
    let $commentUsername = $(this).find('#name');
    //Получаем содержимое поля для имени.
    let usernameVal = $commentUsername.val();
    //Выбираем поле для текста отзыва.
    let $commentText = $(this).find('#comment');
    //Получаем содержимое поля для отзыва.
    let commentVal = $commentText.val();
    //Если поля не пустыее - добаляем отзыв.
    if (usernameVal && commentVal) {
      //Создаем экземпляр нового комментария и указываем, что он не одобреный.
      new Comment(++lastCommentId, usernameVal, commentVal, false, $elementCommentsDiv);
      //Очищаем поле для имени.
      $commentUsername.val('');
      //Очищаем поле для текса отзыва.
      $commentText.val('');
    }
  });

  //Добавляем обработчик события при клике на кнопку "Одобрить".
  $elementCommentsDiv.on('click', '.commentConfirmBtn', function() {
    Comment.confirm(this);
  });

  //Добавляем обработчик события при клике на кнопку "Удалить".
  $elementCommentsDiv.on('click', '.commentRemoveBtn', function() {
    Comment.remove(this);
  })
});