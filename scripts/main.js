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


function handle_navbar_active_item(){
  let post_type_indicator = document.querySelector("body > main > header > div > a:nth-child(1) > div > img");
  let is_audio =  post_type_indicator ? post_type_indicator.src.split("audio.svg").length > 1 : false;
  let is_video =  post_type_indicator ? post_type_indicator.src.split("video.svg").length > 1 : false;
  let is_article =  post_type_indicator ? post_type_indicator.src.split("blog.svg").length > 1 : false;
  if(is_audio){
    document.querySelector(".bottom-nav-icon[src*='audio.svg']").parentElement.parentElement.classList.add("active");
  }
  else if(is_video){
    document.querySelector(".bottom-nav-icon[src*='video.svg']").parentElement.parentElement.classList.add("active");
  }
  else if(is_article){
    document.querySelector(".bottom-nav-icon[src*='blog.svg']").parentElement.parentElement.classList.add("active");
  }
  else{
    document.querySelector(".bottom-nav-icon[src*='all.svg']").parentElement.parentElement.classList.add("active");
  }
}
let navbar_active_item_handled = document.querySelectorAll(".bottom-nav-item.active").length>0;;
if(navbar_active_item_handled === false){
handle_navbar_active_item();
}