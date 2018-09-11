var path = require('path');

// Those are the configurable variables
// if you changed the default folder names
// you should change those variables accordingly
var srcDir = 'src'; // source files
var distDir = 'dist'; // distribution director
var assetsDir = path.join(srcDir, 'assets');

// this is the current working layout
// this defines which layout the gulp tasks work on
// so that it must match the layout's folder name
// there is a list of all available layout names below (config.layouts)
var workingLayout = 'iconbar';


var config = {
	srcDir: srcDir,
	distDir: distDir,
	layout: workingLayout,
  layoutDir: path.join(srcDir, workingLayout),
  assetsDir: assetsDir,
  globalDir: path.join(assetsDir, 'global'),
  vendorDir: path.join(assetsDir, 'vendor'),
  examplesDir: path.join(assetsDir, 'examples'),
  viewsDir: path.join(srcDir, 'views'),
  templatesDir: path.join(srcDir, 'templates'),
	layouts: [
    {name: 'basic',  path: path.join(srcDir, 'basic')},
    {name: 'iconbar',  path: path.join(srcDir, 'iconbar')},
    {name: 'leftbar',   path: path.join(srcDir, 'leftbar')},
    {name: 'topbar',    path: path.join(srcDir, 'topbar')}
  ]
};

module.exports = config;
