"use strict";

var Layout = (function () {
  $(".navbar-main .dropdown").on("hide.bs.dropdown", function () {
    var $this = $(this).find(".dropdown-menu");

    $this.addClass("close");

    setTimeout(function () {
      $this.removeClass("close");
    }, 200);
  });

  $(".dropdown-submenu > .dropdown-toggle").click(function (e) {
    e.preventDefault();
    $(this).parent(".dropdown-submenu").toggleClass("show");
  });

  $(".dropdown").hover(
    function () {
      $(this).addClass("show");
      $(this).find(".dropdown-menu").addClass("show");
      $(this).find(".dropdown-toggle").attr("aria-expanded", "true");
    },
    function () {
      $(this).removeClass("show");
      $(this).find(".dropdown-menu").removeClass("show");
      $(this).find(".dropdown-toggle").attr("aria-expanded", "false");
    }
  );

  $(".dropdown").click(function () {
    if ($(this).hasClass("show")) {
      $(this).removeClass("show");
      $(this).find(".dropdown-menu").removeClass("show");
      $(this).find(".dropdown-toggle").attr("aria-expanded", "false");
    } else {
      $(this).addClass("show");
      $(this).find(".dropdown-menu").addClass("show");
      $(this).find(".dropdown-toggle").attr("aria-expanded", "true");
    }
  });

  function pinSidenav() {
    $(".sidenav-toggler").addClass("active");
    $(".sidenav-toggler").data("action", "sidenav-unpin");
    $("body")
      .removeClass("g-sidenav-hidden")
      .addClass("g-sidenav-show g-sidenav-pinned");
    $("body").append(
      '<div class="backdrop d-xl-none" data-action="sidenav-unpin" data-target=' +
        $("#sidenav-main").data("target") +
        " />"
    );

    // Store the sidenav state in a cookie session
    Cookies.set("sidenav-state", "pinned");
  }

  function unpinSidenav() {
    $(".sidenav-toggler").removeClass("active");
    $(".sidenav-toggler").data("action", "sidenav-pin");
    $("body").removeClass("g-sidenav-pinned").addClass("g-sidenav-hidden");
    $("body").removeClass("g-sidenav-show").addClass("g-sidenav-hidden");
    $("body").find(".backdrop").remove();

    // Store the sidenav state in a cookie session
    Cookies.set("sidenav-state", "unpinned");
  }

  // Set sidenav state from cookie

  var $sidenavState = Cookies.get("sidenav-state")
    ? Cookies.get("sidenav-state")
    : "pinned";

  if ($(window).width() > 1200) {
    if ($sidenavState == "pinned") {
      pinSidenav();
    }

    if (Cookies.get("sidenav-state") == "unpinned") {
      unpinSidenav();
    }

    $(window).resize(function () {
      if (
        $("body").hasClass("g-sidenav-show") &&
        !$("body").hasClass("g-sidenav-pinned")
      ) {
        $("body").removeClass("g-sidenav-show").addClass("g-sidenav-hidden");
      }
    });
  }

  if ($(window).width() < 1200) {
    $("body").removeClass("g-sidenav-hide").addClass("g-sidenav-hidden");
    $("body").removeClass("g-sidenav-show");
    $(window).resize(function () {
      if (
        $("body").hasClass("g-sidenav-show") &&
        !$("body").hasClass("g-sidenav-pinned")
      ) {
        $("body").removeClass("g-sidenav-show").addClass("g-sidenav-hidden");
      }
    });
  }

  // Side nav Active State
  var loc = window.location.pathname.replace(/^.*[\\\/]/, "");
  if (loc.includes("view")) {
    var split = loc.split("-");
    loc = split.slice(0, split.length - 1).join("-");
  } else {
    loc = loc;
  }
  $(".navbar-nav")
    .find("a")
    .each(function () {
      if ($(this).attr("href") == loc) {
        if ($(this).closest('[data="collapse"]').length == 1) {
          $(this).toggleClass("active");
          $(this)
            .closest('[data="collapse"]')
            .parent()
            .siblings("a")
            .toggleClass("active")
            .removeClass("collapased")
            .attr("aria-expanded", true);
          $(this).closest('[data="collapse"]').addClass("show");
        } else {
          $(this).toggleClass("active");
        }
      }
    });

  $("body").on("click", "[data-action]", function (e) {
    e.preventDefault();

    var $this = $(this);
    var action = $this.data("action");
    var target = $this.data("target");

    // Manage actions

    switch (action) {
      case "sidenav-pin":
        pinSidenav();
        break;

      case "sidenav-unpin":
        unpinSidenav();
        break;

      case "search-show":
        target = $this.data("target");
        $("body")
          .removeClass("g-navbar-search-show")
          .addClass("g-navbar-search-showing");

        setTimeout(function () {
          $("body")
            .removeClass("g-navbar-search-showing")
            .addClass("g-navbar-search-show");
        }, 150);

        setTimeout(function () {
          $("body").addClass("g-navbar-search-shown");
        }, 300);
        break;

      case "search-close":
        target = $this.data("target");
        $("body").removeClass("g-navbar-search-shown");

        setTimeout(function () {
          $("body")
            .removeClass("g-navbar-search-show")
            .addClass("g-navbar-search-hiding");
        }, 150);

        setTimeout(function () {
          $("body")
            .removeClass("g-navbar-search-hiding")
            .addClass("g-navbar-search-hidden");
        }, 300);

        setTimeout(function () {
          $("body").removeClass("g-navbar-search-hidden");
        }, 500);
        break;
    }
  });

  // Add sidenav modifier classes on mouse events

  $(".sidenav").on("mouseenter", function () {
    if (!$("body").hasClass("g-sidenav-pinned")) {
      $("body")
        .removeClass("g-sidenav-hide")
        .removeClass("g-sidenav-hidden")
        .addClass("g-sidenav-show");
    }
  });

  $(".sidenav").on("mouseleave", function () {
    if (!$("body").hasClass("g-sidenav-pinned")) {
      $("body").removeClass("g-sidenav-show").addClass("g-sidenav-hide");

      setTimeout(function () {
        $("body").removeClass("g-sidenav-hide").addClass("g-sidenav-hidden");
      }, 200);
    }
  });
})();

