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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./php/style/indexStyle.scss");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/css-loader/index.js!./node_modules/sass-loader/lib/loader.js!./php/style/indexStyle.scss":
/*!******************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/sass-loader/lib/loader.js!./php/style/indexStyle.scss ***!
  \******************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var escape = __webpack_require__(/*! ../../node_modules/css-loader/lib/url/escape.js */ "./node_modules/css-loader/lib/url/escape.js");
exports = module.exports = __webpack_require__(/*! ../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "* {\n  box-sizing: border-box; }\n\nhtml, body, div, span, applet, object, iframe,\nh1, h2, h3, h4, h5, h6, p, blockquote, pre,\na, abbr, acronym, address, big, cite, code,\ndel, dfn, em, img, ins, input, kbd, q, s, samp,\nsmall, strike, strong, sub, sup, tt, var,\nb, u, i, center,\ndl, dt, dd, ol, ul, li,\nfieldset, form, label, legend,\ntable, caption, tbody, tfoot, thead, tr, th, td,\narticle, aside, canvas, details, embed,\nfigure, figcaption, footer, header, hgroup,\nmenu, nav, output, ruby, section, summary,\ntime, mark, audio, video {\n  margin: 0;\n  padding: 0;\n  border: 0;\n  font-size: 10px;\n  font: inherit;\n  vertical-align: baseline; }\n\n/* HTML5 display-role reset for older browsers */\narticle, aside, details, figcaption, figure,\nfooter, header, hgroup, menu, nav, section {\n  display: block; }\n\nbody {\n  line-height: 1; }\n\nol, ul {\n  list-style: none; }\n\nblockquote, q {\n  quotes: none; }\n\nblockquote:before, blockquote:after,\nq:before, q:after {\n  content: '';\n  content: none; }\n\ntable {\n  border-collapse: collapse;\n  border-spacing: 0; }\n\n@font-face {\n  font-family: 'Regular';\n  src: url(" + escape(__webpack_require__(/*! ./fonts/Quicksand-Regular.ttf */ "./php/style/fonts/Quicksand-Regular.ttf")) + "); }\n\n@keyframes slide-top {\n  0% {\n    transform: translateY(1000px);\n    opacity: 0; }\n  100% {\n    transform: translateY(0);\n    opacity: 1; } }\n\n.slide-in-left {\n  animation: slide-in-left 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both; }\n\n@keyframes slide-in-left {\n  0% {\n    transform: translateX(-1000px);\n    opacity: 0; }\n  100% {\n    transform: translateX(0);\n    opacity: 1; } }\n\n.flip-in-ver-right {\n  animation: flip-in-ver-right 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) both; }\n\n@keyframes flip-in-ver-right {\n  0% {\n    transform: rotateY(-80deg);\n    opacity: 0; }\n  100% {\n    transform: rotateY(0);\n    opacity: 1; } }\n\n.img-fluid {\n  max-width: 100%;\n  height: auto; }\n\n.center-block {\n  display: block;\n  margin-left: auto;\n  margin-right: auto; }\n\n.row {\n  display: flex;\n  flex-wrap: wrap;\n  margin-right: -15px;\n  margin-left: -15px; }\n\n@media (min-width: 576px) {\n  .row {\n    margin-right: -15px;\n    margin-left: -15px; } }\n\n@media (min-width: 768px) {\n  .row {\n    margin-right: -15px;\n    margin-left: -15px; } }\n\n@media (min-width: 992px) {\n  .row {\n    margin-right: -15px;\n    margin-left: -15px; } }\n\n@media (min-width: 1200px) {\n  .row {\n    margin-right: -15px;\n    margin-left: -15px; } }\n\n.container {\n  width: 100%; }\n\n@media (min-width: 992px) {\n  .container {\n    width: 85%;\n    margin-left: 195px; } }\n\n.column-lg, .column-sm {\n  width: 100%;\n  padding-left: 30px;\n  padding-right: 30px; }\n\n@media (min-width: 576px) {\n  .column-lg {\n    flex: 0 0 66.66667%;\n    max-width: 66.66667%;\n    padding-right: 15px;\n    padding-left: 15px; } }\n\n@media (min-width: 576px) and (min-width: 576px) {\n  .column-lg {\n    padding-right: 15px;\n    padding-left: 15px; } }\n\n@media (min-width: 576px) and (min-width: 768px) {\n  .column-lg {\n    padding-right: 15px;\n    padding-left: 15px; } }\n\n@media (min-width: 576px) and (min-width: 992px) {\n  .column-lg {\n    padding-right: 15px;\n    padding-left: 15px; } }\n\n@media (min-width: 576px) and (min-width: 1200px) {\n  .column-lg {\n    padding-right: 15px;\n    padding-left: 15px; } }\n\n@media (min-width: 576px) {\n  .column-sm {\n    flex: 0 0 33.33333%;\n    max-width: 33.33333%;\n    padding-right: 15px;\n    padding-left: 15px; } }\n\n@media (min-width: 576px) and (min-width: 576px) {\n  .column-sm {\n    padding-right: 15px;\n    padding-left: 15px; } }\n\n@media (min-width: 576px) and (min-width: 768px) {\n  .column-sm {\n    padding-right: 15px;\n    padding-left: 15px; } }\n\n@media (min-width: 576px) and (min-width: 992px) {\n  .column-sm {\n    padding-right: 15px;\n    padding-left: 15px; } }\n\n@media (min-width: 576px) and (min-width: 1200px) {\n  .column-sm {\n    padding-right: 15px;\n    padding-left: 15px; } }\n\n.form {\n  align-items: center;\n  display: flex;\n  flex-direction: column;\n  width: 100%; }\n  .form .form--search-result {\n    flex-direction: row;\n    justify-content: flex-start; }\n  .form .form__text {\n    background-color: transparent;\n    border: 2px solid #614F85;\n    color: #FAFAFA;\n    padding: 0.4rem;\n    transition: border-color 300ms ease; }\n    .form .form__text:focus {\n      border-color: #634EC2; }\n  .form .form__btn {\n    border: 0;\n    background-color: #F04664;\n    color: #FAFAFA;\n    font-size: 1rem;\n    padding: 0.4rem; }\n    .form .form__btn.\\--size-sm {\n      width: 25%; }\n    .form .form__btn.\\--size-md {\n      width: 50%; }\n    .form .form__btn.\\--size-full {\n      width: 100%; }\n    .form .form__btn:hover {\n      cursor: pointer; }\n\n.btn {\n  border: 0;\n  border-radius: 3px;\n  background-color: #F04664;\n  color: #FAFAFA;\n  font-size: 1rem;\n  padding: 0.4rem; }\n  .btn:hover {\n    cursor: pointer; }\n\n.select {\n  border: 0;\n  border-radius: 8px;\n  background-color: #F04664;\n  color: #FAFAFA;\n  font-size: 1rem;\n  padding: 0.4rem;\n  margin-bottom: 5px;\n  margin-right: 6px;\n  margin-top: 2px;\n  outline: 0 none;\n  border-radius: 2px; }\n  .select:hover {\n    cursor: pointer; }\n\n.card {\n  animation: slide-top 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;\n  position: relative;\n  display: flex;\n  flex-direction: column;\n  border: 1px solid rgba(97, 79, 133, 0.125);\n  border-radius: 0.25rem;\n  box-shadow: 2px 2px 14px 0px rgba(0, 0, 0, 0.25); }\n\n.card-block {\n  flex: 1 1 auto;\n  padding: 1.25rem; }\n\n.card-header {\n  padding: 0.75rem 1.25rem;\n  margin-bottom: 0;\n  background-color: #f7f7f9;\n  border-bottom: 1px solid rgba(0, 0, 0, 0.125); }\n  .card-header:first-child {\n    border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0; }\n\n.card-footer {\n  padding: 0.75rem 1.25rem;\n  background-color: #f7f7f9;\n  border-top: 1px solid rgba(0, 0, 0, 0.125); }\n  .card-footer:last-child {\n    border-radius: 0 0 calc(0.25rem - 1px) calc(0.25rem - 1px); }\n\n/*=============================\n=            cards            =\n=============================*/\n.card {\n  border: 0;\n  margin-bottom: 2rem;\n  height: auto; }\n  .card .headline {\n    font-size: 1.2rem; }\n  .card .nav {\n    flex-direction: column; }\n  .card .card-header, .card .card-footer, .card .card-block {\n    background-color: #1A1A37; }\n  .card.contractors .card-block {\n    display: flex;\n    justify-content: center;\n    align-items: center; }\n    .card.contractors .card-block .fa {\n      font-size: 5rem; }\n      .card.contractors .card-block .fa.warning {\n        color: #fc8f3e; }\n  .card.contractors .card-footer {\n    display: flex;\n    justify-content: space-around; }\n    .card.contractors .card-footer .item {\n      display: flex;\n      flex-direction: column;\n      align-items: center;\n      font-size: 1.3rem; }\n      .card.contractors .card-footer .item .warning {\n        color: #fc8f3e; }\n      .card.contractors .card-footer .item .info {\n        color: #57b0eb; }\n\n@media (max-width: 991px) {\n  .card {\n    width: 100%; } }\n\n@media (min-width: 992px) {\n  .card .nav {\n    flex-direction: row; }\n    .card .nav .nav-item {\n      margin-right: .2rem; } }\n\n.badge {\n  width: 0.88rem;\n  height: 0.88rem;\n  display: inline-block; }\n  .badge.primary {\n    background-color: #293541; }\n  .badge.info {\n    background-color: #57b0eb; }\n  .badge.warning {\n    background-color: #fc8f3e; }\n\n/*=====  End of cards  ======*/\n.nav {\n  display: flex;\n  padding-left: 0;\n  margin-top: 2rem;\n  margin-bottom: 0;\n  list-style: none; }\n\n.nav-link {\n  display: block;\n  padding: 0.5em 1em; }\n  .nav-link:focus, .nav-link:hover {\n    text-decoration: none; }\n\n/*===============================\n=            Sidebar            =\n===============================*/\n.sidebar__menuicon {\n  fill: #FAFAFA;\n  width: 3rem; }\n  .sidebar__menuicon:hover {\n    fill: #F04664; }\n\n.sidebar {\n  height: 100vh;\n  width: 70%;\n  max-width: 180px;\n  position: fixed;\n  left: -80%;\n  top: 0;\n  background-color: #1A1A37;\n  z-index: 1001;\n  transition: left .2s; }\n  .sidebar .sidebar-header {\n    width: 100%;\n    height: 80px;\n    background-color: #634EC2;\n    display: flex;\n    justify-content: center;\n    align-items: center; }\n    .sidebar .sidebar-header .brand-logo {\n      height: 70px; }\n  .sidebar .nav {\n    flex-direction: column; }\n    .sidebar .nav .nav-item {\n      padding: .3rem .1rem; }\n    .sidebar .nav .nav-link {\n      font-size: .9rem;\n      color: #614F85;\n      display: flex;\n      flex-direction: column;\n      align-items: center; }\n      .sidebar .nav .nav-link:hover {\n        color: #FAFAFA;\n        background-color: #74274A; }\n        .sidebar .nav .nav-link:hover .sidebar__icon {\n          fill: #F04664; }\n      .sidebar .nav .nav-link .sidebar__icon {\n        fill: #614F85;\n        width: 3rem; }\n\n@media (min-width: 992px) {\n  .sidebar {\n    left: 0; }\n    .sidebar .nav .nav-link {\n      font-size: 1.1rem; }\n      .sidebar .nav .nav-link .fa {\n        font-size: 1.7rem; } }\n\n.open-sidebar:after {\n  content: \"\";\n  position: fixed;\n  top: 0;\n  left: 0;\n  right: 0;\n  bottom: 0;\n  background-color: rgba(0, 0, 0, 0.4);\n  z-index: 1000; }\n\n.open-sidebar .sidebar {\n  left: 0; }\n\n/*=====  End of Sidebar  ======*/\n/*==============================\n  =            Header           =\n  ==============================*/\n.header {\n  position: fixed;\n  left: 0;\n  top: 0;\n  z-index: 1000;\n  width: 100%;\n  height: 80px;\n  padding: 0 1rem;\n  background-color: #1A1A37;\n  box-shadow: 0 5px 15px -2px rgba(0, 0, 0, 0.2);\n  display: flex;\n  justify-content: space-between;\n  align-items: center; }\n  .header .container {\n    display: flex;\n    justify-content: space-between;\n    align-items: center;\n    width: 100%; }\n  .header .offcanvas, .header .date-timer, .header .user {\n    display: flex;\n    align-items: center; }\n  .header .offcanvas .item {\n    font-size: 2rem; }\n  .header .date-timer {\n    color: #FAFAFA;\n    flex-direction: row; }\n    .header .date-timer > p {\n      margin-right: .5rem;\n      font-size: .8rem;\n      margin-bottom: 0; }\n    .header .date-timer .mark {\n      color: #634EC2; }\n\n@media (min-width: 992px) {\n  .header .offcanvas {\n    display: none; } }\n\n/*!\n * Bootstrap v4.0.0-alpha.6 (https://getbootstrap.com)\n * Copyright 2011-2017 The Bootstrap Authors\n * Copyright 2011-2017 Twitter, Inc.\n * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)\n */\n/*! normalize.css v5.0.0 | MIT License | github.com/necolas/normalize.css */\nhtml {\n  font-family: sans-serif;\n  line-height: 1.15;\n  -ms-text-size-adjust: 100%;\n  -webkit-text-size-adjust: 100%; }\n\nbody {\n  margin: 0;\n  padding-top: 80px;\n  overflow-x: hidden; }\n\narticle, footer, header, nav {\n  display: block; }\n\nh1 {\n  font-size: 2em;\n  margin: 0.67em 0; }\n\nmain {\n  display: block; }\n\na {\n  background-color: transparent;\n  -webkit-text-decoration-skip: objects; }\n  a:active, a:hover {\n    outline-width: 0; }\n\nimg {\n  border-style: none; }\n\n::-webkit-file-upload-button {\n  -webkit-appearance: button;\n  font: inherit; }\n\nhtml {\n  box-sizing: border-box; }\n\n* {\n  box-sizing: inherit; }\n  *::before, *::after {\n    box-sizing: inherit; }\n\n@-ms-viewport {\n  width: device-width; }\n\nhtml {\n  -ms-overflow-style: scrollbar;\n  -webkit-tap-highlight-color: transparent; }\n\nbody {\n  font-family: 'Regular', -apple-system, system-ui, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif;\n  font-weight: normal;\n  line-height: 1.5;\n  color: #FAFAFA; }\n\nh1, h2 {\n  margin-top: 0;\n  margin-bottom: .5rem; }\n\np, ul {\n  margin-top: 0;\n  margin-bottom: 1rem; }\n\na {\n  color: #74274A;\n  text-decoration: none; }\n  a:focus, a:hover {\n    color: #F04664;\n    text-decoration: underline; }\n\nimg {\n  vertical-align: middle; }\n\na {\n  touch-action: manipulation; }\n\nhr {\n  border: 0;\n  height: 1px;\n  background: #1A1A37;\n  background-image: linear-gradient(to right, rgba(26, 26, 55, 0.4), #1A1A37, rgba(26, 26, 55, 0.4)); }\n\n.main-headline {\n  margin-top: .5rem;\n  margin-bottom: .5rem;\n  padding-left: 1rem; }\n\n/*=====  End of Header ======*/\nbody {\n  background-color: #16112e; }\n\n.results {\n  margin: 1rem 0;\n  padding: 0 1rem; }\n  .results .column-sm {\n    display: flex;\n    justify-content: center;\n    flex: 0 0 10%; }\n\n.game__img {\n  height: auto;\n  width: 50%; }\n\n.game-card {\n  align-items: center;\n  background-color: rgba(22, 17, 46, 0.4);\n  border-radius: 5px;\n  cursor: pointer;\n  display: flex;\n  flex-direction: column;\n  justify-content: space-around;\n  height: auto;\n  margin-bottom: 1rem;\n  padding: 1rem;\n  transition: transform 300ms ease; }\n  .game-card .game-image {\n    height: auto;\n    margin-bottom: 1rem;\n    width: 80%; }\n  .game-card > a {\n    align-items: center;\n    display: flex;\n    flex-direction: column;\n    justify-content: space-around;\n    text-align: center; }\n  .game-card:hover {\n    border: 2px solid #16112e;\n    transform: scale(1.05); }\n\n.add-friend:hover {\n  cursor: pointer; }\n\n.img-user {\n  height: 64px;\n  width: 64px; }\n\n.main-logo {\n  height: auto;\n  width: 201px; }\n\n.logo-title {\n  font-size: 2rem;\n  font-weight: thin; }\n\n/* Body styles */\n.box-wrapper {\n  display: flex;\n  margin: 0px;\n  background-color: #1A1A37;\n  width: 100%;\n  height: 100%; }\n\n.bg-video {\n  position: fixed;\n  top: 0;\n  left: 0;\n  overflow: hidden;\n  width: 100%;\n  height: 100%;\n  opacity: 0.2; }\n\n@media (min-aspect-ratio: 16 / 9) {\n  .bg-video {\n    width: 100%;\n    height: auto; } }\n\n@media (max-aspect-ratio: 16 / 9) {\n  .bg-video {\n    width: auto;\n    height: 100%; } }\n\n.signBox {\n  position: relative;\n  margin: auto;\n  width: 40%;\n  height: auto;\n  min-width: 300px;\n  text-align: center;\n  border-radius: 15px;\n  padding: 12px 12px 12px 12px;\n  color: #ffffff; }\n  .signBox .loginBtn {\n    background-color: #4DA2BD;\n    background-color: #F04664;\n    font-family: 'Regular', sans-serif;\n    font-size: 1rem;\n    cursor: pointer;\n    margin-bottom: 1rem;\n    padding: 5px 0px 5px 5px;\n    width: 50%; }\n    .signBox .loginBtn:hover {\n      box-shadow: 0px 0px 11px 4px rgba(255, 255, 255, 0.16); }\n  .signBox .loginInput {\n    background-color: #FAFAFA;\n    background-color: rgba(26, 26, 55, 0.4);\n    border: 2px solid #614F85;\n    color: #FAFAFA;\n    font-family: 'Regular', sans-serif;\n    font-size: 1rem;\n    margin-bottom: 1rem;\n    padding: 5px 0px 5px 5px; }\n    .signBox .loginInput:focus {\n      background-color: rgba(26, 26, 55, 0.8);\n      border: 2px solid #634EC2; }\n\n.inputBtn {\n  background-color: #4DA2BD;\n  background-color: #F04664;\n  font-family: 'Regular', sans-serif;\n  font-size: 1rem;\n  cursor: pointer;\n  margin-bottom: 1rem;\n  padding: 5px 0px 5px 5px;\n  width: 50%; }\n  .inputBtn:hover {\n    box-shadow: 0px 0px 11px 4px rgba(255, 255, 255, 0.16); }\n\n.inputText {\n  background-color: #FAFAFA;\n  background-color: #1A1A37;\n  color: #FAFAFA;\n  font-family: 'Regular', sans-serif;\n  font-size: 1rem;\n  margin-bottom: 1rem;\n  padding: 5px 0px 5px 5px; }\n\ndiv#header {\n  height: 7%;\n  margin: 0 px;\n  padding: 0;\n  color: #ffffff;\n  background-color: #001A4C;\n  width: 100%;\n  overflow: hidden; }\n\ninput[type=text] {\n  border: none;\n  margin-bottom: 10px;\n  margin-right: 6px;\n  margin-top: 10px;\n  outline: 0 none;\n  padding: 0px 0px 0px 0px;\n  width: 70%;\n  border-radius: 2px; }\n\ninput[type=password] {\n  border: none;\n  margin-bottom: 16px;\n  margin-right: 6px;\n  margin-top: 2px;\n  outline: 0 none;\n  padding: 5px 0px 5px 5px;\n  width: 70%;\n  border-radius: 2px; }\n\ninput[type=date] {\n  background: #000F2E;\n  border: none;\n  color: #E0E0E0;\n  height: 25px;\n  line-height: 15px;\n  margin-bottom: 16px;\n  margin-right: 6px;\n  margin-top: 2px;\n  outline: 0 none;\n  padding: 5px 0px 5px 5px;\n  width: 70%;\n  border-radius: 2px; }\n\np {\n  text-align: center; }\n\ninput[type=submit] {\n  border: 0;\n  font-weight: bold;\n  border: none;\n  border: none;\n  color: #E0E0E0;\n  line-height: 15px;\n  margin-bottom: 5px;\n  margin-right: 6px;\n  margin-top: 2px;\n  outline: 0 none;\n  border-radius: 2px; }\n\n.side {\n  width: 50%;\n  height: 100%;\n  float: left;\n  text-align: left; }\n\ndiv#fixedBox {\n  float: center;\n  height: 75%;\n  color: #ffffff;\n  overflow: auto;\n  white-space: normal;\n  display: block;\n  background-color: #000F2E;\n  width: 95%; }\n\n/* unvisited link */\na:link {\n  font-weight: bold;\n  color: #ffffff;\n  text-decoration: none; }\n\n/* visited link */\na:visited {\n  color: #ffffff;\n  text-decoration: none; }\n\n/* mouse over link */\na:hover {\n  color: #CACACA;\n  text-decoration: none; }\n\n.text.\\--regular {\n  font-family: 'Regular'; }\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/lib/css-base.js":
/*!*************************************************!*\
  !*** ./node_modules/css-loader/lib/css-base.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/
// css base code, injected by the css-loader
module.exports = function(useSourceMap) {
	var list = [];

	// return the list of modules as css string
	list.toString = function toString() {
		return this.map(function (item) {
			var content = cssWithMappingToString(item, useSourceMap);
			if(item[2]) {
				return "@media " + item[2] + "{" + content + "}";
			} else {
				return content;
			}
		}).join("");
	};

	// import a list of modules into the list
	list.i = function(modules, mediaQuery) {
		if(typeof modules === "string")
			modules = [[null, modules, ""]];
		var alreadyImportedModules = {};
		for(var i = 0; i < this.length; i++) {
			var id = this[i][0];
			if(typeof id === "number")
				alreadyImportedModules[id] = true;
		}
		for(i = 0; i < modules.length; i++) {
			var item = modules[i];
			// skip already imported module
			// this implementation is not 100% perfect for weird media query combinations
			//  when a module is imported multiple times with different media queries.
			//  I hope this will never occur (Hey this way we have smaller bundles)
			if(typeof item[0] !== "number" || !alreadyImportedModules[item[0]]) {
				if(mediaQuery && !item[2]) {
					item[2] = mediaQuery;
				} else if(mediaQuery) {
					item[2] = "(" + item[2] + ") and (" + mediaQuery + ")";
				}
				list.push(item);
			}
		}
	};
	return list;
};

function cssWithMappingToString(item, useSourceMap) {
	var content = item[1] || '';
	var cssMapping = item[3];
	if (!cssMapping) {
		return content;
	}

	if (useSourceMap && typeof btoa === 'function') {
		var sourceMapping = toComment(cssMapping);
		var sourceURLs = cssMapping.sources.map(function (source) {
			return '/*# sourceURL=' + cssMapping.sourceRoot + source + ' */'
		});

		return [content].concat(sourceURLs).concat([sourceMapping]).join('\n');
	}

	return [content].join('\n');
}

