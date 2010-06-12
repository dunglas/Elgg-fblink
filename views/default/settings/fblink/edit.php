<?php

$body = '';

$body .= elgg_echo('fblink:settings:appId:title');
$body .= '<br />';
$body .= elgg_view('input/text',array('internalname'=>'params[appId]','value'=>get_plugin_setting('appId', 'fblink')));

$body .= '<br /><br />';

$body .= elgg_echo('fblink:settings:secret:title');
$body .= '<br />';
$body .= elgg_view('input/text',array('internalname'=>'params[secret]','value'=>get_plugin_setting('secret', 'fblink')));

echo $body;
?>