(function ($) {

    let page_number = 1;

    $('.load-more-artists').on('click', function () {
        event.preventDefault();
        page_number++;

        $.ajax({
            url: api_vars.root_url + 'wp/v2/artist_users' + '?' +
                $.param({
                    // roles: "Artist",
                    page: "1", // page_number,
                    per_page: "6",
                    context: "view",
                    orderby: "registered_date",
                    order: "desc"
                }),
            method: 'GET',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-WP-Nonce', api_vars.nonce); // eslint-disable-line
            }
        }).done(function (response) {
            if (response.length < 6) {
                $(".load-more-artists").css('display', 'none');
            }
            response.forEach(element => {
                $(".artist-users").append(`
                
                <div class="container">
                    <div class="studio"><a href="${element.link}">
                    <img src="${element.avatar}"
                        width="120" height="120" alt="" class="avatar avatar-120 wp-user-avatar wp-user-avatar-120 photo avatar-default"></a></div>
                    <li><a href="${element.link}">${element.name}</a></li><a href="${element.link}">
                    <li>${element.location}</li>
                    <li></li>
                    </a>
                </div>`);

            });
        }).fail(function () {});
    });

    $('.load-more-studios').on('click', function () {
        event.preventDefault();
        page_number++;

        $.ajax({
            url: api_vars.root_url + 'wp/v2/artist_users' + '?' +
                $.param({
                    // roles: "studio",
                    page: '1', //page_number,
                    page_: page_number,
                    per_page: "6",
                    context: "view",
                    // orderby: "registered_date",
                    // order: "desc"
                }),
            method: 'GET',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-WP-Nonce', api_vars.nonce);
            }
        }).done(function (response) {
            if (response.length < 6) {
                $(".load-more-studios").css('display', 'none');
            }
            response.forEach(element => {
                $('.studio-users').append(`
                <div class="container">
                    <div class="studio"><a href="${element.link}">
                    <img src="${element.avatar}"
                        width="120" height="120" alt="" class="avatar avatar-120 wp-user-avatar wp-user-avatar-120 photo avatar-default"></a></div>
                    <li><a href="${element.link}">${element.name}</a></li><a href="${element.link}">
                    <li>${element.location}</li>
                    <li></li>
                    </a>
                </div>`);

            });
        }).fail(function () {});
    });


})(jQuery);