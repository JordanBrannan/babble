"use strict";

var fs      = require('fs-extra');
var options = require("./config/gulp");

fs.walkSync('./gulp-tasks').forEach(function (file) {
  require('./'+file)(options);
});