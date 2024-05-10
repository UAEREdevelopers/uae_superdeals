/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/theme/js/main.js":
/*!************************************!*\
  !*** ./resources/theme/js/main.js ***!
  \************************************/
/***/ (() => {

(function ($) {
  "use strict";

  $(window).on('load', function () {
    $('[data-loader="circle-side"]').fadeOut(); // will first fade out the loading animation

    $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.

    $('body').delay(350);
    $('.hero_in h1,.hero_in form').addClass('animated');
    $('.hero_single, .hero_in').addClass('start_bg_zoom');
    $(window).scroll();
  }); // Sticky nav

  $(window).on('scroll', function () {
    if ($(this).scrollTop() > 1) {
      $('.header').addClass("sticky");
    } else {
      $('.header').removeClass("sticky");
    }
  }); // news flash section
  //Scroll to top

  $(window).on('scroll', function () {
    'use strict';

    if ($(this).scrollTop() != 0) {
      // hide the news flash section
      $('.scroll-left').hide();
      $(".header").css("top", "0px");
    } else {
      // show the news flash section
      $('.scroll-left').show(); // ***** Make top 50px to show news flash without overlapping the logo
      // $(".header").css("top", "50px"); 

      $(".header").css("top", "0px");
    }
  }); // Sticky sidebar

  $('#sidebar').theiaStickySidebar({
    additionalMarginTop: 150
  }); // Sticky titles

  $('.fixed_title').theiaStickySidebar({
    additionalMarginTop: 180
  }); // Mobile Mmenu

  var $menu = $("nav#menu").mmenu({
    "extensions": ["pagedim-black"],
    counters: true,
    keyboardNavigation: {
      enable: true,
      enhance: true
    },
    navbar: {
      title: 'MENU'
    },
    navbars: [{
      position: 'bottom',
      content: ['<a href="/">© Superdeals</a>']
    }]
  }, {
    // configuration
    clone: true,
    classNames: {
      fixedElements: {
        fixed: "menu_fixed",
        sticky: "sticky"
      }
    }
  });
  var $icon = $("#hamburger");
  var API = $menu.data("mmenu");
  $icon.on("click", function () {
    API.open();
  });
  API.bind("open:finish", function () {
    setTimeout(function () {
      $icon.addClass("is-active");
    }, 100);
  });
  API.bind("close:finish", function () {
    setTimeout(function () {
      $icon.removeClass("is-active");
    }, 100);
  }); // WoW - animation on scroll

  var wow = new WOW({
    boxClass: 'wow',
    // animated element css class (default is wow)
    animateClass: 'animated',
    // animation css class (default is animated)
    offset: 0,
    // distance to the element when triggering the animation (default is 0)
    mobile: true,
    // trigger animations on mobile devices (default is true)
    live: true,
    // act on asynchronously loaded content (default is true)
    callback: function callback(box) {// the callback is fired every time an animation is started
      // the argument that is passed in is the DOM node being animated
    },
    scrollContainer: null // optional scroll container selector, otherwise use window

  });
  wow.init(); //  Video popups

  $('.video').magnificPopup({
    type: 'iframe'
  });
  /* video modal*/
  // Image popups

  $('.magnific-gallery').each(function () {
    $(this).magnificPopup({
      delegate: 'a',
      type: 'image',
      preloader: true,
      gallery: {
        enabled: true
      },
      removalDelay: 500,
      //delay removal by X to allow out-animation
      callbacks: {
        beforeOpen: function beforeOpen() {
          // just a hack that adds mfp-anim class to markup 
          this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
          this.st.mainClass = this.st.el.attr('data-effect');
        }
      },
      closeOnContentClick: true,
      midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.

    });
  }); // Modal Sign In in Register

  $('#sign-in-2').magnificPopup({
    type: 'inline',
    fixedContentPos: true,
    fixedBgPos: true,
    overflowY: 'auto',
    closeBtnInside: true,
    preloader: false,
    midClick: true,
    removalDelay: 300,
    closeMarkup: '<button title="%title%" type="button" class="mfp-close"></button>',
    mainClass: 'my-mfp-zoom-in'
  }); // Modal Sign In

  $('#sign-in').magnificPopup({
    type: 'inline',
    fixedContentPos: true,
    fixedBgPos: true,
    overflowY: 'auto',
    closeBtnInside: true,
    preloader: false,
    midClick: true,
    removalDelay: 300,
    closeMarkup: '<button title="%title%" type="button" class="mfp-close"></button>',
    mainClass: 'my-mfp-zoom-in'
  }); // Modal Register

  $('#register').magnificPopup({
    type: 'inline',
    fixedContentPos: true,
    fixedBgPos: true,
    overflowY: 'auto',
    closeBtnInside: true,
    preloader: false,
    midClick: true,
    removalDelay: 300,
    closeMarkup: '<button title="%title%" type="button" class="mfp-close"></button>',
    mainClass: 'my-mfp-zoom-in'
  }); // Modal generic

  $('#modal').magnificPopup({
    type: 'inline',
    fixedContentPos: true,
    fixedBgPos: true,
    overflowY: 'auto',
    closeBtnInside: true,
    preloader: false,
    midClick: true,
    removalDelay: 300,
    closeMarkup: '<button title="%title%" type="button" class="mfp-close"></button>',
    mainClass: 'my-mfp-zoom-in'
  }); // Show Password

  $('#password').hidePassword('focus', {
    toggle: {
      className: 'my-toggle'
    }
  }); // Forgot Password

  $("#forgot").click(function () {
    $("#forgot_pw").fadeToggle("fast");
  }); // Accordion

  function toggleChevron(e) {
    $(e.target).prev('.card-header').find("i.indicator").toggleClass('ti-minus ti-plus');
  }

  $('.accordion_2').on('hidden.bs.collapse shown.bs.collapse', toggleChevron);

  function toggleIcon(e) {
    $(e.target).prev('.panel-heading').find(".indicator").toggleClass('ti-minus ti-plus');
  } // Jquery select
  // $('.custom-search-input-2 select, .custom-select-form select').niceSelect();
  // Atltenative checkbox styles - Switchery


  var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
  elems.forEach(function (html) {
    var switchery = new Switchery(html, {
      size: 'small'
    });
  }); // Like Icon

  $('.wish_bt').on('click', function (e) {
    e.preventDefault();
    $(this).toggleClass('liked');
  }); // Collapse filters

  $(window).bind('load resize', function () {
    var width = $(window).width();

    if ($(this).width() < 991) {
      $('.collapse#collapseFilters').removeClass('show');
    } else {
      $('.collapse#collapseFilters').addClass('show');
    }

    ;
  }); //Scroll to top

  $(window).on('scroll', function () {
    'use strict';

    if ($(this).scrollTop() != 0) {
      $('#toTop').fadeIn();
    } else {
      $('#toTop').fadeOut();
    }
  });
  $('#toTop').on('click', function () {
    $('body,html').animate({
      scrollTop: 0
    }, 500);
  }); // Carousels

  $('#carousel').owlCarousel({
    center: true,
    items: 2,
    loop: false,
    rewind: true,
    margin: 10,
    responsive: {
      0: {
        items: 1,
        dots: false
      },
      600: {
        items: 2
      },
      1000: {
        items: 4
      }
    }
  });
  $('#reccomended').owlCarousel({
    // center: true,
    // items: 2,
    // loop: true,
    // margin: 0,
    stagePadding: 10,
    loop: false,
    rewind: true,
    margin: 0,
    pagination: false,
    responsive: {
      0: {
        items: 1
      },
      767: {
        items: 2
      },
      1000: {
        items: 3
      },
      1400: {
        items: 4
      }
    }
  });
  $('#special-tours-section').owlCarousel({
    // center: true,
    // items: 2,
    // loop: true,
    // margin: 0,
    stagePadding: 10,
    loop: false,
    rewind: true,
    margin: 0,
    responsive: {
      0: {
        items: 1
      },
      767: {
        items: 2
      },
      1000: {
        items: 3
      },
      1400: {
        items: 3
      }
    }
  });
  $('#reccomended_adventure').owlCarousel({
    center: false,
    items: 2,
    loop: false,
    margin: 15,
    responsive: {
      0: {
        items: 1
      },
      767: {
        items: 3
      },
      1000: {
        items: 4
      },
      1400: {
        items: 5
      }
    }
  }); // Sticky filters

  $(window).bind('load resize', function () {
    var width = $(window).width();

    if (width <= 991) {
      $('.sticky_horizontal').stick_in_parent({
        bottoming: false,
        offset_top: 50
      });
    } else {
      $('.sticky_horizontal').stick_in_parent({
        bottoming: false,
        offset_top: 67
      });
    }
  }); // Opacity mask

  $('.opacity-mask').each(function () {
    $(this).css('background-color', $(this).attr('data-opacity-mask'));
  }); // Aside panel

  $(".aside-panel-bt").on("click", function () {
    $("#panel_dates").toggleClass("show");
    $(".layer").toggleClass("layer-is-visible");
  }); // Show more button

  $(".content_more").hide();
  $(".show_hide").on("click", function () {
    var txt = $(".content_more").is(':visible') ? 'Read More' : 'Read Less';
    $(this).text(txt);
    $(this).prev('.content_more').slideToggle(200);
  }); // Secondary nav scroll

  var $sticky_nav = $('.secondary_nav');
  $sticky_nav.find('a').on('click', function (e) {
    e.preventDefault();
    var target = this.hash;
    var $target = $(target);
    $('html, body').animate({
      'scrollTop': $target.offset().top - 140
    }, 800, 'swing');
  });
  $sticky_nav.find('ul li a').on('click', function () {
    $sticky_nav.find('ul li a.active').removeClass('active');
    $(this).addClass('active');
  }); // Faq section

  $('#faq_box a[href^="#"]').on('click', function () {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');

      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top - 185
        }, 800);
        return false;
      }
    }
  });
  $('ul#cat_nav li a').on('click', function () {
    $('ul#cat_nav li a.active').removeClass('active');
    $(this).addClass('active');
  }); // Button show/hide map

  $(".btn_map, .btn_map_in").on("click", function () {
    var el = $(this);
    el.text() == el.data("text-swap") ? el.text(el.data("text-original")) : el.text(el.data("text-swap"));
    $('html, body').animate({
      scrollTop: $("body").offset().top + 385
    }, 600);
  }); // Panel Dropdown

  function close_panel_dropdown() {
    $('.panel-dropdown').removeClass("active");
  }

  $('.panel-dropdown a').on('click', function (e) {
    if ($(this).parent().is(".active")) {
      close_panel_dropdown();
    } else {
      close_panel_dropdown();
      $(this).parent().addClass('active');
    }

    e.preventDefault();
  }); // Closes dropdown on click outside the conatainer

  var mouse_is_inside = false;
  $('.panel-dropdown').hover(function () {
    mouse_is_inside = true;
  }, function () {
    mouse_is_inside = false;
  });
  $("body").mouseup(function () {
    if (!mouse_is_inside) close_panel_dropdown();
  });
  /* Dropdown user logged */

  $('.dropdown-user').hover(function () {
    $(this).find('.dropdown-menu').stop(true, true).delay(50).fadeIn(300);
  }, function () {
    $(this).find('.dropdown-menu').stop(true, true).delay(50).fadeOut(300);
  }); // Search half screen map

  $('a.search_map').on('click', function () {
    $('.search_map_wp').slideToggle("fast");
  }); // Range slider half screen map

  $('input[type="range"]').rangeslider({
    polyfill: false,
    onInit: function onInit() {
      this.output = $(".distance span").html(this.$element.val());
    },
    onSlide: function onSlide(position, value) {
      this.output.html(value);
    }
  }); // Range DatePicker scroll fix

  $(function () {
    $(window).bind("resize", function () {
      if ($(this).width() < 768) {
        $('.input-dates').removeClass('scroll-fix');
      } else {
        $('.input-dates').addClass('scroll-fix');
      }
    }).trigger('resize');
  }); // Header button explore

  $('a[href^="#"].btn_explore').on('click', function (e) {
    e.preventDefault();
    var target = this.hash;
    var $target = $(target);
    $('html, body').stop().animate({
      'scrollTop': $target.offset().top - 50
    }, 300, 'swing', function () {
      window.location.hash = target;
    });
  }); // Menu hover effect

  $(".main-menu > ul > li").hover(function () {
    $(this).siblings().stop().fadeTo(300, 0.6);
    $(this).parent().siblings().stop().fadeTo(300, 0.3);
  }, function () {
    // Mouse out
    $(this).siblings().stop().fadeTo(300, 1);
    $(this).parent().siblings().stop().fadeTo(300, 1);
  });
})(window.jQuery);

