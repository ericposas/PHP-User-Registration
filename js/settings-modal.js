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