// Adapted from convert-source-map (MIT)
function toComment(sourceMap) {
	// eslint-disable-next-line no-undef
	var base64 = btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap))));
	var data = 'sourceMappingURL=data:application/json;charset=utf-8;base64,' + base64;

	return '/*# ' + data + ' */';
}


/***/ }),

/***/ "./node_modules/css-loader/lib/url/escape.js":
/*!***************************************************!*\
  !*** ./node_modules/css-loader/lib/url/escape.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = function escape(url) {
    if (typeof url !== 'string') {
        return url
    }
    // If url is already wrapped in quotes, remove them
    if (/^['"].*['"]$/.test(url)) {
        url = url.slice(1, -1);
    }
    // Should url be wrapped?
    // See https://drafts.csswg.org/css-values-3/#urls
    if (/["'() \t\n]/.test(url)) {
        return '"' + url.replace(/"/g, '\\"').replace(/\n/g, '\\n') + '"'
    }

    return url
}


/***/ }),

/***/ "./node_modules/style-loader/lib/addStyles.js":
/*!****************************************************!*\
  !*** ./node_modules/style-loader/lib/addStyles.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/

var stylesInDom = {};

var	memoize = function (fn) {
	var memo;

	return function () {
		if (typeof memo === "undefined") memo = fn.apply(this, arguments);
		return memo;
	};
};

var isOldIE = memoize(function () {
	// Test for IE <= 9 as proposed by Browserhacks
	// @see http://browserhacks.com/#hack-e71d8692f65334173fee715c222cb805
	// Tests for existence of standard globals is to allow style-loader
	// to operate correctly into non-standard environments
	// @see https://github.com/webpack-contrib/style-loader/issues/177
	return window && document && document.all && !window.atob;
});

var getTarget = function (target) {
  return document.querySelector(target);
};

var getElement = (function (fn) {
	var memo = {};

	return function(target) {
                // If passing function in options, then use it for resolve "head" element.
                // Useful for Shadow Root style i.e
                // {
                //   insertInto: function () { return document.querySelector("#foo").shadowRoot }
                // }
                if (typeof target === 'function') {
                        return target();
                }
                if (typeof memo[target] === "undefined") {
			var styleTarget = getTarget.call(this, target);
			// Special case to return head of iframe instead of iframe itself
			if (window.HTMLIFrameElement && styleTarget instanceof window.HTMLIFrameElement) {
				try {
					// This will throw an exception if access to iframe is blocked
					// due to cross-origin restrictions
					styleTarget = styleTarget.contentDocument.head;
				} catch(e) {
					styleTarget = null;
				}
			}
			memo[target] = styleTarget;
		}
		return memo[target]
	};
})();

var singleton = null;
var	singletonCounter = 0;
var	stylesInsertedAtTop = [];

var	fixUrls = __webpack_require__(/*! ./urls */ "./node_modules/style-loader/lib/urls.js");