/***/ }),

/***/ "./resources/theme/js/typed.min.js":
/*!*****************************************!*\
  !*** ./resources/theme/js/typed.min.js ***!
  \*****************************************/
/***/ (function(module, exports, __webpack_require__) {

/* module decorator */ module = __webpack_require__.nmd(module);
var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

/*!
 * 
 *   typed.js - A JavaScript Typing Animation Library
 *   Author: Matt Boldt <me@mattboldt.com>
 *   Version: v2.0.11
 *   Url: https://github.com/mattboldt/typed.js
 *   License(s): MIT
 * 
 */
(function (t, e) {
  "object" == ( false ? 0 : _typeof(exports)) && "object" == ( false ? 0 : _typeof(module)) ? module.exports = e() :  true ? !(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_FACTORY__ = (e),
		__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
		(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)) : 0;
})(this, function () {
  return function (t) {
    function e(n) {
      if (s[n]) return s[n].exports;
      var i = s[n] = {
        exports: {},
        id: n,
        loaded: !1
      };
      return t[n].call(i.exports, i, i.exports, e), i.loaded = !0, i.exports;
    }

    var s = {};
    return e.m = t, e.c = s, e.p = "", e(0);
  }([function (t, e, s) {
    "use strict";

    function n(t, e) {
      if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function");
    }

    Object.defineProperty(e, "__esModule", {
      value: !0
    });

    var i = function () {
      function t(t, e) {
        for (var s = 0; s < e.length; s++) {
          var n = e[s];
          n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(t, n.key, n);
        }
      }

      return function (e, s, n) {
        return s && t(e.prototype, s), n && t(e, n), e;
      };
    }(),
        r = s(1),
        o = s(3),
        a = function () {
      function t(e, s) {
        n(this, t), r.initializer.load(this, s, e), this.begin();
      }

      return i(t, [{
        key: "toggle",
        value: function value() {
          this.pause.status ? this.start() : this.stop();
        }
      }, {
        key: "stop",
        value: function value() {
          this.typingComplete || this.pause.status || (this.toggleBlinking(!0), this.pause.status = !0, this.options.onStop(this.arrayPos, this));
        }
      }, {
        key: "start",
        value: function value() {
          this.typingComplete || this.pause.status && (this.pause.status = !1, this.pause.typewrite ? this.typewrite(this.pause.curString, this.pause.curStrPos) : this.backspace(this.pause.curString, this.pause.curStrPos), this.options.onStart(this.arrayPos, this));
        }
      }, {
        key: "destroy",
        value: function value() {
          this.reset(!1), this.options.onDestroy(this);
        }
      }, {
        key: "reset",
        value: function value() {
          var t = arguments.length <= 0 || void 0 === arguments[0] || arguments[0];
          clearInterval(this.timeout), this.replaceText(""), this.cursor && this.cursor.parentNode && (this.cursor.parentNode.removeChild(this.cursor), this.cursor = null), this.strPos = 0, this.arrayPos = 0, this.curLoop = 0, t && (this.insertCursor(), this.options.onReset(this), this.begin());
        }
      }, {
        key: "begin",
        value: function value() {
          var t = this;
          this.options.onBegin(this), this.typingComplete = !1, this.shuffleStringsIfNeeded(this), this.insertCursor(), this.bindInputFocusEvents && this.bindFocusEvents(), this.timeout = setTimeout(function () {
            t.currentElContent && 0 !== t.currentElContent.length ? t.backspace(t.currentElContent, t.currentElContent.length) : t.typewrite(t.strings[t.sequence[t.arrayPos]], t.strPos);
          }, this.startDelay);
        }
      }, {
        key: "typewrite",
        value: function value(t, e) {
          var s = this;
          this.fadeOut && this.el.classList.contains(this.fadeOutClass) && (this.el.classList.remove(this.fadeOutClass), this.cursor && this.cursor.classList.remove(this.fadeOutClass));
          var n = this.humanizer(this.typeSpeed),
              i = 1;
          return this.pause.status === !0 ? void this.setPauseStatus(t, e, !0) : void (this.timeout = setTimeout(function () {
            e = o.htmlParser.typeHtmlChars(t, e, s);
            var n = 0,
                r = t.substr(e);

            if ("^" === r.charAt(0) && /^\^\d+/.test(r)) {
              var a = 1;
              r = /\d+/.exec(r)[0], a += r.length, n = parseInt(r), s.temporaryPause = !0, s.options.onTypingPaused(s.arrayPos, s), t = t.substring(0, e) + t.substring(e + a), s.toggleBlinking(!0);
            }

            if ("`" === r.charAt(0)) {
              for (; "`" !== t.substr(e + i).charAt(0) && (i++, !(e + i > t.length));) {
                ;
              }

              var u = t.substring(0, e),
                  l = t.substring(u.length + 1, e + i),
                  c = t.substring(e + i + 1);
              t = u + l + c, i--;
            }

            s.timeout = setTimeout(function () {
              s.toggleBlinking(!1), e >= t.length ? s.doneTyping(t, e) : s.keepTyping(t, e, i), s.temporaryPause && (s.temporaryPause = !1, s.options.onTypingResumed(s.arrayPos, s));
            }, n);
          }, n));
        }
      }, {
        key: "keepTyping",
        value: function value(t, e, s) {
          0 === e && (this.toggleBlinking(!1), this.options.preStringTyped(this.arrayPos, this)), e += s;
          var n = t.substr(0, e);
          this.replaceText(n), this.typewrite(t, e);
        }
      }, {
        key: "doneTyping",
        value: function value(t, e) {
          var s = this;
          this.options.onStringTyped(this.arrayPos, this), this.toggleBlinking(!0), this.arrayPos === this.strings.length - 1 && (this.complete(), this.loop === !1 || this.curLoop === this.loopCount) || (this.timeout = setTimeout(function () {
            s.backspace(t, e);
          }, this.backDelay));
        }
      }, {
        key: "backspace",
        value: function value(t, e) {
          var s = this;
          if (this.pause.status === !0) return void this.setPauseStatus(t, e, !0);
          if (this.fadeOut) return this.initFadeOut();
          this.toggleBlinking(!1);
          var n = this.humanizer(this.backSpeed);
          this.timeout = setTimeout(function () {
            e = o.htmlParser.backSpaceHtmlChars(t, e, s);
            var n = t.substr(0, e);

            if (s.replaceText(n), s.smartBackspace) {
              var i = s.strings[s.arrayPos + 1];
              i && n === i.substr(0, e) ? s.stopNum = e : s.stopNum = 0;
            }

            e > s.stopNum ? (e--, s.backspace(t, e)) : e <= s.stopNum && (s.arrayPos++, s.arrayPos === s.strings.length ? (s.arrayPos = 0, s.options.onLastStringBackspaced(), s.shuffleStringsIfNeeded(), s.begin()) : s.typewrite(s.strings[s.sequence[s.arrayPos]], e));
          }, n);
        }
      }, {
        key: "complete",
        value: function value() {
          this.options.onComplete(this), this.loop ? this.curLoop++ : this.typingComplete = !0;
        }
      }, {
        key: "setPauseStatus",
        value: function value(t, e, s) {
          this.pause.typewrite = s, this.pause.curString = t, this.pause.curStrPos = e;
        }
      }, {
        key: "toggleBlinking",
        value: function value(t) {
          this.cursor && (this.pause.status || this.cursorBlinking !== t && (this.cursorBlinking = t, t ? this.cursor.classList.add("typed-cursor--blink") : this.cursor.classList.remove("typed-cursor--blink")));
        }
      }, {
        key: "humanizer",
        value: function value(t) {
          return Math.round(Math.random() * t / 2) + t;
        }
      }, {
        key: "shuffleStringsIfNeeded",
        value: function value() {
          this.shuffle && (this.sequence = this.sequence.sort(function () {
            return Math.random() - .5;
          }));
        }
      }, {
        key: "initFadeOut",
        value: function value() {
          var t = this;
          return this.el.className += " " + this.fadeOutClass, this.cursor && (this.cursor.className += " " + this.fadeOutClass), setTimeout(function () {
            t.arrayPos++, t.replaceText(""), t.strings.length > t.arrayPos ? t.typewrite(t.strings[t.sequence[t.arrayPos]], 0) : (t.typewrite(t.strings[0], 0), t.arrayPos = 0);
          }, this.fadeOutDelay);
        }
      }, {
        key: "replaceText",
        value: function value(t) {
          this.attr ? this.el.setAttribute(this.attr, t) : this.isInput ? this.el.value = t : "html" === this.contentType ? this.el.innerHTML = t : this.el.textContent = t;
        }
      }, {
        key: "bindFocusEvents",
        value: function value() {
          var t = this;
          this.isInput && (this.el.addEventListener("focus", function (e) {
            t.stop();
          }), this.el.addEventListener("blur", function (e) {
            t.el.value && 0 !== t.el.value.length || t.start();
          }));
        }
      }, {
        key: "insertCursor",
        value: function value() {
          this.showCursor && (this.cursor || (this.cursor = document.createElement("span"), this.cursor.className = "typed-cursor", this.cursor.innerHTML = this.cursorChar, this.el.parentNode && this.el.parentNode.insertBefore(this.cursor, this.el.nextSibling)));
        }
      }]), t;
    }();

    e["default"] = a, t.exports = e["default"];
  }, function (t, e, s) {
    "use strict";

    function n(t) {
      return t && t.__esModule ? t : {
        "default": t
      };
    }

    function i(t, e) {
      if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function");
    }

    Object.defineProperty(e, "__esModule", {
      value: !0
    });

    var r = Object.assign || function (t) {
      for (var e = 1; e < arguments.length; e++) {
        var s = arguments[e];

        for (var n in s) {
          Object.prototype.hasOwnProperty.call(s, n) && (t[n] = s[n]);
        }
      }

      return t;
    },
        o = function () {
      function t(t, e) {
        for (var s = 0; s < e.length; s++) {
          var n = e[s];
          n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(t, n.key, n);
        }
      }

      return function (e, s, n) {
        return s && t(e.prototype, s), n && t(e, n), e;
      };
    }(),
        a = s(2),
        u = n(a),
        l = function () {
      function t() {
        i(this, t);
      }

      return o(t, [{
        key: "load",
        value: function value(t, e, s) {
          if ("string" == typeof s ? t.el = document.querySelector(s) : t.el = s, t.options = r({}, u["default"], e), t.isInput = "input" === t.el.tagName.toLowerCase(), t.attr = t.options.attr, t.bindInputFocusEvents = t.options.bindInputFocusEvents, t.showCursor = !t.isInput && t.options.showCursor, t.cursorChar = t.options.cursorChar, t.cursorBlinking = !0, t.elContent = t.attr ? t.el.getAttribute(t.attr) : t.el.textContent, t.contentType = t.options.contentType, t.typeSpeed = t.options.typeSpeed, t.startDelay = t.options.startDelay, t.backSpeed = t.options.backSpeed, t.smartBackspace = t.options.smartBackspace, t.backDelay = t.options.backDelay, t.fadeOut = t.options.fadeOut, t.fadeOutClass = t.options.fadeOutClass, t.fadeOutDelay = t.options.fadeOutDelay, t.isPaused = !1, t.strings = t.options.strings.map(function (t) {
            return t.trim();
          }), "string" == typeof t.options.stringsElement ? t.stringsElement = document.querySelector(t.options.stringsElement) : t.stringsElement = t.options.stringsElement, t.stringsElement) {
            t.strings = [], t.stringsElement.style.display = "none";
            var n = Array.prototype.slice.apply(t.stringsElement.children),
                i = n.length;
            if (i) for (var o = 0; o < i; o += 1) {
              var a = n[o];
              t.strings.push(a.innerHTML.trim());
            }
          }

          t.strPos = 0, t.arrayPos = 0, t.stopNum = 0, t.loop = t.options.loop, t.loopCount = t.options.loopCount, t.curLoop = 0, t.shuffle = t.options.shuffle, t.sequence = [], t.pause = {
            status: !1,
            typewrite: !0,
            curString: "",
            curStrPos: 0
          }, t.typingComplete = !1;

          for (var o in t.strings) {
            t.sequence[o] = o;
          }

          t.currentElContent = this.getCurrentElContent(t), t.autoInsertCss = t.options.autoInsertCss, this.appendAnimationCss(t);
        }
      }, {
        key: "getCurrentElContent",
        value: function value(t) {
          var e = "";
          return e = t.attr ? t.el.getAttribute(t.attr) : t.isInput ? t.el.value : "html" === t.contentType ? t.el.innerHTML : t.el.textContent;
        }
      }, {
        key: "appendAnimationCss",
        value: function value(t) {
          var e = "data-typed-js-css";

          if (t.autoInsertCss && (t.showCursor || t.fadeOut) && !document.querySelector("[" + e + "]")) {
            var s = document.createElement("style");
            s.type = "text/css", s.setAttribute(e, !0);
            var n = "";
            t.showCursor && (n += "\n        .typed-cursor{\n          opacity: 1;\n        }\n        .typed-cursor.typed-cursor--blink{\n          animation: typedjsBlink 0.7s infinite;\n          -webkit-animation: typedjsBlink 0.7s infinite;\n                  animation: typedjsBlink 0.7s infinite;\n        }\n        @keyframes typedjsBlink{\n          50% { opacity: 0.0; }\n        }\n        @-webkit-keyframes typedjsBlink{\n          0% { opacity: 1; }\n          50% { opacity: 0.0; }\n          100% { opacity: 1; }\n        }\n      "), t.fadeOut && (n += "\n        .typed-fade-out{\n          opacity: 0;\n          transition: opacity .25s;\n        }\n        .typed-cursor.typed-cursor--blink.typed-fade-out{\n          -webkit-animation: 0;\n          animation: 0;\n        }\n      "), 0 !== s.length && (s.innerHTML = n, document.body.appendChild(s));
          }
        }
      }]), t;
    }();

    e["default"] = l;
    var c = new l();
    e.initializer = c;
  }, function (t, e) {
    "use strict";

    Object.defineProperty(e, "__esModule", {
      value: !0
    });
    var s = {
      strings: ["These are the default values...", "You know what you should do?", "Use your own!", "Have a great day!"],
      stringsElement: null,
      typeSpeed: 0,
      startDelay: 0,
      backSpeed: 0,
      smartBackspace: !0,
      shuffle: !1,
      backDelay: 700,
      fadeOut: !1,
      fadeOutClass: "typed-fade-out",
      fadeOutDelay: 500,
      loop: !1,
      loopCount: 1 / 0,
      showCursor: !0,
      cursorChar: "|",
      autoInsertCss: !0,
      attr: null,
      bindInputFocusEvents: !1,
      contentType: "html",
      onBegin: function onBegin(t) {},
      onComplete: function onComplete(t) {},
      preStringTyped: function preStringTyped(t, e) {},
      onStringTyped: function onStringTyped(t, e) {},
      onLastStringBackspaced: function onLastStringBackspaced(t) {},
      onTypingPaused: function onTypingPaused(t, e) {},
      onTypingResumed: function onTypingResumed(t, e) {},
      onReset: function onReset(t) {},
      onStop: function onStop(t, e) {},
      onStart: function onStart(t, e) {},
      onDestroy: function onDestroy(t) {}
    };
    e["default"] = s, t.exports = e["default"];
  }, function (t, e) {
    "use strict";

    function s(t, e) {
      if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function");
    }

    Object.defineProperty(e, "__esModule", {
      value: !0
    });

    var n = function () {
      function t(t, e) {
        for (var s = 0; s < e.length; s++) {
          var n = e[s];
          n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(t, n.key, n);
        }
      }

      return function (e, s, n) {
        return s && t(e.prototype, s), n && t(e, n), e;
      };
    }(),
        i = function () {
      function t() {
        s(this, t);
      }

      return n(t, [{
        key: "typeHtmlChars",
        value: function value(t, e, s) {
          if ("html" !== s.contentType) return e;
          var n = t.substr(e).charAt(0);

          if ("<" === n || "&" === n) {
            var i = "";

            for (i = "<" === n ? ">" : ";"; t.substr(e + 1).charAt(0) !== i && (e++, !(e + 1 > t.length));) {
              ;
            }

            e++;
          }

          return e;
        }
      }, {
        key: "backSpaceHtmlChars",
        value: function value(t, e, s) {
          if ("html" !== s.contentType) return e;
          var n = t.substr(e).charAt(0);

          if (">" === n || ";" === n) {
            var i = "";

            for (i = ">" === n ? "<" : "&"; t.substr(e - 1).charAt(0) !== i && (e--, !(e < 0));) {
              ;
            }

            e--;
          }

          return e;
        }
      }]), t;
    }();

    e["default"] = i;
    var r = new i();
    e.htmlParser = r;
  }]);
});

/***/ }),

