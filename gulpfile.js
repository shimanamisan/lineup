// pulg-in
const gulp = require("gulp");
// gulp-minify-cssが非推奨になり、gulp-clean-cssを使用するようアナウンスが出ている
// https://www.npmjs.com/package/gulp-minify-css
const sass = require("gulp-sass");
const changed = require("gulp-changed");
const imagemin = require("gulp-imagemin");
const browserSync = require("browser-sync");
const browserify = require("browserify");
const source = require("vinyl-source-stream"); // gulpで使用するvinylオブジェクトに変換するためのもの

// gulp4系の書き方
var paths = {
  srcDir: "src",
  dstDir: "dist",
};

// browserifyを使ってJSファイルをビルド
const js_Build = function (done) {
  browserify({
    entries: [paths.srcDir + "/js/main.js"],
  })
    .bundle()
    .pipe(source("bundle.js")) // sourceメソッドの引数にソースとなるファイル名を渡すことでvinylに変換されたオブジェクトが返ってくる
    .pipe(gulp.dest(paths.dstDir + "/js/"));
  done();
};

// scssファイルをコンパイル
const sass_Build = function (done) {
  gulp
    .src(paths.srcDir + "/scss/**/*.scss")
    .pipe(sass({ outputStyle: "compressed" }).on("error", sass.logError))
    // {outputStyle: 'compressed'}はgulp-sassのオプションで出力ファイルを圧縮している
    // https://www.npmjs.com/package/gulp-sass
    // .pipe(
    //   autoprefixer(["last 3 versions", "ie >= 8", "Android >= 4", "iOS >= 8"])
    // )
    .pipe(gulp.dest(paths.dstDir + "/css/"));
  done();
};

//画像圧縮
//圧縮前と圧縮後のディレクトリを定義

// jpg, png, gif画像の圧縮タスク
// gulp-imageminのバージョンアップによるでるエラー：imagemin.jpegtran is not a function
// imagemin.jpegtran()をimagemin.mozjpeg()に変更
const img_Build = function (done) {
  var srcGlob = paths.srcDir + "/img/*.+(jpg|jpeg|png|gif)"; // /**/ で、その配下の全部のディレクトリを見に行く
  var dstGlob = paths.dstDir + "/img";
  gulp
    .src(srcGlob)
    //gulp-changedというライブラリは、読込み元と保存先のディレクトリの差分を確認して、画像圧縮を実行するか判断するもの
    .pipe(changed(dstGlob))
    .pipe(
      imagemin([
        imagemin.gifsicle({ interlaced: true }),
        // imagemin.jpegtran({progressive: true}), v6.x系の書き方
        // imagemin.mozjpeg({progressive: true}),
        imagemin.mozjpeg({ quality: 80 }),
        imagemin.optipng({ optimizationLevel: 5 }),
      ])
    )
    .pipe(gulp.dest(dstGlob));
  done();
};

// ローカルサーバの立ち上げの設定
const browserSyncOption = {
  port: 8080,
  server: {
    baseDir: "./", // 対象ディレクトリ
    index: "index.html", // 対象ファイル
  },
  reloadOnRestart: true,
};
const sync = function (done) {
  browserSync.init(browserSyncOption);

  gulp.watch(paths.srcDir + "/js/main.js", gulp.series(js_Build));
  gulp.watch(paths.dstDir + "/js/bundle.js").on("change", browserSync.reload);

  gulp.watch(paths.srcDir + "/scss/**/*.scss", gulp.series(sass_Build));
  gulp.watch(paths.dstDir + "/css/style.css").on("change", browserSync.reload);

  gulp.watch(paths.srcDir + "/img", gulp.series(img_Build));

  gulp.watch("./index.html").on("change", browserSync.reload);

  done();
};

// 定義したタスクを使えるように出力 gulp [タスク名] でコマンドを叩くと使える
exports.default = sync;
