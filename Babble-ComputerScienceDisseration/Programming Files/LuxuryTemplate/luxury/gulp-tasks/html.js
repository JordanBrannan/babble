'use strict';

var gulp      = require('gulp');
var data      = require('../config/site.json');
var $         = require('gulp-load-plugins')();
var baseWatch = require('base-watch');
var assemble  = null;

function start() {
  assemble = require('assemble')();
  assemble.use(baseWatch());
  assemble.data(data);
  assemble.engine('*', require('engine-handlebars'));
  assemble.on('postRender', function(view) {
    console.log(' assembled >', view.relative);
  });
}

module.exports = function(config) {
  // assembles the currentWorking layout specified in configuration
  // if a --file option is provided this task will assemble specified file only
  gulp.task('html', function() {
    var args = process.argv;
    var src;

    if (args[3] && /--file/.test(args[3])) {
      var filename = args[3].substring(args[3].indexOf('=') + 1);
      src = config.viewsDir + '/' + filename + '.hbs';
    } else {
      src = config.viewsDir + '/**/*.hbs';
    }

    return start(), assemble.layouts([
      config.templatesDir + '/layouts/*.hbs',
      config.layoutDir + '/templates/layout/*.hbs'
    ]), assemble.partials([
      config.templatesDir + '/partials/*.hbs',
      config.layoutDir + '/templates/partials/*.hbs'
    ]), assemble.src([src], {layout: config.layout + '.hbs'})
      .pipe(assemble.renderFile('*'))
      .pipe($.extname())
      .pipe($.flatten())
      .pipe(assemble.dest(config.layoutDir));
  });

  // assembles all layouts at once
  // the list of layouts is specified in config/gulp.js
  gulp.task('html:all', function() {
    return config.layouts.forEach(function(layout) {
      return start(), assemble.layouts([
        config.templatesDir + '/layouts/*.hbs',
        layout.path + '/templates/layout/*.hbs'
      ]), assemble.partials([
        config.templatesDir + '/partials/*.hbs',
        layout.path + '/templates/partials/*.hbs'
      ]), assemble.src([config.viewsDir + '/**/*.hbs'], {layout: layout.name + '.hbs'})
        .pipe(assemble.renderFile('*'))
        .pipe($.extname())
        .pipe($.flatten())
        .pipe(assemble.dest(layout.path));
    });
  });
};