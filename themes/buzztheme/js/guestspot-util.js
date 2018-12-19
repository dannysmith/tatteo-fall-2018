(function ($) {
  $(function () {

    $('.edit-guestspot-btn').on("click", function () {
      $(".edit-guestspot-form").css("display", "block");
      $(".image-upload-form").css("display", "none");       
    });

    $('.guestspot-upload-form').submit(function (event) {
      event.preventDefault();
                                    //find out if the user's uploaded any files
                                   //$('input[type = file]')[0].files[0]) -> something in this line will be helpful
       

        
                                        //if they have, the code below is fine
                                      //if not, we have to skip the image upload request and go straight to guestspot request

                                      //$('.guestspot img').attr('id'); -> the old image id

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



  
    $('.delete-guestspot-btn').on("click", function () {
      $.ajax({
          method: 'DELETE',
          url: api_vars.root_url + 'wp/v2/guestspots-api/' + $('.guestspot').attr('id'),
          beforeSend: function (xhr) {
            xhr.setRequestHeader('X-WP-Nonce', api_vars.nonce);
          }
        })
        .done(function () {
          window.location.href = api_vars.home_url + "/my-guestspots/";
        })

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
          // update 
        })
        .fail(function () {

        });
    }

    
  });
})(jQuery);