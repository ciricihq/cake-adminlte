var del = require('del'),
    gulp = require('gulp'),
    bower = require('gulp-bower'),
    less = require('gulp-less-sourcemap'),
    concat = require('gulp-concat'),
    cssnano = require('gulp-cssnano')
;

gulp.task('bower', function() {
  return bower();
});

gulp.task('clean', ['bower'], function() {
  return del([
    'webroot/css/AdminLTE.css',
    'webroot/css/AdminLTE.css.map',
    'webroot/css/skin-black.css',
    'webroot/css/skin-black.css.map',
    'webroot/css/bootstrap.css',
    'webroot/css/bootstrap.css.map',
    'webroot/css/admin.css'
  ]);
});

gulp.task('less.bootstrap', ['bower'], function(){
  var stream = gulp.src('./webroot/vendor/bootstrap/less/bootstrap.less')
    .pipe(less({sourceMap: {
        sourceMapRootPath: './bootstrap/less/'
    }}))
    .pipe(gulp.dest('./webroot/css'))
  ;
  return stream;
});

gulp.task('less.admin', ['bower'], function () {
  var stream = gulp.src([
      './webroot/vendor/AdminLTE/build/less/AdminLTE.less',
      './webroot/vendor/AdminLTE/build/less/skins/skin-black.less',
      './webroot/less/admin.less',
    ])
    .pipe(less({sourceMap: {
        sourceMapRootPath: './AdminLTE/build/less/'
    }}))
    .pipe(gulp.dest('./webroot/css'))
  ;
  return stream;
});

gulp.task('uglify', ['less'], function() {
  var stream = gulp.src([
    './webroot/css/bootstrap.css',
    './webroot/css/AdminLTE.css',
    './webroot/css/skin-black.css',
    './webroot/css/admin.css'
  ]).pipe(concat('admin.css'))
    .pipe(gulp.dest('./webroot/css'))
    // .pipe(rename('admin.min.css'))
    // .pipe(gulp.dest('./webroot/css'))
    .pipe(cssnano())
    .pipe(gulp.dest('./webroot/css'))
  ;
  return stream;
});

gulp.task('less', ['bower', 'clean', 'less.bootstrap', 'less.admin']);

gulp.task('compile', ['less', 'uglify'])

gulp.task('default', ['compile']);
