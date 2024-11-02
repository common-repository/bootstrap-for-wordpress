<?php
/*
Plugin Name: Bootstrap for wordpress plugin
Plugin URI: http://www.kankod.com/bootstrapWP
Description: Bootstrap for wordpress plugin enables the Twitter bootstrap library for your wordpress site
Version: 0.11
Author: kankod.com
*/

if( !is_admin() ) {
	add_action('wp_print_scripts', 'bootstrap_filter_footer');
}
add_action('admin_menu', 'bootstrap_config_page');

function bootstrap_filter_footer() {
	$bootstrapJS = get_option('bootstrapJS');
	$bootstrapJQ = get_option('bootstrapJQ');
	$bootstrapUrl = get_option('bootstrapURL');
	$bootstrap_enabled = get_option('bootstrapEN');
	if ($bootstrap_enabled) {
		if($bootstrapUrl != ''){
			wp_register_style( 'bootstrap',$bootstrapUrl);	 
		}
		else {
			wp_register_style( 'bootstrap',plugins_url('css/bootstrap.min.css', __FILE__));
		}
		wp_enqueue_style( 'bootstrap' );
	}

	if ($bootstrapJQ) {
			wp_enqueue_script('btJQ', plugins_url('js/bsjq.js', __FILE__), false, false, true );		
	}
	
	if ($bootstrapJS) {
			wp_enqueue_script('btJS', plugins_url('js/bs.js', __FILE__), false, false, true );		
	}
}

function bootstrap_config_page() {
	add_submenu_page('themes.php', __('Bootstrap'), __('Bootstrap'), 'manage_options', 'bootstrap-key-config', 'bootstrap_config');
}

function bootstrap_config() {
	$bootstrapCssUrl = get_option('bootstrapURL');
	$bootstrap_enabled = get_option('bootstrapEN');
	$bootstrapJQ = get_option('bootstrapJQ');
	$bootstrapJS = get_option('bootstrapJS');
	if ( isset($_POST['submit']) ) {
		if (isset($_POST['bootstrap_enabled']))
		{
			if ($_POST['bootstrap_enabled'] == 'on')
			{
				$bootstrap_enabled = 1;
			}
			else
			{
				$bootstrap_enabled = 0;
			}
		}
		else
		{
			$bootstrap_enabled = 0;
		}
		
		if (isset($_POST['bootstrapJQ']))
		{
			if ($_POST['bootstrapJQ'] == 'on')
			{
				$bootstrapJQ = 1;
			}
			else
			{
				$bootstrapJQ = 0;
			}
		}

		else
		{
			$bootstrapJQ = 0;
		}		
		
		if (isset($_POST['bootstrapJS']))
		{
			if ($_POST['bootstrapJS'] == 'on')
			{
				$bootstrapJS = 1;
			}
			else
			{
				$bootstrapJS = 0;
			}
		}
		
		else
		{
			$bootstrapJS = 0;
		}		
		
		$bootstrapCssUrl = $_POST['bootstrapCssUrl'];
		
		update_option('bootstrapJS', $bootstrapJS);
		update_option('bootstrapJQ', $bootstrapJQ);
		update_option('bootstrapEN', $bootstrap_enabled);
		update_option('bootstrapURL', $bootstrapCssUrl);

		echo "<div id=\"updatemessage\" class=\"updated fade\"><p>Bootstrap settings updated.</p></div>\n";
		echo "<script type=\"text/javascript\">setTimeout(function(){jQuery('#updatemessage').hide('slow');}, 3000);</script>";
			
	}
	?>
	<div class="wrap" style="width:99%;">
		<h2>Bootstrap for WordPress Configuration</h2>
		<div class="postbox-container" style="width:100%;">
			<div class="metabox-holder">	
				<div class="meta-box-sortables">
					<form action="" method="post" id="">
					<div id="" class="postbox">
						<div class="handlediv" title="Click to toggle"><br /></div>
						<h3 class="hndle"><span>Bootstap for wordpress Settings</span></h3>
						<div class="inside">
							<table class="form-table">
								<tr><th valign="top" scrope="row">Bootstrap CSS On/Off:</th>
								<td valign="top"><input type="checkbox" id="" name="bootstrap_enabled" <?php echo ($bootstrap_enabled ? 'checked="checked"' : ''); ?> /> <label for="enabled">Enable or disable Bootstrap CSS</label><br/></td></tr>

								<tr><th valign="top" scrope="row"><label for="toolbarpath">Custom bootstrap CSS URL (optional):</label></th>
								<td valign="top"><input id="bootstrapCssUrl" name="bootstrapCssUrl" type="text" size="20" value="<?php echo $bootstrapCssUrl; ?>"/></td></tr>
								
								<tr><th valign="top" scrope="row">Bootstrap JS On/Off:</th>
								<td valign="top"><input type="checkbox" id="" name="bootstrapJS" <?php echo ($bootstrapJS ? 'checked="checked"' : ''); ?> /> <label for="enabled">Enable or disable Bootstrap JS</label><br/></td></tr>
								
								<tr><th valign="top" scrope="row">Include jQuery</th>
								<td valign="top"><input type="checkbox" id="" name="bootstrapJQ" <?php echo ($bootstrapJQ ? 'checked="checked"' : ''); ?> /> <label for="enabled">Include jQuery</label><br/></td></tr>

							</table>
														<table>
																<tr>					<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fkankod&amp;width=292&amp;height=62&amp;colorscheme=light&amp;show_faces=false&amp;border_color&amp;stream=false&amp;header=true&amp;appId=161452587293470" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:62px;" allowTransparency="true"></iframe></tr>
							</table>
						</div>
					</div>
					<div class="submit"><input type="submit" class="button-primary" name="submit" value="Update Toolbar &raquo;" /></div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php
} 
?>