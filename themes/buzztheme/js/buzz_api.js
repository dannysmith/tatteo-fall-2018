(function ($) {

  function toHide() {
    $('.overlay').css('display', 'none');
    $('.dilog-container').css('display', 'none');
    $('.modal-dilog-roles').css('display', 'none');
    $('.modal-dilog-submit').css('display', 'none');

  }

  $(function () {
    $('.register-form').on('submit', function (event) {

      alert("nonce 33 " + api_vars.nonce);
      event.preventDefault();

      let data = {
        security: api_vars.nonce,
        _wpnonce: api_vars.nonce,
        email: $('.new-user-email').val(),
        username: $('.new-user-email').val(),
        password: $('.new-user-password').val()
      };
      $.ajax({
          url: api_vars.root_url + 'wp/v2/users',
          method: 'POST',
          beforeSend: function (xhr) {
            xhr.setRequestHeader('X-WP-Nonce', api_vars.nonce);
          },
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
  });
})(jQuery);



// email: $('.new-user-email').val(),
//   username: $('.new-user-email').val(),
//   password: $('.new-user-password').val()