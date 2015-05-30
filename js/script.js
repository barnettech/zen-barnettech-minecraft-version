(function($) {
    $(document).ready(function() {
      $(".pause-button").hide();
      $(".play-button").show();
      $( ".pause-button" ).click(function() {
        $(".pause-button").hide();
        $(".play-button").show();
        controls.lookSpeed = 0;
        //$('canvas').toggle();
      });
      $( ".play-button" ).click(function() {
        $(".pause-button").show();
        $(".play-button").hide();
        //$('canvas').toggle();
        controls.lookSpeed = 0.125;
      });

    });
})(jQuery);

