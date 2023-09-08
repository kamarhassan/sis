import beautify from 'js-beautify';
window.beautify = beautify;

import { config } from './config.js';
window.config = config;

// jquery
import jQuery from './lib/jquery-3.4.1.min.js';
window.jQuery = jQuery;
window.$ = jQuery;

// bootstrap
require('./lib/popper.js');
require('./lib/bootstrap/bootstrap.min.css');
require('./lib/bootstrap/bootstrap.min.js');

// fontawesome
if (config.builderMode == 'production') {
  require('./lib/fontawesome-free/css/fontawesome.min.css');
  require('./lib/fontawesome-free/css/brands.min.css');
  require('./lib/fontawesome-free/css/solid.min.css');
} else if (config.builderMode == 'demo') {
  require('./lib/fontawesome/css/fontawesome.min.css');
  require('./lib/fontawesome/css/light.min.css');
  require('./lib/fontawesome/css/brands.min.css');
}

// main css/scss
require('./css/font.css');
require('./css/app.css');
require('./scss/builder.scss');
require('./scss/builder_ext.scss');

// export widgets
import {
  OneRowWidget,
  TwoRow48Widget,
  TwoRow66Widget,
  TwoRow84Widget,
  ThreeRow444Widget,
  FourRow3333Widget,
  TextWidget,
  ImageWidget,
  ButtonWidget,
  DividerWidget,
  SocialWidget,
  HtmlWidget,
  VideoWidget,
  ImageCaptionWidget,
  FooterWidget,
  HeaderWidget,
  TableWidget,
  ListImageWidget,
  ProgressBarWidget,
  ListGroupWidget,
  PanelWidget,
  ImageHeaderWidget,
  JumbotronWidget,
  MeterialWidget,
  NavbarWidget,
  PricingTableWidget,
  ServicesListWidget,
  ImageGridWidget,
  UserProfileWidget,
  DivContainerWidget,
  ContainerWidget,
  WellWidget,
  MediaObjectWidget,
  ParagraphWidget,
  MarkedTextWidget,
  DefinitionListWidget,
  BlockqouteWidget,
  UnorderedListWidget,
  HeadingWidget,
  LinkWidget,
  ButtonGroupWidget,
  ButtonToolbarWidget,
  InputFieldWidget,
  TextAreaWidget,
  CheckboxWidget,
  InputGroupWidget,
  FormGroupWidget,
  SelectWidget,
  FormWidget,
  CustomWidget
} from './js/widgets.js';
window.OneRowWidget = OneRowWidget;
window.TwoRow48Widget = TwoRow48Widget;
window.TwoRow66Widget = TwoRow66Widget;
window.TwoRow84Widget = TwoRow84Widget;
window.ThreeRow444Widget = ThreeRow444Widget;
window.FourRow3333Widget = FourRow3333Widget;
window.TextWidget = TextWidget;
window.ImageWidget = ImageWidget;
window.ButtonWidget = ButtonWidget;
window.DividerWidget = DividerWidget;
window.DividerWidget = DividerWidget;
window.SocialWidget = SocialWidget;
window.HtmlWidget = HtmlWidget;
window.VideoWidget = VideoWidget;
window.ImageCaptionWidget = ImageCaptionWidget;
window.FooterWidget = FooterWidget;
window.HeaderWidget = HeaderWidget;
window.TableWidget = TableWidget;
window.ListImageWidget = ListImageWidget;
window.ProgressBarWidget = ProgressBarWidget;
window.ListGroupWidget = ListGroupWidget;
window.PanelWidget = PanelWidget;
window.ImageHeaderWidget = ImageHeaderWidget;
window.JumbotronWidget = JumbotronWidget;
window.MeterialWidget = MeterialWidget;
window.NavbarWidget = NavbarWidget;
window.PricingTableWidget = PricingTableWidget;
window.ServicesListWidget = ServicesListWidget;
window.ImageGridWidget = ImageGridWidget;
window.UserProfileWidget = UserProfileWidget;
window.DivContainerWidget = DivContainerWidget;
window.ContainerWidget = ContainerWidget;
window.WellWidget = WellWidget;
window.MediaObjectWidget = MediaObjectWidget;
window.ParagraphWidget = ParagraphWidget;
window.MarkedTextWidget = MarkedTextWidget;
window.DefinitionListWidget = DefinitionListWidget;
window.BlockqouteWidget = BlockqouteWidget;
window.UnorderedListWidget = UnorderedListWidget;
window.HeadingWidget = HeadingWidget;
window.LinkWidget = LinkWidget;
window.ButtonGroupWidget = ButtonGroupWidget;
window.ButtonToolbarWidget = ButtonToolbarWidget;
window.ButtonToolbarWidget = ButtonToolbarWidget;
window.InputFieldWidget = InputFieldWidget;
window.TextAreaWidget = TextAreaWidget;
window.CheckboxWidget = CheckboxWidget;
window.InputGroupWidget = InputGroupWidget;
window.FormGroupWidget = FormGroupWidget;
window.SelectWidget = SelectWidget;
window.FormWidget = FormWidget;
window.CustomWidget = CustomWidget;

