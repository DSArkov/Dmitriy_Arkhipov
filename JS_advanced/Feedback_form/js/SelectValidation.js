'use strict';

class SelectValidation {

  constructor(name, error) {
    this.name = name;
    this.error = error;
  }

  run() {
    let errorDiv = document.getElementById('dialog');
    let newLi = document.createElement('li');

    if (!this.name.value) {
      this.name.classList.remove('is-valid');
      $(this.name).effect('bounce', {}, 2000);
      this.name.classList.add('is-invalid');
      newLi.innerHTML = this.error;
      errorDiv.appendChild(newLi);
    } else {
      this.name.classList.remove('is-invalid');
      this.name.classList.add('is-valid');
    }
  }
}