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
    //Add a class to wrapper for the right height on body
    document.querySelector('.wrapper').classList.add('cookie-box-visible');

    const cbutton = document.querySelector('.cookie-box-button');
    cbutton.addEventListener('click', event => {
      setCookie('accept-cookie', '1', 1);
      document.querySelector('.cookie-box').style.display = 'none';
      //Remove/rewrite the wrapper class
      document.querySelector('.wrapper').className = 'wrapper';
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

  //show and hide effect on login form if clicked on login button
  const button = document.querySelector('.login-button');
  const login = document.querySelector('.login-wrapper');
  //if login button is null nothing happens, otherwise show/hide when clicked
  if (button != null) {
    button.addEventListener('click', event => {
      if (login.style.display != 'block') {
        login.style.display = 'block';
      } else {
        login.style.display = 'none';
      }
    });
  }

  //show and hide effect on register form if clicked on register button
  const regButton = document.querySelector('.register-button');
  const register = document.querySelector('.register-wrapper');
  //if register button is null nothing happens, otherwise show/hide when cicked
  if (regButton != null) {
    regButton.addEventListener('click', event => {
      if (register.style.display != 'block') {
        register.style.display = 'block';
      } else {
        register.style.display = 'none';
      }
    });
  }

  //intercepts click events on the body and checks if login or register forms are open
  document.body.addEventListener('click', event => {
    if (login != null && register != null) {
      const clickInsideLogin = login.contains(event.target);
      const clickInsideRegister = register.contains(event.target);
      const clickLoginButton = button.contains(event.target);
      const clickRegButton = regButton.contains(event.target)

      if ((!clickInsideLogin && !clickLoginButton) && login.style.display == 'block') {
        login.style.display = 'none';
      } else if ((!clickInsideRegister && !clickRegButton) && register.style.display == 'block') {
        register.style.display = 'none';
      }
    }
  });

  //show edit post form when clicked on editbutton
  const editButton = document.querySelector('.posts-edit');
  if (editButton != null) {
    editButton.addEventListener('click', event => {

      let editPost = document.querySelectorAll('.' + event.target.classList[0] + '.edit-post');
      let post = document.querySelectorAll('.' + event.target.classList[0] + '.posts');

      if (editPost[0].style.display != 'block') {
        editPost[0].style.display = 'block';
        post[0].style.display = 'none';
      }
    });
  }

  //hide edit post form when clicked on closebutton
  let closeButtons = document.querySelectorAll('.edit-post-cross');
  for (let i = 0; i < closeButtons.length; i++) {
    let closeButton = closeButtons[i];

    closeButton.addEventListener('click', event => {

      let editPost = document.querySelectorAll('.' + event.target.classList[0] + '.edit-post');
      let post = document.querySelectorAll('.' + event.target.classList[0] + '.posts');

      if (closeButton != null) {
        if (post[0].style.display != 'block') {
          editPost[0].style.display = 'none';
          post[0].style.display = 'block';
        }
      }
    });
  }

  //show edit post form on profile page when clicked on editbutton
  let editProfileButtons = document.querySelectorAll('.profile-edit');
  for (let i = 0; i < editProfileButtons.length; i++) {
    let editProfileButton = editProfileButtons[i];

    if (editProfileButton != null) {
      editProfileButton.addEventListener('click', event => {

        let editPost = document.querySelectorAll('.' + event.target.classList[0] + '.profile-edit-post');
        let post = document.querySelectorAll('.' + event.target.classList[0] + '.profile-posts');

        if (editPost[0].style.display != 'block') {
          editPost[0].style.display = 'block';
          post[0].style.display = 'none';
        }
      });
    }
  }

  //hide edit post form on profile page when clicked on closebutton
  let closeProfileButtons = document.querySelectorAll('.profile-edit-post-cross');
  for (let i = 0; i < closeProfileButtons.length; i++) {
    let closeProfileButton = closeProfileButtons[i];

    closeProfileButton.addEventListener('click', event => {

      let editPost = document.querySelectorAll('.' + event.target.classList[0] + '.profile-edit-post');
      let post = document.querySelectorAll('.' + event.target.classList[0] + '.profile-posts');

      if (closeProfileButton != null) {
        if (post[0].style.display != 'block') {
          editPost[0].style.display = 'none';
          post[0].style.display = 'block';
        }
      }
    });
  }
});
