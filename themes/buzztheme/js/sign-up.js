(function ($) {

  function toHide() {
    $('.overlay').css('display', 'none');
    $('.dilog-container').css('display', 'none');
    $('.modal-dilog-roles').css('display', 'none');
    $('.modal-dilog-submit').css('display', 'none');
    $('.modal-dilog-login').css('display', 'none');
  }


  $(document).on("keydown", this, function (e) {
    var keycode = ((typeof e.keyCode != 'undefined' && e.keyCode) ? e.keyCode : e.which);
    if (keycode === 27) {
      toHide();
    }
  });

  $('.login-link').on('click', function (event) {
    event.preventDefault();
    toHide();
    $('.overlay').css('display', 'block');
    $('.dilog-container').css('display', 'flex');
    $('.modal-dilog-login').css('display', 'flex');
  });

  // Log in form  

  $('.login-form').on('submit', function (event) {
    event.preventDefault();
    let data = {
      log: $('.user-name').val(),
      pwd: $('.user-password').val(),
      rememberme: "forever",
      "wp-submit": "Log In",
      testcookie: 1
    };
    $.ajax({
        url: api_vars.home_url + "/wp-login.php",
        method: 'POST',
        data: data,
      })
      .done(function (response) {
        toHide();
        location.reload(true);
      })
      .fail(function (response) {
        console.log('fail');
        console.log(response);
      });
  });

  // Sign-up link
  $(".sign-up-link").on("click", function () {
    toHide();
    $('.overlay').css('display', 'block');
    $('.dilog-container').css('display', 'flex');
    $('.modal-dilog-roles').css('display', 'flex');
  });

  let role;
  const rolesEnum = {
    "artist": "artist",
    "studio": "studio"
  }


  $('.studio-role').on('click', function (event) {
    event.preventDefault();
    role = rolesEnum.studio;
    console.log(role);
    toHide();
    $('.overlay').css('display', 'block');
    $('.dilog-container').css('display', 'flex');
    $('.modal-dilog-submit').css('display', 'flex');

  });

  $('.artist-role').on('click', function (event) {
    event.preventDefault();
    role = rolesEnum.artist;
    console.log(role);
  });

  $('.cancel-modal-dilog-roles').on('click', function (event) {
    event.preventDefault();
    toHide();
  });


  $('.register-form').on('submit', function (event) {
    event.preventDefault();

    let data = {
      user_email: $('.new-user-email').val(),
      user_login: $('.new-user-email').val(),
      pass1: $('.new-user-password').val(),
      // role: 'studio'
      first_name: 'john',
      role: "studio"
    };
    $.ajax({
        url: api_vars.home_url + "/wp-login.php?action=register",
        method: 'POST',
        data: data,
      })
      .done(function (response) {

        console.log(response);
        toHide();
      })
      .fail(function (response) {
        console.log('fail');
        console.log(response);
        //post and alert with failure var from functions.php
      });
  });

})(jQuery);


// $('.login-link').on('click', function (event) {
//   event.preventDefault();
//   toHide();
//   $('.overlay').css('display', 'block');
//   $('.dilog-container').css('display', 'flex');
//   $('.modal-dilog-roles').css('display', 'flex');

// });