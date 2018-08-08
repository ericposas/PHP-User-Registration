exports.change_address = (function(){
  
  let add_change_details_elt = document.getElementById('add-change-address');
  let add_change_details_x = document.getElementById('change-address-modal-close-button');
  let addchange_popup = document.getElementById('change-address-modal');
  add_change_details_elt.addEventListener('click', function(){
    addchange_popup.style.display = 'block';
  });
  add_change_details_x.addEventListener('click', function(){
    addchange_popup.style.display = 'none';
  });
  
}());