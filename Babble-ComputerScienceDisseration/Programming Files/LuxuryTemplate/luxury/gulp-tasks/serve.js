var gulp = require('gulp'),
  browserSync = require('browser-sync');

module.exports = function(options) {
  gulp.task('serve', ['watch'], function() {
    browserSync({
      notify: false,
      port: 9000,
      server: {
        baseDir: [options.srcDir],
        routes: {'/bower_components': 'bower_components'}
      }
    });
  });

  gulp.task('serve:dist', function() {
    browserSync({
      notify: false,
      port: 9000,
      server: {
        baseDir: [options.distDir],
      }
    });
  });
};