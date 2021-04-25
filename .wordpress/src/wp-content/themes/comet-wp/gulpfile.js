'use strict';
const gulp = require('gulp');
const less = require('gulp-less');
const autoprefixer = require('gulp-autoprefixer');
const wpPot = require('gulp-wp-pot');
const sort = require('gulp-sort');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const minifyCss = require('gulp-minify-css');

gulp.task('less', () => {
  return gulp.src('./assets/css/theme.less')
    .pipe(less())
    .pipe(gulp.dest('./assets/css/'))
});

gulp.task('concat', function() {
  return gulp.src('./assets/js/lib/*.js')
    .pipe(concat('bundle.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./assets/js/'));
});

gulp.task('concat-css', function() {
  return gulp.src('./assets/css/lib/*.css')
    .pipe(concat('bundle.css'))
    .pipe(minifyCss())
    .pipe(gulp.dest('./assets/css/'));
});

gulp.task('pot', () => {
  return gulp.src('./**/*.php')
    .pipe(sort())
    .pipe(wpPot( {
      domain: 'comet-wp',
      destFile: 'comet-wp.pot',
      package: 'comet-wp',
      bugReport: 'http://hody.co',
      lastTranslator: 'HodyLab <support@hody.co>',
      team: 'Team Team <support@hody.co>'
    } ))
    .pipe(gulp.dest('./languages'));
});

gulp.task('default', ['less'], () => {

    /*browserSync({
        server: './',
        port: 8000,
        open: false,
        notify: false,
        reloadDelay: 1000
    });*/

    gulp.watch('./assets/css/*.less',       ['less']);
});
