let pageNumber = 1;
let load_more_post_form = document.getElementById('load_more_post_form');
function load_more_post(){
    let url = new URL(window.location.href);
    let search_params = url.searchParams;
    search_params.set('pageNumber', ++pageNumber);
    window.location.href = url;
}

document.querySelector('.view-more-container button').addEventListener('click', load_more_post);