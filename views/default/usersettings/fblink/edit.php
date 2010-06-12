<?php
/**
 * User settings for fblink.
 *
 * @package fblink
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Kévin Dunglas
 * @link http://lapin-blanc.net/
 */
?>

<p>
    <?php if (isset($vars['entity']->facebook_id) && $vars['entity']->facebook_id): ?>
        <?php echo elgg_echo('fblink:usersettings:facebook_id'); ?>
    <input type="text" name="params[facebook_id]" value="<?php echo htmlspecialchars($vars['entity']->facebook_id) ?>" />
    <?php else: ?>
<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script type="text/javascript">
    FB.init({appId: <?php echo get_plugin_setting('appId', 'fblink'); ?>, status: true, cookie: true, xfbml: true});

    function notOk() {
        alert("<?php echo elgg_echo('fblink:usersettings:loginerror') ?>");
    }

    $(document).ready(function() {
        $('#fb-login-button').click(function () {
            var neededPerms = ['offline_access', 'friends_online_presence'];

            FB.login(function(response) {
                if (response.session) {
                    if (response.perms) {
                        // user is logged in and granted some permissions.
                        // perms is a comma separated list of granted permissions
                        var perms = response.perms.split(',');

                        $.each(neededPerms, function (index, value) {
                            if (jQuery.inArray(value, perms) == -1) {
                                return notOk();
                            }
                        });

                        document.location.href = "<?php echo elgg_validate_action_url($vars['url'].'action/fblink/link') ?>";

                    } else {
                        // user is logged in, but did not grant any permissions
                        notOk();
                    }
                } else {
                    // user is not logged in
                    notOk();
                }
            }, {perms: neededPerms.join(',')});
        });
    });
</script>
<input type="button" id="fb-login-button" value="<?php echo elgg_echo('fblink:usersettings:link') ?>" />
<?php endif ?>