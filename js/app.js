const hamburger = document.querySelector('#mobile-menu')
const menulinks = document.querySelector('.navbar_menu')

// Display Mobile Menu

const mobilemenu = () =>{
    hamburger.classList.toggle('is-active');
    menulinks.classList.toggle('active');
};

hamburger.addEventListener('click', mobilemenu)