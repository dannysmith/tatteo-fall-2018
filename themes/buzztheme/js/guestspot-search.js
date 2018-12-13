(function ($) {
    $('.form-guest-search').on('submit', function (event) {
        event.preventDefault();
        let data = {
        location: $("#location").val(),
        start_date: $('#start-date').val(),
        finish_date: $('#finish-date').val(),
        }
        $.ajax({
            method: 'GET',
            url: api_vars.root_url + 'wp/v2/guestspots-api',
            data: data,
            beforeSend: function (xhr) {
              xhr.setRequestHeader('X-WP-Nonce', api_vars.nonce);
            }
          })
          .done(function () {
            event.preventDefault(); 
          })
          .fail(function (t) {
            //post and alert with failure var from functions.php
          });
    })
})(jQuery);