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