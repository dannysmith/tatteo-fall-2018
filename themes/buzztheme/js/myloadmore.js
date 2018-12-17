(function ($) {

    let page_number = 1;

    $('.load-more').on('click', function () {
        event.preventDefault();
        page_number++;
        $.ajax({
            url: api_vars.root_url + 'wp/v2/users?filter[role]=studio' + '?' +
                $.param({
                    page: page_number,
                    per_page: "6",
                    roles: "artist",
                    context: "view",
                    orderby: "registered_date",
                }),
            method: 'GET',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-WP-Nonce', api_vars.nonce);
            }
        }).done(function (response) {
            console.log(response);
        }).fail(function () {
            alert("fail ");
        });
    })
})(jQuery);