module.exports = function(list, options) {
	if (typeof DEBUG !== "undefined" && DEBUG) {
		if (typeof document !== "object") throw new Error("The style-loader cannot be used in a non-browser environment");
	}

	options = options || {};

	options.attrs = typeof options.attrs === "object" ? options.attrs : {};

	// Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
	// tags it will allow on a page
	if (!options.singleton && typeof options.singleton !== "boolean") options.singleton = isOldIE();

	// By default, add <style> tags to the <head> element
        if (!options.insertInto) options.insertInto = "head";

	// By default, add <style> tags to the bottom of the target
	if (!options.insertAt) options.insertAt = "bottom";

	var styles = listToStyles(list, options);

	addStylesToDom(styles, options);

	return function update (newList) {
		var mayRemove = [];

		for (var i = 0; i < styles.length; i++) {
			var item = styles[i];
			var domStyle = stylesInDom[item.id];

			domStyle.refs--;
			mayRemove.push(domStyle);
		}

		if(newList) {
			var newStyles = listToStyles(newList, options);
			addStylesToDom(newStyles, options);
		}

		for (var i = 0; i < mayRemove.length; i++) {
			var domStyle = mayRemove[i];

			if(domStyle.refs === 0) {
				for (var j = 0; j < domStyle.parts.length; j++) domStyle.parts[j]();

				delete stylesInDom[domStyle.id];
			}
		}
	};
};

