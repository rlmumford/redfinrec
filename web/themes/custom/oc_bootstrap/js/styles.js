(function($, Drupal) {
  $(window).resize(function() {
    if (($(document).scrollTop() + $(window).height()) < ($(document).height() - 100)) {
      $('.gutter-wrapper').addClass('gutter-wrapper-over');
    }
    else {
      $('.gutter-wrapper').removeClass('gutter-wrapper-over');
    }
  });

  $(document).scroll(function() {
    if (($(document).scrollTop() + $(window).height()) < ($(document).height() - 100)) {
      $('.gutter-wrapper').addClass('gutter-wrapper-over');
    }
    else {
      $('.gutter-wrapper').removeClass('gutter-wrapper-over');
    }
  });

  Drupal.behaviors.ocBootstrapStyles = {
    attach: function(context) {
      let $footer = $('.gutter-wrapper');
      if ($(window).height() > $(document).height()) {
        $footer.removeClass('gutter-wrapper-over');
      }
      else {
        if (($(document).scrollTop() + $(window).height()) < ($(document).height() - 100)) {
          $footer.addClass('gutter-wrapper-over');
        }
        else {
          $footer.removeClass('gutter-wrapper-over');
        }
      }
    }
  };
})(jQuery, Drupal);
