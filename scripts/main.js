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

// if (document.querySelector('.posts-grid .post-container#p1') && sessionStorage.postCardsCount) {
//   let postCardsCount = Number(sessionStorage.postCardsCount);
//   let scrollToPost = document.getElementById(`p${postCardsCount + 1}`);

//   window.addEventListener('load', function () {
//     document.querySelector('html').style.scrollBehavior = 'auto';
//     window.scrollTo(0, scrollToPost.offsetTop - 16);
//     document.querySelector('html').style.scrollBehavior = null;
//     sessionStorage.removeItem('postCardsCount');
//   });
// }

// function getPostCardsCount() {
//   let postCards = document.querySelectorAll('.posts-grid .post-container');

//   sessionStorage.postCardsCount = postCards.length;
// }

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

// if (document.querySelector('.download-button')) {
//   let downloadButtons = document.querySelectorAll('.download-button');

//   for (let i = 0; i < downloadButtons.length; i++) {
//     downloadButtons[i].addEventListener('click', startLoading);
//   }
// }

// function startLoading() {
//   this.classList.add('is-loading');
// }

function switchDownloadButton() {
  let downloadButtons = document.querySelectorAll('.download-button');
  let selectedQuality = document.getElementById('downloadQualitySelect').value;

  for (let i = 0; i < downloadButtons.length; i++) {
    downloadButtons[i].style.display = 'none';

    if (downloadButtons[i].dataset.quality === selectedQuality) {
      downloadButtons[i].style.display = 'block';
    }
  }
}

if (document.getElementById('downloadQualitySelect')) {
  switchDownloadButton();
}