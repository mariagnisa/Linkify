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
  const accept = getCookie('accept-cookie');
  if (accept == "") {
    document.querySelector('.cookie-box').style.display = 'flex';
    const cbutton = document.querySelector('.cookie-box__button');
    cbutton.addEventListener('click', event => {
      setCookie('accept-cookie', '1', 1);
      document.querySelector('.cookie-box').style.display = 'none';
    });
  }
}

//check username and password cookie
function checkLoginCookie() {
  const username = getCookie('username');
  const password = getCookie('password');

  const usernameField = document.getElementsByName('username')[0];
  const passwordField = document.getElementsByName('password')[0];
  if(usernameField != null && passwordField != null) {
      usernameField.value = username;
      passwordField.value = password;
  }
}

document.addEventListener("DOMContentLoaded", function(event) {
  checkCookie();
  checkLoginCookie();
  const button = document.querySelector('.login-button');
  const login = document.querySelector('.login-wrapper');
  if (button != null) {
    button.addEventListener('click', event => {
      if (login.style.display != 'block') {
        login.style.display = 'block';
      } else {
        login.style.display = 'none';
      }
    });
  }

  const regButton = document.querySelector('.register-button');
  const register = document.querySelector('.register-wrapper');
  if (regButton != null) {
    regButton.addEventListener('click', event => {
      if (register.style.display != 'block') {
        register.style.display = 'block';
      } else {
        register.style.display = 'none';
      }
    });
  }
});