function addStylesToDom (styles, options) {
	for (var i = 0; i < styles.length; i++) {
		var item = styles[i];
		var domStyle = stylesInDom[item.id];

		if(domStyle) {
			domStyle.refs++;

			for(var j = 0; j < domStyle.parts.length; j++) {
				domStyle.parts[j](item.parts[j]);
			}

			for(; j < item.parts.length; j++) {
				domStyle.parts.push(addStyle(item.parts[j], options));
			}
		} else {
			var parts = [];

			for(var j = 0; j < item.parts.length; j++) {
				parts.push(addStyle(item.parts[j], options));
			}

			stylesInDom[item.id] = {id: item.id, refs: 1, parts: parts};
		}
	}
}

function listToStyles (list, options) {
	var styles = [];
	var newStyles = {};

	for (var i = 0; i < list.length; i++) {
		var item = list[i];
		var id = options.base ? item[0] + options.base : item[0];
		var css = item[1];
		var media = item[2];
		var sourceMap = item[3];
		var part = {css: css, media: media, sourceMap: sourceMap};

		if(!newStyles[id]) styles.push(newStyles[id] = {id: id, parts: [part]});
		else newStyles[id].parts.push(part);
	}

	return styles;
}

function insertStyleElement (options, style) {
	var target = getElement(options.insertInto)

	if (!target) {
		throw new Error("Couldn't find a style target. This probably means that the value for the 'insertInto' parameter is invalid.");
	}

	var lastStyleElementInsertedAtTop = stylesInsertedAtTop[stylesInsertedAtTop.length - 1];

	if (options.insertAt === "top") {
		if (!lastStyleElementInsertedAtTop) {
			target.insertBefore(style, target.firstChild);
		} else if (lastStyleElementInsertedAtTop.nextSibling) {
			target.insertBefore(style, lastStyleElementInsertedAtTop.nextSibling);
		} else {
			target.appendChild(style);
		}
		stylesInsertedAtTop.push(style);
	} else if (options.insertAt === "bottom") {
		target.appendChild(style);
	} else if (typeof options.insertAt === "object" && options.insertAt.before) {
		var nextSibling = getElement(options.insertInto + " " + options.insertAt.before);
		target.insertBefore(style, nextSibling);
	} else {
		throw new Error("[Style Loader]\n\n Invalid value for parameter 'insertAt' ('options.insertAt') found.\n Must be 'top', 'bottom', or Object.\n (https://github.com/webpack-contrib/style-loader#insertat)\n");
	}
}

