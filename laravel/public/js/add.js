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

/***/ "./resources/js/src/add/events.js":
/*!****************************************!*\
  !*** ./resources/js/src/add/events.js ***!
  \****************************************/
/***/ (() => {

eval("var resultBox = document.querySelector('.add-bet__result-box');\nvar resultList = document.querySelector('.add-bet__result-list');\nresultBox.addEventListener('click', function () {\n  var className = 'max-height-8';\n  resultList.classList.contains(className) ? resultList.classList.remove(className) : resultList.classList.add(className);\n});\nresultList.addEventListener('click', function (e) {\n  var resultInput = resultBox.querySelector('input');\n  var result = e.target.textContent;\n  resultInput.value = result;\n  resultBox.querySelector('span').textContent = result;\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvc3JjL2FkZC9ldmVudHMuanM/YjRjYyJdLCJuYW1lcyI6WyJyZXN1bHRCb3giLCJkb2N1bWVudCIsInF1ZXJ5U2VsZWN0b3IiLCJyZXN1bHRMaXN0IiwiYWRkRXZlbnRMaXN0ZW5lciIsImNsYXNzTmFtZSIsImNsYXNzTGlzdCIsImNvbnRhaW5zIiwicmVtb3ZlIiwiYWRkIiwiZSIsInJlc3VsdElucHV0IiwicmVzdWx0IiwidGFyZ2V0IiwidGV4dENvbnRlbnQiLCJ2YWx1ZSJdLCJtYXBwaW5ncyI6IkFBQUEsSUFBSUEsU0FBUyxHQUFHQyxRQUFRLENBQUNDLGFBQVQsQ0FBdUIsc0JBQXZCLENBQWhCO0FBQ0EsSUFBSUMsVUFBVSxHQUFHRixRQUFRLENBQUNDLGFBQVQsQ0FBdUIsdUJBQXZCLENBQWpCO0FBRUFGLFNBQVMsQ0FBQ0ksZ0JBQVYsQ0FBMkIsT0FBM0IsRUFBb0MsWUFBTTtBQUN0QyxNQUFJQyxTQUFTLEdBQUcsY0FBaEI7QUFDQUYsRUFBQUEsVUFBVSxDQUFDRyxTQUFYLENBQXFCQyxRQUFyQixDQUE4QkYsU0FBOUIsSUFDTUYsVUFBVSxDQUFDRyxTQUFYLENBQXFCRSxNQUFyQixDQUE0QkgsU0FBNUIsQ0FETixHQUVNRixVQUFVLENBQUNHLFNBQVgsQ0FBcUJHLEdBQXJCLENBQXlCSixTQUF6QixDQUZOO0FBR0gsQ0FMRDtBQU9BRixVQUFVLENBQUNDLGdCQUFYLENBQTRCLE9BQTVCLEVBQXFDLFVBQUNNLENBQUQsRUFBTztBQUN4QyxNQUFJQyxXQUFXLEdBQUdYLFNBQVMsQ0FBQ0UsYUFBVixDQUF3QixPQUF4QixDQUFsQjtBQUNBLE1BQUlVLE1BQU0sR0FBR0YsQ0FBQyxDQUFDRyxNQUFGLENBQVNDLFdBQXRCO0FBQ0FILEVBQUFBLFdBQVcsQ0FBQ0ksS0FBWixHQUFvQkgsTUFBcEI7QUFDQVosRUFBQUEsU0FBUyxDQUFDRSxhQUFWLENBQXdCLE1BQXhCLEVBQWdDWSxXQUFoQyxHQUE4Q0YsTUFBOUM7QUFDSCxDQUxEIiwic291cmNlc0NvbnRlbnQiOlsibGV0IHJlc3VsdEJveCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5hZGQtYmV0X19yZXN1bHQtYm94Jyk7XG5sZXQgcmVzdWx0TGlzdCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5hZGQtYmV0X19yZXN1bHQtbGlzdCcpO1xuXG5yZXN1bHRCb3guYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCAoKSA9PiB7XG4gICAgbGV0IGNsYXNzTmFtZSA9ICdtYXgtaGVpZ2h0LTgnO1xuICAgIHJlc3VsdExpc3QuY2xhc3NMaXN0LmNvbnRhaW5zKGNsYXNzTmFtZSlcbiAgICAgICAgPyByZXN1bHRMaXN0LmNsYXNzTGlzdC5yZW1vdmUoY2xhc3NOYW1lKVxuICAgICAgICA6IHJlc3VsdExpc3QuY2xhc3NMaXN0LmFkZChjbGFzc05hbWUpO1xufSk7XG5cbnJlc3VsdExpc3QuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCAoZSkgPT4ge1xuICAgIGxldCByZXN1bHRJbnB1dCA9IHJlc3VsdEJveC5xdWVyeVNlbGVjdG9yKCdpbnB1dCcpO1xuICAgIGxldCByZXN1bHQgPSBlLnRhcmdldC50ZXh0Q29udGVudDtcbiAgICByZXN1bHRJbnB1dC52YWx1ZSA9IHJlc3VsdDtcbiAgICByZXN1bHRCb3gucXVlcnlTZWxlY3Rvcignc3BhbicpLnRleHRDb250ZW50ID0gcmVzdWx0O1xufSk7Il0sImZpbGUiOiIuL3Jlc291cmNlcy9qcy9zcmMvYWRkL2V2ZW50cy5qcy5qcyIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/src/add/events.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/src/add/events.js"]();
/******/ 	
/******/ })()
;