var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');
var browserSync = require('browser-sync').create();
var gcmq = require('gulp-group-css-media-queries');
var cleanCSS = require('gulp-clean-css');
var connect = require('gulp-connect');
var webpack = require('webpack-stream');

var input = './scss/main.scss';
var output = './dist/css';


gulp.task('sass', function () {
	return gulp.src(input)
		.pipe(sourcemaps.init())
		.pipe(sass({errLogToConsole: true,outputStyle: 'compressed'}))
		.pipe(autoprefixer({browsers: ['last 2 versions', '> 5%', 'Firefox ESR']}))
		.pipe(gcmq())
		.pipe(sourcemaps.write())
		.pipe(gulp.dest(output))
		.pipe(browserSync.stream());
});

gulp.task('sass-build', function () {
	return gulp.src(input)
		.pipe(sass({errLogToConsole: true, outputStyle: 'compressed'}))
		.pipe(autoprefixer({browsers: ['last 2 versions', '> 5%', 'Firefox ESR']}))
		.pipe(gcmq())
		.pipe(cleanCSS({compatibility: 'ie8'}))
		.pipe(gulp.dest(output))
		.pipe(browserSync.stream());
});

gulp.task('dist', function () {
	
});

gulp.task('webpack', function(){
	return gulp.src('./app/js/main.js')
		.pipe(webpack( require('./webpack.config.js') ))
		.pipe(gulp.dest('./app/dist/js/'))
		.pipe(connect.reload());
});

// Watch files for change and set Browser Sync
gulp.task('watch', function() {
	// BrowserSync settings
	browserSync.init({
		proxy: "spletnibit.dev",
		files: "./css/main.css",
		livereload: true
		// server: {
		// 	baseDir: 'app'
		// }
	});

	gulp.watch('./app/*.html')
		.on('change', function(event) {
			console.log('File' + event.path + ' was ' + event.type + ', running tasks...')
			gulp.src(event.path).pipe(browserSync.reload({stream:true}));
		});

// Scss file watcher
	gulp.watch('./scss/**/*.scss', ['sass'])
		.on('change', function(event){
			console.log('File' + event.path + ' was ' + event.type + ', running tasks...')
		});
});

// Default task
gulp.task('default', ['sass', 'watch']);