(function ($) {
  $('.form-guest-search').on('submit', function (event) {
    const $guestspotsContainer = $('.guestspots-container-js');
    const $guestspotsMessage = $('.guestspots-message');
    event.preventDefault();

    const searchLocation = $('#location').val().toLowerCase();
    const searchStartDate = $('#start-date').val();
    const searchFinishDate = $('#finish-date').val();

    let startDateChoosen = searchStartDate == "" ? null : new Date(searchStartDate);
    let finishDateChoosen = searchFinishDate == "" ? null : new Date(searchFinishDate);
    $.ajax({
        method: 'GET',
        url: api_vars.root_url + 'wp/v2/guestspots-api', // eslint-disable-line
        // data: data,
        beforeSend: function (xhr) {
          xhr.setRequestHeader('X-WP-Nonce', api_vars.nonce); // eslint-disable-line
        }
      })
      .done(function (response) {
        // event.preventDefault();
        $guestspotsContainer.empty();
        $guestspotsMessage.empty();
        let filteredGuestspots = [];

        response.forEach(guestspot => {

          let guestspotLocation = guestspot.location;

          if ((searchLocation != '') && (!guestspotLocation.toLowerCase().includes(searchLocation))) {
            return;
          }

          let guestspotFinishDate = new Date(guestspot.finish_date);
          if (startDateChoosen !== null && startDateChoosen > guestspotFinishDate) {
            return;
          }
          let guestspotStartDate = new Date(guestspot.start_date);
          if (finishDateChoosen !== null && finishDateChoosen < guestspotStartDate) {
            return;
          }
          filteredGuestspots.push(guestspot);
        });

        filteredGuestspots.forEach(guestspot => {
          let guestspotLocation = guestspot.location;
          if ((searchLocation != '') && (!guestspotLocation.toLowerCase().includes(searchLocation))) {
            return;
          }
          let image = guestspot.image;
          let title = guestspot.title.rendered;
          let link = guestspot.link;
          $guestspotsMessage.append(`<div class='guestspot-after-search'>
                                              <div class='guest-container-search'>
                                              <img src='${image}' />
                                              <div class='studio-information'>
                                                <a href='${link}'>
                                                <h2>${title}</h2>
                                                </a>
                                                <p>${guestspotLocation}</p>
                                              </div>
                                              </div>
                                        </div>`);
        });

        if (filteredGuestspots.length == 0) {
          let errorMessage = "";

          if (searchLocation !== "") {
            if (searchStartDate !== "" || searchFinishDate !== "") {
              errorMessage = "Sorry, no guestspots currently available for these dates and/or in this location.";
            } else { //if (searchStartDate === "" && searchFinishDate === "")
              errorMessage = "Sorry, no guestspots currently available in this location.";
            }
          } else { //  if (searchLocation === "")
            if (searchStartDate !== "" || searchFinishDate !== "") {
              errorMessage = "Sorry, no guestspots currently available for these dates.";
            } else {
              errorMessage = "Sorry, no guestspots currently available.";
            }
          }
          $guestspotsMessage.html(`<p class="sorry-msg">${errorMessage}</p>`);
        }
      })
      .fail(function () {
        $guestspotsContainer.empty();
        $guestspotsContainer.html('Something went wrong..')
      });
  })


  // Featured Artist Part
  const $widgetTitle = $('.widget-title');
  const $widgetTitleValue = $widgetTitle.text()
  const $formatWidgetTitle = $widgetTitleValue.toLowerCase();
  const $finalArtistName = $formatWidgetTitle.split(' ').join('-');
  const _href = $('.featured-artist-link').attr("href");
  $(".featured-artist-link").attr("href", _href + $finalArtistName);
})(jQuery);



// Global search - tabs 

function openSearch(evt, searchName) { // eslint-disable-line
  var i, tabcontent, tablinks;
  // hiding all of the tab panes
  tabcontent = document.getElementsByClassName('tabcontent');
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].className = tabcontent[i].className.replace(' visible', '');
  }
  //taking the 'active' class off all the tab buttons
  tablinks = document.getElementsByClassName('tablinks');
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(' active', '');
  }
  document.getElementById(searchName).className += ' visible';
  evt.currentTarget.className += ' active';
}