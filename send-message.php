<?php
// send-message.php

// hna daba ghanjibo les infos mn form
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];


// ila t-sift l message b sukses
header("Location: contact.php?success=1");
exit;
