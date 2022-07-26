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

// function handleScrollAnimation(el) {
//   if (el.getBoundingClientRect().top <= (window.innerHeight || document.documentElement.clientHeight) &&
//     el.getBoundingClientRect().bottom >= (window.clientTop || document.documentElement.clientTop)) {
//     el.style.transform = 'scale(1)';
//   } else {
//     el.style.transform = 'scale(0)';
//   }
// }

// window.addEventListener('scroll', function () {
//   scrollEls.forEach(handleScrollAnimation);
// });

if (document.querySelector('.posts-grid .post-container#p1') && sessionStorage.postCardsCount) {
  let postCardsCount = Number(sessionStorage.postCardsCount);
  let scrollToPost = document.getElementById(`p${postCardsCount + 1}`);

  window.addEventListener('load', function () {
    document.querySelector('html').style.scrollBehavior = 'auto';
    window.scrollTo(0, scrollToPost.offsetTop - 16);
    document.querySelector('html').style.scrollBehavior = null;
    sessionStorage.removeItem('postCardsCount');
  });
}

function getPostCardsCount() {
  let postCards = document.querySelectorAll('.posts-grid .post-container');
  
  sessionStorage.postCardsCount = postCards.length;
}