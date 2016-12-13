'use strict';

  if (!localStorage.getItem('Accepted cookie', 'cookie')) {
    setCookie();
  };

  function setCookie(key, value) {

    document.querySelector('.alertbox').style.display = 'block';

    document.querySelector('.button').addEventListener('click', function() {
         localStorage.setItem('Accepted cookie', 'cookie');
         document.querySelector('.alertbox').style.display = 'none';
    });
  }
