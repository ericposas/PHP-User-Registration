(function(){function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s}return e})()({1:[function(require,module,exports){
let settings = require('./settings-modal.js');
let photo = require('./photo-modal.js');
let user = require('./change-user-details.js');

},{"./change-user-details.js":2,"./photo-modal.js":3,"./settings-modal.js":4}],2:[function(require,module,exports){
exports.change_user_details = (function(){
  
  let add_change_details_elt = document.getElementById('add-change-user-details');
  let add_change_details_x = document.getElementById('change-user-details-modal-close-button');
  let addchange_popup = document.getElementById('change-user-details-modal');
  add_change_details_elt.addEventListener('click', function(){
    addchange_popup.style.display = 'block';
  });
  add_change_details_x.addEventListener('click', function(){
    addchange_popup.style.display = 'none';
  });
  
}());
},{}],3:[function(require,module,exports){
exports.photo_modal = (function() {
  // "constructor" 
  var photo_change = document.getElementById('profile-photo-change');
  var photo_modal = document.getElementById('profile-photo-modal');
  var x = document.getElementById('profile-photo-modal-close-button');
  photo_change.addEventListener('click', toggle_photo_modal);
  x.addEventListener('click', toggle_photo_modal);
  
  function toggle_photo_modal(){
    if(app.photo_modal.state == 'closed'){
      photo_modal.style.display = 'block';
      app.photo_modal.state = 'open';
    }else{
      photo_modal.style.display = 'none';
      app.photo_modal.state = 'closed';
    }
  }
  
}());
},{}],4:[function(require,module,exports){
exports.settings_modal = (function() {
  // "constructor" 
  var gear = document.getElementById('gear');
  var settings = document.getElementById('settings');
  var x = document.getElementById('settings-close-button');
  gear.addEventListener('click', toggle_settings_modal);
  x.addEventListener('click', toggle_settings_modal);
  function toggle_settings_modal(){
    if(app.settings.state == 'closed'){
      settings.style.display = 'block';
      document.getElementById('dimmer').style.opacity = 1;
      app.settings.state = 'open';
    }else{
      settings.style.display = 'none';
      document.getElementById('dimmer').style.opacity = 0;
      app.settings.state = 'closed';
    }
  }
}());
},{}]},{},[1]);
