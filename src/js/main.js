"use strict";

var $ = require("jquery");

$(function () {
  // スクロールアニメーション
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
youtube動画自動無限ループ
*****************************************/

  var loopSlider = (function () {
    // 窓枠となる要素のDOMを取得
    var $sliderContainer = $(".p-slider__container");
    // スライドさせる各li要素のDOMの個数を取得
    var sliderItemNum = $(".p-slider__item").length;
    // li要素の幅を取得する
    var sliderItemWidth = $(".p-slider__item").innerWidth();
    //
    var sliderContainerWidth = sliderItemWidth * sliderItemNum;
    //
    const DURATION = 6000;

    // オブジェクトを返す
    return {
      sliderLoop: function () {
        // 関数の中からでもthisの参照先を、sliderLoopというオブジェクト自身に指定出来るようにthisを変数に格納
        var that = this;
        console.log(that)
        $sliderContainer.animate(
          {
            left: "-=" + sliderItemWidth + "px",
          },
          DURATION,
          "linear",
          function () {
            // append：指定した子要素の最後にHTML要素やテキスト文字を移動させる
            $sliderContainer.append($("li:first-childe"));
            $sliderContainer.css({
              left: "+=" + sliderItemWidth + "px",
            });
          }
        );
        // ループさせる
        setTimeout(function () {
          that.sliderLoop();
        }, 6000);
      },
      init: function () {
        // 関数の中からでもthisの参照先を、initというオブジェクト自身に指定出来るようにthisを変数に格納
        var that = this;
        // スライドさせる大枠の幅を決定する
        // attrメソッド：指定した要素に属性を追加する（今回はstyle属性をjQuery側から書き込んでいる）
        $sliderContainer.attr("style", "width: " + sliderContainerWidth + "px");
        // オブジェクト内の関数を呼び出す
        that.sliderLoop();
      },
    };
  })();

  // オブジェクト内のメソッドを実行
  loopSlider.init();

  // console.log(loopSlider);
});