/***/ "./resources/theme/js/validate.js":
/*!****************************************!*\
  !*** ./resources/theme/js/validate.js ***!
  \****************************************/
/***/ (() => {

/* <![CDATA[ */
/// Jquery validate newsletter
jQuery(document).ready(function () {
  $('#newsletter_form').submit(function () {
    var action = $(this).attr('action');
    $("#message-newsletter").slideUp(750, function () {
      $('#message-newsletter').hide();
      $('#submit-newsletter').after('<i class="icon-spin4 animate-spin loader"></i>').attr('disabled', 'disabled');
      $.post(action, {
        email: $('#email_newsletter').val(),
        "_token": $('#newsletter_token').val()
      }, function (data) {
        document.getElementById('message-newsletter').innerHTML = data;
        $('#message-newsletter').slideDown('slow');
        $('#newsletter_form .loader').fadeOut('slow', function () {
          $(this).remove();
        });
        $('#submit-newsletter').removeAttr('disabled');
        if (data.match('success') != null) $('#newsletter_form').slideUp('slow');
      });
    });
    return false;
  });
}); // Jquery validate form contact

$('#contactform').submit(function () {
  var action = $(this).attr('action');
  $("#message-contact").slideUp(750, function () {
    $('#message-contact').hide();
    $('#submit-contact').after('<i class="icon-spin4 animate-spin loader"></i>').attr('disabled', 'disabled');
    $.post(action, {
      name_contact: $('#name_contact').val(),
      lastname_contact: $('#lastname_contact').val(),
      email_contact: $('#email_contact').val(),
      phone_contact: $('#phone_contact').val(),
      message_contact: $('#message_contact').val(),
      verify_contact: $('#verify_contact').val()
    }, function (data) {
      document.getElementById('message-contact').innerHTML = data;
      $('#message-contact').slideDown('slow');
      $('#contactform .loader').fadeOut('slow', function () {
        $(this).remove();
      });
      $('#submit-contact').removeAttr('disabled');
      if (data.match('success') != null) $('#contactform').slideUp('slow');
    });
  });
  return false;
}); /// Jquery validate contact form detail page

$('#contact_detail').submit(function () {
  var action = $(this).attr('action');
  $("#message-contact-detail").slideUp(750, function () {
    $('#message-contact-detail').hide();
    $('#submit-contact-detail').after('<i class="icon-spin4 animate-spin loader"></i>').attr('disabled', 'disabled');
    $.post(action, {
      name_detail: $('#name_detail').val(),
      email_detail: $('#email_detail').val(),
      message_detail: $('#message_detail').val(),
      verify_contact_detail: $('#verify_contact_detail').val()
    }, function (data) {
      document.getElementById('message-contact-detail').innerHTML = data;
      $('#message-contact-detail').slideDown('slow');
      $('#contact_detail .loader').fadeOut('slow', function () {
        $(this).remove();
      });
      $('#submit-contact-detail').removeAttr('disabled');
      if (data.match('success') != null) $('#contact_detail').slideUp('slow');
    });
  });
  return false;
});
/* ]]> */

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			id: moduleId,
/******/ 			loaded: false,
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/node module decorator */
/******/ 	(() => {
/******/ 		__webpack_require__.nmd = (module) => {
/******/ 			module.paths = [];
/******/ 			if (!module.children) module.children = [];
/******/ 			return module;
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	__webpack_require__("./resources/theme/js/main.js");
/******/ 	__webpack_require__("./resources/theme/js/validate.js");
/******/ 	// This entry module is referenced by other modules so it can't be inlined
/******/ 	var __webpack_exports__ = __webpack_require__("./resources/theme/js/typed.min.js");
/******/ 	
/******/ })()
;