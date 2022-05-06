'use strict';

let filtersOverlay = document.getElementById('filtersOverlay');
let backgroundOverlay = document.getElementById('backgroundOverlay');

function openFilters() {
  filtersOverlay.classList.add('show');
  backgroundOverlay.addEventListener('click', closeFilters);
}

function closeFilters() {
  filtersOverlay.classList.remove('show');
  backgroundOverlay.removeEventListener('click', closeFilters);
}