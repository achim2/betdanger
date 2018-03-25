var gulp = require('gulp'),
    plumber = require('gulp-plumber'),
    sass = require('gulp-sass'),
    notify = require('gulp-notify'),
    sourcemaps = require('gulp-sourcemaps'),
    autoprefixer  = require('gulp-autoprefixer'),
    gulpif = require('gulp-if'),
    argv = require('yargs').argv;

var dist = 'assets/';
var distCss = dist + 'css/';

var paths = {
    scss : [
        dist + 'scss/**/*.scss'
    ]
};


gulp.task('sass', function() {

    var outputStyle = (argv.dev) ? 'expanded' : 'compressed';

    return gulp.src(paths.scss)
        .pipe(plumber())
        .pipe(gulpif(argv.dev, sourcemaps.init()))
        .pipe(sass({
            outputStyle: outputStyle
        })).on('error', notify.onError(function (error) {
            return error.message;
        }))
        .pipe(autoprefixer({
            browsers: [
                'Chrome >= 45',
                'Firefox >= 45',
                'Edge >= 12',
                'Explorer >= 9',
                'iOS >= 8',
                'Safari >= 8',
                'Android 2.3',
                'Android >= 4',
                'Opera >= 12'
            ]
        }))
        .pipe(gulpif(argv.dev, sourcemaps.write('./')))
        .pipe(gulp.dest(distCss))
});

gulp.task('watch', function() {
    gulp.watch(paths.scss, ['sass']);
});

gulp.task('default', ['sass', 'watch']);