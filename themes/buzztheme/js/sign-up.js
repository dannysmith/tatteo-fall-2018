(function ($) {

  function toHide() {
    $('.overlay').css('display', 'none');
    $('.dilog-container').css('display', 'none');
    $('.modal-dilog-roles').css('display', 'none');
    $('.modal-dilog-submit').css('display', 'none');
    $('.modal-dilog-login').css('display', 'none');
    $('.error-message-sign-up').css('display', 'none');
    $('.error-message').css('display', 'none');
    $('.error-message').empty();
    $('.error-message-sign-up').empty();

  }

  $(document).on('keydown', this, function (e) {
    var keycode = ((typeof e.keyCode != 'undefined' && e.keyCode) ? e.keyCode : e.which);
    if (keycode === 27) {
      toHide();
      $('.user-menu').css('display', 'none');
    }
  });

  // Showing login form 
  $('.login-here').on('click', function (event) {
    alert('test');
    event.preventDefault();
    toHide();
    $('.overlay').css('display', 'block');
    $('.dilog-container').css('display', 'flex');
    $('.modal-dilog-login').css('display', 'flex');
  });

  $('.login-link').on('click', function (event) {
    event.preventDefault();
    toHide();
    $('.overlay').css('display', 'block');
    $('.dilog-container').css('display', 'flex');
    $('.modal-dilog-login').css('display', 'flex');
  });

  let err = false;
  // Log in submit
  $('.login-form').on('submit', function (event) {
    event.preventDefault();
    // let data = {
    //   log: $('.user-name').val(),
    //   pwd: $('.user-password').val(),
    //   rememberme: 'forever',
    //   'wp-submit': 'Log In',
    //   testcookie: 1
    // };
    $.ajax({
        url: api_vars.home_url + '/wp-login.php', // eslint-disable-line
        method: 'POST',
        data: $(this).serialize(),
        success: function (response) {
          if ($(response).text().includes('ERROR')) {
            err = true;
          }
        }
      })
      .done(function () {
        if (err) {
          $('.error-message').css('display', 'block');
          $('.error-message').empty();
          $('.error-message').text('Incorrect Username or password. Please try again.');
        } else {
          toHide();
          location.reload(true);
        }
      })
      .fail(function () {});
  });

  // Sign-up form
  $('.sign-up-link').on('click', function () {
    toHide();
    $('.overlay').css('display', 'block');
    $('.dilog-container').css('display', 'flex');
    $('.modal-dilog-roles').css('display', 'flex');
  });

  let role;
  const rolesEnum = {
    'artist': 'artist',
    'studio': 'studio'
  }


  // chosing studio role
  $('.studio-role').on('click', function (event) {
    event.preventDefault();
    role = rolesEnum.studio;
    console.log(role);
    toHide();
    $('.overlay').css('display', 'block');
    $('.dilog-container').css('display', 'flex');
    $('.modal-dilog-submit').css('display', 'flex');

  });

  // chosing artist role
  $('.artist-role').on('click', function (event) {
    event.preventDefault();
    role = rolesEnum.artist;
    console.log(role);
    toHide();
    $('.overlay').css('display', 'block');
    $('.dilog-container').css('display', 'flex');
    $('.modal-dilog-submit').css('display', 'flex');

  });

  $('.cancel-modal-dilog-roles').on('click', function (event) {
    event.preventDefault();
    toHide();
  });

  function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("guespot-image").files[0]);

    oFReader.onload = function (oFREvent) {
        document.getElementById("guespot-image").src = oFREvent.target.result;
    };
};


  // Sign-up submit
  $('.register-form').on('submit', function (event) {
    event.preventDefault();

    let data = {
      user_email: $('.new-user-email').val(), // eslint-disable-line
      user_login: $('.new-user-name').val(), // eslint-disable-line
      pass1: $('.new-user-password').val(),
      location: $('.new-user-location').val(),
      description: $('.new-user-description').val(),
      role: role
    };
    $.ajax({
        url: api_vars.home_url + '/wp-login.php?action=register', // eslint-disable-line
        method: 'POST',
        data: data,
      })
      .done(function (response) {
        console.log(response);
        if ($(response).text().includes('ERROR')) {
          $('.error-message-sign-up').empty();
          $('.error-message-sign-up').css('display', 'block');
          let parser = new DOMParser();
          const htmlDoc = parser.parseFromString(response, 'text/html');
          console.log($(htmlDoc).find('#login_error').html());// eslint-disable-line
          $('.error-message-sign-up').append($(htmlDoc).find('#login_error').html());
        } else {
          toHide();
          location.reload(true);
        }
      })
      .fail(function (response) {
        console.log('fail');// eslint-disable-line
        console.log(response);// eslint-disable-line
      });
  });

})(jQuery);