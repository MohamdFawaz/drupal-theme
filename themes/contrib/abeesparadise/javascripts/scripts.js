/**
* Helper function for Mobile Hamburger menu.
*/
function onClickHamburger(x) {
    var main_menu = document.getElementById('mobile-menu');
    x.classList.toggle('change');
    main_menu.classList.toggle('change');
}
