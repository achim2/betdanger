var gulp = require('gulp');
var browserSync = require('browser-sync').create();
var requireDir = require('require-dir');
var fs = require('fs');

requireDir('./gulp-tasks');

gulp.task('bs', ['watch'], function() {
  if (fs.existsSync('gulp-config.json')) {
    var config = require('./gulp-config.json');

    browserSync.init({
      proxy: config.browsersync.proxy
    });
  } else {
    console.log('Create a gulp-config.json file from gulp-config.json.sample');
  }
});

gulp.task('watch', function () {
  gulp.watch('assets/scss/**/*.scss', ['sass']);
  gulp.watch('assets/js/**/*.js', ['scripts']);
});

gulp.task('default', ['sass', 'scripts', 'watch']);




