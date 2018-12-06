(function ($) {
  $(function () {

    function toHide() {
      $('.overlay').css('display', 'none');
      $('.dilog-container').css('display', 'none');
      $('.modal-dilog-roles').css('display', 'none');
      $('.modal-dilog-submit').css('display', 'none');
      $('.modal-dilog-login').css('display', 'none');

    }

    // $('.login-link').on('click', function (event) {
    //   event.preventDefault();
    //   toHide();
    //   $('.overlay').css('display', 'block');
    //   $('.dilog-container').css('display', 'flex');
    //   $('.modal-dilog-login').css('display', 'flex');

    // });

  });
})(jQuery);