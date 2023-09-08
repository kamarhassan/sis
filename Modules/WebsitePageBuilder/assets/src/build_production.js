const iconStyle = 'default';
const inlineEditor = 'tinymce';

import beautify from 'js-beautify';
window.beautify = beautify;

// jquery
import jQuery from './lib/jquery-3.4.1.min.js';
window.jQuery = jQuery;
window.$ = jQuery;

// bootstrapGrowl
require('./lib/jquery.bootstrap-growl.min.js');

window.bootstrapGrowl = $.bootstrapGrowl;

// bootstrap
require('./lib/popper.js');
require('./lib/bootstrap/bootstrap.min.css');
require('./lib/bootstrap/bootstrap.min.js');

// fontawesome free
require('./lib/fontawesome-free/css/fontawesome.min.css');
require('./lib/fontawesome-free/css/brands.min.css');
require('./lib/fontawesome-free/css/solid.min.css');

// main css/scss
require('./css/font.css');
require('./css/app.css');
require('./css/builder_core.css');
require('./css/fix.css');

require('./js/beepro.js');
require('./css/beepro.css');

// add all widgets from js/widgets
require('./js/widgets.js');

// add all elements from js/elements
require('./js/elements.js');

// add all controls from js/controls
require('./js/controls.js');

// something in builder ext
import {
   rgb2hex,
   removeModalGetLinkVideo,
   modal_display,
   htmlLoader
} from './js/builder_ext.js';
window.rgb2hex = rgb2hex;
window.removeModalGetLinkVideo = removeModalGetLinkVideo;
window.modal_display = modal_display;
window.htmlLoader = htmlLoader;

// all thing from builder
import {
  createElementFromHTML,
  makeid,
  Editor,
  simulateClick
} from './js/builder.js';
window.createElementFromHTML = createElementFromHTML;
window.makeid = makeid;
window.Editor = Editor;
window.simulateClick = simulateClick;

// ClipboardJS
import ClipboardJS from './lib/clipboard.min.js';
window.ClipboardJS = ClipboardJS;

// ace JS
import * as ace from 'ace-builds/src-noconflict/ace';
import 'ace-builds/src-noconflict/theme-monokai';
import 'ace-builds/src-noconflict/mode-html';
import 'ace-builds/src-noconflict/worker-html';
window.ace = ace;

// Builder HTML
import main from './main.html';
import main_beepro from './main_beepro.html';
import other from './other.html';
import controls from './controls.html';
import widgets from './widgets.html';
import { BuilderIcons } from './js/icon.js';
window.BuilderIcons = BuilderIcons;

// extend prepair html for editor
Editor.prototype.setIcons = function(html) {
    var icons = BuilderIcons[iconStyle];

    for (var key in icons) {
      var value = icons[key];

      var replace = '\{' + key + '\}';
      var re = new RegExp(replace,"g");
      var re2 = new RegExp('\=' + replace,"g");

      html = html.replace(re2, '="'+value+'"');
      html = html.replace(re, value);
    }
    
    return html;
};

// extend prepair html for editor
Editor.prototype.updateLanguage = function(html) {
    for (var key in this.I18n) {
      var value = this.I18n[key];

      var replace = '\{language\.' + key + '\}';
      var re = new RegExp(replace,"g");

      html = html.replace(re, value);
    }
     return html;
};

// prepair Urls
Editor.prototype.prepairUrls = function(html) {
  html = html.replace(/{{root}}/g, this.root);
  return html;
};

Editor.prototype.prepairHtml = function(theme) {
    // custom render canvas/sidebar
    if (typeof(this.canvas) !== 'undefined' && typeof(this.sidePanel) !== 'undefined') {
      var div = $(main);

      // google font/icon
      $('head').append('<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">');
      $('head').append('<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">');
      $('head').append('<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">');

      $(this.canvas).append(this.transformHtml(div.find('.content-left')[0].outerHTML));
      $(this.canvas).append(this.transformHtml(div.find('.undo-redo')[0].outerHTML));
      $(this.sidePanel).append(this.transformHtml(div.find('#builder_sidebar')[0].outerHTML));

      $('body').append(this.transformHtml(controls));
      $('body').append(this.transformHtml(widgets));
      $('body').append(this.transformHtml(other));

      return;
    }

    // Default theme
    if (theme == 'beepro') {
      var html = main_beepro + controls + widgets + other;
    } else {
      var html = main + controls + widgets + other;
    }

    html = this.transformHtml(html);
    html = html.replace(/{{root}}/g, this.root);

    $('body').html(html);
};

Editor.prototype.build = function() {
    // set inline editor
    this.inlineEditor = inlineEditor;
    
    // Icon style
    this.iconStyle = iconStyle;
};

// Popup
require('./scss/popup.scss');
import { PopUp } from './js/popup.js';
window.PopUp = PopUp;

import { helpPopUp } from './js/helpPopup.js';
window.helpPopUp = helpPopUp;

// Sweetalert2
require('./lib/sweetalert/sweetalert2.min.css');
import Swal from './lib/sweetalert/sweetalert2.min.js';
window.Swal = Swal;

// Autocomplete
import {
    acpAutocomplete,
    acpAddCss,
    acpDictionary
} from './js/autocomplete.js';
import { type } from 'jquery';
window.acpAutocomplete = acpAutocomplete;
window.acpAddCss = acpAddCss;
window.acpDictionary = acpDictionary;
