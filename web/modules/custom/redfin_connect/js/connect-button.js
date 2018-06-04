(function($, Drupal) {
  Drupal.behaviors.redfinConnectButton = {
    attach: function (context, settings) {
      $('.connect-info', context).hide();
      $('.connect-button', context).click(function(e) {
        e.preventDefault();
        $('.connect-info', context).slideToggle();
      });
    }
  };
})(jQuery, Drupal);