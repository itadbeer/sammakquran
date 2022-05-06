'use strict';

let postsSliders = document.getElementsByClassName('posts-carousel');

new Splide('.header-carousel', {
  type: 'loop',
  direction: 'rtl',
  lazyLoad: 'nearby',
  perPage: 1,
  perMove: 1,
  gap: 24,
  mediaQuery: 'min',
  breakpoints: {
    672: {
      perPage: 2,
    },
  }
}).mount();

new Splide('.categories-carousel', {
  direction: 'rtl',
  pagination: false,
  perMove: 1,
  gap: 16,
  autoWidth: true,
  trimSpace: 'move',
}).mount();

for (let i = 0; i < postsSliders.length; i++) {
  new Splide(postsSliders[i], {
    direction: 'rtl',
    pagination: false,
    perPage: 1,
    fixedWidth: '80%',
    gap: 16,
    perMove: 1,
    trimSpace: 'move',
    mediaQuery: 'min',
    breakpoints: {
      672: {
        perPage: 2,
        fixedWidth: 'calc(50% - 12px)',
        gap: 24,
      },
    }
  }).mount();
}