$(function () {  
  //   start local starorage
  var coloroption = localStorage.getItem("color-option");
  var navbaroption = localStorage.getItem("navbar-option");
  if (coloroption !== null) {
    $(":root").css("--mymaincolor", coloroption);
    if (navbaroption === "white") {
      $(".mynav").addClass("white");
    }
    if (navbaroption === "themecolor") {
      $(".mynav").removeClass("white");
    }
  }
  //    toggle  settings
  function togglesetting() {
    $(".setting i").click(function () {
      $(this).fadeOut(300).siblings(".setting i").fadeIn(300);
      if ($(this).hasClass("active")) {
        $(".setting").animate(
          {
            left: "0",
          },
          300
        );
      } else {
        $(".setting").animate(
          {
            left: "-278px",
          },
          300
        );
      }
    });
  }
  togglesetting();

  $(".setting").click(function (e) {
    e.stopPropagation();
  });

  $("html,body").click(function (e) {
    var settingleft = $(".setting").css("left");
    if (e.target !== $(".setting")) {
      if (settingleft !== 278) {
        $(".setting").animate(
          {
            left: "-278px",
          },
          500
        );

        $(".setting .fa-times").fadeOut(300);
        $(".setting .fa-cog").fadeIn(300);
      }
    }
  });

  //  close settings by click on body

  //  change themes of page
  $(".color-option ul li").click(function () {
    $(":root").css("--mymaincolor", $(this).data("color"));
    //    start local localStorage
    localStorage.setItem("color-option", $(this).data("color"));
  });

  //  end change themes of bage

  //  end show and hide navbar

  // toggle background navbar
  $(".whitebtn").click(function () {
    $(".mynav").addClass("white");
    localStorage.setItem("navbar-option", "white");
  });
  $(".tempcolor").click(function () {
    $(".mynav").removeClass("white");
    localStorage.setItem("navbar-option", "themecolor");
  });

  // end toggle background navbar
  $("#btntoggle").click(function (e) {
    e.stopPropagation();
    if ($(this).hasClass("open")) {
      $(".links").toggleClass("open");
    }
  });

  $(".links").click(function (e) {
    e.stopPropagation();
  });

  $("html,body").click(function (e) {
    if (e.target !== $("#btntoggle") && e.target !== $(".links")) {
      $(".links").removeClass("open");
    }
  });
  //   start scroll
  $("nav ul li a").click(function (e) {
    e.preventDefault();
    $("nav ul li a").removeClass("active");
    $(this).addClass("active");
    $("html,body").animate(
      {
        scrollTop: $($(this).data("scroll")).offset().top,
      },
      900
    );
  });

  //  add class active when scroll on navbar links
  function addactiveclass() {
    $("nav ul li a").each(function () {
      var scrollPos = $(document).scrollTop();
      var currLink = $(this);
      var refElement = $(currLink.data("scroll"));
      if (
        refElement.position().top <= scrollPos &&
        refElement.position().top + refElement.height() > scrollPos
      ) {
        $("nav ul li a").removeClass("active");
        currLink.addClass("active");
      } else {
        currLink.removeClass("active");
      }
    });
  }
  $(window).on("scroll", function () {
    addactiveclass();
    if ($(window).scrollTop() >= $(".couple").offset().top + 100) {
      $(".mynav").removeClass("hide");
      $(".mynav").addClass("show");
    } else {
      $(".mynav").removeClass("show");
      $(".mynav").addClass("hide");
    }
  });

  //    button scnroll to top
  $(window).scroll(function () {
    if ($(this).scrollTop() > $(".more-info").offset().top) {
      $(".scroll").fadeIn(1000);
    } else {
      $(".scroll").fadeOut(100);
    }
  });
  $(".scroll").click(function () {
    $("html,body").animate(
      {
        scrollTop: 0,
      },
      2000
    );
  });
  //  end  button scroll to top

  //reset all option
  $(".res").click(function () {
    localStorage.removeItem("color-option");
    localStorage.removeItem("navbar-option");
  });

  //click on arrow on wedding page
  $(".wedding-gallery .arrow").click(function () {
    $("html,body").animate(
      {
        scrollTop: $(".couple").offset().top + 100,
      },
      900
    );
  });

  //  make function to animate h2 and p on scroll
  function showanimation(scrolldiv, firstelement, secondelemetn) {
    $(window).scroll(function () {
      if ($(window).scrollTop() >= scrolldiv - 500) {
        firstelement.addClass("myanimation");
        secondelemetn.addClass("myanimation");
      }
    });
  }

  showanimation($(".couple").offset().top, $(".couple h2"), $(".couple p"));

  showanimation(
    $(".our-date").offset().top,
    $(".our-date h2"),
    $(".our-date p")
  );

  showanimation(
    $(".place-date").offset().top,
    $(".place-date h2"),
    $(".place-date p")
  );

  showanimation(
    $(".attending").offset().top,
    $(".attending .textinfo h2"),
    $(".attending .textinfo p")
  );

  showanimation(
    $(".timeline").offset().top,
    $(".timeline .our-story h2"),
    $(".timeline .our-story p")
  );

  showanimation($(".gallery").offset().top, $(".gallery h2"), $(".gallery p"));
  showanimation(
    $(".more-info").offset().top,
    $(".more-info .container > h2"),
    $(".more-info .container > p")
  );
});
//  end make function to animate h2 and p on scroll

