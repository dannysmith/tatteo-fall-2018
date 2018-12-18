(function ($) {

    let page_number = 1;

    $('.load-more').on('click', function () {
        event.preventDefault();
        page_number++;
        $.ajax({
            url: api_vars.root_url + 'wp/v2/users' + '?' +
                $.param({
                    roles: "artist",
                    page: page_number,
                    per_page: "6",
                    // roles: "artist",
                    context: "view",
                    orderby: "registered_date",
                    order: "desc"
                }),
            method: 'GET',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-WP-Nonce', api_vars.nonce);
            }
        }).done(function (response) {
            console.log(page_number);

            response.forEach(element => {
                $(".artist-users").append(`
                
                <div class="container">
                    <div class="artist"><a href="${element.link}">
                    <img src="${element.avatar}"
                        width="120" height="120" alt="" class="avatar avatar-120 wp-user-avatar wp-user-avatar-120 photo avatar-default"></a></div>
                    <li><a href="${element.link}">${element.name}</a></li><a href="${element.link}">
                    <li>${element.location}</li>
                    <li></li>
                    </a>
                </div>`);

            });
            console.log(response);
        }).fail(function () {
            alert("fail ");
        });
    })
})(jQuery);