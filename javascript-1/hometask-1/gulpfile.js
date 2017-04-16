var gulp = require('gulp'),
    prettify = require('gulp-prettify'), // https://www.npmjs.com/package/gulp-prettify
    csscomb = require('gulp-csscomb'), // https://www.npmjs.com/package/gulp-csscomb
    sass = require('gulp-sass'), // Подключаем Sass пакет,
    scss = require('gulp-scss'), // Подключаем SCSS пакет,
    pug = require('gulp-pug'),
    browsersync = require('browser-sync'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglifyjs'),
    cssnano = require('gulp-cssnano'),
    rename = require('gulp-rename'),
    del = require('del'),
    imagemin = require('gulp-imagemin'),
    pngquant = require('imagemin-pngquant'),
    stylus = require('gulp-stylus'),
    cache = require('gulp-cache'),
    spritesmith = require("gulp.spritesmith"),
    plumber = require("gulp-plumber"),
    notify = require("gulp-notify"),
    newer = require("gulp-newer"),
    autoprefixer = require('gulp-autoprefixer');


// Дефолтный таск
gulp.task('default', ['watch']);

// Очистка кеша
gulp.task('clear', function() {
    return cache.clearAll();
});

gulp.task('scss', function(){ // Создаем таск SCSS
    return gulp.src('dev/static/scss/**/main.scss') // Берем источник
        .pipe(scss()) // Преобразуем SCSS в CSS посредством gulp-scss
        //        .pipe(autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], { cascade: true })) // Создаем префиксы
        //        .pipe(gulp.dest('dev/static/css')) // Выгружаем результат
        //        .pipe(browsersync.reload({stream: true})) // Обновляем CSS на странице при изменении
        .on("error", notify.onError(function(error) {
            return "SCSS: " + error.message;
        }))
        .pipe(autoprefixer([
            'Android 2.3',
            'Android >= 4',
            'Chrome >= 20',
            'Firefox >= 24', // Firefox 24 is the latest ESR
            'Explorer >= 7',
            'iOS >= 6',
            'Opera >= 12',
            'Safari >= 6']))
        // .pipe(autoprefixer(['last 2 version']))
        // .pipe(cssnano()) // Сжимаем
        // .pipe(prettify({indent_size: 2}))
        // .pipe(csscomb())
        .pipe(gulp.dest('dev/static/css/'))
        .pipe(browsersync.reload({
            stream: true
        }));
});

gulp.task('sass', function(){ // Создаем таск Sass
    return gulp.src('dev/static/sass/**/main.sass') // Берем источник
        .pipe(sass()) // Преобразуем Sass в CSS посредством gulp-sass
//        .pipe(autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], { cascade: true })) // Создаем префиксы
//        .pipe(gulp.dest('dev/static/css')) // Выгружаем результат
//        .pipe(browsersync.reload({stream: true})) // Обновляем CSS на странице при изменении
    .on("error", notify.onError(function(error) {
            return "Sass: " + error.message;
        }))
        .pipe(autoprefixer([
          'Android 2.3',
          'Android >= 4',
          'Chrome >= 20',
          'Firefox >= 24', // Firefox 24 is the latest ESR
          'Explorer >= 7',
          'iOS >= 6',
          'Opera >= 12',
          'Safari >= 6']))
//        .pipe(autoprefixer(['last 2 version']))
//        .pipe(csscomb())
//        .pipe(prettify({indent_size: 2}))
        .pipe(gulp.dest('dev/static/css'))
        .pipe(browsersync.reload({
            stream: true
        }));
});

// Работа со Stylus
gulp.task('stylus', function() {
    return gulp.src([
            'dev/static/stylus/main.styl',
        ])
        .pipe(plumber())
        .pipe(stylus({
            'include css': true
        }))


    .on("error", notify.onError(function(error) {
            return "Stylus: " + error.message;
        }))
        .pipe(autoprefixer([
          'Android 2.3',
          'Android >= 4',
          'Chrome >= 20',
          'Firefox >= 24', // Firefox 24 is the latest ESR
          'Explorer >= 7',
          'iOS >= 6',
          'Opera >= 12',
          'Safari >= 6']))
//        .pipe(autoprefixer(['last 2 version']))
//        .pipe(csscomb())
//        .pipe(prettify({indent_size: 2}))
        .pipe(gulp.dest('dev/static/css'))
        .pipe(browsersync.reload({
            stream: true
        }));
});

// Работа с Pug
gulp.task('pug', function() {
    return gulp.src('dev/pug/pages/*.pug')
        .pipe(plumber())
        .pipe(pug({
            pretty: true
        }))
        .on("error", notify.onError(function(error) {
            return "Pug: " + error.message;
        }))
//        .pipe(prettify({indent_size: 2}))
        .pipe(gulp.dest('dev'));
});

// Browsersync
gulp.task('browsersync', function() {
    browsersync({
        server: {
            baseDir: 'dev'
        },
    });
});

// Работа с JS
gulp.task('scripts', function() {
    return gulp.src([
            // Библиотеки
            'dev/static/libs/magnific/jquery.magnific-popup.min.js',
            'dev/static/libs/bxslider/jquery.bxslider.min.js',
            'dev/static/libs/maskedinput/maskedinput.js',
            'dev/static/libs/slick/slick.min.js',
            'dev/static/libs/validate/jquery.validate.min.js'
        ])
        .pipe(concat('libs.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('dev/static/js'))
        .pipe(browsersync.reload({
            stream: true
        }));
});


// Сборка спрайтов PNG
gulp.task('cleansprite', function() {
    return del.sync('dev/static/img/sprite/sprite.png');
});


gulp.task('spritemade', function() {
    var spriteData =
        gulp.src('dev/static/img/sprite/*.*')
        .pipe(spritesmith({
            imgName: 'sprite.png',
            cssName: '_sprite.styl',
            padding: 15,
            cssFormat: 'stylus',
            algorithm: 'binary-tree',
            cssTemplate: 'stylus.template.mustache',
            cssVarMap: function(sprite) {
                sprite.name = 's-' + sprite.name;
            }
        }));

    spriteData.img.pipe(gulp.dest('dev/static/img/sprite/')); // путь, куда сохраняем картинку
    spriteData.css.pipe(gulp.dest('dev/static/stylus/')); // путь, куда сохраняем стили
});

gulp.task('sprite', ['cleansprite', 'spritemade']);

// Слежение
gulp.task('watch', ['browsersync', 'sass', 'scss', /*'stylus',*/ 'pug', 'scripts'], function() {
//    gulp.watch('dev/static/sass/**/*.sass', ['sass']); // Наблюдение за sass файлами в папке sass
    gulp.watch('dev/static/scss/**/*.scss', ['scss']); // Наблюдение за scss файлами в папке scss
//    gulp.watch('dev/static/stylus/**/*.styl', ['stylus']);
//    gulp.watch('dev/static/css/*.css', browsersync.reload);
    gulp.watch('dev/pug/**/*.pug', ['pug']);
    gulp.watch('dev/*.html', browsersync.reload);
    gulp.watch(['dev/static/js/*.js', '!dev/static/js/libs.min.js', '!dev/static/js/jquery.js'], ['scripts']);
});

// Очистка папки сборки
gulp.task('clean', function() {
    return del.sync('prodact');
});

// Оптимизация изображений
gulp.task('img', function() {
    return gulp.src(['dev/static/img/**/*', '!dev/static/img/sprite/*'])
        .pipe(cache(imagemin({
            progressive: true,
            use: [pngquant()]

        })))
        .pipe(gulp.dest('product/static/img'));
});

// Сборка проекта

gulp.task('build', ['clean', 'img', /*'stylus',*/ 'scripts'], function() {
    var buildCss = gulp.src('dev/static/css/*.css')
        .pipe(gulp.dest('product/static/css'));

    var buildFonts = gulp.src('dev/static/fonts/**/*')
        .pipe(gulp.dest('product/static/fonts'));

    var buildJs = gulp.src('dev/static/js/**.js')
        .pipe(gulp.dest('product/static/js'));

    var buildHtml = gulp.src('dev/*.html')
        .pipe(gulp.dest('product/'));

    var buildImg = gulp.src('dev/static/img/sprite/sprite.png')
        .pipe(imagemin({
            progressive: true,
            use: [pngquant()]
        }))
        .pipe(gulp.dest('product/static/img/sprite/'));
});