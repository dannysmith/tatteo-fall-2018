(function ($) {
  $(function () {
    $('.login-link').on('click', function (event) {
      alert('test')
      event.preventDefault();
      $('.overlay').css('display', 'block');
      $('.dilog-container').css('display', 'flex');

    });
  });
})(jQuery);