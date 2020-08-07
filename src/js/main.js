var $ = require("jquery");

$(function () {
  "use strict";
  /*******************************************
ユーザーエージェントよりスマホ端末か判定する
*********************************************/
  // 即時関数をの返り値を変数に格納（オブジェクトの形で返ってくる）
  var UserAgent = (function () {
    var phoneActive = /iPhone|iPod|iPad|Android/i.test(
      window.navigator.userAgent
    );
    var $mainVisual = $(".js-mainVisual");
    var $youtube = $(".js-youtube");

    // オブジェクトを返す
    return {
      phoneFlg: function () {
        if (phoneActive) {
          console.log('ユーザーエージェントを実行')
          $mainVisual.css({
            height: `${window.outerHeight}`,
          });
          $youtube.css({
            height: `${window.outerHeight}`,
          });
        }
      },
    };
  })();

  // オブジェクトの中の関数を実行
  UserAgent.phoneFlg();

  /****************************************
スクロールアニメーション
*****************************************/
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

  /****************************************
SPナビメニュー
*****************************************/
  var $spMenuTrigger = $("#js-spmenu-trigger");
  var $spNavTrigger = $("#js-nav-trigger");
  $spMenuTrigger.on("click", function () {
    $spMenuTrigger.toggleClass("burgerActive");
    $spNavTrigger.toggleClass("navActive");
  });

  /****************************************
youtube動画自動無限ループ
*****************************************/
  var slider = (function () {
    // 窓枠となる要素のDOMを取得
    var $sliderContainer = $(".p-slider__container");
    // レスポンシブに対応させるために、窓枠の幅を取得する（これをli要素の幅にもjs側から適応する）
    var movieItemWidth = $(".p-youtube__container").innerWidth();
    // iframe内の動画幅を調節する
    var $iframe = $(".p-youtube");
    // // スライドさせる各li要素を取得
    var $sliderItem = $(".p-slider__item");
    // スライドさせる各li要素のDOMの個数を取得
    var sliderItemNum = $sliderItem.length;

    var sliderContainerWidth = movieItemWidth * sliderItemNum;
    // 無限ループさせるために、最後尾に移動した要素分の幅を付け加える
    var sliderNextObj = {
      left: "+=" + movieItemWidth + "px",
    };
    var DURATION = 500;

    // オブジェクトを返す
    return {
      slideNext: function () {
        $sliderContainer.animate(
          { left: "-=" + movieItemWidth + "px" },
          DURATION,
          function () {
            $sliderContainer.append($(".p-slider__container li:first-child"));
            $sliderContainer.css(sliderNextObj);
          }
        );
      },
      init: function () {
        // スライドさせる大本の枠を決定している
        $sliderContainer.attr("style", "width: " + sliderContainerWidth + "px");
        // スライドさせる要素の幅を記述する
        $sliderItem.attr("style", "width: " + movieItemWidth + "px");
        // スライダーの開始位置をずらす
        $sliderContainer.css({ left: "-=" + movieItemWidth + "px" });
        // スライダーの開始位置をずらす
        $iframe.attr("style", "width: " + movieItemWidth + "px");
        // ここでthisとすることで、変数のスコープがオブジェクト自身になる
        var that = this;
        $(".js-slide-next").on("click", function () {
          that.slideNext(); //ここでthisとしてしまうと、js-slide-nextを指してしまう
        });
        $(".js-slide-prev").on("click", function () {
          that.slidePrev();
        });
      },
    };
  })();
  // オブジェクト内のメソッドを実行
  slider.init();

});
