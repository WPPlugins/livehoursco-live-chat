<?php
/*
Plugin Name: OnlineLiveChat.com Live Chat
Description: Add Live Chat Support for your website (messages come to your phone a text messages).
Version: 1.1.2
Author: OnlineLiveChat.com
Author URI: http://www.onlinelivechat.com
License: GPL2

Copyright 2012 - 2014  Livehours.co  (email : help@onlinelivechat.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function livehours_menu() {
	$tab_name = "OnlineLiveChat";
	if (get_option( 'livehours_token' ) == "") { $tab_name = $tab_name . "*"; }
	add_menu_page( 'OnlineLiveChat', $tab_name, 'manage_options', 'livehours', 'livehours_options' );
}

function livehours_tag() {
?>
<script type="text/javascript">
	var _lhs = _lhs || [];
	_lhs.push(['_setAccount', '<?php echo get_option( 'livehours_token' ); ?>']);

	(function() {
		var lh = document.createElement('script'); lh.type = 'text/javascript'; lh.async = true;
		lh.src = 'http://cdn.onlinelivechat.com/<?php echo get_option( 'livehours_token' ); ?>';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lh, s);
	})();
</script>
<?php
}

function livehours_options() {
	
	$siteurl = get_option('siteurl');
	$pluginurl = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__));
	$notice = "";
	
	if ($_POST)
	{
		update_option( 'livehours_token', $_POST["livehours"]["token"] );
		$notice = $notice . " Your token is <b>updated</b>! ";
	}
		
	if (get_option( 'livehours_token' ) != "")
	{
		$notice = $notice . "OnlineLiveChat is <b>installed</b>! ";
	}
?>

<div class="wrap">
	
	<p><a href="http://www.onlinelivechat.com"><img src="<?php echo $pluginurl; ?>/imgs/logo.png" /></a></p>
	
	<?php if ($notice != "") { ?>
		<div style="color: green; background: #C0F2C9; border: 1px solid green; border-radius: 5px; padding: 0px 10px; margin-bottom: 20px; ">
			<p><?php echo $notice; ?></p>
		</div>
	<?php } ?>

	<p>Welcome to the OnlineLiveChat.com plugin - the easiest way to install your OnlineLiveChat.com live chat on your website. To control</p>

	<form action="admin.php?page=livehours" method="post">
		<label for="livehours_token">
			<h3>What is your OnlineLiveChat token? <a id="show_help" href="javascript:showHelp();">How do I find it?</a></h3>
			<div id="token_help" style="display: none; font-size: 12px; ">
				<ol>
					<li>
						<p>Sign in to your account at <a href="http://app.onlinelivechat.com" target="_blank">http://app.onlinelivechat.com</a>.</p>
					</li>
					<li>
						<p>
							Visit the "Settings" page. 
						</p>
					</li>
					<li>
						<p>
							You should see something like the image below. We have circled where you can find your OnlineLiveChat token.
						</p>
						<img src="<?php echo $pluginurl; ?>/imgs/screenshot1.png" />
					</li>
				</ol>
			</div>
			<input type="text" name="livehours[token]" id="livehours_token" value="<?php echo get_option( 'livehours_token' ); ?>" /><br /><br />
		</label>
		<input type="submit" value="Add OnlineLiveChat to my site!" class="button-primary" />
	</form>
	
</div>

<script type="text/javascript">
	function showHelp() {
		if (document.getElementById("token_help").style.display == "none")
		{
			document.getElementById("token_help").style.display = "block";
			document.getElementById("show_help").innerText = "Close help.";
		}
		else
		{
			document.getElementById("token_help").style.display = "none";
			document.getElementById("show_help").innerText = "How do I find it?";
		}
	}
</script>

<?php
}

add_action( 'admin_menu', 'livehours_menu' );
add_action( 'wp_head' , 'livehours_tag' );

?>