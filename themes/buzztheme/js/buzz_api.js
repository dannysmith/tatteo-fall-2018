(function ($) {
  $(function () {
    $('.register-form').on('submit', function (event) {
      alert('test')
      event.preventDefault();
      let data = {
        email: 'someone@somewhere.net',
        username: 'someone',
        password: Math.random().toString(36).substring(7)
      };
      $.ajax({
          method: 'POST',
          url: api_vars.root_url + 'wp/v2/users',
          data: data,
          beforeSend: function (xhr) {
            xhr.setRequestHeader('X-WP-Nonce', api_vars.nonce);
          }
        })
        .done(function (response) {
          console.log(response);
        })
        .fail(function () {
          console.log('fail');
          //post and alert with failure var from functions.php
        });
    });
  });
})(jQuery);