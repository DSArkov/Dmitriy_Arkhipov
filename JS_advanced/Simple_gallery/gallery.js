'use strict';

/**
 * @property {Object} settings Объект с настройками галереи.
 * @property {string} settings.previewSelector Селектор обертки для миниатюр галереи.
 * @property {string} settings.openedImageWrapperClass Класс для обертки открытой картинки.
 * @property {string} settings.openedImageClass Класс открытой картинки.
 * @property {string} settings.openedImageScreenClass Класс для ширмы открытой картинки.
 * @property {string} settings.openedImageCloseBtnClass Класс для картинки кнопки закрыть.
 * @property {string} settings.openedImageCloseBtnSrc Путь до картинки кнопки открыть.
 * @property {string} settings.openedImagePrewBtnClass Класс для картинки кнопки "Назад".
 * @property {string} settings.openedImagePrewBtnSrc Путь для картинки кнопки "Назад".
 * @property {string} settings.openedImageNextBtnClass Класс для картинки кнопки "Вперед".
 * @property {string} settings.openedImageNextBtnSrc Путь для картинки кнопки "Вперед".
 * @property {string} settings.failedImage Путь для default картинки.
 */
const gallery = {
  //Свойство для хранения маленькой картинки, по которой кликнули.
  openedImageEl: null,

  settings: {
    previewSelector: '.galleryPreviewsContainer',
    openedImageWrapperClass: 'galleryWrapper',
    openedImageClass: 'galleryWrapper__image',
    openedImageScreenClass: 'galleryWrapper__screen',
    openedImageCloseBtnClass: 'galleryWrapper__close',
    openedImageCloseBtnSrc: 'img/close.png',
    openedImagePrevBtnClass: 'galleryWrapper__prev',
    openedImagePrevBtnSrc: 'img/arrow_left.png',
    openedImageNextBtnClass: 'galleryWrapper__next',
    openedImageNextBtnSrc: 'img/arrow_right.png',
    failedImage: 'img/failed.jpg'
  },

  /**
   * Инициализирует галерею, ставит обработчик события.
   * @param {Object} userSettings Объект настроек для галереи.
   */
  init(userSettings = {}) {
    // Записываем настройки, которые передал пользователь в наши настройки.
    Object.assign(this.settings, userSettings);

    // Находим элемент, где будут превью картинок и ставим обработчик на этот элемент,
    // при клике на этот элемент вызовем функцию containerClickHandler в нашем объекте
    // gallery и передадим туда событие MouseEvent, которое случилось.
    document
      .querySelector(this.settings.previewSelector)
      .addEventListener('click', event => this.containerClickHandler(event));
  },

  /**
   * Обработчик события клика для открытия картинки.
   * @param {MouseEvent} event Событие клики мышью.
   * @param {HTMLElement} event.target Целевой объект, куда был произведен клик.
   */
  containerClickHandler(event) {
    // Если целевой тег не был картинкой, то ничего не делаем, просто завершаем функцию.
    if (event.target.tagName !== 'IMG') {
      return;
    }

    this.openedImageEl = event.target;
    console.log(this.openedImageEl);

    // Открываем картинку с полученным из целевого тега (data-full_image_url аттрибут).
    this.openImage(event.target.dataset.full_image_url);
  },

  /**
   * Открывает картинку.
   * @param {string} src Ссылка на картинку, которую надо открыть.
   */
  openImage(src) {
    // Получаем контейнер для открытой картинки, в нем находим тег img и ставим ему нужный src.
    this.getScreenContainer().querySelector(`.${this.settings.openedImageClass}`).src = src;
  },

  /**
   * Возвращает контейнер для открытой картинки, либо создает такой контейнер, если его еще нет.
   * @returns {Element}
   */
  getScreenContainer() {
    // Получаем контейнер для открытой картинки.
    const galleryWrapperElement = document.querySelector(`.${this.settings.openedImageWrapperClass}`);
    // Если контейнер для открытой картинки существует - возвращаем его.
    if (galleryWrapperElement) {
      return galleryWrapperElement;
    }

    // Возвращаем полученный из метода createScreenContainer контейнер.
    return this.createScreenContainer();
  },

  /**
   * Создает контейнер для открытой картинки.
   * @returns {HTMLElement}
   */
  createScreenContainer() {
    // Создаем сам контейнер-обертку и ставим ему класс.
    const galleryWrapperElement = document.createElement('div');
    galleryWrapperElement.classList.add(this.settings.openedImageWrapperClass);

    // Создаем контейнер занавеса, ставим ему класс и добавляем в контейнер-обертку.
    const galleryScreenElement = document.createElement('div');
    galleryScreenElement.classList.add(this.settings.openedImageScreenClass);
    galleryWrapperElement.appendChild(galleryScreenElement);

    // Создаем картинку для кнопки закрыть, ставим класс, src и добавляем ее в контейнер-обертку.
    const closeImageElement = new Image();
    closeImageElement.classList.add(this.settings.openedImageCloseBtnClass);
    closeImageElement.src = this.settings.openedImageCloseBtnSrc;
    closeImageElement.addEventListener('click', () => this.close());
    galleryWrapperElement.appendChild(closeImageElement);

    //Создаем картинку для кнопки "Назад", ставим класс, src и добавляем ее в контейнер-обертку.
    const prevImageElement = new Image();
    prevImageElement.classList.add(this.settings.openedImagePrevBtnClass);
    prevImageElement.src = this.settings.openedImagePrevBtnSrc;
    galleryWrapperElement.appendChild(prevImageElement);
    prevImageElement.addEventListener('click', () => {
      this.openedImageEl = this.getPrevImage();
      this.openImage(this.openedImageEl.dataset.full_image_url);
    });

    //Создаем картинку для кнопки "Вперед", ставим класс, src и добавляем ее в контейнер-обертку.
    const nextImageElement = new Image();
    nextImageElement.classList.add(this.settings.openedImageNextBtnClass);
    nextImageElement.src = this.settings.openedImageNextBtnSrc;
    galleryWrapperElement.appendChild(nextImageElement);
    nextImageElement.addEventListener('click', () => {
      this.openedImageEl = this.getNextImage();
      this.openImage(this.openedImageEl.dataset.full_image_url);
    });

    // Создаем картинку, которую хотим открыть, ставим класс и добавляем ее в контейнер-обертку.
    const image = new Image();
    image.onerror = () => image.src = this.settings.failedImage;
    image.classList.add(this.settings.openedImageClass);
    galleryWrapperElement.appendChild(image);

    // Добавляем контейнер-обертку в тег body.
    document.body.appendChild(galleryWrapperElement);

    // Возвращаем добавленный в body элемент, наш контейнер-обертку.
    return galleryWrapperElement;
  },

  /**
   * Возвращает предыдущий элемент(картинку) от открытой картинки или последнюю картинку в контейнере, если текущая
   * картинка
   * первая.
   * @returns {Element} Передыдущую картинку от текущей открытой.
   */
  getPrevImage() {
    const prevSibling = this.openedImageEl.previousElementSibling;
    console.log(prevSibling);
    return prevSibling ? prevSibling : this.openedImageEl.parentNode.lastElementChild;
  },

  /**
   * Возвращает следующий элемент(куртинку) от открытой картинки или первую картинку в контейнере, если текущая картинка
   * последняя.
   * @returns {Element} Следующую картинку от текущей открытой.
   */
  getNextImage() {
    const nextSibling = this.openedImageEl.nextElementSibling;
    return nextSibling ? nextSibling : this.openedImageEl.parentNode.firstElementChild;
  },

  /**
   * Закрывает (удаляет) контейнер для открытой картинки.
   */
  close() {
    document.querySelector(`.${this.settings.openedImageWrapperClass}`).remove();
  }
};

let render = function () {
  //Асинхронный запрос
  let xhr = new XMLHttpRequest();
  xhr.open('GET', 'path.json', true);

  xhr.onreadystatechange = function () {
    console.log(xhr.readyState);
    if (xhr.readyState !== 4) {
      return;}
      if (xhr.status !== 200) {
      console.log('Error retrieving data', xhr.status, xhr.statusText);
    } else {
      console.log('ok', xhr.responseText);
      let dataObj = JSON.parse(xhr.responseText);

      for (let i = 0; i < dataObj.length; i++) {
        let img = new Image();
        img.setAttribute('src', dataObj[i].min);
        img.setAttribute('data-full_image_url', dataObj[i].max);
        img.setAttribute('alt', dataObj[i].alt);
        document.querySelector(gallery.settings.previewSelector).appendChild(img);
      }
    }
  };
  xhr.send();
};

window.onload = function () {
  render();
  gallery.init();
};