// export elements
import {
  NoneElement,
  OtherElement,
  AElement,
  PElement,
  DivElement,
  ImgElement,
  HeadingElement,
  SpanElement,
  ButtonElement,
  DropdownElement,
  TextElement,
  CheckboxElement,
  VideoElement,
  HtmlElement
} from './js/elements.js';
window.NoneElement = NoneElement;
window.OtherElement = OtherElement;
window.AElement = AElement;
window.PElement = PElement;
window.DivElement = DivElement;
window.ImgElement = ImgElement;
window.HeadingElement = HeadingElement;
window.SpanElement = SpanElement;
window.ButtonElement = ButtonElement;
window.DropdownElement = DropdownElement;
window.TextElement = TextElement;
window.CheckboxElement = CheckboxElement;
window.VideoElement = VideoElement;
window.HtmlElement = HtmlElement;

// export controls
import {
  ColorPickerControl,
  LinkColorControl,
  LineHeightControl,
  ActionControl,
  DivOptionControl,
  BlockOptionControl,
  ImageControl,
  ButtonOptionControl,
  ActionButtonControl,
  DropdownAssociateControl,
  PlaceholderControl,
  TextAssociateControl,
  CheckboxAssociateControl,
  VideoOptionControl,
  HtmlOptionControl,
  TextStyleControl,
  TextSizeControl,
  FontFamilyControl
} from './js/controls.js';
window.ColorPickerControl = ColorPickerControl;
window.LinkColorControl = LinkColorControl;
window.LineHeightControl = LineHeightControl;
window.ActionControl = ActionControl;
window.DivOptionControl = DivOptionControl;
window.BlockOptionControl = BlockOptionControl;
window.ImageControl = ImageControl;
window.ButtonOptionControl = ButtonOptionControl;
window.ActionButtonControl = ActionButtonControl;
window.DropdownAssociateControl = DropdownAssociateControl;
window.PlaceholderControl = PlaceholderControl;
window.TextAssociateControl = TextAssociateControl;
window.CheckboxAssociateControl = CheckboxAssociateControl;
window.VideoOptionControl = VideoOptionControl;
window.HtmlOptionControl = HtmlOptionControl;
window.TextStyleControl = TextStyleControl;
window.TextSizeControl = TextSizeControl;
window.FontFamilyControl = FontFamilyControl;

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
window.ace = ace;

// Builder HTML
import main from './main.html';
import other from './other.html';
import controls from './controls.html';
import widgets from './widgets.html';
import { BuilderIcons } from './js/icon.js';
window.BuilderIcons = BuilderIcons;

// language
import { LANGUAGE } from './language/all.js';
window.LANGUAGE = LANGUAGE;

// extend prepair html for editor
Editor.prototype.setIcons = function(html) {
    var icon = 'default';

    if (typeof(this.iconStyle) != 'undefined') {
      if (typeof(this.iconStyle) != 'undefined') {
        icon = this.iconStyle;
      }
    }

    var icons = BuilderIcons[icon];

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

Editor.prototype.prepairHtml = function() {
    var html = main + controls + widgets + other;

    html = this.setIcons(html);
    html = this.updateLanguage(html);

    $('body').html(this.setIcons(html));
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

// bootstrapGrowl
require('./lib/jquery.bootstrap-growl.min.js');

// Autocomplete
import {
    acpAutocomplete,
    acpAddCss,
    acpDictionary
} from './js/autocomplete.js';
window.acpAutocomplete = acpAutocomplete;
window.acpAddCss = acpAddCss;
window.acpDictionary = acpDictionary;
