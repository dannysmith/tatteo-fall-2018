(function ($) {
  $('.dropbtn').on('click', function () {
    $('.main-navigation').toggle();
  });
  $('.user-link').on('click', function () {
    $('.user-menu').toggleClass('show-menu');
  });
})(jQuery);