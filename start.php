<?php
/**
 * Fblink.
 * 
 * @package fblink
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Kévin Dunglas
 * @link http://lapin-blanc.net/
 */

function fblink_init() {
  global $CONFIG;

	register_translations($CONFIG->pluginspath . 'fblink/languages/');	
	register_plugin_hook('usersettings:save','user','fblink_user_settings_save');
}

function fblink_facebook() {
  global $CONFIG;
  static $facebook = null;

  if (!$facebook instanceof Facebook) {
  	include_once($CONFIG->pluginspath . 'fblink/lib/vendor/facebook/facebook.php');
  	
  	
    Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYPEER] = false;
    Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYHOST] = 2;

  	
  	$appId = get_plugin_setting('appId', 'fblink');
  	$secret = get_plugin_setting('secret', 'fblink');
  	
  	$facebook = new Facebook(array(
      'appId'  => $appId,
      'secret' => $secret,
      'cookie' => true,
    ));
    
    $session = $facebook->getSession();
    
    $me = null;
    // Session based API call.
    if ($session) {
      try {
        $uid = $facebook->getUser();
        $me = $facebook->api('/me');
      } catch (FacebookApiException $e) {
        error_log($e);
      }
    }
  }
  
  return $facebook;
}

global $CONFIG;

register_action('fblink/link', false, $CONFIG->pluginspath . 'fblink/actions/link.php');
?>