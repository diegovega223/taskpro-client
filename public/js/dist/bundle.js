/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./js/src/app.js":
/*!***********************!*\
  !*** ./js/src/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _darkmode__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./darkmode */ \"./js/src/darkmode.js\");\n/* harmony import */ var _darkmode__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_darkmode__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _mobileMenu__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./mobileMenu */ \"./js/src/mobileMenu.js\");\n/* harmony import */ var _mobileMenu__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_mobileMenu__WEBPACK_IMPORTED_MODULE_1__);\n\r\n\r\n\r\n(0,_darkmode__WEBPACK_IMPORTED_MODULE_0__.enableDarkMode)();\r\n(0,_mobileMenu__WEBPACK_IMPORTED_MODULE_1__.setupMobileMenu)();\r\n\n\n//# sourceURL=webpack://taskpro-frontend/./js/src/app.js?");

/***/ }),

/***/ "./js/src/darkmode.js":
/*!****************************!*\
  !*** ./js/src/darkmode.js ***!
  \****************************/
/***/ (() => {

eval("const modoSwitches = document.querySelectorAll(\".modoSwitch\");\r\n\r\n\r\nfunction cambiarModo(event) {\r\n  const switchInput = event.target;\r\n  const switchLabel = switchInput.parentElement;\r\n  const leftText = switchLabel.querySelector(\".left\");\r\n  const rightText = switchLabel.querySelector(\".right\");\r\n\r\n  if (switchInput.checked) {\r\n    leftText.classList.remove(\"active\");\r\n    rightText.classList.add(\"active\");\r\n    document.body.classList.add(\"dark\");\r\n    localStorage.setItem(\"modoDark\", \"activado\");\r\n  } else {\r\n    rightText.classList.remove(\"active\");\r\n    leftText.classList.add(\"active\");\r\n    document.body.classList.remove(\"dark\");\r\n    localStorage.setItem(\"modoDark\", \"desactivado\");\r\n  }\r\n}\r\n\r\nmodoSwitches.forEach((switchInput) => {\r\n  switchInput.addEventListener(\"change\", cambiarModo);\r\n});\r\n\r\nconst modoAlmacenado = localStorage.getItem(\"modoDark\");\r\nmodoSwitches.forEach((switchInput) => {\r\n  if (modoAlmacenado === \"activado\") {\r\n    switchInput.checked = true;\r\n    cambiarModo({ target: switchInput });\r\n  }\r\n});\r\n\n\n//# sourceURL=webpack://taskpro-frontend/./js/src/darkmode.js?");

/***/ }),

/***/ "./js/src/mobileMenu.js":
/*!******************************!*\
  !*** ./js/src/mobileMenu.js ***!
  \******************************/
/***/ (() => {

eval("const bodyElement = document.body;\r\nconst menu = document.querySelector(\".mobile-menu\");\r\n\r\nfunction mobileMenu() {\r\n\r\n  bodyElement.classList.toggle(\"mobile\");\r\n}\r\n\r\nmenu.addEventListener(\"click\", mobileMenu);\r\n\r\n\r\n\n\n//# sourceURL=webpack://taskpro-frontend/./js/src/mobileMenu.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = __webpack_require__("./js/src/app.js");
/******/ 	
/******/ })()
;