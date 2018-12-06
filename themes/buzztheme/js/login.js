(function ($) {
  $(function () {

    function toHide() {
      $('.overlay').css('display', 'none');
      $('.dilog-container').css('display', 'none');
      $('.modal-dilog-submit').css('display', 'none');
    }

    $(document).on("keydown", this, function (e) {
      var keycode = ((typeof e.keyCode != 'undefined' && e.keyCode) ? e.keyCode : e.which);
      if (keycode === 27) {
        toHide();
      }
    });

    $('.login-link').on('click', function (event) {
      event.preventDefault();
      toHide();
      $('.overlay').css('display', 'block');
      $('.dilog-container').css('display', 'flex');
    });

    $('.cancel-modal-dilog-roles').on('click', function (event) {
      event.preventDefault();
      toHide();
    });
  });
})(jQuery);