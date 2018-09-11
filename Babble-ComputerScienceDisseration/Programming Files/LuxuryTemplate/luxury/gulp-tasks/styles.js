"use strict";

var gulp = require('gulp'),
	browserSync = require('browser-sync'),
	$ = require('gulp-load-plugins')({
	  pattern: ['gulp-*', 'gulp.*', 'del']
	});


module.exports = function(options) {
	// Used for SASS files that are in the (${layout}/scss) directory
	gulp.task('sass', function() {
		return gulp.src(options.layoutDir + "/scss/**/*.scss")
			.pipe($.plumber())
			.pipe($.sourcemaps.init())
			.pipe($.sass().on('error', $.sass.logError))
			.pipe($.autoprefixer({browsers: ['> 1%', 'last 3 versions', 'Firefox ESR']}))
			.pipe($.sourcemaps.write())
			.pipe(gulp.dest(options.layoutDir + '/css'))
			.pipe(browserSync.stream());
	});

	// Used for SASS files that are in the (global/scss) directory
	gulp.task('sass:global', function() {
		return gulp.src(options.globalDir + "/scss/**/*.scss")
			.pipe($.plumber())
			.pipe($.sourcemaps.init())
			.pipe($.sass().on('error', $.sass.logError))
			.pipe($.autoprefixer({browsers: ['> 1%', 'last 3 versions', 'Firefox ESR']}))
			.pipe($.sourcemaps.write())
			.pipe(gulp.dest(options.globalDir + '/css'))
			.pipe(browserSync.stream());
	});

	// Used for SASS files that are in the (examples/scss) directory
	gulp.task('sass:examples', function() {
		return gulp.src(options.examplesDir + "/scss/**/*.scss")
			.pipe($.plumber())
			.pipe($.sourcemaps.init())
			.pipe($.sass().on('error', $.sass.logError))
			.pipe($.autoprefixer({browsers: ['> 1%', 'last 3 versions', 'Firefox ESR']}))
			.pipe($.sourcemaps.write())
			.pipe(gulp.dest(options.examplesDir + '/css'))
			.pipe(browserSync.stream());
	});

	// Used for SASS files that are in the (vendor/scss) directory
	gulp.task('sass:vendor', function() {
		return gulp.src(options.vendorDir + "/scss/**/*.scss")
			.pipe($.plumber())
			.pipe($.sourcemaps.init())
			.pipe($.sass().on('error', $.sass.logError))
			.pipe($.autoprefixer({browsers: ['> 1%', 'last 3 versions', 'Firefox ESR']}))
			.pipe($.sourcemaps.write())
			.pipe(gulp.dest(options.vendorDir + '/css'))
			.pipe(browserSync.stream());
	});

	// Compiles .scss files from assets folder and
	// the current working layout
	gulp.task('sass:all', [
		'sass',
		'sass:global',
		'sass:examples',
		'sass:vendor'
	]);


	// Compiles .scss files from all layouts at once
	gulp.task('sass:layouts', function() {
		options.layouts.forEach(function(layout) {
			return gulp.src(layout.path + "/scss/**/*.scss")
				.pipe($.plumber())
				.pipe($.sourcemaps.init())
				.pipe($.sass().on('error', $.sass.logError))
				.pipe($.autoprefixer({browsers: ['> 1%', 'last 3 versions', 'Firefox ESR']}))
				.pipe($.sourcemaps.write())
				.pipe(gulp.dest(layout.path + '/css'));
		});
	});

	// Compiles .scss files from assets folder and
	// all layouts
	gulp.task('sass:all:layouts', [
		'sass:layouts',
		'sass:global',
		'sass:examples',
		'sass:vendor'
	]);
};