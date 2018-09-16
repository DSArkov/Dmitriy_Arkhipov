'use strict';

class Good {

  constructor(id, title, price) {
    this.id = id;
    this.title = title;
    this.price = price;
  }

  render($jQueryElement) {
    let $goodContainer = $('<div/>', {
      class: 'good',
      'data-id': this.id,
      'data-title': this.title,
      'data-price': this.price
    });

    let $goodTitle = $('<p/>', {
      text: this.title
    });

    let $goodPrice = $(`<p>Цена: <span class = "product_price">${this.price}</span> руб.</p>`);

    let $goodBtn = $('<button/>', {
      class: 'buyGood',
      text: 'Добавить',
      'data-id': this.id,
      'data-title': this.title
    });

    let $goodBtnRemove = $('<button/>', {
      class: 'removeGood',
      text: 'Удалить',
      'data-id': this.id
    });

    //Создаем структуру товара
    $goodTitle.appendTo($goodContainer);
    $goodPrice.appendTo($goodContainer);
    $goodBtn.appendTo($goodContainer);
    $goodBtnRemove.appendTo($goodContainer);

    $jQueryElement.append($goodContainer);
  }
}