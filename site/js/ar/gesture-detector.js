/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 23);
/******/ })
/************************************************************************/
/******/ ({

/***/ 23:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(24);


/***/ }),

/***/ 24:
/***/ (function(module, exports) {

// Component that detects and emits events for touch gestures

AFRAME.registerComponent("gesture-detector", {
  schema: {
    element: { default: "" }
  },

  init: function init() {
    this.targetElement = this.data.element && document.querySelector(this.data.element);

    if (!this.targetElement) {
      this.targetElement = this.el;
    }

    this.internalState = {
      previousState: null
    };

    this.emitGestureEvent = this.emitGestureEvent.bind(this);

    this.targetElement.addEventListener("touchstart", this.emitGestureEvent);

    this.targetElement.addEventListener("touchend", this.emitGestureEvent);

    this.targetElement.addEventListener("touchmove", this.emitGestureEvent);
  },

  remove: function remove() {
    this.targetElement.removeEventListener("touchstart", this.emitGestureEvent);

    this.targetElement.removeEventListener("touchend", this.emitGestureEvent);

    this.targetElement.removeEventListener("touchmove", this.emitGestureEvent);
  },

  emitGestureEvent: function emitGestureEvent(event) {
    var currentState = this.getTouchState(event);

    var previousState = this.internalState.previousState;

    var gestureContinues = previousState && currentState && currentState.touchCount == previousState.touchCount;

    var gestureEnded = previousState && !gestureContinues;

    var gestureStarted = currentState && !gestureContinues;

    if (gestureEnded) {
      var eventName = this.getEventPrefix(previousState.touchCount) + "fingerend";

      this.el.emit(eventName, previousState);

      this.internalState.previousState = null;
    }

    if (gestureStarted) {
      currentState.startTime = performance.now();

      currentState.startPosition = currentState.position;

      currentState.startSpread = currentState.spread;

      var _eventName = this.getEventPrefix(currentState.touchCount) + "fingerstart";

      this.el.emit(_eventName, currentState);

      this.internalState.previousState = currentState;
    }

    if (gestureContinues) {
      var eventDetail = {
        positionChange: {
          x: currentState.position.x - previousState.position.x,

          y: currentState.position.y - previousState.position.y
        }
      };

      if (currentState.spread) {
        eventDetail.spreadChange = currentState.spread - previousState.spread;
      }

      // Update state with new data

      Object.assign(previousState, currentState);

      // Add state data to event detail

      Object.assign(eventDetail, previousState);

      var _eventName2 = this.getEventPrefix(currentState.touchCount) + "fingermove";

      this.el.emit(_eventName2, eventDetail);
    }
  },


  getTouchState: function getTouchState(event) {
    if (event.touches.length === 0) {
      return null;
    }

    // Convert event.touches to an array so we can use reduce

    var touchList = [];

    for (var i = 0; i < event.touches.length; i++) {
      touchList.push(event.touches[i]);
    }

    var touchState = {
      touchCount: touchList.length
    };

    // Calculate center of all current touches

    var centerPositionRawX = touchList.reduce(function (sum, touch) {
      return sum + touch.clientX;
    }, 0) / touchList.length;

    var centerPositionRawY = touchList.reduce(function (sum, touch) {
      return sum + touch.clientY;
    }, 0) / touchList.length;

    touchState.positionRaw = { x: centerPositionRawX, y: centerPositionRawY };

    // Scale touch position and spread by average of window dimensions

    var screenScale = 2 / (window.innerWidth + window.innerHeight);

    touchState.position = {
      x: centerPositionRawX * screenScale,
      y: centerPositionRawY * screenScale
    };

    // Calculate average spread of touches from the center point

    if (touchList.length >= 2) {
      var spread = touchList.reduce(function (sum, touch) {
        return sum + Math.sqrt(Math.pow(centerPositionRawX - touch.clientX, 2) + Math.pow(centerPositionRawY - touch.clientY, 2));
      }, 0) / touchList.length;

      touchState.spread = spread * screenScale;
    }

    return touchState;
  },

  getEventPrefix: function getEventPrefix(touchCount) {
    var numberNames = ["one", "two", "three", "many"];

    return numberNames[Math.min(touchCount, 4) - 1];
  }
});

/***/ })

/******/ });