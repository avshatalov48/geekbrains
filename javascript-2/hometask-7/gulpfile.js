var gulp = require('gulp'),
    // Основные
    scss = require('gulp-scss'),
    pug = require('gulp-pug'),
    browsersync = require('browser-sync'),

    // Для Gulp
    plumber = require('gulp-plumber'), // Отслеживание ошибок в Gulp
    clearCache = require('gulp-cache'),
    notify = require('gulp-notify'),
    newer = require('gulp-newer'), // Запускает таски только для изменившихся файлов
    lec = require ('gulp-line-ending-corrector'), // Корректор конца строк

    // Автодополнения
    autoprefixer = require('gulp-autoprefixer'),

    // Минификаторы
    htmlmin = require('gulp-htmlmin'),
    uglify = require('gulp-uglify'),
    cssnano = require('gulp-cssnano'),

    // Работа с файлами
    concat = require('gulp-concat'),
    rename = require('gulp-rename'),
    del = require('del');


// Конфигурация проекта
var config = {
    app: './app',
    dist: './dist'
};


// Таск по умолчанию
gulp.task('default', ['watch']);


// Очистка кеша
gulp.task('clearCache', function() {
    return clearCache.clearAll();
});


// SCSS
gulp.task('scss', function(){
    return gulp.src([config.app + '/scss/**/styles.scss', config.app + '/bower_components/jquery-ui/themes/smoothness/jquery-ui.css'])
        .pipe(plumber())
        .pipe(scss())
        .on('error', notify.onError(function(error) {
            return 'SCSS: ' + error.message;
        }))
        .pipe(autoprefixer([
            'Android 2.3',
            'Android >= 4',
            'Chrome >= 20',
            'Firefox >= 24',
            'Explorer >= 7',
            'iOS >= 6',
            'Opera >= 12',
            'Safari >= 6']))
        .pipe(concat('styles.css'))
        .pipe(lec({verbose:true, eolc: 'LF', encoding:'utf8'}))
        .pipe(gulp.dest(config.app + '/css/'))
        .pipe(browsersync.reload({
            stream: true
        }));
});


// Pug
gulp.task('pug', function() {
    return gulp.src(config.app + '/pug/pages/*.pug')
        .pipe(plumber())
        .pipe(pug({
            pretty: true
        }))
        .on('error', notify.onError(function(error) {
            return 'Pug: ' + error.message;
        }))
        .pipe(lec({verbose:true, eolc: 'LF', encoding:'utf8'}))
        .pipe(gulp.dest(config.app));
});


// BrowserSync
gulp.task('browsersync', function() {
    browsersync({
        server: {
            baseDir: config.app
        }
    });
});


// JS
gulp.task('scripts', function() {
    return gulp.src([
            config.app + '/bower_components/jquery/dist/jquery.min.js',
            config.app + '/bower_components/jquery-ui/jquery-ui.min.js',
            config.app + '/bower_components/jquery.maskedinput/dist/jquery.maskedinput.min.js'
        ])
        .pipe(plumber())
        .pipe(concat('libs.min.js'))
        .pipe(lec({verbose:true, eolc: 'LF', encoding:'utf8'}))
        .pipe(gulp.dest(config.app + '/js'))
        .pipe(browsersync.reload({
            stream: true
        }));
});


// Watch
gulp.task('watch', ['browsersync', 'scss', 'pug', 'scripts'], function() {
    gulp.watch(config.app + '/scss/**/*.scss', ['scss']);
    gulp.watch(config.app + '/pug/**/*.pug', ['pug']);
    gulp.watch([config.app + '/js/*.js', '!' + config.app + '/js/scripts.min.js'], ['scripts']);
});


// Очистка папки готовой сборки
gulp.task('clean', function() {
    return del.sync(config.dist);
});


// Сборка проекта
gulp.task('build', ['clean', 'scss', 'pug', 'scripts'], function() {
    var buildCss = gulp.src(config.app + '/css/*.css')
        .pipe(plumber())
        .pipe(cssnano())
        .pipe(lec({verbose:true, eolc: 'LF', encoding:'utf8'}))
        .pipe(gulp.dest(config.dist + '/css'));

    var buildFonts = gulp.src(config.app + '/fonts/*.*')
        .pipe(plumber())
        .pipe(gulp.dest(config.dist + '/fonts'));

    var buildImg = gulp.src(config.app + '/img/*.*')
        .pipe(plumber())
        .pipe(gulp.dest(config.dist + '/img'));

    var buildJson = gulp.src(config.app + '/json/*.json')
        .pipe(plumber())
        .pipe(gulp.dest(config.dist + '/json'));

    var buildJs = gulp.src(config.app + '/js/*.js')
        .pipe(plumber())
        .pipe(uglify())
        .pipe(lec({verbose:true, eolc: 'LF', encoding:'utf8'}))
        .pipe(gulp.dest(config.dist + '/js'));

    var buildHtml = gulp.src(config.app + '/*.html')
        .pipe(plumber())
        .pipe(htmlmin({
            minifyCSS: true,
            minifyJS: true,
            collapseWhitespace: true,
            removeComments: true
        }))
        .pipe(lec({verbose:true, eolc: 'LF', encoding:'utf8'}))
        .pipe(gulp.dest(config.dist + '/'));
});