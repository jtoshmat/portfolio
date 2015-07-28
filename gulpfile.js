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
gulp.task('build',  ['lint', 'build-css', 'build-js', 'copy-html', 'copy-images', 'copy-static']);

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
    .pipe(gulp.dest('public/css'));
});

// build-js: minify and concat js, copy to dist
gulp.task('build-js', function() {
  return gulp.src('src/js/**/*.js')
    .pipe(sourcemaps.init())
    .pipe(concat('scripts.js'))
    //only uglify if gulp is ran with '--type production'
    .pipe(gutil.env.type === 'production' ? uglify() : gutil.noop())
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('public/js'));
});

// copy tasks
gulp.task('copy-html', function() {
  gulp.src('src/*.html').pipe(gulp.dest('dist'));
});

gulp.task('copy-images', function() {
  gulp.src('src/img/*').pipe(gulp.dest('public/img'));
});

gulp.task('copy-static', function() {
  return gulp.src(['src/static/**/*', 'src/static/**/.*'])
    .pipe(gulp.dest('public'));
});

// Watch files for changes, on change, call compile tasks
gulp.task('watch', function() {
  gulp.watch('src/js/**/*.js', ['lint', 'build-js']);
  gulp.watch('src/scss/**/*.scss', ['build-css']);
  gulp.watch('src/*.html', ['copy-html']);
  gulp.watch('src/img/*', ['copy-images']);
  gulp.watch('src/static/**/*', ['copy-static']);
  gulp.watch('src/static/**/.*', ['copy-static']);
});

// Task to clean the public folder
gulp.task('clean', function() {
  del([
  'public/**/*'
  ]);
});
