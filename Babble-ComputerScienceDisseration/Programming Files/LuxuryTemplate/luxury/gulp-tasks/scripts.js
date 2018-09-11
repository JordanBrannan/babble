var gulp = require('gulp');
var browserSync = require('browser-sync');

module.exports = function(options) {
  // used for js files that are in the (${layout}/assets/js) directory
  gulp.task('scripts', function(){
    return gulp.src(options.layoutDir + "/js/*.js")
      .pipe(browserSync.stream());
  });

  // used for js files that are in the (global/js) directory
  gulp.task('scripts:global', function() {
    return gulp.src(options.globalDir + "/js/*.js")
      .pipe(browserSync.stream());
  });

  // used for js files that are in the (examples/js) directory
  gulp.task('scripts:examples', function() {
    return gulp.src(options.examplesDir + "/js/*.js")
      .pipe(browserSync.stream());
  });
};