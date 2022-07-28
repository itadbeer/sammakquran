'use strict';

let postsSliders = document.getElementsByClassName('posts-carousel');

if (document.querySelector('.header-carousel')) {
  new Splide('.header-carousel', {
    // type: 'loop',
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
}

if (document.querySelector('.categories-carousel')) {
  new Splide('.categories-carousel', {
    direction: 'rtl',
    pagination: false,
    perMove: 1,
    gap: 16,
    autoWidth: true,
    trimSpace: 'move',
  }).mount();
}

if (document.querySelector('.posts-carousel')) {
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
        1024: {
          perPage: 3,
          fixedWidth: 'calc(33.33% - 16px)',
        },
        1440: {
          perPage: 4,
          fixedWidth: 'calc(25% - 18px)',
        },
        1920: {
          perPage: 5,
          fixedWidth: 'calc(20% - 19.2px)',
        },
        2560: {
          perPage: 6,
          fixedWidth: 'calc(16.66% - 20px)',
        },
      }
    }).mount();
  }
}