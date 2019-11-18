(function($, Drupal) {
  Drupal.behaviors.redfinConnectButton = {
    attach: function (context, settings) {
      $('.connect-info', context).hide();
      $('.connect-button', context).click(function(e) {
        if (!$(this).hasClass('connect-button-open')) {
          $(this).addClass('connect-button-open');
        }

        e.preventDefault();
        $('.connect-info', context).slideToggle('slow', function() {
          $('.connect-button').toggleClass('connect-button-open', $(this).is(':visible'));
        });
      });
    }
  };
})(jQuery, Drupal);
