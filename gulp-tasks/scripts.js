var gulp = require('gulp');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var gulpif = require('gulp-if');
var argv = require('yargs').argv;

var scriptsOptions = {
  paths: {
    src: [
      'node_modules/jquery/dist/jquery.js',
      'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
      'node_modules/slick-carousel/slick/slick.js',
      'assets/js/src/ajax_calls.js',
      'assets/js/src/general.js'

    ],
    dest: 'assets/js/dest'
  }
};

gulp.task('scripts', function() {
  gulp.src(scriptsOptions.paths.src)
    .pipe(concat('bundle.js'))
    .pipe(gulpif(!argv.dev, uglify()))
    .pipe(gulp.dest(scriptsOptions.paths.dest));
});
