'use strict';

let filtersOverlay = document.getElementById('filtersOverlay');
let shareMenu = document.getElementById('shareMenu');
let snackbar = document.getElementById('snackbar');
let backgroundOverlay = document.getElementById('backgroundOverlay');
let scrollEls = document.querySelectorAll('.revealable');

function openFilters() {
  filtersOverlay.classList.add('show');
  backgroundOverlay.classList.add('show');

  backgroundOverlay.addEventListener('click', closeFilters);
}

function closeFilters() {
  filtersOverlay.classList.remove('show');
  backgroundOverlay.classList.remove('show');

  backgroundOverlay.removeEventListener('click', closeFilters);
}

function openShareMenu() {
  shareMenu.classList.add('show');
  backgroundOverlay.classList.add('show', 'invisible');

  backgroundOverlay.addEventListener('click', closeShareMenu);
}

function closeShareMenu() {
  shareMenu.classList.remove('show');
  backgroundOverlay.classList.remove('show', 'invisible');

  backgroundOverlay.removeEventListener('click', closeShareMenu);
}

function copyUrl() {
  let snackbarMsg = snackbar.querySelector('.snackbar-message');

  navigator.clipboard.writeText(window.location.href);

  snackbarMsg.innerText = 'لینک کپی شد.'
  snackbar.classList.add('show');

  setTimeout(hideSnackbar, 3000);

  closeShareMenu();
}

function hideSnackbar() {
  snackbar.classList.remove('show');
}

function goToSelectedPage(thisElem) {
  let params = new URLSearchParams(window.location.search);

  params.set('pageNumber', thisElem.value);
  window.location.search = params;
}

function goToNextPage() {
  let params = new URLSearchParams(window.location.search);
  let pageNumber = Number(params.get('pageNumber'));

  if (pageNumber === 0) {
    params.set('pageNumber', 2);
  } else {
    params.set('pageNumber', pageNumber + 1);
  }
  window.location.search = params;
}

function goToPrevPage() {
  let params = new URLSearchParams(window.location.search);
  let pageNumber = Number(params.get('pageNumber'));

  if (pageNumber <= 1) {
    params.set('pageNumber', 1);
  } else {
    params.set('pageNumber', pageNumber - 1);
  }
  window.location.search = params;
} 