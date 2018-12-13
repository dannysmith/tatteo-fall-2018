(function ($) {
  $('.form-guest-search').on('submit', function (event) {
    event.preventDefault();
    let data = {
      location: $("#location").val(),
      start_date: $('#start-date').val(),
      finish_date: $('#finish-date').val(),
    }
   let locationLow = data.location.toLowerCase();
   let startDateChoosen = new Date(data.start_date);
   let finishDateChoosen = new Date(data.finish_date);
    $.ajax({
        method: 'GET',
        url: api_vars.root_url + 'wp/v2/guestspots-api',
        data: data,
        beforeSend: function (xhr) {
          xhr.setRequestHeader('X-WP-Nonce', api_vars.nonce);
        }
      })
      .done(function (response) {
        event.preventDefault();
        console.log(response)
        for (let i = 0; i < response.length; i++) {
          let locationJson = response[i].location.toLowerCase();
          let startDateJson = new Date(response[i].start_date);
          let finishDateJson = new Date (response[i].finish_date);
          if (locationLow == locationJson ){
            if (startDateChoosen >= startDateJson && finishDateChoosen<= finishDateJson){
              console.log('Hey')
            }
          }
        }
      })
      .fail(function () {
        //post and alert with failure var from functions.php
      });
  })
})(jQuery);