!(function (t) {
  "use strict";
  t(function () {
    t('[data-toggle="sweet-alert"]').on("click", function () {
      switch (t(this).data("sweet-alert")) {
        case "basic":
          swal.fire({
            title: "Here's a message!",
            text: "A few words about this sweet alert ...",
            buttonsStyling: !1,
            confirmButtonClass: "btn btn-primary",
            icon: "success",
          });
          break;
        case "info":
        case "info":
          swal.fire({
            title: "Info",
            text: "A few words about this sweet alert ...",
            type: "info",
            buttonsStyling: !1,
            confirmButtonClass: "btn btn-info",
            icon: "info",
          });
          break;
        case "success":
          swal.fire({
            title: "Success",
            text: "A few words about this sweet alert ...",
            type: "success",
            buttonsStyling: !1,
            confirmButtonClass: "btn btn-success",
            icon: "success",
          });
          break;
        case "warning":
          swal.fire({
            title: "Warning",
            text: "A few words about this sweet alert ...",
            type: "warning",
            buttonsStyling: !1,
            confirmButtonClass: "btn btn-warning",
            icon: "warning",
          });
          break;
        case "question":
          swal.fire({
            title: "Are you sure?",
            text: "A few words about this sweet alert ...",
            type: "question",
            buttonsStyling: !1,
            confirmButtonClass: "btn btn-default",
            icon: "question",
          });
          break;
        case "confirm":
          swal
            .fire({
              title: "Are you sure?",
              text: "You won't be able to revert this!",
              type: "warning",
              showCancelButton: !0,
              buttonsStyling: !1,
              confirmButtonClass: "btn btn-danger",
              confirmButtonText: "Yes, delete it!",
              cancelButtonClass: "btn btn-secondary",
            })
            .then((t) => {
              t.value &&
                swal.fire({
                  title: "Deleted!",
                  text: "Your file has been deleted.",
                  type: "success",
                  buttonsStyling: !1,
                  confirmButtonClass: "btn btn-primary",
                  icon: "success",
                });
            });
          break;
        case "image":
          swal.fire({
            title: "Sweet",
            text: "Modal with a custom image ...",
            imageUrl: "/assets/img/logo.svg",
            buttonsStyling: !1,
            confirmButtonClass: "btn btn-primary",
            confirmButtonText: "Super!",
          });
          break;
        case "timer":
          swal.fire({
            title: "Auto close alert!",
            text: "I will close in 2 seconds.",
            timer: 2e3,
            showConfirmButton: !1,
          });
      }
    });
  });
})(jQuery);

("use strict");
if ($(".input-slider-container")[0]) {
  $(".input-slider-container").each(function () {
    var slider = $(this).find(".input-slider");
    var sliderId = slider.attr("id");
    var minValue = slider.data("range-value-min");
    var maxValue = slider.data("range-value-max");

    var sliderValue = $(this).find(".range-slider-value");
    var sliderValueId = sliderValue.attr("id");
    var startValue = sliderValue.data("range-value-low");

    var c = document.getElementById(sliderId),
      d = document.getElementById(sliderValueId);

    noUiSlider.create(c, {
      start: [parseInt(startValue)],
      connect: [true, false],
      //step: 1000,
      range: {
        min: [parseInt(minValue)],
        max: [parseInt(maxValue)],
      },
    });

    c.noUiSlider.on("update", function (a, b) {
      d.textContent = a[b];
    });
  });
}

