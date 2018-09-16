'use strict';

$(document).ready(function () {
  //Товары.
  let goods = $('#goods');

  let good1 = new Good(1, 'Клавиатура', 768);
  good1.render(goods);

  let good2 = new Good(2, 'Мышь игровая', 521);
  good2.render(goods);

  //Корзина.
  let basket = new Basket('basket');
  basket.render($('#basket_wrapper'));

  //Добавление товара в корзину.
  $('.buyGood').on('click', function() {
    let title = $(this).attr('data-title');
    let idProduct = parseInt($(this).attr('data-id'));
    let price = parseInt($(this).parent().find('.product_price').text());
    basket.add(title, idProduct, price);
  });

  //Удаление товара из корзины.
  $('.removeGood').on('click', function() {
    let idProduct = parseInt($(this).attr('data-id'));
    basket.remove(idProduct);
  });

  //Очистка корзины.
  $('.removeAll').on('click', function() {
    basket.removeAll();
  });

  //Добавление товара в корзину перетаскиванием.
  $('.good').draggable({
    revert: true
  });
  $('#basket').droppable({
    drop: function(event, ui) {
      let title = $(ui.draggable[0]).attr('data-title');
      let idProduct = parseInt($(ui.draggable[0]).attr('data-id'));
      let price = parseInt($(ui.draggable[0]).attr('data-price'));
      basket.add(title, idProduct, price);
    }
  })
});