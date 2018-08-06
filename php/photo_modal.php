<?php

function photo_modal(){
  echo "
  <div id=\"profile-photo-modal\">
    <div id=\"profile-photo-modal-close-button\">x</div>
    <div id=\"choose-a-photo\">
      Please choose a photo for upload.
    </div>
    <form id=\"upload-form\" enctype=\"multipart/form-data\" method=\"post\" action=\"upload_photo.php\">
      <input type=\"file\" name=\"file\"><br><br>
      <input id=\"upload-btn\" type=\"submit\" value=\"Upload\">
    </form>
  </div>
  ";
}