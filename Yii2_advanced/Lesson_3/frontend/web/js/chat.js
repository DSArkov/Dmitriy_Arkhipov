if (!window.WebSocket) {
  alert('Ваш браузер не поддерживает веб-сокеты!');
}

let webSocket = new WebSocket('ws://task.local:8080');

$('#task-chat-form').submit(function(event) {
  if (this.message.value.trim() === '') {
    $('#task-chat-form')[0].reset();
    return false;
  }

  let data = {
    message: this.message.value,
    channel: this.channel.value,
    user_id: this.user_id.value
  };
  webSocket.send(JSON.stringify(data));
  event.preventDefault();
  $('#task-chat-form')[0].reset();
  return false;
});

webSocket.onmessage = function(event) {
  let data = event.data;
  $('#task-chat-div').append('<div>' + data + '</div>\n');
};