if ($("#input-slider-range")[0]) {
  var c = document.getElementById("input-slider-range"),
    d = document.getElementById("input-slider-range-value-low"),
    e = document.getElementById("input-slider-range-value-high"),
    f = [d, e];

  noUiSlider.create(c, {
    start: [
      parseInt(d.getAttribute("data-range-value-low")),
      parseInt(e.getAttribute("data-range-value-high")),
    ],
    connect: !0,
    range: {
      min: parseInt(c.getAttribute("data-range-value-min")),
      max: parseInt(c.getAttribute("data-range-value-max")),
    },
  }),
    c.noUiSlider.on("update", function (a, b) {
      f[b].textContent = a[b];
    });
}

//
// Navbar
//

("use strict");

var Navbar = (function () {
  // Variables

  var $nav = $(".navbar-nav, .navbar-nav .nav");
  var $collapse = $(".navbar .collapse");
  var $dropdown = $(".navbar .dropdown");

  // Methods

  function accordion($this) {
    $this.closest($nav).find($collapse).not($this).collapse("hide");
  }

  function closeDropdown($this) {
    var $dropdownMenu = $this.find(".dropdown-menu");

    $dropdownMenu.addClass("close");

    setTimeout(function () {
      $dropdownMenu.removeClass("close");
    }, 200);
  }

  // Events

  $collapse.on({
    "show.bs.collapse": function () {
      accordion($(this));
    },
  });

  $dropdown.on({
    "hide.bs.dropdown": function () {
      closeDropdown($(this));
    },
  });
})();

//
// Navbar collapse
//

var NavbarCollapse = (function () {
  // Variables

  var $nav = $(".navbar-nav"),
    $collapse = $(".navbar .navbar-custom-collapse");

  // Methods

  function hideNavbarCollapse($this) {
    $this.addClass("collapsing-out");
  }

  function hiddenNavbarCollapse($this) {
    $this.removeClass("collapsing-out");
  }

  // Events

  if ($collapse.length) {
    $collapse.on({
      "hide.bs.collapse": function () {
        hideNavbarCollapse($collapse);
      },
    });

    $collapse.on({
      "hidden.bs.collapse": function () {
        hiddenNavbarCollapse($collapse);
      },
    });
  }
})();

//
// Popover
//

//
// Tooltip
//

("use strict");

var Tooltip = (function () {
  // Variables

  var $tooltip = $('[data-toggle="tooltip"]');

  // Methods

  function init() {
    $tooltip.tooltip();
  }

  // Events

  if ($tooltip.length) {
    init();
  }
})();

//
// Form control
//

("use strict");

$('input[type="file"]').bind("change", function (e) {
  $(this).siblings(".custom-file-label").html(e.target.files[0].name);
});

//
// Datatable
//

//
// Notify
// init of the bootstrap-notify plugin
//

("use strict");

var Notify = (function () {
  // Variables

  var $notifyBtn = $('[data-toggle="notify"]');

  // Methods

  function notify(
    placement,
    align,
    icon,
    type,
    animIn,
    animOut,
    heading,
    content
  ) {
    $.notify(
      {
        icon: icon,
        title: heading,
        message: content,
        url: "",
      },
      {
        element: "body",
        type: type,
        allow_dismiss: true,
        placement: {
          from: placement,
          align: align,
        },
        offset: {
          x: 30, // Keep this as default
          y: 50, // Unless there'll be alignment issues as this value is targeted in CSS
        },
        spacing: 10,
        z_index: 1080,
        delay: 2500,
        timer: 2500,
        showProgressbar: true,
        url_target: "_blank",
        mouse_over: false,
        animate: {
          // enter: animIn,
          // exit: animOut
          enter: animIn,
          exit: animOut,
        },
        template:
          '<div data-notify="container" class="alert alert-dismissible alert-{0} alert-notify" role="alert">' +
          '<span class="alert-icon" data-notify="icon"></span> ' +
          '<div class="alert-text"</div> ' +
          '<span class="alert-title" data-notify="title">{1}</span> ' +
          '<span data-notify="message">{2}</span>' +
          "</div>" +
          '<button type="button" class="close" data-notify="dismiss" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
          "</div>",
      }
    );
  }

  // Events

  if ($notifyBtn.length) {
    $notifyBtn.on("click", function (e) {
      e.preventDefault();

      var placement = $(this).attr("data-placement");
      var align = $(this).attr("data-align");
      var icon = $(this).attr("data-icon");
      var type = $(this).attr("data-type");
      var animIn = $(this).attr("data-animation-in");
      var animOut = $(this).attr("data-animation-out");
      var heading = $(this).attr("data-heading");
      var content = $(this).attr("data-content");
      var animOut = $(this).attr("data-animation-out");

      notify(placement, align, icon, type, animIn, animOut, heading, content);
    });
  }
})();
