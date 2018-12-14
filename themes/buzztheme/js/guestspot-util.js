(function ($) {
  $(function () {

    $('.edit-guestspot').on("click", function () {

    });

    $('.image-upload-form').submit(function (event) {

      event.preventDefault();
      var formData = new FormData();
      formData.append('file', $('input[type = file]')[0].files[0]);
      formData.append('title', "title");
      formData.append('caption', "caption");

      $.ajax({
        url: api_vars.root_url + 'wp/v2/media',
        type: 'POST',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (xhr) {
          xhr.setRequestHeader('X-WP-Nonce', api_vars.nonce);
        }
      }).done(function (response) {
        uploadPost(response.id);
      })
    });

    function uploadPost(imageId) {
      let data = {
        title: $("#studio-name").val(),
        "status": "publish",
        post_type: "guestspot",
        studio_name: $("#studio-name").val(),
        location: $("#location").val(),
        start_date: $('#start-date').val(),
        finish_date: $('#finish-date').val(),
        image: imageId,
        author: api_vars.user_id,
        post_author: api_vars.user_id,
        user_ID: api_vars.user_id
        // author: 30
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
          window.location.href = api_vars.home_url + "/my-guestspots/";
        })
        .fail(function () {

        });
    }
  });
})(jQuery);