import $ from "jquery";

$(function () {
  "use strict";

  // Cookie読み出し用の関数
  function getCookie(key) {
    // Cookieから値を取得する
    let cookieString = document.cookie;
    // 要素ごとに ; で区切られているので、 ; で切り出しを行う。新しく配列として生成
    // ここでは前後にスペースが入っている
    let cookieKeyArray = cookieString.split(";");

    // 要素分ループを行う
    for (let i = 0; i < cookieKeyArray.length; i++) {
      let targetCookie = cookieKeyArray[i];

      // 前後のスペースをカットする
      targetCookie = targetCookie.replace(/^\s+|\s+$/g, "");

      // indexOf("=") とすると、= という文字が何番目にあるのか、というのが返ってくる
      let valuIndex = targetCookie.indexOf("=");
      console.log(valuIndex);

      if (targetCookie.substring(0, valuIndex) == key) {
        // キーが引数と一致した場合値を返す
        console.log(valuIndex); // 4
        console.log(targetCookie.substring(0, valuIndex)); // name
        console.log(typeof targetCookie);
        console.log("targetCookieのif文でtrueの判定です " + targetCookie);
        return decodeURIComponent(targetCookie.slice(valuIndex + 1));
      }
    }

    // 一致するものがなければ空文字を返す
    return "";
  }

  console.log("getCookie関数：" + getCookie("name"));

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
          console.log("window.outerHeightを見ています ：" + window.outerHeight);
          console.log("innerHeightを見ています ：" + window.innerHeight);
          $mainVisual.css({
            height: `${window.innerHeight}`,
          });
          $youtube.css({
            height: `${window.innerHeight}`,
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
  let $jsBody = $("body");
  let $jsLoading = $(".js-loading");
  let $jsLoadingModule = $(".js-loading-module");
  let $jsLoadingContent = $(".js-loading-content");

  if (getCookie("name") === "") {
    $jsLoading.css("display", "block");
    $jsBody.css("overflow", "hidden");
    // 読み込みが完了したら、コールバックの処理を実行する
    $(window).on("load", function () {
      console.log("初回アクセス時");
      $jsLoadingModule.fadeOut("slow", function () {
        setTimeout(() => {
          $jsBody.css("overflow", "");
        }, 2000);
      });
      $jsLoadingContent.css("display", "block");
      $jsLoading.toggleClass("c-loading__open");
      // Cookieに初回アクセス時か判定する値を記述する
      document.cookie = "name=" + encodeURIComponent("first_access");
    });
  } else {
    $jsBody.css("overflow", "");
    console.log("2回目以降");
  }

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
  let $pageTop = $(".js-pagetop"); // トップページへ戻るリンクの要素
  let $jsThirdSection = $(".js-thirdSection");

  $(window).scroll(function() {
    console.log($(window).scrollTop());
    // scrollTop：要素のスクロール位置（Y座標）を取得
    if ($(window).scrollTop() >= 400) {
      // スクロール位置が250を超えたらtrueに分岐
      $jsScrollHeader.addClass("c-anime__scroll");
      $jsHeaderLogo.addClass("p-header__scroll");
      $pageTop.addClass("p-footer__pagetop--active");
    } else {
      $jsScrollHeader.removeClass("c-anime__scroll");
      $jsHeaderLogo.removeClass("p-header__scroll");
      $pageTop.removeClass("p-footer__pagetop--active");
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
    $spitem.toggleClass("c-anime__fadeIn__spmenu");
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
  // console.log(element.length);
  if (element.length !== 0) {
    setTimeout(function () {
      window.location.href = "/";
    }, 3000);
  }

  /****************************************
リンク内のスムーズスクロール
*****************************************/
// #で始まるhref属性のリンクをクリックした際に処理を実行
$('a[href^="#"]').on("click", function(){
  // クリックした要素のhref属性を取得
  let href = $(this).attr("href");

  // 条件：上記で取得したhref属性が # かつ 空文字 であれば "html" と言う文字列を返す。そうでなければ取得してきたhtml属性を返す
  // したがって、条件がtrueだったら "html" が返ってくるので $("html") と言うエレメントを入れていることになる
  // 条件がfalseであれば $(this).attr("href") で取得したエレメントが入ってくる
  let target = $(href == "#" || href === "" ? "html" : href);
  // documentを起点として要素の座標を取得
  let position = target.offset().top;
  $("body, html").animate({
    scrollTop: position // 移動先の要素の座標
  }, 500);
  return false; // aタグの画面遷移を止める
})

});
