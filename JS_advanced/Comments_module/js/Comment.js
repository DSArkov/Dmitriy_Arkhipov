'use strict';

/**
 * Класс работает с отзывами пользователей.
 */
class Comment {
  /**
   * @param {number} id - id текущего отзыва.
   * @param {string} username - имя пользователя оставившего отзыв.
   * @param {string} text - текст отзыва.
   * @param {boolean} confirmed - статус(true - подтвержден, false - не подтвержден).
   * @param $jqueryElement - контейнер для добавления отзыва.
   */
  constructor(id, username, text, confirmed, $jqueryElement) {
    //Инициализируем id элемента.
    this.id = id;
    //Инициализируем имя пользователя.
    this.username = username;
    //Инициализирует текст отзыва.
    this.text = text;
    //Инициализирует статус отзыва.
    this.confirmed = confirmed;
    //Инициализируем элемент контейнера.
    this.commentContainer = $jqueryElement;
    //Добавляем отзыв на страницу.
    this.render();
  }

  /**
   * Метод для отображения отзыва на странице.
   */
  render() {
    //Создаем контейнер для отзыва.
    let $commentItem = $('<div/>', {
      'data-id': this.id,
      class: this.confirmed === true ? 'formDiv' : 'formDiv waitConfirm'
    });

    //Добавляем контейнер с именем пользователя.
    let $commentItemUsername = $('<p/>', {
      text: this.username,
    });

    //Добавляем текст отзыва.
    let $commentItemText = $('<p/>', {
      text: this.text
    });

    //Добавляем кнопку "Удалить".
    let $commentRemoveBtn = $('<button/>', {
      text: 'Удалить',
      class: 'btn btn-outline-danger commentRemoveBtn'
    });

    //Добавляем кнопку "Одобрить."
    let $commentConfirmedBtn = $('<button/>', {
      text: 'Одобрить',
      class: 'btn btn-warning commentConfirmBtn'
    });

    //Добавляем контейнер с именем в блок отзыва.
    $commentItem.append($commentItemUsername);
    //Добавляем контейнер с текстом отзыва в блок отзыва.
    $commentItem.append($commentItemText);
    //Добавляем кнопку "Удалить" в блок отзыва.
    $commentRemoveBtn.appendTo($commentItem);
    //Добавляем кнопку "Одобрить" в блок отзыва.
    this.confirmed !== true ? $commentConfirmedBtn.appendTo($commentItem): null;

    //Добавляем блок с отзывов в контейнер для отзывов.
    this.commentContainer.append($commentItem);
  }

  /**
   * Метод для удаления отзыва.
   * @param {Object} item - элемент HTML по которому кликнули.
   */
  static remove(item) {
    //Получаем контейнер с отзывом, который удалям. Для этого ищем ближайший родительский
    //элемент <div>.
    let $commentElem = item.closest('div');
    //Удаляем контейнер.
    $commentElem.remove();
  }

  /**
   * Метод для одобрения отзыва.
   * @param {Object} item - элемент HTML по которому кликнули.
   */
  static confirm(item) {
    //Получаем контейнер с отзывом, который подтверждаем. Для этого ищем ближайший родительский
    //элемент <div>.
    let $commentElem = item.closest('div');
    //Удаляем класс "waitConfirm".
    $($commentElem).removeClass('waitConfirm');
    //Удаляем кнопку "Одобрить".
    $($commentElem).find('.commentConfirmBtn').remove();
  }

}