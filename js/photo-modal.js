exports.photo_modal = (function() {
  // "constructor" 
  var photo_change = document.getElementById('profile-photo-change');
  var photo_modal = document.getElementById('profile-photo-modal');
  //var settings = document.getElementById('settings');
  var x = document.getElementById('profile-photo-modal-close-button');
  
  //var photo = document.getElementById('profile-photo');
  
  /*photo.addEventListener('click', function(){
    settings.style.display = 'block';
    photo_modal.style.display = 'block';
  });*/
  
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