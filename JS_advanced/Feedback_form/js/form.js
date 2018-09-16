'use strict';

$(document).ready(function() {
  $.ajax({
    url: 'json/cities.json',
    type: 'GET',
    dataType: 'json',
    success: function (data) {
      for (let i = 0; i < data.length; i++) {
        $('#town_data').append(`<option>${data[i]}</option>`);
      }
    },
    error: function (error) {
      console.log(error);
    }
  });

  $('#selectDate').datepicker({
    dateFormat: 'dd.mm.yy',
    firstDay: 1
  });
});

document.getElementById('myForm').addEventListener('submit', function(event) {
  event.preventDefault();

  let name = document.getElementById('inputName');
  let nameRules = /^[a-zа-яё]{1,30}$/i;
  let nameError = 'The name must consist of letters only.';

  let phone = document.getElementById('inputPhone');
  let phoneRules = /^\+\d\(\d{3}\)\d{3}-\d{4}$/;
  let phoneError = 'The phone should look like: +7(000)000-0000';

  let email = document.getElementById('inputEmail');
  let emailRules = /^\w{1,10}\.?-?\w{1,10}@\w{1,6}\.[a-z]{1,3}$/;
  let emailError = 'The email should look' +
    ' like:<ul class = "list"><li>mymail@mail.ru</li><li>my.mail@mail.ru</li><li>my-mail@mail.ru</li></ul>';

  let city = document.getElementById('selectCity');
  let cityError = 'The field city is required.';

  let date = document.getElementById('selectDate');
  let dateError = 'The field date is required.';

  let nameCheck = new InputValidation(name, nameRules, nameError);
  let phoneCheck = new InputValidation(phone, phoneRules, phoneError);
  let emailCheck = new InputValidation(email, emailRules, emailError);
  let cityCheck = new SelectValidation(city, cityError);
  let dateCheck = new SelectValidation(date, dateError);

  let dialogDiv = document.getElementById('dialog');
  dialogDiv.innerHTML = '';

  nameCheck.run();
  phoneCheck.run();
  emailCheck.run();
  cityCheck.run();
  dateCheck.run();

  //Показвыем диалоговое окно с ошибками, которое автоматически
  //закрывается через 5 сек.
  if (dialogDiv.innerHTML !== '') {

    let $dialogContainer = $('#dialog');

    let $textSpan = $('<span/>', {
      id: 'textSpan',
      text: 'This window closes after: '
    });
    $textSpan.appendTo($dialogContainer);

    let $timeSpan = $('<span/>', {
      id: 'timeDelay',
      text: 5
    });
    $timeSpan.appendTo($dialogContainer);

    $($dialogContainer).dialog({
      modal: true,
      open: function() {
        let count = $('#timeDelay').text();
        let intID = setInterval(function() {
          count--;
          $($timeSpan).text(count);
          if (count === 0) {
            clearInterval(intID);
            $($dialogContainer).dialog('close');
          }
        }, 1000);
      }
    });

  }

});