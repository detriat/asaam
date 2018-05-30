var gulp         = require('gulp'),
	cssmin       = require('gulp-cssmin'),
	autoprefixer = require('gulp-autoprefixer'),
	cleanCSS     = require('gulp-clean-css'),
	rename       = require('gulp-rename'),
	concat       = require('gulp-concat'),
	uglify       = require('gulp-uglify'),
	imagemin     = require('gulp-imagemin'),
    del          = require('del');

gulp.task('styles', function () {
	return gulp.src('./development/css/**/*.css')
        .pipe(autoprefixer({browsers: ['last 15 versions'], cascade: false}))
		.pipe(rename({suffix: '.min', prefix : ''}))
		.pipe(gulp.dest('./public/css'));
});

gulp.task('libs-scripts', function() {
    return gulp.src([
        './development/libs/jquery/jquery-1.11.2.min.js'
    ])
        .pipe(concat('libs.js'))
        .pipe(uglify())
        .pipe(rename({suffix: '.min', prefix : ''}))
        .pipe(gulp.dest('./public/js/'));
});

gulp.task('common-scripts', function () {
	return gulp.src('./development/js/common.js')
        /*.pipe(uglify())*/
        .pipe(rename({suffix: '.min', prefix : ''}))
        .pipe(gulp.dest('./public/js/'));
});

gulp.task('imagemin', function () {
    return gulp.src('./development/img/**/*')
        .pipe(imagemin({
            interlaced: true,
            progressive: true,
            svgoPlugins: [{removeViewBox: false}]
        }))
        .pipe(gulp.dest('./public/img'));
});

gulp.task('watch', function () {
    gulp.watch('development/css/**/*.css', ['styles']);
    /*gulp.watch('development/img/!**!/!*.*', ['imagemin']);*/
    gulp.watch('development/js/common.js', ['common-scripts']);
});

