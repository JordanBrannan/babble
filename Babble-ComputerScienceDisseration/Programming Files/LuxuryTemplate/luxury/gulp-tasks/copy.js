var gulp  = require('gulp');
var bower = require('../bower.json');
var copy  = require('gulp-copy');

module.exports = function(options) {
  // - Copies the bower_components main files to
  // the specified destination directory
  //
  // - The list of files to copy (src) and the destination paths
  // are specified in the (bower.json) file
  // under (copy.src and copy.dest)
  gulp.task('copy:bower', ['clean:bower'], function() {
    return gulp.src(bower.copy.src)
      .pipe(copy(bower.copy.dest));
  });
};