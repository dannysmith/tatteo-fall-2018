(function ($) {
  $(function () {

    $('.image-upload-form').submit(function (event) {

      event.preventDefault();
      var formData = new FormData();
      formData.append('file', $('input[type = file]')[0].files[0]);
      formData.append('title', "title");
      formData.append('caption', "caption");

      console.log($('#guespot-image'));


      $.ajax({

        url: api_vars.root_url + 'wp/v2/media',
        type: 'POST',
        data: formData,
        cache: false,
        processData: false, // Don't process the files
        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
        beforeSend: function (xhr) {
          xhr.setRequestHeader('X-WP-Nonce', api_vars.nonce);
        }
      }).done(function (response) {
        alert(response.id);
        uploadPost(response.id);
      }).fail(function (response) {
        alert("fail " + response.id);
      });
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
        image: imageId
      };
      $.ajax({
          method: 'POST',
          url: api_vars.root_url + 'wp/v2/guestspots-api',
          data: data,
          //cache: false,
          // contentType: false,
          //processData: false,
          // success: function (data) {
          //   alert(data);
          //   console.log(data);
          // },
          beforeSend: function (xhr) {
            xhr.setRequestHeader('X-WP-Nonce', api_vars.nonce);
          }
        })
        .done(function () {

        })
        .fail(function () {
          //post and alert with failure var from functions.php
        });
    }
  });
})(jQuery);