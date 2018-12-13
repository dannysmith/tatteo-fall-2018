(function ($) {
  $('.form-guest-search').on('submit', function (event) {
    const $guestspotsContainer = $('.guestspots-container-js')
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
        $guestspotsContainer.empty();
        for (let i = 0; i < response.length; i++) {
          let locationJson = response[i].location.toLowerCase();
          let startDateJson = new Date(response[i].start_date);
          let finishDateJson = new Date(response[i].finish_date);
          let image = response[i].image;
          let title = response[i].title.rendered;
          if (locationLow == locationJson) {
            if (startDateChoosen >= startDateJson && finishDateChoosen <= finishDateJson) {
              $guestspotsContainer.empty();
              $guestspotsContainer.html(`<div><img src="${image}"><h2>${title}</h2>
              <p>${data.location}</p>`)
            }
          }
        }
      })
      .fail(function () {
        $guestspotsContainer.empty();
        $guestspotsContainer.html('Sorry, try again...')
      });
  })
})(jQuery);