let $ = require("jquery");

$(function () {
  "use strict";
  /*******************************************
ユーザーエージェントよりスマホ端末か判定する
*********************************************/
  // 即時関数をの返り値を変数に格納（オブジェクトの形で返ってくる）
  let UserAgent = (function () {
    let phoneActive = /iPhone|iPod|iPad|Android/i.test(window.navigator.userAgent);
    let $mainVisual = $(".js-mainVisual");
    let $youtube = $(".js-youtube");

    // オブジェクトを返す
    return {
      phoneFlg: function () {
        if (phoneActive) {
          console.log("ユーザーエージェントを実行");
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
ローディングアニメーションに制御
*****************************************/
  let $jsLoader = $("#js-loader");
  // 読み込みが完了したら、コールバックの処理を実行する
  $(window).on("load", function () {
    $jsLoader.toggleClass('c-loading__open')
  });

  /****************************************
フッターをを固定する
*****************************************/
  let $ftr = $("#footer");
  console.log($ftr.offset());
  console.log($ftr.offset().top);
  console.log($ftr.outerHeight());
  console.log(window.innerHeight);
  if (window.innerHeight > $ftr.offset().top + $ftr.outerHeight()) {
    $ftr.attr({
      style: "position:fixed; top:" + (window.innerHeight - $ftr.outerHeight()) + "px; width: 100%;",
    });
  }

  /****************************************
スクロールアニメーション
*****************************************/
  let $jsScrollHeader = $(".js-scroll-trigger");
  let $jsHeaderLogo = $(".js-p-header__logo");

  $(window).scroll(() => {
    if ($(window).scrollTop() >= 250) {
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
  let $spitem = $(".p-header__item");
  let $spMenuTrigger = $("#js-spmenu-trigger");
  let $spNavTrigger = $("#js-nav-trigger");

  $spMenuTrigger.on("click", function () {
    $spMenuTrigger.toggleClass("burgerActive");
    $spNavTrigger.toggleClass("navActive");
    $spitem.toggleClass("c-anime__fadeIn");
  });

  /****************************************
youtube動画自動無限ループ
*****************************************/
  let slider = (function () {
    // 窓枠となる要素のDOMを取得
    let $sliderContainer = $(".p-slider__container");
    // レスポンシブに対応させるために、窓枠の幅を取得する（これをli要素の幅にもjs側から適応する）
    let movieItemWidth = $(".p-youtube__container").innerWidth();
    // iframe内の動画幅を調節する
    let $iframe = $(".p-youtube");
    // スライドさせる各li要素を取得
    let $sliderItem = $(".p-slider__item");
    // スライドさせる各li要素のDOMの個数を取得
    let sliderItemNum = $sliderItem.length;

    let sliderContainerWidth = movieItemWidth * sliderItemNum;
    // 無限ループさせるために、移動した要素分の幅を加える
    let sliderNextObj = {
      left: "+=" + movieItemWidth + "px",
    };
    let sliderPrevObj = {
      left: "-=" + movieItemWidth + "px",
    };
    let DURATION = 500;

    // オブジェクトを返す

    return {
      slideNext: function () {
        $sliderContainer.animate({ left: "-=" + movieItemWidth + "px" }, DURATION, function () {
          // アニメーション完了時、先頭の要素を最後尾に移動する
          $sliderContainer.append($(".p-slider__container li:first-child"));
          $sliderContainer.css(sliderNextObj);
        });
      },
      slidePrev: function () {
        $sliderContainer.animate({ left: "+=" + movieItemWidth + "px" }, DURATION, function () {
          // アニメーション完了時、最後尾の要素を先頭に持ってくる
          $sliderContainer.prepend($(".p-slider__container li:last-child"));
          $sliderContainer.css(sliderPrevObj);
        });
      },
      init: function () {
        // スライドさせる大本の枠を決定している
        $sliderContainer.attr("style", "width: " + sliderContainerWidth + "px");
        // スライドさせる要素の幅を記述する
        $sliderItem.attr("style", "width: " + movieItemWidth + "px");
        // スライダーの開始位置をずらす
        $sliderContainer.css({ left: "-=" + movieItemWidth * 2 + "px" });
        // スライダーの開始位置をずらす
        $iframe.attr("style", "width: " + movieItemWidth + "px");
        // ここでthisとすることで、変数のスコープがオブジェクト自身になる
        let that = this;
        $(".js-slide-next").on("click", function () {
          that.slideNext(); // ここでthisとしてしまうと、js-slide-nextを指してしまう
        });
        $(".js-slide-prev").on("click", function () {
          that.slidePrev();
        });
      },
    };
  })();
  // オブジェクト内のメソッドを実行
  slider.init();

  /***********************************************
メール送信後、トップページへリダイレクトさせる処理
*************************************************/
  let element = document.querySelectorAll("#js-top-redirect");
  console.log(element.length);
  if (element.length !== 0) {
    setTimeout(function () {
      window.location.href = "/";
    }, 3000);
  }
});
