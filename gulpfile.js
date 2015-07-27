// Include Gulp
var gulp = require('gulp'),
  gutil = require('gulp-util'),
  jshint = require('gulp-jshint'),
  sourcemaps = require('gulp-sourcemaps'),
  sass = require('gulp-sass'),
  concat = require('gulp-concat'),
  uglify = require('gulp-uglify'),
  del = require('del');

// Default Task
gulp.task('default', ['build', 'watch']);

// Build Tasks
gulp.task('build',  ['lint', 'build-css', 'build-js', 'copy-html']);

// lint: Ensure JavaScript is free of errors
gulp.task('lint', function() {
  return gulp.src('src/js/*.js')
    .pipe(jshint())
    .pipe(jshint.reporter('default'));
});

// build-css: compile sass to css, copy to dist
gulp.task('build-css', function() {
  return gulp.src('src/scss/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('dist/css'));
});

// build-js: minify and concat js, copy to dist
gulp.task('build-js', function() {
  return gulp.src('src/js/**/*.js')
    .pipe(sourcemaps.init())
    .pipe(concat('scripts.js'))
    //only uglify if gulp is ran with '--type production'
    .pipe(gutil.env.type === 'production' ? uglify() : gutil.noop())
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('dist/js'));
});

gulp.task('copy-html', function() {
  gulp.src('src/*.html').pipe(gulp.dest('dist'));
});

// Watch files for changes, on change, call compile tasks
gulp.task('watch', function() {
  gulp.watch('src/js/**/*.js', ['lint', 'build-js']);
  gulp.watch('src/scss/**/*.scss', ['build-css']);
  gulp.watch('src/*.html', ['copy-html']);
});

// Task to clean the dist folder
gulp.task('clean', function() {
  del([
  'dist/**/*'
  ]);
});
