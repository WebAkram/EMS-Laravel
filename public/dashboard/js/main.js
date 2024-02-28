(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($("#spinner").length > 0) {
                $("#spinner").removeClass("show");
            }
        }, 0);
    };
    spinner();

    $(document).ready(function () {
        $(".back-to-top").hide(); // Hide the button initially

        $(window).scroll(function () {
            if ($(this).scrollTop() > 300) {
                $(".back-to-top").fadeIn("slow");
            } else {
                $(".back-to-top").fadeOut("slow");
            }
        });

        $(".back-to-top").click(function () {
            $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
            return false;
        });
    });

    // Sidebar Toggler
    $(".sidebar-toggler").click(function () {
        $(".sidebar, .content").toggleClass("open");
        return false;
    });

    $('.Dateofbirth').datepicker({
        'format': 'm/d/yyyy',
        'autoclose': true
      });
      $('.Dateofissue').datepicker({
        'format': 'm/d/yyyy',
        'autoclose': true
      });
      $('.Dateofexpiry').datepicker({
        'format': 'm/d/yyyy',
        'autoclose': true
      });

    //   $('.appointment_time').timepicker();

})(jQuery);
