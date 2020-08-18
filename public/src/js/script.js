const btnBurger = document.querySelector('.btnBurger');
const menuPopUp = document.querySelector('.menuPopUp');
const menuPopOut = document.querySelector('.menuPopOut');
const body = document.querySelector('.body')
const podology = document.querySelector('.blueBackGround');

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