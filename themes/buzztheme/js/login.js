(function ($) {
  $(function () {

    function toHide() {
      $('.overlay').css('display', 'none');
      $('.dilog-container').css('display', 'none');
      $('.modal-dilog-roles').css('display', 'none');
      $('.modal-dilog-submit').css('display', 'none');

    }

    $(document).on("keydown", this, function (e) {
      var keycode = ((typeof e.keyCode != 'undefined' && e.keyCode) ? e.keyCode : e.which);
      if (keycode === 27) {
        toHide();
      }
    });
    let role;
    const rolesEnum = {
      "artist": 1,
      "studio": 2
    }

    $('.login-link').on('click', function (event) {
      event.preventDefault();
      toHide();
      $('.overlay').css('display', 'block');
      $('.dilog-container').css('display', 'flex');
      $('.modal-dilog-roles').css('display', 'flex');

    });

    $('.studio-role').on('click', function (event) {
      event.preventDefault();
      role = rolesEnum.studio;
      console.log(role);
      toHide();
      $('.overlay').css('display', 'block');
      $('.dilog-container').css('display', 'flex');
      $('.modal-dilog-submit').css('display', 'flex');

    });

    $('.artist-role').on('click', function (event) {
      event.preventDefault();
      role = rolesEnum.artist;
      console.log(role);
    });

    $('.cancel-modal-dilog-roles').on('click', function (event) {
      event.preventDefault();
      toHide();
    });
  });
})(jQuery);