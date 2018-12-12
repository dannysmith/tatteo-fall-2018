(function ($) {

  $(function () {
    $('.guestspot-form').on('submit', function (event) {
      event.preventDefault();
      let data = {
        title: $("#studio-name").val(),
        "status": "publish",
        original_post_status: "auto-draft",
        auto_draft: '1',
        hidden_post_status: "publish",
        post_status: "publish",
        hidden_post_visibility: "public",
        visibility: "public",
        original_publish: "Publish",
        publish: "Publish",
        post_type: "guestspot",
        studio_name: $("#studio-name").val(),
        location: $("#guestspot-location").val(),
        start_date: $('#guestspot-start').val(),
        finish_date: $('#guestspot-finish').val(),
        //image:
      };
      $.ajax({
          method: 'POST',
          url: api_vars.root_url + 'wp/v2/guestspots-api',
          data: data,
          beforeSend: function (xhr) {
            xhr.setRequestHeader('X-WP-Nonce', api_vars.nonce);
          }
        })
        .done(function () {
          event.preventDefault();
          console.log("GS created!")
        })
        .fail(function (t) {
          //post and alert with failure var from functions.php
        });
    });
  });
})(jQuery);