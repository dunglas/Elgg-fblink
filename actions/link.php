<?php
$facebook = fblink_facebook();

$facebook_id = $facebook->getUser();
if ($facebook_id) {
  set_plugin_usersetting('facebook_id', $facebook_id, $_SESSION['user']->getGUID(), 'fblink');
} else {
	register_error(elgg_echo('fblink:link:fail'));
}

forward();
exit;
?>