//add animation to timeline
$(window).scroll(function () {
  if (
    $(window).scrollTop() >=
    $(".timeline-content .leftside1").offset().top - 800
  ) {
    $(".timeline-content .leftside1").addClass("left-animation");
    $(".timeline-content .rightside1").addClass("right-animation");
  }
  if (
    $(window).scrollTop() >=
    $(".timeline-content .leftside3").offset().top - 800
  ) {
    $(".timeline-content .leftside3").addClass("left-animation");
    $(".timeline-content .rightside3").addClass("right-animation");
  }
  if (
    $(window).scrollTop() >=
    $(".timeline-content .leftside2").offset().top - 800
  ) {
    $(".timeline-content .leftside2").addClass("right-animation");
    $(".timeline-content .rightside2").addClass("left-animation");
  }
  if (
    $(window).scrollTop() >=
    $(".timeline-content .leftside4").offset().top - 800
  ) {
    $(".timeline-content .leftside4").addClass("right-animation");
    $(".timeline-content .rightside4").addClass("left-animation");
    $(".timeline-footer h2").addClass("myanimation");
  }
  if ($(window).scrollTop() >= $(".thanks").offset().top - 800) {
    $(".thanks .textinfo").addClass("myanimation");
  }
});

//popup when loading page
$(window).on("load", function () {
  $(".inner-popuo").fadeOut(2500, function () {
    $(this).parent().fadeOut(500);
    $("body").css("overflow-y", "auto");
    $(".textinfo .wedding-span").addClass("weddingicon");
    $(".wedding-gallery .textinfo h2").addClass("myanimation");
    $(".wedding-gallery .textinfo h4").addClass("myanimation");
    $('.fa-music').fadeIn();
    $('#soundcloud').attr("src","https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/80063367&color=%23ff5500&auto_play=true&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true")
  });
});

//images pop up
$(".timeline-content .search,.gallery-box .row div .search").click(function () {
  $(".popup-overlay").removeClass("hidden").addClass("show");
  $(".image-popup").removeClass("hidden").addClass("show");
  $("body").css("overflow-y", "hidden");
  $(".image-popup img").attr("src", $(this).siblings("img").attr("src"));
});

//click on overlay to hide pop up

$(".popup-overlay").click(function () {
  $(".popup-overlay").removeClass("show").addClass("hidden");
  $(".image-popup").removeClass("show").addClass("hidden");
  $("body").css("overflow-y", "auto");
});

// reload page when click on h4 in navbar
$(".brand h4").click(function () {
  window.location.reload();
});

//click in couples button to show popup
$(".ahmed").on("click", function (e) {
  e.preventDefault();
  $(".couples-popup-overlay").fadeIn(1000, function () {
    $(".couples-popup-husband").fadeIn(400);
    $("body").css("overflow-y", "hidden");
  });
});
$(".koky").on("click", function (e) {
  e.preventDefault();
  $(".couples-popup-overlay").fadeIn(1000, function () {
    $(".couples-popup-wife").fadeIn(400);
    $("body").css("overflow-y", "hidden");
  });
});
//click on overlay to hide pop up

$(".couples-popup-overlay").click(function () {
  //    $(this).removeClass('show').addClass('hidden');
  //   $('.couples-popup').removeClass('show').addClass('hidden');
  $(this).hide();
  $(".couples-popup-husband,.couples-popup-wife").hide();
  $("body").css("overflow-y", "auto");
});

// toggle music 


 // slide toogle music 
 $('.fa-music').click(function(){
   $('.player__container').slideToggle(500);
 })



 