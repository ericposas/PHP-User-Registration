exports.about_me_modal = (function(){
  
  var about_me_btn = document.getElementById('about-me-update');
  var about_me_modal = document.getElementById('about-me-modal');
  var about_me_modal_close_button = document.getElementById('about-me-modal-close-button');
  
  about_me_btn.addEventListener('click', function(){
    about_me_modal.style.display = 'block';
  });
  about_me_modal_close_button.addEventListener('click', function(){
    about_me_modal.style.display = 'none';
  });
  
}());