'use strict';
//set cookie
function setCookie(cname, cvalue, cmaxDay) {
  const d = new Date();
  d.setTime(d.getTime() + (cmaxDay*24*60*60*1000));
  const expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires;
}
//get cookie
function getCookie(cname) {
  const name = cname + "=";
  const ca = document.cookie.split(';');
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0)== ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
//check if there is a cookie
function checkCookie() {
  const username = getCookie('uid');
  document.querySelector('.cookie-box').style.display = 'flex';
  if (username != "") {
    getCookie();
  } else {
    setCookie();
  }
}

document.addEventListener("DOMContentLoaded", function(event) {
  const button = document.querySelector('.login-button');
  const login = document.querySelector('.login-wrapper');
  button.addEventListener('click', event => {
    if (login.style.display != 'block') {
      login.style.display = 'block';
    } else {
      login.style.display = 'none';
    }

  });

  const regButton = document.querySelector('.register-button');
  const register = document.querySelector('.register-wrapper');
  regButton.addEventListener('click', event => {
    if (register.style.display != 'block') {
      register.style.display = 'block';
    } else {
      register.style.display = 'none';
    }
  });
});
