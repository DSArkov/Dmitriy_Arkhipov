if (!window.WebSocket) {
  alert('Ваш браузер не поддерживает веб-сокеты!');
}

let webSocket = new WebSocket('ws://task.local:8080');

$('#task-chat-form').submit(function(event) {
  let msg = this.message.value;
  webSocket.send(msg);
  event.preventDefault();
  return false;
});

webSocket.onmessage = function(event) {
  let data = event.data;
  $('#task-chat-div').append('div').html(data);
};