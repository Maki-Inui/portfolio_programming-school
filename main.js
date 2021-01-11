const swiper = new Swiper('.swiper-container', {
  // Optional parameters
  loop: true,
  effect: 'fade',
  speed: 1000,

  autoplay: {
    delay: 2500
  },
  
})

const headerElement = document.getElementById('main-logo');

document.addEventListener('scroll', function(){
  const scrollY = window.pageYOffset;

  if (scrollY > 0) {
    headerElement.classList.add('active');
  } else {
    headerElement.classList.remove('active');
  }
});

document.addEventListener('DOMContentLoaded', function(){
  const open = document.getElementById('open');
  const overlay = document.querySelector('.overlay');
  const close = document.getElementById('close');

  open.addEventListener('click', () => {
    overlay.classList.add('show');
    open.classList.add('hide');
  });

  close.addEventListener('click', () => {
    overlay.classList.remove('show');
    open.classList.remove('hide');
  });
});


