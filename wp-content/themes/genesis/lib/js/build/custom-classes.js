!function(e){var t={};function n(o){if(t[o])return t[o].exports;var r=t[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{configurable:!1,enumerable:!0,get:o})},n.r=function(e){Object.defineProperty(e,"__esModule",{value:!0})},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=22)}([function(e,t){!function(){e.exports=this.wp.element}()},function(e,t){!function(){e.exports=this.wp.i18n}()},function(e,t){!function(){e.exports=this.wp.data}()},function(e,t){!function(){e.exports=this.wp.components}()},function(e,t){!function(){e.exports=this.wp.compose}()},function(e,t){!function(){e.exports=this.wp.plugins}()},function(e,t,n){var o=n(7);e.exports=function(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{},r=Object.keys(n);"function"==typeof Object.getOwnPropertySymbols&&(r=r.concat(Object.getOwnPropertySymbols(n).filter(function(e){return Object.getOwnPropertyDescriptor(n,e).enumerable}))),r.forEach(function(t){o(e,t,n[t])})}return e}},function(e,t){e.exports=function(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}},,,,,,,,,,,,,,,function(e,t,n){"use strict";n.r(t);var o=n(0),r=n(1),c=n(3),s=n(5),i=n(6),u=n.n(i),a=n(4),l=n(2);var f=Object(a.compose)([Object(l.withSelect)(function(){return{bodyClass:Object(l.select)("core/editor").getEditedPostAttribute("meta")._genesis_custom_body_class}}),Object(l.withDispatch)(function(e){return{onUpdate:function(t){var n=Object(l.select)("core/editor").getEditedPostAttribute("meta"),o=u()({},n,{_genesis_custom_body_class:t});e("core/editor").editPost({meta:o})}}})])(
/**
 * The BodyClassTextControl component for use in the Custom Classes panel.
 *
 * @since   3.1.0
 * @package Genesis\JS
 * @author  StudioPress
 * @license GPL-2.0-or-later
 */
function(e){var t=e.bodyClass,n=e.onUpdate;return Object(o.createElement)(c.TextControl,{label:Object(r.__)("Body Class","genesis"),value:t,onChange:function(e){return n(e)}})});
/**
 * The PostClassTextControl component for use in the Custom Classes panel.
 *
 * @since   3.1.0
 * @package Genesis\JS
 * @author  StudioPress
 * @license GPL-2.0-or-later
 */var b=Object(a.compose)([Object(l.withSelect)(function(){return{postClass:Object(l.select)("core/editor").getEditedPostAttribute("meta")._genesis_custom_post_class}}),Object(l.withDispatch)(function(e){return{onUpdate:function(t){var n=Object(l.select)("core/editor").getEditedPostAttribute("meta"),o=u()({},n,{_genesis_custom_post_class:t});e("core/editor").editPost({meta:o})}}})])(function(e){var t=e.postClass,n=e.onUpdate;return Object(o.createElement)(c.TextControl,{label:Object(r.__)("Post Class","genesis"),value:t,onChange:function(e){return n(e)}})});
/**
 * Adds a Classes panel to the Genesis Block Editor sidebar with body class
 * and post class input fields.
 *
 * Fields are stored in post meta as:
 *
 * - `_genesis_custom_body_class`
 * - `_genesis_custom_post_class`
 *
 * These are the same fields used by the original Layout Settings meta box.
 *
 * @since   3.1.0
 * @package Genesis\JS
 * @author  StudioPress
 * @license GPL-2.0-or-later
 */Object(s.registerPlugin)("genesis-custom-classes",{render:function(){return Object(o.createElement)(o.Fragment,null,Object(o.createElement)(c.Fill,{name:"GenesisSidebar"},Object(o.createElement)(c.Panel,null,Object(o.createElement)(c.PanelBody,{initialOpen:!0,title:Object(r.__)("Custom Classes","genesis")},Object(o.createElement)(f,null),Object(o.createElement)(b,null)))))}})}]);