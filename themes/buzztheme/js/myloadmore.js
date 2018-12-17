(function ($) {

$('.load-more').on('click', function() {
    event.preventDefault();
    $.ajax({
        url: 'http://localhost:8888/buzz/wp-json/wp/v2/pages',
        method: 'GET',
        }).done(function() {
            console.log('hello');
        }).fail(function() {
            alert("fail ");
       });
    })
})(jQuery);