function removeStyleElement (style) {
	if (style.parentNode === null) return false;
	style.parentNode.removeChild(style);

	var idx = stylesInsertedAtTop.indexOf(style);
	if(idx >= 0) {
		stylesInsertedAtTop.splice(idx, 1);
	}
}

function createStyleElement (options) {
	var style = document.createElement("style");

	if(options.attrs.type === undefined) {
		options.attrs.type = "text/css";
	}

	addAttrs(style, options.attrs);
	insertStyleElement(options, style);

	return style;
}

function createLinkElement (options) {
	var link = document.createElement("link");

	if(options.attrs.type === undefined) {
		options.attrs.type = "text/css";
	}
	options.attrs.rel = "stylesheet";

	addAttrs(link, options.attrs);
	insertStyleElement(options, link);

	return link;
}

function addAttrs (el, attrs) {
	Object.keys(attrs).forEach(function (key) {
		el.setAttribute(key, attrs[key]);
	});
}

function addStyle (obj, options) {
	var style, update, remove, result;

	// If a transform function was defined, run it on the css
	if (options.transform && obj.css) {
	    result = options.transform(obj.css);

	    if (result) {
	    	// If transform returns a value, use that instead of the original css.
	    	// This allows running runtime transformations on the css.
	    	obj.css = result;
	    } else {
	    	// If the transform function returns a falsy value, don't add this css.
	    	// This allows conditional loading of css
	    	return function() {
	    		// noop
	    	};
	    }
	}

	if (options.singleton) {
		var styleIndex = singletonCounter++;

		style = singleton || (singleton = createStyleElement(options));

		update = applyToSingletonTag.bind(null, style, styleIndex, false);
		remove = applyToSingletonTag.bind(null, style, styleIndex, true);

	} else if (
		obj.sourceMap &&
		typeof URL === "function" &&
		typeof URL.createObjectURL === "function" &&
		typeof URL.revokeObjectURL === "function" &&
		typeof Blob === "function" &&
		typeof btoa === "function"
	) {
		style = createLinkElement(options);
		update = updateLink.bind(null, style, options);
		remove = function () {
			removeStyleElement(style);

			if(style.href) URL.revokeObjectURL(style.href);
		};
	} else {
		style = createStyleElement(options);
		update = applyToTag.bind(null, style);
		remove = function () {
			removeStyleElement(style);
		};
	}

	update(obj);

	return function updateStyle (newObj) {
		if (newObj) {
			if (
				newObj.css === obj.css &&
				newObj.media === obj.media &&
				newObj.sourceMap === obj.sourceMap
			) {
				return;
			}

			update(obj = newObj);
		} else {
			remove();
		}
	};
}

