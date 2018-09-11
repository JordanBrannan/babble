"use strict";

var gulp = require('gulp');
var svgSprite = require('gulp-svg-sprite');

var config = {
  mode: {
    symbol: { // symbol mode to build the SVG
      dest: 'svg-sprite', // destination foldeer
      sprite: 'sprite.svg', //sprite name
      example: true, // Build sample page
      dimensions: '-icon',
      render: {
        scss: true
      }
    }
  },
  svg: {
    xmlDeclaration: false, // strip out the XML attribute
    doctypeDeclaration: false // don't include the !DOCTYPE declaration
  }
}

module.exports = function(options) {
  gulp.task('svg', function() {
    return gulp.src(options.globalDir + '/svg/**/*.svg')
      .pipe(svgSprite(config))
      .pipe(gulp.dest(options.globalDir));
  });
};