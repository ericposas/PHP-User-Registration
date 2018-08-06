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
      app.settings.state = 'open';
    }else{
      settings.style.display = 'none';
      app.settings.state = 'closed';
    }
  }
}());