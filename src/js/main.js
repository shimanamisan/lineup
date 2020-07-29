"use strict";

var $ = require("jquery");

$(function () {
  var $jsScrollHeader = $(".js-scroll-trigger");
  var $jsHeaderLogo = $(".js-p-header__logo");

  $(window).scroll(() => {
    if ($(window).scrollTop() >= 300) {
      //   console.log($(window).scrollTop());
      $jsScrollHeader.addClass("c-anime__scroll");
      $jsHeaderLogo.addClass("p-header__scroll");
    } else {
      $jsScrollHeader.removeClass("c-anime__scroll");
      $jsHeaderLogo.removeClass("p-header__scroll");
    }
  });

  

  console.log($(window).innerWidth())
});