var replaceText = (function () {
	var textStore = [];

	return function (index, replacement) {
		textStore[index] = replacement;

		return textStore.filter(Boolean).join('\n');
	};
})();

function applyToSingletonTag (style, index, remove, obj) {
	var css = remove ? "" : obj.css;

	if (style.styleSheet) {
		style.styleSheet.cssText = replaceText(index, css);
	} else {
		var cssNode = document.createTextNode(css);
		var childNodes = style.childNodes;

		if (childNodes[index]) style.removeChild(childNodes[index]);

		if (childNodes.length) {
			style.insertBefore(cssNode, childNodes[index]);
		} else {
			style.appendChild(cssNode);
		}
	}
}

function applyToTag (style, obj) {
	var css = obj.css;
	var media = obj.media;

	if(media) {
		style.setAttribute("media", media)
	}

	if(style.styleSheet) {
		style.styleSheet.cssText = css;
	} else {
		while(style.firstChild) {
			style.removeChild(style.firstChild);
		}

		style.appendChild(document.createTextNode(css));
	}
}

function updateLink (link, options, obj) {
	var css = obj.css;
	var sourceMap = obj.sourceMap;

	/*
		If convertToAbsoluteUrls isn't defined, but sourcemaps are enabled
		and there is no publicPath defined then lets turn convertToAbsoluteUrls
		on by default.  Otherwise default to the convertToAbsoluteUrls option
		directly
	*/
	var autoFixUrls = options.convertToAbsoluteUrls === undefined && sourceMap;

	if (options.convertToAbsoluteUrls || autoFixUrls) {
		css = fixUrls(css);
	}

	if (sourceMap) {
		// http://stackoverflow.com/a/26603875
		css += "\n/*# sourceMappingURL=data:application/json;base64," + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + " */";
	}

	var blob = new Blob([css], { type: "text/css" });

	var oldSrc = link.href;

	link.href = URL.createObjectURL(blob);

	if(oldSrc) URL.revokeObjectURL(oldSrc);
}


