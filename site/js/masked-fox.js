/*
 *  jquery-boilerplate - v3.4.0
 *  A jump-start for jQuery plugins development.
 *  http://jqueryboilerplate.com
 *
 *  Made by Zeno Rocha
 *  Under MIT License
 */
// the semi-colon before function invocation is a safety net against concatenated
// scripts and/or other plugins which may not be closed properly.
;(function ( $, window, document, undefined ) {

	'use strict';

		// undefined is used here as the undefined global variable in ECMAScript 3 is
		// mutable (ie. it can be changed by someone else). undefined isn't really being
		// passed in so we can ensure the value of it is truly undefined. In ES5, undefined
		// can no longer be modified.

		// window and document are passed through as local variable rather than global
		// as this (slightly) quickens the resolution process and can be more efficiently
		// minified (especially when both are regularly referenced in your plugin).

		// Create the defaults once
		var pluginName = 'maskedFox',
			defaults = {
				fps: 25,
				responsive: false 
			};

		// The actual plugin constructor
		function Plugin ( element, options ) {
			this.element = element;
			// jQuery has an extend method which merges the contents of two or
			// more objects, storing the result in the first object. The first object
			// is generally empty as we don't want to alter the default options for
			// future instances of the plugin
			this.settings = $.extend( {}, defaults, options );
			this._defaults = defaults;
			this._name = pluginName;
			this.init( this );
		}

		// Avoid Plugin.prototype conflicts
		$.extend(Plugin.prototype, {
			init: function ( plugin ) {
				// Place initialization logic here
				// You already have access to the DOM element and
				// the options via the instance, e.g. this.element and this.settings
				// you can add more functions like the one below and
				// call them like so: this.yourOtherFunction(this.element, this.settings).
				
				this.wrapper = $(this.element).parent();
				this.ie9Fix = $('html').hasClass('ie9') && $(this.element).hasClass('responsive');
				
				this.mask = new Image();
				this.mask.src = this.settings.maskerImage;
				$(this.mask).on('load', function (e) {
					plugin.initVideo( plugin );
				});
				$(window).bind('resize',function(e) {
		            plugin.onResize(plugin);
		        });
		        plugin.onResize(plugin);
				
			},
			
			initVideo: function ( plugin ) {
				this.video = document.createElement('video');
				this.video.setAttribute('width', '576'); 
				this.video.setAttribute('height', '180'); 
				this.video.autoplay = true;
				this.video.loop = true;
				$(this.video).on('canplay oncanplay', function (e) {
					plugin.initCanvas( plugin );
				});
				this.addSourceToVideo( this.video, this.settings.maskedVideo, 'video/mp4' );
			},
			
			initCanvas: function ( plugin ) {
				var w = $( window ).width();
				$(this.video).off('canplay oncanplay');
				if (w>=576)
					$(plugin.element).replaceWith('<canvas id="' + this.settings.id + '" class="fox-masked" width="576" height="180"></canvas>');
				else
					$(plugin.element).replaceWith('<canvas id="' + this.settings.id + '" class="fox-masked" width="'+w+'" height="'+(w/3.2)+'"></canvas>');

				this.stage = new createjs.Stage( this.settings.id );
				
				this.cjsMask = new createjs.Bitmap( this.mask );
				if (w>=576)
					this.cjsMask.cache(0, 0, 576, 180);
				else
					this.cjsMask.cache(0, 0, w, (w/3.2));
				
				this.cjsVideo = new createjs.Bitmap( this.video );
				this.cjsVideo.x = 0;
				this.cjsVideo.y = 0;
				this.cjsVideo.filters = [
					new createjs.AlphaMaskFilter( this.cjsMask.image )
				];

				if (w>=576)
					this.cjsVideo.cache(0, 0, 576, 180);
				else
					this.cjsVideo.cache(0, 0, w, (w/3.2));
				
				this.stage.addChild( this.cjsVideo );
				
				createjs.Ticker.setFPS( this.settings.fps );
				createjs.Ticker.addEventListener('tick', function (e) {
					plugin.handleTick();
				});
				
				if( this.ie9Fix ) {
					$(window).on('resize', function (e) {
						plugin.onResize( plugin );
					});
					this.onResize( plugin );
				}

			},
			
			handleTick: function () {
				this.cjsVideo.updateCache();
				this.stage.update();
			},
			
			addSourceToVideo: function ( element, src, type ) {
				var source = document.createElement('source');
				source.src = src;
				source.type = type;

				$(this.video).append(source);
			},
			
			onResize: function ( plugin ) {
				var w = $( window ).width(),
					ow = 576,
					oh = 180,
					//scale = Math.min(w / ow, h / oh),
					scale = Math.min(w / ow);
				if( scale > 1 ) scale = 1;
				console.log("resizing");
				console.log(scale);
				console.log(w);

				$(plugin.wrapper).find('canvas').height( oh * scale );
			}
		});

		// A really lightweight plugin wrapper around the constructor,
		// preventing against multiple instantiations
		$.fn[ pluginName ] = function ( options ) {
			return this.each(function() {
					if ( !$.data( this, 'plugin_' + pluginName ) ) {
							$.data( this, 'plugin_' + pluginName, new Plugin( this, options ) );
					}
			});
		};

})( jQuery, window, document );