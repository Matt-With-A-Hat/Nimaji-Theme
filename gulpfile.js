var gulp = require('gulp');

var gutil = require('gulp-util');
var sass = require('gulp-ruby-sass');
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var cleanCss = require('gulp-clean-css');
var wait = require('gulp-wait');
var del = require('del');
var zip = require('gulp-zip');

/**
 * =Compile SCSS and move to build
 */
gulp.task('sass', function () {

    var utilities = sass('src/scss/utilities.scss', {style: 'compressed'})

        .pipe(concat('utilities.css'))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('../css'));

    var nimaji = sass('src/scss/nimaji.scss', {style: 'compressed'})

        .pipe(concat('nimaji.css'))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('../css'));

    //src-local files for offline development mode
    var localScss = [
        'bower_components/bootstrap-sass/assets/stylesheets/_bootstrap.scss',
        'bower_components/css-hamburgers/_sass/hamburgers/hamburgers.scss',
        // 'bower_components/font-awesome/scss/font-awesome.scss',
        'src/src-local/scss/font-awesome/font-awesome.scss',
        'src/src-local/scss/*.scss'
    ];
    var local = sass(localScss, {style: 'compressed'})
        .pipe(concat('nimaji-local.css'))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('../src-local/css'))

});


/**
 * =Concat and minify CSS
 */
gulp.task('css', function () {

    //WordPress default style.css
    gulp.src('src/css/style.css').pipe(gulp.dest('..'));

    //src-local files for offline development mode
    // var cssLocal = [
    //     'src/src-local/css/**/*'
    // ];
    // gulp.src(cssLocal)
    //     .pipe(concat('vendor-local-css.css'))
    //     .pipe(cleanCss())
    //     .pipe(rename({suffix: '.min'}))
    //     .pipe(gulp.dest('../src-local/css/'));
});


/**
 * =Fonts
 */
gulp.task('fonts', function () {

    //src-local files for offline development mode
    gulp.src('src/src-local/fonts/**/*').pipe(gulp.dest('../src-local/fonts'));
    gulp.src('bower_components/font-awesome/fonts/*').pipe(gulp.dest('../fonts'));

});


/**
 * =Concat and minify JS
 */
gulp.task('js', function () {

    var js = [
        // 'bower_components/bootstrap-sass/assets/javascripts/bootstrap.js',
        'src/js/*',
        'src/js/vendor/!hyphenator.js'
    ];

    gulp.src(js)
        .pipe(concat('nimaji.js'))
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('../js'));

    //hyphenator
    var hyphenator = 'src/js/vendor/hyphenator.js';

    gulp.src(hyphenator)
        .pipe(concat('hyphenator.js'))
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('../js'));

    //src-local files for offline development mode
    var jsLocal = [
        'bower_components/jquery/dist/jquery.js',
        'bower_components/bootstrap-sass/assets/javascripts/bootstrap.js'
    ];

    gulp.src(jsLocal)
        .pipe(concat('nimaji-local.js'))
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('../src-local/js'));
});


/**
 * =Copy images
 */
gulp.task('img', function () {

    var img = [
        'src/img/**/*',
        '!src/img/screenshot.png/*'
    ];

    gulp.src(img, {base: 'src/img'})
        .pipe(gulp.dest('../img'));

    var screenshot = [
        'src/img/screenshot.png'
    ];

    gulp.src(screenshot).pipe(gulp.dest('..'));
});


/**
 * =Copy PHP
 */
gulp.task('php', function () {

    var php = [
        'src/php/**/*'
    ];

    gulp.src(php, {base: 'src/php'})
        .pipe(gulp.dest('..'));
});


/**
 * =Watcher
 */
gulp.task('watch', function () {

    gulp.watch(['src/scss/**/*', 'src/src-local/scss/**/*'], ['sass']);
    gulp.watch(['src/js/**/*', 'src/src-local/js/**/*'], ['js']);
    gulp.watch(['src/fonts/**/*', 'src/src-local/fonts/**/*'], ['fonts']);
    gulp.watch(['src/css/**/*', 'src/src-local/css/**/*'], ['css']);
    gulp.watch('src/img/**/*', ['img']);
    gulp.watch('src/php/**/*', ['php']);

});

gulp.task('default', ['sass', 'css', 'fonts', 'js', 'img', 'php']);


/**
 * =Update other installations
 */
gulp.task('update',function(){

    var files = ['../**/*', '!../.git*', '!../gulp/**/*', '!../gulp'];

    gulp.src(files)
        .pipe(gulp.dest('../../../../../wireless-empire/wp-content/themes/nimaji'))
});


/**
 * =Extract
 */
gulp.task('extract', function () {

    var files = ['../**/*', '!../.git*', '!../gulp/**/*', '!../gulp'];
    // var files = '**/*';
    gulp.src(files)
        .pipe(zip('nimaji.zip'))
        .pipe(gulp.dest('../..'))
});