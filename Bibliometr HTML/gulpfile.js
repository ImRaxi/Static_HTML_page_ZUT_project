var gulp = require('gulp');
var sass = require('gulp-sass');
var uglifycss = require('gulp-uglifycss');
var concat = require('gulp-concat');
 
gulp.task('mincss', function () {
  return gulp.src('./css/*.css')
    .pipe(uglifycss({
      "maxLineLen": 80,
      "uglyComments": true
    }))
    .pipe(gulp.dest('./min/'));
});

gulp.task('js', function () {
  return gulp.src('./js/*.js')
    .pipe(uglifycss({
      "maxLineLen": 80,
      "uglyComments": true
    }))
    .pipe(gulp.dest('./dist/'));
});

sass.compiler = require('node-sass');

gulp.task('sass', function () {
  return gulp.src('./sass/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./css'));
});

gulp.task('allcss', function() {
  return gulp.src('./min/*.css')
    .pipe(concat('all.css'))
    .pipe(gulp.dest('./dist/'));
});

gulp.task('alljs', function() {
  return gulp.src('./js/*.js')
    .pipe(concat('all.js'))
    .pipe(gulp.dest('./dist/'));
});

gulp.task('minallcss', function () {
  return gulp.src('./dist/*.css')
    .pipe(uglifycss({
      "maxLineLen": 80,
      "uglyComments": true
    }))
    .pipe(gulp.dest('./min/'));
});