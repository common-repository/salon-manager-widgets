<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.salonmanager.com/
 * @since      1.0.0
 *
 * @package    Salon_Manager_Widget
 * @subpackage Salon_Manager_Widget/admin/partials
 */

?>
	<?php
	//Grab all options
	$options = get_option($this->plugin_name);
	
	$sal_widget_id = $options['sal_widget_id'];
	$sal_widget_key = $options['sal_widget_key'];
	
	//$msg="asas";
	if($sal_widget_id!=""){
	$apikey=$sal_widget_id;
    $data_array =  array("accessKey" => $apikey);
	$args = array(
    'body'        => json_encode($data_array),
    'timeout'     => '5',
	'method'      => 'PUT',
    'redirection' => '5',
    'httpversion' => '1.0',
    'blocking'    => true,
    'headers'     => array(),
    'cookies'     => array(),
	);
	$updateplan = wp_remote_post('https://widgets.api.salonmanager.com/v1/web-access-keys/verify', $args );
	$response = json_decode($updateplan['body']);
	$valuetoinput=$response->data->widgetId;
    if($valuetoinput!=""){
        $sal_widget_key = $valuetoinput;
    	//$msg="Entered data";
    }else{
    	//$msg="Invalid Access Key";
        
	}
	}
	
	
	?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

	<h2 class="h2content">Salon Widget Settings</h2>

	<h2 class="h2content">Your Access Key will be sent to your buisness email address once you enable the web widgets in your iPad app.</br>Please go to Side Menu > Admin Dashboard > Settings > Website Widgets.</h2>

	<form method="post" name="cleanup_options" action="options.php">
	   <?php  
	    settings_fields( $this->plugin_name );
    	do_settings_sections( $this->plugin_name );
      ?>
	<!-- load jQuery from CDN -->
	<fieldset>
		         <fieldset>
                    <p class="pcalls">Enter Access Key</p>
                    <legend class="screen-reader-text"><span><?php _e('Enter Your Salon Id', $this->plugin_name);?></span></legend>
                    <input type="text" required class="regular-text inputclass" id="<?php echo esc_html($this->plugin_name);?>-sal_widget_id" placeholder="Enter Access Key" name="<?php echo esc_html($this->plugin_name);?>[sal_widget_id]" value="<?php if(!empty($sal_widget_id)) echo esc_html($sal_widget_id);?>"/>
                    <input type="hidden" class="regular-text" id="<?php echo esc_html($this->plugin_name);?>-sal_widget_key" name="<?php echo esc_html($this->plugin_name);?>[sal_widget_key]" value="<?php if(!empty($sal_widget_key)) echo esc_html($sal_widget_key);?>"/>
                </fieldset>
	</fieldset>
        <?php submit_button('Publish', 'primary','submit', TRUE); ?>

    </form>

</div>