var gulp = require('gulp');
var sass = require('gulp-sass');
var plumber = require('gulp-plumber');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');
var notify = require('gulp-notify');
var gulpif = require('gulp-if');
var argv = require('yargs').argv;

var sassOptions = {
  paths: {
    src: 'assets/scss/**/*.scss',
    dest: 'assets/css'
  },
  autoprefixer: [
  'Chrome >= 45', 'Firefox >= 45', 'Edge >= 12', 'Explorer >= 9', 'iOS >= 8', 'Safari >= 8', 'Android 2.3', 'Android >= 4', 'Opera >= 12'
  ]
};

gulp.task('sass', function() {

  var outputStyle = (argv.dev) ? 'expanded' : 'compressed';

  gulp.src(sassOptions.paths.src)
    .pipe(plumber())
    .pipe(gulpif(argv.dev, sourcemaps.init()))
    .pipe(sass({
      outputStyle: outputStyle
    })).on('error', notify.onError(function (error) {
      return error.message;
    }))
    .pipe(autoprefixer(sassOptions.autoprefixer))
    .pipe(gulpif(argv.dev, sourcemaps.write('./')))
    .pipe(gulp.dest(sassOptions.paths.dest));
});
