const btnBurger = document.querySelector('.btnBurger');
const menuPopUp = document.querySelector('.menuPopUp');
const menuPopOut = document.querySelector('.menuPopOut');
const body = document.querySelector('.body')
const podology = document.querySelector('.blueBackGround');
const searchbloc = document.querySelector('.inputSearch');
const searchlogo = document.querySelector('.searchLogo');


btnBurger.addEventListener('click', function () {
    menuPopUp.classList.toggle('active');
    menuPopOut.classList.toggle('active');
    body.classList.toggle('hidden');
});

menuPopOut.addEventListener('click', function() {
   menuPopUp.classList.toggle('active');
   menuPopOut.classList.toggle('active');
   body.classList.toggle('hidden');
});

searchlogo.addEventListener('click', function () {
    searchbloc.classList.toggle('active');
})