(function($) {
    $(document).ready(function() {
      $( ".pause-button" ).click(function() {
        $(".pause-button").hide();
        $(".play-button").show();
        $('canvas').toggle();
      });
      $( ".play-button" ).click(function() {
        $(".pause-button").show();
        $(".play-button").hide();
        $('canvas').toggle();
      });

    });
})(jQuery);

