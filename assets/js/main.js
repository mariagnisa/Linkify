'use strict';

function setCookie(cname, cvalue, cmaxDay) {
  const d = new Date();
  d.setTime(d.getTime() + (cmaxDay*24*60*60*1000));
  const expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires;
}

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

function checkCookie() {
  
}