/***/ }),

/***/ "./node_modules/style-loader/lib/urls.js":
/*!***********************************************!*\
  !*** ./node_modules/style-loader/lib/urls.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {


/**
 * When source maps are enabled, `style-loader` uses a link element with a data-uri to
 * embed the css on the page. This breaks all relative urls because now they are relative to a
 * bundle instead of the current page.
 *
 * One solution is to only use full urls, but that may be impossible.
 *
 * Instead, this function "fixes" the relative urls to be absolute according to the current page location.
 *
 * A rudimentary test suite is located at `test/fixUrls.js` and can be run via the `npm test` command.
 *
 */

module.exports = function (css) {
  // get current location
  var location = typeof window !== "undefined" && window.location;

  if (!location) {
    throw new Error("fixUrls requires window.location");
  }

	// blank or null?
	if (!css || typeof css !== "string") {
	  return css;
  }

  var baseUrl = location.protocol + "//" + location.host;
  var currentDir = baseUrl + location.pathname.replace(/\/[^\/]*$/, "/");

	// convert each url(...)
	/*
	This regular expression is just a way to recursively match brackets within
	a string.

	 /url\s*\(  = Match on the word "url" with any whitespace after it and then a parens
	   (  = Start a capturing group
	     (?:  = Start a non-capturing group
	         [^)(]  = Match anything that isn't a parentheses
	         |  = OR
	         \(  = Match a start parentheses
	             (?:  = Start another non-capturing groups
	                 [^)(]+  = Match anything that isn't a parentheses
	                 |  = OR
	                 \(  = Match a start parentheses
	                     [^)(]*  = Match anything that isn't a parentheses
	                 \)  = Match a end parentheses
	             )  = End Group
              *\) = Match anything and then a close parens
          )  = Close non-capturing group
          *  = Match anything
       )  = Close capturing group
	 \)  = Match a close parens

	 /gi  = Get all matches, not the first.  Be case insensitive.
	 */
	var fixedCss = css.replace(/url\s*\(((?:[^)(]|\((?:[^)(]+|\([^)(]*\))*\))*)\)/gi, function(fullMatch, origUrl) {
		// strip quotes (if they exist)
		var unquotedOrigUrl = origUrl
			.trim()
			.replace(/^"(.*)"$/, function(o, $1){ return $1; })
			.replace(/^'(.*)'$/, function(o, $1){ return $1; });

		// already a full url? no change
		if (/^(#|data:|http:\/\/|https:\/\/|file:\/\/\/|\s*$)/i.test(unquotedOrigUrl)) {
		  return fullMatch;
		}

		// convert the url to a full url
		var newUrl;

		if (unquotedOrigUrl.indexOf("//") === 0) {
		  	//TODO: should we add protocol?
			newUrl = unquotedOrigUrl;
		} else if (unquotedOrigUrl.indexOf("/") === 0) {
			// path should be relative to the base url
			newUrl = baseUrl + unquotedOrigUrl; // already starts with '/'
		} else {
			// path should be relative to current directory
			newUrl = currentDir + unquotedOrigUrl.replace(/^\.\//, ""); // Strip leading './'
		}

		// send back the fixed url(...)
		return "url(" + JSON.stringify(newUrl) + ")";
	});

	// send back the fixed css
	return fixedCss;
};


/***/ }),

/***/ "./php/style/fonts/Quicksand-Regular.ttf":
/*!***********************************************!*\
  !*** ./php/style/fonts/Quicksand-Regular.ttf ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__.p + "f87b9b4f34bdbf75b5c0cf3a5a137508.ttf";

/***/ }),

/***/ "./php/style/indexStyle.scss":
/*!***********************************!*\
  !*** ./php/style/indexStyle.scss ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../node_modules/css-loader!../../node_modules/sass-loader/lib/loader.js!./indexStyle.scss */ "./node_modules/css-loader/index.js!./node_modules/sass-loader/lib/loader.js!./php/style/indexStyle.scss");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ })

/******/ });
//# sourceMappingURL=bundle.js.map