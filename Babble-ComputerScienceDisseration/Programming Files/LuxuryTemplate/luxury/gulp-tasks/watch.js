var gulp = require('gulp'),
  browserSync = require('browser-sync');

// Note: ${layout} is used to refer to
// a layout directory(e.g. leftbar, topbar, basic,...)
// the (layoutDir) is set in (config/config.js) file

module.exports = function(options) {
  // runs all the watch tasks
  gulp.task('watch', [
    'watch:html', 
    'watch:sass',
    'watch:scripts'
  ]);


  // watches SASS files in the following directories:
  // - ${layout}/scss
  // - assets/global/scss
  // - assets/vendor/scss
  // - assets/examples/scss
  //
  // and runs the appropriate task
  gulp.task('watch:sass', ['sass', 'sass:global', 'sass:examples', 'sass:vendor'], function() {
    gulp.watch(options.layoutDir + '/scss/**/*.scss', ['sass']);
    gulp.watch(options.vendorDir + '/scss/**/*.scss', ['sass:vendor']);
    gulp.watch(options.examplesDir + '/scss/**/*.scss', ['sass:examples']);
    // The global dir contains the main SASS files that are imported in:
    // (global, vendor, examples, and layout) directories
    // so that we should run all sass tasks to reflect
    // the changes in all importing files
    gulp.watch(
      options.globalDir + '/scss/**/*.scss',
      ['sass', 'sass:global', 'sass:examples', 'sass:vendor']
    );
  });


  // watches .hbs(handlbars) files in the following directories:
  // - ${layout}/templates/layout
  // - ${layout}/templates/partials
  // - src/templates/layouts
  // - src/templates/partials
  // - src/views
  //
  // and reloads the browser when any HTML file
  // in the ${layout} directory is changed
  gulp.task('watch:html', ['html'], function() {
    gulp.watch([
      // specific for each individual ${layout}
      options.layoutDir + '/templates/partials/*.hbs',
      options.layoutDir + '/templates/layout/*.hbs',
      // Globaly (used by all different layouts) Layouts and partials
      options.templatesDir + '/partials/*.hbs',
      options.templatesDir + '/layouts/*.hbs',
      // views (content of all pages)
      options.viewsDir + '/**/*.hbs'
      ], ['html']
    );

    // and reloads the browser when any HTML file
    // in the ${layout} directory is changed
    gulp.watch(options.layoutDir + '/*.html').on('change', browserSync.reload);
  });


  // watches .js files in the following directories:
  // - ${layout}/js
  // - assets/global/js
  // - assets/examples/js
  //
  // and runs the appropriate task
  gulp.task('watch:scripts', ['scripts', 'scripts:global', 'scripts:examples'], function() {
    gulp.watch(options.layoutDir + '/js/**/*.js', ['scripts']);
    gulp.watch(options.globalDir + '/js/**/*.js', ['scripts:global']);
    gulp.watch(options.examplesDir + '/js/**/*.js', ['scripts:examples']);
  });
};