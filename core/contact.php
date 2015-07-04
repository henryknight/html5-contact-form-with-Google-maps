<?php
function removebadtags($data) {
  $data = preg_replace("/<html/i", "&lt;html",$data);
  $data = preg_replace("/<body/i", "&lt;body",$data);
  return strip_tags(trim($data));
}
function eraseData($data) {
  $data = str_replace(' & ', ' &amp; ', $data);
  return (get_magic_quotes_gpc() ? stripslashes($data) : $data);
}
function multiDimensionalArrayMap($func,$arr) {
  $newArr = array();
  if (!empty($arr)) {
    foreach($arr AS $key => $value) {
      $newArr[$key] = (is_array($value) ? multiDimensionalArrayMap($func,$value) : $func($value));
    }
  }
  return $newArr;
}
if (!empty($_POST)){
  $data['success'] = true;
  $_POST = multiDimensionalArrayMap('removebadtags', $_POST);
  $_POST = multiDimensionalArrayMap('eraseData', $_POST);
  $emailTo ="anyemail@email.com"; // This is the email you want the response to go to.
  $emailFrom ="anyemail@email.com"; // This is to show where the email has come from and to stop errors with spam if using a black list.
  $emailSubject = "Contact Us!"; // This is the the title for the contact
  $name = $_POST["name"];
  $email = $_POST["email"];
  $comment = $_POST["comment"];
    if($name == "")
   $data['success'] = false;
 if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) 
   $data['success'] = false;
 if($comment == "")
   $data['success'] = false;
