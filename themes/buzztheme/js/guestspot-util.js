(function ($) {
  $(function () {

    $('.edit-guestspot-btn').on("click", function () {
      $(".edit-guestspot-form").css("display", "block");
      $(".image-upload-form").css("display", "none");      
    });

    $('.guestspot-upload-form').submit(function (event) {
      event.preventDefault();
      if ($('input[type = file]')[0].files.length) {
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
          console.log(response);
          updateGuestspot(response.id);
        
        })
        
      } else {
        updateGuestspot($('.guestspot img').attr('id'));
      }


       
      
    });

function updateGuestspot(imageId) {
  const data = {
    title: $('#edit-guestspot-title').val(),
    studio_name: $('#edit-guestspot-studio-name').val(),
    location: $('#edit-guestspot-location').val(),
    start_date: $('#edit-guestspot-start-date').val(),
    finish_date: $('#edit-guestspot-finish-date').val(),
    post_status: 'pending',
    image: imageId,
   
    
    }

    
    $.ajax({
      method: 'POST',
      url: api_vars.root_url + 'wp/v2/guestspots-api/' + $('.guestspot-upload-form').attr('id'),
      data: data,
      beforeSend: function(xhr) {
          xhr.setRequestHeader( 'X-WP-Nonce', api_vars.nonce );
      }
      
  })
 
    .done(function() {
      window.location.href = api_vars.home_url + "/my-guestspots/";
    })
}



    $('.delete-guestspot-btn').on('click', function () {
      $.ajax({
          method: 'DELETE',
          url: api_vars.root_url + 'wp/v2/guestspots-api/' + $('.guestspot').attr('id'), // eslint-disable-line
          beforeSend: function (xhr) {
            xhr.setRequestHeader('X-WP-Nonce', api_vars.nonce);// eslint-disable-line
          }
        })
        .done(function () {
          window.location.href = api_vars.home_url + '/my-guestspots/'; // eslint-disable-line
        })

    });




    $('.image-upload-form').submit(function (event) {
      event.preventDefault();
      var formData = new FormData();
      formData.append('file', $('input[type = file]')[0].files[0]);
      formData.append('title', 'title');
      formData.append('caption', 'caption');

      $.ajax({
        url: api_vars.root_url + 'wp/v2/media',// eslint-disable-line
        type: 'POST',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (xhr) {
          xhr.setRequestHeader('X-WP-Nonce', api_vars.nonce);// eslint-disable-line
        }
      }).done(function (response) {
        uploadPost(response.id);
      })
    });

    function uploadPost(imageId) {
      let data = {
        title: $('#studio-name').val(),
        'status': 'publish',
        post_type: 'guestspot',// eslint-disable-line
        studio_name: $('#studio-name').val(), // eslint-disable-line
        location: $('#location').val(),
        start_date: $('#start-date').val(), // eslint-disable-line
        finish_date: $('#finish-date').val(), // eslint-disable-line
        image: imageId,
        author: api_vars.user_id, // eslint-disable-line
        post_author: api_vars.user_id, // eslint-disable-line
        user_ID: api_vars.user_id // eslint-disable-line
        // author: 30
      };
      $.ajax({
          method: 'POST',
          url: api_vars.root_url + 'wp/v2/guestspots-api',// eslint-disable-line
          data: data,
          beforeSend: function (xhr) {
            xhr.setRequestHeader('X-WP-Nonce', api_vars.nonce);// eslint-disable-line
          }
        })
        .done(function () {
          window.location.href = api_vars.home_url + '/my-guestspots/';// eslint-disable-line
        })
        .fail(function () {

        });
    }

    
  });
})(jQuery);