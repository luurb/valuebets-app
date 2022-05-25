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

/***/ "./resources/js/src/dashboard/events.js":
/*!**********************************************!*\
  !*** ./resources/js/src/dashboard/events.js ***!
  \**********************************************/
/***/ (() => {

eval("//Change input text when file was choosen\nvar imageUploadInput = document.querySelector('.dashboard__file-input input');\nvar imageUploadSpan = document.querySelector('.dashboard__file-input span');\nimageUploadInput.addEventListener('change', function () {\n  var fileName = imageUploadInput.files[0].name;\n  imageUploadSpan.textContent = fileName;\n}); //Delete account message with confirmation\n\nvar deleteDiv = document.querySelector('.dashboard__delete-div');\ndeleteDiv.addEventListener('click', function () {\n  var infoDiv = document.createElement('div');\n  var form = deleteDiv.parentNode;\n  infoDiv.className = 'error-text';\n  infoDiv.textContent = 'Please confirm (all your data will be deleted)';\n  form.insertBefore(infoDiv, deleteDiv);\n  var deleteButton = document.createElement('button');\n  deleteButton.className = 'dashboard__delete-button';\n  deleteButton.type = 'submit';\n  deleteButton.textContent = 'Confirm';\n  form.removeChild(deleteDiv);\n  form.appendChild(deleteButton);\n}); //Edit name//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvc3JjL2Rhc2hib2FyZC9ldmVudHMuanM/N2NkMSJdLCJuYW1lcyI6WyJpbWFnZVVwbG9hZElucHV0IiwiZG9jdW1lbnQiLCJxdWVyeVNlbGVjdG9yIiwiaW1hZ2VVcGxvYWRTcGFuIiwiYWRkRXZlbnRMaXN0ZW5lciIsImZpbGVOYW1lIiwiZmlsZXMiLCJuYW1lIiwidGV4dENvbnRlbnQiLCJkZWxldGVEaXYiLCJpbmZvRGl2IiwiY3JlYXRlRWxlbWVudCIsImZvcm0iLCJwYXJlbnROb2RlIiwiY2xhc3NOYW1lIiwiaW5zZXJ0QmVmb3JlIiwiZGVsZXRlQnV0dG9uIiwidHlwZSIsInJlbW92ZUNoaWxkIiwiYXBwZW5kQ2hpbGQiXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0EsSUFBSUEsZ0JBQWdCLEdBQUdDLFFBQVEsQ0FBQ0MsYUFBVCxDQUF1Qiw4QkFBdkIsQ0FBdkI7QUFDQSxJQUFJQyxlQUFlLEdBQUdGLFFBQVEsQ0FBQ0MsYUFBVCxDQUF1Qiw2QkFBdkIsQ0FBdEI7QUFDQUYsZ0JBQWdCLENBQUNJLGdCQUFqQixDQUFrQyxRQUFsQyxFQUE0QyxZQUFNO0FBQzlDLE1BQUlDLFFBQVEsR0FBR0wsZ0JBQWdCLENBQUNNLEtBQWpCLENBQXVCLENBQXZCLEVBQTBCQyxJQUF6QztBQUNBSixFQUFBQSxlQUFlLENBQUNLLFdBQWhCLEdBQThCSCxRQUE5QjtBQUNILENBSEQsRSxDQUtBOztBQUNBLElBQUlJLFNBQVMsR0FBR1IsUUFBUSxDQUFDQyxhQUFULENBQXVCLHdCQUF2QixDQUFoQjtBQUNBTyxTQUFTLENBQUNMLGdCQUFWLENBQTJCLE9BQTNCLEVBQW9DLFlBQU07QUFDdEMsTUFBSU0sT0FBTyxHQUFHVCxRQUFRLENBQUNVLGFBQVQsQ0FBdUIsS0FBdkIsQ0FBZDtBQUNBLE1BQUlDLElBQUksR0FBR0gsU0FBUyxDQUFDSSxVQUFyQjtBQUNBSCxFQUFBQSxPQUFPLENBQUNJLFNBQVIsR0FBb0IsWUFBcEI7QUFDQUosRUFBQUEsT0FBTyxDQUFDRixXQUFSLEdBQXNCLGdEQUF0QjtBQUNBSSxFQUFBQSxJQUFJLENBQUNHLFlBQUwsQ0FBa0JMLE9BQWxCLEVBQTJCRCxTQUEzQjtBQUVBLE1BQUlPLFlBQVksR0FBR2YsUUFBUSxDQUFDVSxhQUFULENBQXVCLFFBQXZCLENBQW5CO0FBQ0FLLEVBQUFBLFlBQVksQ0FBQ0YsU0FBYixHQUF5QiwwQkFBekI7QUFDQUUsRUFBQUEsWUFBWSxDQUFDQyxJQUFiLEdBQW9CLFFBQXBCO0FBQ0FELEVBQUFBLFlBQVksQ0FBQ1IsV0FBYixHQUEyQixTQUEzQjtBQUNBSSxFQUFBQSxJQUFJLENBQUNNLFdBQUwsQ0FBaUJULFNBQWpCO0FBQ0FHLEVBQUFBLElBQUksQ0FBQ08sV0FBTCxDQUFpQkgsWUFBakI7QUFDSCxDQWJELEUsQ0FlQSIsInNvdXJjZXNDb250ZW50IjpbIi8vQ2hhbmdlIGlucHV0IHRleHQgd2hlbiBmaWxlIHdhcyBjaG9vc2VuXG5sZXQgaW1hZ2VVcGxvYWRJbnB1dCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5kYXNoYm9hcmRfX2ZpbGUtaW5wdXQgaW5wdXQnKTtcbmxldCBpbWFnZVVwbG9hZFNwYW4gPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcuZGFzaGJvYXJkX19maWxlLWlucHV0IHNwYW4nKTtcbmltYWdlVXBsb2FkSW5wdXQuYWRkRXZlbnRMaXN0ZW5lcignY2hhbmdlJywgKCkgPT4ge1xuICAgIGxldCBmaWxlTmFtZSA9IGltYWdlVXBsb2FkSW5wdXQuZmlsZXNbMF0ubmFtZTtcbiAgICBpbWFnZVVwbG9hZFNwYW4udGV4dENvbnRlbnQgPSBmaWxlTmFtZTtcbn0pO1xuXG4vL0RlbGV0ZSBhY2NvdW50IG1lc3NhZ2Ugd2l0aCBjb25maXJtYXRpb25cbmxldCBkZWxldGVEaXYgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcuZGFzaGJvYXJkX19kZWxldGUtZGl2Jyk7XG5kZWxldGVEaXYuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCAoKSA9PiB7XG4gICAgbGV0IGluZm9EaXYgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdkaXYnKTtcbiAgICBsZXQgZm9ybSA9IGRlbGV0ZURpdi5wYXJlbnROb2RlO1xuICAgIGluZm9EaXYuY2xhc3NOYW1lID0gJ2Vycm9yLXRleHQnO1xuICAgIGluZm9EaXYudGV4dENvbnRlbnQgPSAnUGxlYXNlIGNvbmZpcm0gKGFsbCB5b3VyIGRhdGEgd2lsbCBiZSBkZWxldGVkKSc7XG4gICAgZm9ybS5pbnNlcnRCZWZvcmUoaW5mb0RpdiwgZGVsZXRlRGl2KTtcblxuICAgIGxldCBkZWxldGVCdXR0b24gPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdidXR0b24nKTtcbiAgICBkZWxldGVCdXR0b24uY2xhc3NOYW1lID0gJ2Rhc2hib2FyZF9fZGVsZXRlLWJ1dHRvbic7XG4gICAgZGVsZXRlQnV0dG9uLnR5cGUgPSAnc3VibWl0JztcbiAgICBkZWxldGVCdXR0b24udGV4dENvbnRlbnQgPSAnQ29uZmlybSc7XG4gICAgZm9ybS5yZW1vdmVDaGlsZChkZWxldGVEaXYpO1xuICAgIGZvcm0uYXBwZW5kQ2hpbGQoZGVsZXRlQnV0dG9uKTtcbn0pO1xuXG4vL0VkaXQgbmFtZSJdLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvc3JjL2Rhc2hib2FyZC9ldmVudHMuanMuanMiLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/src/dashboard/events.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/src/dashboard/events.js"]();
/******/ 	
/******/ })()
;