!function(window, document) { "use strict";
	var name 		= 'Luxury';
	var version 	= '1.0.0';
	var settingsKey = name + '_Settings_Key_' + version;
	var settings 	= localStorage.getItem(settingsKey);

	if (settings && settings.indexOf("{") === 0) {
		settings = JSON.parse(settings);
		var interval = setInterval(function() {
			var body = document.body;
			var siteNavbar = document.querySelector('.site-navbar');
			var classList, isNavbarDark;
			siteNavbar && (
				clearInterval(interval), 
				classList = siteNavbar.classList,
				classList.forEach(function(className) {
					/bg-/.test(className) && classList.remove(className);
				}), classList.add(settings.navbar.skin),
				settings.navbar.navbarDark && (classList.remove('navbar-light'), classList.add('navbar-dark')),
				!settings.menubar.menubarDark && (body.classList.remove('menubar-dark'), body.classList.add('menubar-light')),
				settings.menubar.folded && body.classList.add('menubar-fold')
			);
		}, 5);
	}
	document.addEventListener('DOMContentLoaded', function() {
		var $body 		= $(document.body);
		var $navbar 	= $('.site-navbar');
		var $menubar 	= $('.site-menubar');
		var defaults 	= {
			navbar: {
				navbarDark: false,
				skin: 'bg-blue'
			},
			menubar: {
				menubarDark: true,
				folded: false,
				top: false
			}
		};

		var storageApi = {
			defaults: defaults || {},
			currentState: null,
			storage: window.localStorage,
			init: function() {
				if (!this.isStored()) {
					this.currentState = this.defaults,
					this.storage.setItem(settingsKey, this._stringify(this.currentState));
				}
				// the current settings = the stored settings
				this.currentState = this.retrive();
			},
			isStored: function() {
				return this.storage.hasOwnProperty(settingsKey) && !$.isEmptyObject(this.retrive());
			},
			retrive: function() {
				return this._parse(this.storage.getItem(settingsKey));
			},
			clear: function() {
				return this.storage.clear(), this;
			},
			save: function() {
				return this.storage.setItem(settingsKey, this._stringify(this.currentState)), this;
			},
			get: function(key) {
				return this.currentState[key];
			},
			set: function(key, value) {
				if (typeof this.currentState[key] === "object" && typeof value === "object") {
					$.extend(this.currentState[key], value);
				} else {
					this.currentState[key] = value;
				}
				return this;
			},
			_parse: function(input) {
				return typeof input === "string" ? JSON.parse(input) : void 0;
			},
			_stringify: function(input) {
				return JSON.stringify(input);
			}
		};

		var themeCustomizer = {
			navbarDark: false,
			navbarSkin: null,
			menubarDark: true,
			menubarFolded: false,
			init: function() {
				var _this = this;
				typeof storageApi != "undefined" && storageApi.init();

				$(document).on('change', '[data-toggle="navbarDark"]', function(e) {
					_this.navbarDark = $(this).prop("checked"), _this.toggleNavbarDark();
				}), $(document).on('change', '[data-toggle="navbarSkin"]', function(e) {
					_this.setNavbarSkin($(this).data('skin'));
				}), $(document).on('change', '[data-toggle="menubarDark"]', function(e) {
					_this.menubarDark = $(this).prop("checked"), _this.toggleMeubarDark();
				}), $(document).on('change', '[data-toggle="menubarFold"]', function(e) {
					if (!site.menubar) return;
					if ($(this).prop('checked') && !site.menubar.folded) {
						site.menubar.fold(), _this.menubarFolded = true;
					} else if(!$(this).prop('checked') && site.menubar.folded) {
						site.menubar.unFold(), _this.menubarFolded = false;
					}
				}), $(document).on('click', '#customizerSaveButton', function() {
					var $this = $(this), message = "Your Settings Saved!";
					_this.save(), $this.parents('#theme-customizer').removeClass('show');
					if (typeof swal !== "undefined") {
						swal({ title: 'Saved', text: message, type: 'success', timer: 1500, showConfirmButton: false });
					} else {
						$this.closest('section').append('<div class="flash-msg mt-4 text-success">'+message+'</div>'),
						setTimeout(function() {
							$this.closest('section').find('div.flash-msg').fadeOut();
						}, 1500);
					}
				}), $(document).on('click', '#customizerResetButton', function() {
					_this.reset();
				});

				if (storageApi.isStored()) {
					this.navbarDark = storageApi.get('navbar').navbarDark;
					this.navbarSkin = storageApi.get('navbar').skin;
					this.menubarDark = storageApi.get('menubar').menubarDark;
					this.menubarFolded = storageApi.get('menubar').folded;
				} else {
					this.navbarDark = this._isNavbarDark(),
					this.menubarDark = this._isMenubarDark(),
					this.navbarSkin = this._getAppliedNavbarSkin();
				}
				
				this.checkTheme();
			},
			save: function() {
				storageApi.set("navbar", {
					navbarDark: this.navbarDark,
					skin: this.navbarSkin
				}).set("menubar", {
					menubarDark: this.menubarDark,
					folded: this.menubarFolded
				}).save();
			},
			reset: function() {
				storageApi.clear(), location.reload();
			},
			toggleNavbarDark: function() {
				if (this.navbarDark) {
					$navbar.removeClass('navbar-light'), $navbar.addClass('navbar-dark');
				} else {
					$navbar.removeClass('navbar-dark'), $navbar.addClass('navbar-light');
				}
			},
			toggleMeubarDark: function() {
				if (this.menubarDark) {
					$body.removeClass('menubar-light'), $body.addClass('menubar-dark');
				} else {
					$body.removeClass('menubar-dark'), $body.addClass('menubar-light');
				}
			},
			setNavbarSkin: function(skin) {
				// set navbar theme (inverse|light)
				var currentSkin = this._getAppliedNavbarSkin();
				this.navbarSkin = skin, currentSkin !== skin && $navbar.addClass(skin).removeClass(currentSkin);

				return this;
			},
			checkTheme: function() {
				$('[data-toggle="navbarDark"]').prop("checked", this.navbarDark);
				$('[data-toggle="navbarSkin"][data-skin="'+this.navbarSkin+'"]').prop('checked', true);
				$('[data-toggle="menubarDark"]').prop('checked', this.menubarDark);
				$('[data-toggle="menubarFold"]').prop('checked', this.menubarFolded);
				return this;
			},
			_getAppliedNavbarSkin: function() {
				var navbar      = document.querySelector('.site-navbar');
				var currentSkin = null;

				navbar.classList.forEach(function(className) {
					className.search('bg') !== -1 && (currentSkin = className);
				});
				
				return currentSkin;
			},
			_isNavbarDark: function() {
				return $navbar.is('.navbar-dark');
			},
			_isMenubarDark: function() {
				return $body.is('.menubar-dark');
			}
		};

		themeCustomizer.init();
	});
}(window, document);