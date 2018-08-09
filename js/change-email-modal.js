exports.change_email = (function(){
  
  var c_email = document.getElementById('add-change-email');
  var x_btn = document.getElementById('change-email-modal-close-button');
  var email_modal = document.getElementById('change-email-modal');
  c_email.addEventListener('click', function(){
    email_modal.style.display = 'block';
  });
  x_btn.addEventListener('click', function(){
    email_modal.style.display = 'none';
  });
  
}());