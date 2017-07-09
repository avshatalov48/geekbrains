var gulp = require('gulp'),

    scss = require('gulp-scss'),
    pug = require('gulp-pug'),
    browsersync = require('browser-sync'),

    plumber = require('gulp-plumber'), // Отслеживание ошибок в Gulp // https://www.npmjs.com/package/gulp-plumber
    clearCache = require('gulp-cache'),
    notify = require('gulp-notify'),
    newer = require('gulp-newer'), // Запускает таски только для изменившихся файлов // https://www.npmjs.com/package/gulp-newer
    lec = require ('gulp-line-ending-corrector'), // Gulp Plugin for Line Ending Corrector (A utility that makes sure your files have consistent line endings)

    autoprefixer = require('gulp-autoprefixer'),

    htmlmin = require('gulp-htmlmin'),
    uglify = require('gulp-uglify'),
    cssnano = require('gulp-cssnano'),

    concat = require('gulp-concat'),
    rename = require('gulp-rename'),
    del = require('del');

// Таск по умолчанию
gulp.task('default', ['watch']);

// Очистка кеша
gulp.task('clearCache', function() {
    return clearCache.clearAll();
});

// SCSS
gulp.task('scss', function(){
    return gulp.src(['app/scss/**/styles.scss', 'app/bower_components/jquery-ui/themes/smoothness/jquery-ui.css'])
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
        .pipe(gulp.dest('app/css/'))
        .pipe(browsersync.reload({
            stream: true
        }));
});

// Pug
gulp.task('pug', function() {
    return gulp.src('app/pug/pages/*.pug')
        .pipe(plumber())
        .pipe(pug({
            pretty: true
        }))
        .on('error', notify.onError(function(error) {
            return 'Pug: ' + error.message;
        }))
        .pipe(lec({verbose:true, eolc: 'LF', encoding:'utf8'}))
        .pipe(gulp.dest('app'));
});

// Browsersync
gulp.task('browsersync', function() {
    browsersync({
        server: {
            baseDir: 'app'
        },
    });
});

// JS
gulp.task('scripts', function() {
    return gulp.src([
            'app/bower_components/jquery/dist/jquery.min.js',
            'app/bower_components/jquery-ui/jquery-ui.min.js'
        ])
        .pipe(plumber())
        .pipe(concat('libs.min.js'))
        .pipe(lec({verbose:true, eolc: 'LF', encoding:'utf8'}))
        .pipe(gulp.dest('app/js'))
        .pipe(browsersync.reload({
            stream: true
        }));
});

// Watch
gulp.task('watch', ['browsersync', 'scss', 'pug', 'scripts'], function() {
    gulp.watch('app/scss/**/*.scss', ['scss']);
    gulp.watch('app/pug/**/*.pug', ['pug']);
    gulp.watch(['app/js/*.js', '!app/js/scripts.min.js'], ['scripts']);
});

// Очистка папки сборки - dev
gulp.task('clean', function() {
    return del.sync('dev');
});

// Сборка проекта
gulp.task('build', ['clean', 'scss', 'scripts'], function() {
    var buildCss = gulp.src('app/css/*.css')
        .pipe(cssnano())
        .pipe(lec({verbose:true, eolc: 'LF', encoding:'utf8'}))
        .pipe(gulp.dest('dev/css'));

    var buildJson = gulp.src('app/fonts/*.*')
        .pipe(gulp.dest('dev/fonts'));

    var buildJson = gulp.src('app/img/*.*')
        .pipe(gulp.dest('dev/img'));

    var buildJson = gulp.src('app/json/*.json')
        .pipe(gulp.dest('dev/json'));

    var buildJs = gulp.src('app/js/*.js')
        .pipe(uglify())
        .pipe(lec({verbose:true, eolc: 'LF', encoding:'utf8'}))
        .pipe(gulp.dest('dev/js'));

    var buildHtml = gulp.src('app/*.html')
        .pipe(htmlmin({
            minifyCSS: true,
            minifyJS: true,
            collapseWhitespace: true,
            removeComments: true
        }))
        .pipe(lec({verbose:true, eolc: 'LF', encoding:'utf8'}))
        .pipe(gulp.dest('dev/'));
});