/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/src/modules/add-icons.js":
/*!***********************************************!*\
  !*** ./resources/js/src/modules/add-icons.js ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"addSportIcon\": () => (/* binding */ addSportIcon)\n/* harmony export */ });\n//Function adding correct image depends on which sport td represent\nfunction addSportIcon() {\n  var el = document.querySelector('.main-table__table');\n  el = el.querySelector('tbody').querySelectorAll('tr');\n  var elLength = el.length;\n\n  for (var i = 0; i < elLength; i++) {\n    var td = el[i].querySelectorAll('td');\n    var sport = td[2].textContent;\n    var sportSpan = '<span class=\"main-table__sport-span\">' + sport + '</span>';\n\n    switch (sport) {\n      case 'Football':\n        td[2].innerHTML = '<img src=\"./images/svg/football.svg\" class=\"main-table__img none\"/>' + sportSpan;\n        break;\n\n      case 'Basketball':\n        td[2].innerHTML = '<img src=\"./images/svg/basketball.svg\" class=\"main-table__img none\"/>' + sportSpan;\n        break;\n\n      case 'Tennis':\n        td[2].innerHTML = '<img src=\"./images/svg/tennis-ball.svg\" class=\"main-table__img none\"/>' + sportSpan;\n        break;\n\n      case 'Volleyball':\n        td[2].innerHTML = '<img src=\"./images/svg/volleyball.svg\" class=\"main-table__img none\"/>' + sportSpan;\n        break;\n\n      case 'Esport':\n        td[2].innerHTML = '<img src=\"./images/svg/esport.svg\" class=\"main-table__img none\"/>' + sportSpan;\n        break;\n    }\n  }\n}\n\nwindow.addEventListener('load', addSportIcon);\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvc3JjL21vZHVsZXMvYWRkLWljb25zLmpzLmpzIiwibWFwcGluZ3MiOiI7Ozs7QUFBQTtBQUNBLFNBQVNBLFlBQVQsR0FBd0I7QUFDcEIsTUFBSUMsRUFBRSxHQUFHQyxRQUFRLENBQUNDLGFBQVQsQ0FBdUIsb0JBQXZCLENBQVQ7QUFDQUYsRUFBQUEsRUFBRSxHQUFHQSxFQUFFLENBQUNFLGFBQUgsQ0FBaUIsT0FBakIsRUFBMEJDLGdCQUExQixDQUEyQyxJQUEzQyxDQUFMO0FBQ0EsTUFBSUMsUUFBUSxHQUFHSixFQUFFLENBQUNLLE1BQWxCOztBQUVBLE9BQUssSUFBSUMsQ0FBQyxHQUFHLENBQWIsRUFBZ0JBLENBQUMsR0FBR0YsUUFBcEIsRUFBOEJFLENBQUMsRUFBL0IsRUFBbUM7QUFDL0IsUUFBSUMsRUFBRSxHQUFHUCxFQUFFLENBQUNNLENBQUQsQ0FBRixDQUFNSCxnQkFBTixDQUF1QixJQUF2QixDQUFUO0FBQ0EsUUFBSUssS0FBSyxHQUFHRCxFQUFFLENBQUMsQ0FBRCxDQUFGLENBQU1FLFdBQWxCO0FBQ0EsUUFBSUMsU0FBUyxHQUNULDBDQUEwQ0YsS0FBMUMsR0FBa0QsU0FEdEQ7O0FBR0EsWUFBUUEsS0FBUjtBQUNJLFdBQUssVUFBTDtBQUNJRCxRQUFBQSxFQUFFLENBQUMsQ0FBRCxDQUFGLENBQU1JLFNBQU4sR0FDSSx3RUFDQUQsU0FGSjtBQUdBOztBQUNKLFdBQUssWUFBTDtBQUNJSCxRQUFBQSxFQUFFLENBQUMsQ0FBRCxDQUFGLENBQU1JLFNBQU4sR0FDSSwwRUFDQUQsU0FGSjtBQUdBOztBQUNKLFdBQUssUUFBTDtBQUNJSCxRQUFBQSxFQUFFLENBQUMsQ0FBRCxDQUFGLENBQU1JLFNBQU4sR0FDSSwyRUFDQUQsU0FGSjtBQUdBOztBQUNKLFdBQUssWUFBTDtBQUNJSCxRQUFBQSxFQUFFLENBQUMsQ0FBRCxDQUFGLENBQU1JLFNBQU4sR0FDSSwwRUFDQUQsU0FGSjtBQUdBOztBQUNKLFdBQUssUUFBTDtBQUNJSCxRQUFBQSxFQUFFLENBQUMsQ0FBRCxDQUFGLENBQU1JLFNBQU4sR0FDSSxzRUFDQUQsU0FGSjtBQUdBO0FBekJSO0FBMkJIO0FBQ0o7O0FBRURFLE1BQU0sQ0FBQ0MsZ0JBQVAsQ0FBd0IsTUFBeEIsRUFBZ0NkLFlBQWhDIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2pzL3NyYy9tb2R1bGVzL2FkZC1pY29ucy5qcz84NWJhIl0sInNvdXJjZXNDb250ZW50IjpbIi8vRnVuY3Rpb24gYWRkaW5nIGNvcnJlY3QgaW1hZ2UgZGVwZW5kcyBvbiB3aGljaCBzcG9ydCB0ZCByZXByZXNlbnRcbmZ1bmN0aW9uIGFkZFNwb3J0SWNvbigpIHtcbiAgICBsZXQgZWwgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcubWFpbi10YWJsZV9fdGFibGUnKTtcbiAgICBlbCA9IGVsLnF1ZXJ5U2VsZWN0b3IoJ3Rib2R5JykucXVlcnlTZWxlY3RvckFsbCgndHInKTtcbiAgICBsZXQgZWxMZW5ndGggPSBlbC5sZW5ndGg7XG5cbiAgICBmb3IgKGxldCBpID0gMDsgaSA8IGVsTGVuZ3RoOyBpKyspIHtcbiAgICAgICAgbGV0IHRkID0gZWxbaV0ucXVlcnlTZWxlY3RvckFsbCgndGQnKTtcbiAgICAgICAgbGV0IHNwb3J0ID0gdGRbMl0udGV4dENvbnRlbnQ7XG4gICAgICAgIGxldCBzcG9ydFNwYW4gPVxuICAgICAgICAgICAgJzxzcGFuIGNsYXNzPVwibWFpbi10YWJsZV9fc3BvcnQtc3BhblwiPicgKyBzcG9ydCArICc8L3NwYW4+JztcblxuICAgICAgICBzd2l0Y2ggKHNwb3J0KSB7XG4gICAgICAgICAgICBjYXNlICdGb290YmFsbCc6XG4gICAgICAgICAgICAgICAgdGRbMl0uaW5uZXJIVE1MID1cbiAgICAgICAgICAgICAgICAgICAgJzxpbWcgc3JjPVwiLi9pbWFnZXMvc3ZnL2Zvb3RiYWxsLnN2Z1wiIGNsYXNzPVwibWFpbi10YWJsZV9faW1nIG5vbmVcIi8+JyArXG4gICAgICAgICAgICAgICAgICAgIHNwb3J0U3BhbjtcbiAgICAgICAgICAgICAgICBicmVhaztcbiAgICAgICAgICAgIGNhc2UgJ0Jhc2tldGJhbGwnOlxuICAgICAgICAgICAgICAgIHRkWzJdLmlubmVySFRNTCA9XG4gICAgICAgICAgICAgICAgICAgICc8aW1nIHNyYz1cIi4vaW1hZ2VzL3N2Zy9iYXNrZXRiYWxsLnN2Z1wiIGNsYXNzPVwibWFpbi10YWJsZV9faW1nIG5vbmVcIi8+JyArXG4gICAgICAgICAgICAgICAgICAgIHNwb3J0U3BhbjtcbiAgICAgICAgICAgICAgICBicmVhaztcbiAgICAgICAgICAgIGNhc2UgJ1Rlbm5pcyc6XG4gICAgICAgICAgICAgICAgdGRbMl0uaW5uZXJIVE1MID1cbiAgICAgICAgICAgICAgICAgICAgJzxpbWcgc3JjPVwiLi9pbWFnZXMvc3ZnL3Rlbm5pcy1iYWxsLnN2Z1wiIGNsYXNzPVwibWFpbi10YWJsZV9faW1nIG5vbmVcIi8+JyArXG4gICAgICAgICAgICAgICAgICAgIHNwb3J0U3BhbjtcbiAgICAgICAgICAgICAgICBicmVhaztcbiAgICAgICAgICAgIGNhc2UgJ1ZvbGxleWJhbGwnOlxuICAgICAgICAgICAgICAgIHRkWzJdLmlubmVySFRNTCA9XG4gICAgICAgICAgICAgICAgICAgICc8aW1nIHNyYz1cIi4vaW1hZ2VzL3N2Zy92b2xsZXliYWxsLnN2Z1wiIGNsYXNzPVwibWFpbi10YWJsZV9faW1nIG5vbmVcIi8+JyArXG4gICAgICAgICAgICAgICAgICAgIHNwb3J0U3BhbjtcbiAgICAgICAgICAgICAgICBicmVhaztcbiAgICAgICAgICAgIGNhc2UgJ0VzcG9ydCc6XG4gICAgICAgICAgICAgICAgdGRbMl0uaW5uZXJIVE1MID1cbiAgICAgICAgICAgICAgICAgICAgJzxpbWcgc3JjPVwiLi9pbWFnZXMvc3ZnL2VzcG9ydC5zdmdcIiBjbGFzcz1cIm1haW4tdGFibGVfX2ltZyBub25lXCIvPicgK1xuICAgICAgICAgICAgICAgICAgICBzcG9ydFNwYW47XG4gICAgICAgICAgICAgICAgYnJlYWs7XG4gICAgICAgIH1cbiAgICB9XG59XG5cbndpbmRvdy5hZGRFdmVudExpc3RlbmVyKCdsb2FkJywgYWRkU3BvcnRJY29uKTtcblxuZXhwb3J0IHthZGRTcG9ydEljb259OyJdLCJuYW1lcyI6WyJhZGRTcG9ydEljb24iLCJlbCIsImRvY3VtZW50IiwicXVlcnlTZWxlY3RvciIsInF1ZXJ5U2VsZWN0b3JBbGwiLCJlbExlbmd0aCIsImxlbmd0aCIsImkiLCJ0ZCIsInNwb3J0IiwidGV4dENvbnRlbnQiLCJzcG9ydFNwYW4iLCJpbm5lckhUTUwiLCJ3aW5kb3ciLCJhZGRFdmVudExpc3RlbmVyIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/src/modules/add-icons.js\n");

