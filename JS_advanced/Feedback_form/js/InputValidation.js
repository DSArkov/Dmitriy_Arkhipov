'use strict';

class InputValidation {

  constructor(name, rules, error) {
    this.name = name;
    this.rules = rules;
    this.error = error;
  }

  run() {
    let errorDiv = document.getElementById('dialog');
    let newLi = document.createElement('li');

    if (this.rules.test(this.name.value)) {
      this.name.classList.remove('is-invalid');
      this.name.classList.add('is-valid');
    } else {
      this.name.classList.remove('is-valid');
      $(this.name).effect('bounce', {}, 2000);
      newLi.innerHTML = this.error;
      errorDiv.appendChild(newLi);
      this.name.classList.add('is-invalid');
    }
  }
}

