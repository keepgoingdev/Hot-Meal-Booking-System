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
/******/ 	return __webpack_require__(__webpack_require__.s = 81);
/******/ })
/************************************************************************/
/******/ ({

/***/ 2:
/***/ (function(module, exports) {

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

var serialize = function serialize(obj, prefix) {
    var str = [];
    Object.keys(obj).forEach(function (p) {
        var k = prefix ? prefix + "[" + p + "]" : p;
        var v = obj[p];
        str.push(v !== null && (typeof v === "undefined" ? "undefined" : _typeof(v)) === "object" ? serialize(v, k) : k + "=" + v);
    });
    return str.join("&");
};

var fetchFromApi = function fetchFromApi(url, params) {
    return new Promise(function (resolve) {
        fetch(url + "?" + serialize(params), {
            credentials: 'same-origin'
        }).then(function (result) {
            return result.json();
        }).then(function (response) {
            return resolve(response);
        });
    });
};

var putToApi = function putToApi(url, params) {
    return new Promise(function (resolve) {
        fetch(url + "?" + serialize(params), {
            method: 'put',
            credentials: 'same-origin'
        }).then(function (result) {
            return result.json();
        }).then(function (response) {
            return resolve(response);
        });
    });
};
var postToApi = function postToApi(url, data) {
    return new Promise(function (resolve) {
        fetch("" + url, {
            method: 'post',
            body: data,
            credentials: 'same-origin'
        }).then(function (result) {
            return result.json();
        }).then(function (response) {
            return resolve(response);
        });
    });
};

var deleteToApi = function deleteToApi(url, params) {
    return new Promise(function (resolve) {
        fetch(url + "?" + serialize(params), {
            method: 'delete',
            credentials: 'same-origin'
        }).then(function (result) {
            return result.json();
        }).then(function (response) {
            return resolve(response);
        });
    });
};

module.exports = {
    fetchFromApi: fetchFromApi,
    putToApi: putToApi,
    postToApi: postToApi,
    deleteToApi: deleteToApi
};

/***/ }),

/***/ 81:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(2);


/***/ })

/******/ });