/***/ }),

/***/ "./resources/js/src/show-filters.js":
/*!******************************************!*\
  !*** ./resources/js/src/show-filters.js ***!
  \******************************************/
/***/ (() => {

eval("var filtersIcon = document.querySelector('.nav-box__filters-icon');\nvar filters = document.querySelector('.filters');\nfiltersIcon.addEventListener('click', function () {\n  if (filtersIcon.classList.contains('show-filters')) {\n    filtersIcon.classList.remove('show-filters');\n    filtersIcon.classList.add('hide-filters');\n    filters.classList.remove('right-0');\n  } else {\n    filtersIcon.classList.remove('hide-filters');\n    filtersIcon.classList.add('show-filters');\n    filters.classList.add('right-0');\n  }\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvc3JjL3Nob3ctZmlsdGVycy5qcz83ZGY0Il0sIm5hbWVzIjpbImZpbHRlcnNJY29uIiwiZG9jdW1lbnQiLCJxdWVyeVNlbGVjdG9yIiwiZmlsdGVycyIsImFkZEV2ZW50TGlzdGVuZXIiLCJjbGFzc0xpc3QiLCJjb250YWlucyIsInJlbW92ZSIsImFkZCJdLCJtYXBwaW5ncyI6IkFBQUEsSUFBSUEsV0FBVyxHQUFHQyxRQUFRLENBQUNDLGFBQVQsQ0FBdUIsd0JBQXZCLENBQWxCO0FBQ0EsSUFBSUMsT0FBTyxHQUFHRixRQUFRLENBQUNDLGFBQVQsQ0FBdUIsVUFBdkIsQ0FBZDtBQUVBRixXQUFXLENBQUNJLGdCQUFaLENBQTZCLE9BQTdCLEVBQXNDLFlBQU07QUFDeEMsTUFBSUosV0FBVyxDQUFDSyxTQUFaLENBQXNCQyxRQUF0QixDQUErQixjQUEvQixDQUFKLEVBQW9EO0FBQ2hETixJQUFBQSxXQUFXLENBQUNLLFNBQVosQ0FBc0JFLE1BQXRCLENBQTZCLGNBQTdCO0FBQ0FQLElBQUFBLFdBQVcsQ0FBQ0ssU0FBWixDQUFzQkcsR0FBdEIsQ0FBMEIsY0FBMUI7QUFDQUwsSUFBQUEsT0FBTyxDQUFDRSxTQUFSLENBQWtCRSxNQUFsQixDQUF5QixTQUF6QjtBQUNILEdBSkQsTUFJTztBQUNIUCxJQUFBQSxXQUFXLENBQUNLLFNBQVosQ0FBc0JFLE1BQXRCLENBQTZCLGNBQTdCO0FBQ0FQLElBQUFBLFdBQVcsQ0FBQ0ssU0FBWixDQUFzQkcsR0FBdEIsQ0FBMEIsY0FBMUI7QUFDQUwsSUFBQUEsT0FBTyxDQUFDRSxTQUFSLENBQWtCRyxHQUFsQixDQUFzQixTQUF0QjtBQUNIO0FBQ0osQ0FWRCIsInNvdXJjZXNDb250ZW50IjpbImxldCBmaWx0ZXJzSWNvbiA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5uYXYtYm94X19maWx0ZXJzLWljb24nKTtcbmxldCBmaWx0ZXJzID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLmZpbHRlcnMnKTtcblxuZmlsdGVyc0ljb24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCAoKSA9PiB7XG4gICAgaWYgKGZpbHRlcnNJY29uLmNsYXNzTGlzdC5jb250YWlucygnc2hvdy1maWx0ZXJzJykpIHtcbiAgICAgICAgZmlsdGVyc0ljb24uY2xhc3NMaXN0LnJlbW92ZSgnc2hvdy1maWx0ZXJzJyk7XG4gICAgICAgIGZpbHRlcnNJY29uLmNsYXNzTGlzdC5hZGQoJ2hpZGUtZmlsdGVycycpO1xuICAgICAgICBmaWx0ZXJzLmNsYXNzTGlzdC5yZW1vdmUoJ3JpZ2h0LTAnKVxuICAgIH0gZWxzZSB7XG4gICAgICAgIGZpbHRlcnNJY29uLmNsYXNzTGlzdC5yZW1vdmUoJ2hpZGUtZmlsdGVycycpO1xuICAgICAgICBmaWx0ZXJzSWNvbi5jbGFzc0xpc3QuYWRkKCdzaG93LWZpbHRlcnMnKTtcbiAgICAgICAgZmlsdGVycy5jbGFzc0xpc3QuYWRkKCdyaWdodC0wJylcbiAgICB9XG59KSJdLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvc3JjL3Nob3ctZmlsdGVycy5qcy5qcyIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/src/show-filters.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The require scope
/******/ 	var __webpack_require__ = {};
/******/ 	
/************************************************************************/
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
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	__webpack_modules__["./resources/js/src/modules/add-icons.js"](0, {}, __webpack_require__);
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/src/show-filters.js"](0, __webpack_exports__, __webpack_require__);
/******/ 	
/******/ })()
;