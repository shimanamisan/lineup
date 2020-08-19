<?php
$siteTitle = 'トップページ';
// メタタグなど読み込み
require('head.php');

// bodyタグからheaderを読み込み
require('header.php');

?>

    <main class="l-main">
    <div class="c-loading js-loading">
      <div class="c-loading__module js-loading-module">
        <p class="c-loading__module__text">Loading...</p>
      </div>
      <div class="c-loading__content js-loading-content">
        <p class="">野球しようよ！！</p>
      </div>
    </div>

      <section class="c-homeContainer p-mainVisual js-mainVisual">
        <div class="p-mainVisual__body u-row">
          <h2 class="p-mainVisual__title">
            LINEUP BASEBALLCULB
          </h2>
          <span class="p-mainVisual__text">LINEUPは、土曜日活動チームとして大阪市内で活動している結成12年目のチームです</span>
          <ul class="p-social">
            <li class="p-social__item p-social__title">Follow Us</li>
            <li class="p-social__item p-social__icon"><a href="">Twitter</a></li>
            <li class="p-social__item p-social__icon"><a href="https://www.instagram.com/wada.kenichi_lineup10/" target="_brank" rel="noopener">Instagram</a></li>
            <span class="p-social__fab"><i class="fab fa-twitter"></i></span>
            <span class="p-social__fab"><a href="https://www.instagram.com/wada.kenichi_lineup10/" target="_brank" rel="noopener"><i class="fab fa-instagram"></i></a></span>
          </ul>
        </div>
        <video class="p-mainVisual__movie" loop autoplay muted playsinline>
          <source src="movie/top-video.webm" />
          <source src="movie/top-video.mp4" />
        </video>

        <div class="p-mainVisual__cover"></div>
      </section>
      <section class="p-news">
        <div class="p-news__inner">
          <h2 class="c-title">
            お知らせ
            <span class="c-title__sub">What's New</span>
          </h2>
          <div class="p-news__body">
            <ul class="p-news__nav">
              <li class="p-news__item">
                <span class="p-news__date">2020.05.10</span>
                <span class="p-news__itemTitle">新メンバーが加入しました。</span>
              </li>
              <li class="p-news__item">
                <span class="p-news__date">2020.05.10</span>
                <span class="p-news__itemTitle">試合結果を更新しました。</span>
              </li>
              <li class="p-news__item">
                <span class="p-news__date">2020.05.10</span>
                <span class="p-news__itemTitle">お知らせ</span>
              </li>
              <li class="p-news__item">
                <span class="p-news__date">2020.05.10</span>
                <span class="p-news__itemTitle">お知らせ</span>
              </li>
              <li class="p-news__item">
                <span class="p-news__date">2020.05.10</span>
                <span class="p-news__itemTitle">お知らせ</span>
              </li>
              <li class="p-news__item">
                <span class="p-news__date">2020.05.10</span>
                <span class="p-news__itemTitle">お知らせ</span>
              </li>
              <li class="p-news__item">
                <span class="p-news__date">2020.05.10</span>
                <span class="p-news__itemTitle">お知らせ</span>
              </li>
              <li class="p-news__item">
                <span class="p-news__date">2020.05.10</span>
                <span class="p-news__itemTitle">お知らせ</span>
              </li>
              <li class="p-news__item">
                <span class="p-news__date">2020.05.10</span>
                <span class="p-news__itemTitle">お知らせ</span>
              </li>
              <li class="p-news__item">
                <span class="p-news__date">2020.05.10</span>
                <span class="p-news__itemTitle">お知らせ</span>
              </li>
            </ul>
          </div>
        </div>
      </section>
      <section class="p-homeCategory u-group">
        <div class="p-homeCategory__item">
          <div class="p-homeCategory__cover">
            <div class="p-homeCategory__img p-homeCategory__img--panel01">
              <a href="team.html"></a>
              <div class="p-homeCategory__img--inner">
                <p class="p-homeCategory__img--content">チーム紹介</p>
              </div>
            </div>
          </div>
        </div>
        <div class="p-homeCategory__item">
          <div class="p-homeCategory__cover">
            <div class="p-homeCategory__img p-homeCategory__img--panel02">
              <a href="rule.html"></a>
              <div class="p-homeCategory__img--inner">
                <p class="p-homeCategory__img--content">チーム規則</p>
              </div>
            </div>
          </div>
        </div>
        <div class="p-homeCategory__item">
          <div class="p-homeCategory__cover">
            <div class="p-homeCategory__img p-homeCategory__img--panel03">
              <a href="#"></a>
              <div class="p-homeCategory__img--inner">
                <p class="p-homeCategory__img--content">選手名鑑</p>
              </div>
            </div>
          </div>
        </div>
        <div class="p-homeCategory__item">
          <div class="p-homeCategory__cover">
            <div class="p-homeCategory__img p-homeCategory__img--panel04">
              <a href="#"></a>
              <div class="p-homeCategory__img--inner">
                <p class="p-homeCategory__img--content">スケジュール</p>
              </div>
            </div>
          </div>
        </div>
        <div class="p-homeCategory__item">
          <div class="p-homeCategory__cover">
            <div class="p-homeCategory__img p-homeCategory__img--panel05">
              <a href="#"></a>
              <div class="p-homeCategory__img--inner">
                <p class="p-homeCategory__img--content">成績表</p>
              </div>
            </div>
          </div>
        </div>
        <div class="p-homeCategory__item">
          <div class="p-homeCategory__cover">
            <div class="p-homeCategory__img p-homeCategory__img--panel06">
              <a href="member.php"></a>
              <div class="p-homeCategory__img--inner">
                <p class="p-homeCategory__img--content">メンバー募集</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="c-homeContainer p-homeCategory__thirdSection">
        <div class="p-homeCategory__thirdSection__wrapp">
          <h2 class="p-homeCategory__thirdSection__title">チームのコンセプトは、<br />『楽しみながら勝つ』</h2>
          <p class="p-homeCategory__thirdSection__text">
            チームのコンセプトは、『楽しみながら勝つ』という草野球の永遠のテーマを掲げています。<br />
            これからも、仲良く、前向きに、チーム一丸となって戦っていきます！
          </p>
        </div>
      </section>

      <section class="c-homeContainer p-homeCategory u-hidden u-padding__top--xxl js-youtube">
        <h2 class="p-homeCategory__movie__title">MOVIE NEWS</h2>
        <div class="flex-wrapp">
          <div class="p-homeCategory__movie p-slider__wrapp p-youtube__container">
            <i class="p-slider p-slider__prev js-slide-prev fas fa-chevron-left"></i>
            <i class="p-slider p-slider__next js-slide-next fas fa-chevron-right"></i>
            <ul class="p-homeCategory__movie p-homeCategory__movie__list p-slider__container">
              <li class="p-homeCategory__movie__item p-slider__item">
                <iframe
                  class="p-youtube"
                  src="//www.youtube.com/embed/n6uQNIvgLco"
                  frameborder="0"
                  allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen
                ></iframe>
              </li>
              <li class="p-homeCategory__movie__item p-slider__item">
                <iframe
                  class="p-youtube"
                  src="//www.youtube.com/embed/lLH7XCjYgpE"
                  frameborder="0"
                  allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen
                ></iframe>
              </li>
              <li class="p-homeCategory__movie__item p-slider__item">
                <iframe
                  class="p-youtube"
                  src="//www.youtube.com/embed/n6uQNIvgLco"
                  frameborder="0"
                  allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen
                ></iframe>
              </li>
              <li class="p-homeCategory__movie__item p-slider__item">
                <iframe
                  class="p-youtube"
                  src="//www.youtube.com/embed/lLH7XCjYgpE"
                  frameborder="0"
                  allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen
                ></iframe>
              </li>
              <li class="p-homeCategory__movie__item p-slider__item">
                <iframe
                  class="p-youtube"
                  src="//www.youtube.com/embed/n6uQNIvgLco"
                  frameborder="0"
                  allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen
                ></iframe>
              </li>
            </ul>
          </div>
        </div>
      </section>
    </main>

    <?php
// フッターを読み込み
require("footer.php");
?>
