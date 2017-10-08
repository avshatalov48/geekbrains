var gulp       = require('gulp'), // Подключаем Gulp
	// strip = require('gulp-strip-comments'), // https://www.npmjs.com/package/gulp-strip-comments
    // prettify = require('gulp-prettify'), // https://www.npmjs.com/package/gulp-prettify
    notify = require("gulp-notify"),
	htmlmin = require('gulp-htmlmin'),
	uncss = require('gulp-uncss'),
    stripCssComments = require('gulp-strip-css-comments'),
    // CleanCSS = require('clean-css'),
	sass         = require('gulp-sass'), //Подключаем Sass пакет,
	scss         = require('gulp-scss'), //Подключаем SCSS пакет,
	browserSync  = require('browser-sync'), // Подключаем Browser Sync
	concat       = require('gulp-concat'), // Подключаем gulp-concat (для конкатенации файлов)
	uglify       = require('gulp-uglifyjs'), // Подключаем gulp-uglifyjs (для сжатия JS)
	cssnano      = require('gulp-cssnano'), // Подключаем пакет для минификации CSS
	rename       = require('gulp-rename'), // Подключаем библиотеку для переименования файлов
	del          = require('del'), // Подключаем библиотеку для удаления файлов и папок
	imagemin     = require('gulp-imagemin'), // Подключаем библиотеку для работы с изображениями
	pngquant     = require('imagemin-pngquant'), // Подключаем библиотеку для работы с png
	cache        = require('gulp-cache'), // Подключаем библиотеку кеширования
	autoprefixer = require('gulp-autoprefixer');// Подключаем библиотеку для автоматического добавления префиксов

gulp.task('default', ['watch']);

// Минификация HTML
gulp.task('html-min', function () {
	return gulp.src('./app/*.html')
		.pipe(htmlmin({collapseWhitespace: true}))
		.pipe(gulp.dest('./dist'))
});

// Удаление неиспользуемых CSS стилей
gulp.task('uncss', function () {
	gulp.src(['./app/css/styles.css'])
		.pipe(uncss({
			html: ['app/index.html']
		}))
		// .pipe(csso())
		.pipe(gulp.dest('./dist/css'));
});

gulp.task('sass', function(){ // Создаем таск Sass
	return gulp.src('app/sass/**/*.sass') // Берем источник
		.pipe(sass()) // Преобразуем Sass в CSS посредством gulp-sass
        .on("error", notify.onError(function(error) {
            return "SCSS: " + error.message;
        }))
		.pipe(autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], { cascade: true })) // Создаем префиксы
		.pipe(gulp.dest('app/css')) // Выгружаем результата в папку app/css
		.pipe(browserSync.reload({stream: true})) // Обновляем CSS на странице при изменении
});

gulp.task('scss', function(){ // Создаем таск SCSS
	return gulp.src('app/scss/**/styles.scss') // Берем источник
		.pipe(scss()) // Преобразуем SCSS в CSS посредством gulp-scss
        .on("error", notify.onError(function(error) {
            return "SCSS: " + error.message;
        }))
		.pipe(autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], { cascade: true })) // Создаем префиксы
        // .pipe(strip()) // removes comments from JSON, JavaScript, CSS, HTML, etc.
        .pipe(stripCssComments()) // Strip comments from CSS
        .pipe(cssnano()) // Сжимаем
		.pipe(gulp.dest('app/css')) // Выгружаем результата в папку app/css
		.pipe(browserSync.reload({stream: true})) // Обновляем CSS на странице при изменении
});

gulp.task('browser-sync', function() { // Создаем таск browser-sync
	browserSync({ // Выполняем browserSync
		server: { // Определяем параметры сервера
			baseDir: 'app' // Директория для сервера - app
		},
		notify: false // Отключаем уведомления
	});
});

gulp.task('scripts', function() {
	return gulp.src([ // Берем все необходимые библиотеки
		'app/libs/jquery/jquery.min.js',
		'app/libs/scrollto/jquery.scrollTo.min.js',
		'app/js/common.js'
		])
		.pipe(concat('scripts.js')) // Собираем их в кучу в новом файле
		.pipe(uglify()) // Сжимаем JS файл
		.pipe(gulp.dest('app/js')); // Выгружаем в папку app/js
});

gulp.task('css-libs', ['sass', 'scss'], function() {
	return gulp.src('app/css/libs.css') // Выбираем файл для минификации
		.pipe(cssnano()) // Сжимаем
		.pipe(rename({suffix: '.min'})) // Добавляем суффикс .min
		.pipe(gulp.dest('app/css')); // Выгружаем в папку app/css
});

gulp.task('watch', ['browser-sync', 'scss'], function() {
	gulp.watch('app/sass/**/*.sass', ['sass']); // Наблюдение за sass файлами в папке sass
	gulp.watch('app/scss/**/*.scss', ['scss']); // Наблюдение за scss файлами в папке scss
	gulp.watch('app/*.html', browserSync.reload); // Наблюдение за HTML файлами в корне проекта
	gulp.watch('app/js/**/*.js', browserSync.reload);   // Наблюдение за JS файлами в папке js
	// gulp.watch('app/css/*.css', browserSync.reload);
});

gulp.task('clean', function() {
	return del.sync('dist'); // Удаляем папку dist перед сборкой
});

gulp.task('img', function() {
	return gulp.src('app/img/**/*') // Берем все изображения из app
		.pipe(cache(imagemin({  // Сжимаем их с наилучшими настройками с учетом кеширования
			interlaced: true,
			progressive: true,
			svgoPlugins: [{removeViewBox: false}],
			use: [pngquant()]
		})))
		.pipe(gulp.dest('dist/img')); // Выгружаем на продакшен
});

gulp.task('build', ['clean', 'img', 'sass', 'scss', 'scripts'], function() {

	var buildCss = gulp.src([ // Переносим библиотеки в продакшен
		'app/css/main.css',
		'app/css/libs.min.css'
		])
	.pipe(gulp.dest('dist/css'))

	var buildFonts = gulp.src('app/fonts/**/*') // Переносим шрифты в продакшен
	.pipe(gulp.dest('dist/fonts'))

	var buildJs = gulp.src('app/js/**/*') // Переносим скрипты в продакшен
	.pipe(gulp.dest('dist/js'))

	var buildHtml = gulp.src('app/*.html') // Переносим HTML в продакшен
	.pipe(gulp.dest('dist'));

});

gulp.task('clear', function (callback) {
	return cache.clearAll();
})