'use strict';

class Basket {

  constructor(idBasket) {
    this.id = idBasket;

    this.amount = 0; //Общая стоимость товаров.
    this.basketItems = []; //Массив для хранения товаров.
    this.ajaxGetItems(); //Получение уже добавленных товаров.
  }

  render($jQueryElement) {
    let $basketDiv = $('<div/>', {
      id: this.id,
      text: 'Корзина'
    });

    let $basketItemsDiv = $('<div/>', {
      id: this.id + '_items_div'
    });

    let $allRemoveBtn = $('<button/>', {
      class: 'removeAll',
      text: 'Очистить корзину',
    });

    $basketItemsDiv.appendTo($basketDiv);
    $basketDiv.appendTo($jQueryElement);
    $allRemoveBtn.appendTo($basketDiv);
  }

  ajaxGetItems() {
    let appendId = `#${this.id}_items_div`;

    $.ajax({
      type: 'GET',
      url: 'json/basket_get.json',
      dataType: 'json',
      context: this,
      success: function(data) {
        let $basketData = $('<div/>', {
          id: 'basket_data'
        });

        this.amount = data.amount;

        for (let i = 0; i < data.basket.length; i++) {
          this.basketItems.push(data.basket[i]);
        }

        let $basketItems = $('<div/>', {
          id: 'basket_items'
        });

        for (let j = 0; j < this.basketItems.length; j++) {
          $basketItems.append(`<p>${j + 1} ${this.basketItems[j].title} - ${this.basketItems[j].price} руб.</p>`);
        }

        $basketData.append(`<p>Всего товаров: ${this.basketItems.length}</p>`);
        $basketData.append(`<p>Общая стоимость: ${this.amount} руб.</p>`);
        $basketItems.appendTo(appendId);
        $basketData.appendTo(appendId);
      },
      error: function(error) {
        console.log('Ошибка при получении содержимого корзины', error);
      }
    });
  }

  add(title, idProduct, price) {
    let basketItems = {
      "title" : title,
      "id_product": idProduct,
      "price": price
    };

    this.basketItems.push(basketItems);
    this.amount += price;
    this.refresh();
  }

  remove(idProduct) {
    //Перебираем наш массив с товарами.
    for (let i = 0; i < this.basketItems.length; i++) {
      //Если id текущего элемента и товара, который собираемся удалить совпадают,
      if(this.basketItems[i].id_product === idProduct) {
        //то уменьщаем общую стоимость на цену текущего товара,
        this.amount -= this.basketItems[i].price;
        //в результате удаляем сам элемент из массива.
        this.basketItems.splice(i, 1);
        //Обновляем корзину.
        this.refresh();
        //Выходим из цикла.
        return;
      }
    }
  }

  removeAll() {
    this.amount = 0;
    this.basketItems = [];
    this.refresh();
  }

  //Перерисовываем корзину.
  refresh() {
    let $basketItemDiv = $(`#${this.id}_items`);
    let $basketDataDiv = $('#basket_data');
    $basketItemDiv.empty(); //Удаляем содержимое контейнера.
    $basketDataDiv.empty(); //Удаляем содержимое контейнера.

    let i = 0;
    for (let item of this.basketItems) {
      i++;
      $basketItemDiv.append(`<p>${i} ${item.title} - ${item.price} руб.</p>`);
    }

    $basketDataDiv.append(`<p>Всего товаров: ${this.basketItems.length}</p>`);
    $basketDataDiv.append(`<p>Общая стоимость: ${this.amount} руб.</p>`);
  }
}