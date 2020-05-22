<?php
add_action('admin_menu', 'wiki_plugin_settings');

function wiki_plugin_settings() {

    add_menu_page('Wiki Settings', 'Wiki Settings', 'administrator', 'wiki_settings', 'wiki_display_settings','');

}

function wiki_display_settings() {

    $ff_toggle = (get_option('ff_action') == 'toggle') ? 'selected' : '';
    $ff_accordion = (get_option('ff_action') == 'accordion') ? 'selected' : '';
	
	$ff_css = (get_option('ff_showicon') == 'css') ? 'selected' : '';
    $ff_image = (get_option('ff_showicon') == 'image') ? 'selected' : '';
    $ff_none = (get_option('ff_showicon') == 'none') ? 'selected' : '';
	
    $abgcolor = (get_option('ff_abgcolor') != '') ? get_option('ff_abgcolor') : '#93dd64';
    $pbgcolor = (get_option('ff_pbgcolor') != '') ? get_option('ff_pbgcolor') : '#60B7FC';
    

    $html = '<div class="wrap">

            <form method="post" name="options" action="options.php">

            <h2>Wiki Settings</h2>' . wp_nonce_field('update-options') . '
            <table width="100%" cellpadding="10" class="form-table">
                <tr>
                    <td align="left" scope="row">
                    <label>jQuery Action: </label><select name="ff_action" >
						<option value="accordion" '.$ff_accordion.'>Accordion</option>
						<option value="toggle" ' . $ff_toggle . '>Toggle</option>
                    </select>
             

                    </td> 
                </tr>
				<tr>
                    <td align="left" scope="row">
                    <label>Show Q & A Icon: </label><select name="ff_showicon" >
						<option value="css" '.$ff_css.'>CSS Icon</option>
						<option value="image" ' . $ff_image . '>Image Icon</option>
						<option value="none" ' . $ff_none . '>None</option>
                    </select>
                    </td> 
                </tr>
                <tr>
                    <td align="left" scope="row">
                    <label>"Q" Icon Background Color: </label><input type="text" name="ff_pbgcolor" 
                    value="' . $pbgcolor . '" />

                    </td> 
                </tr>
                <tr>
                    <td align="left" scope="row">
                    <label>"A" Icon Background Color: </label><input type="text" name="ff_abgcolor" 
                    value="' . $abgcolor . '" />

                    </td> 
                </tr>
            </table>
            <p class="submit">
                <input type="hidden" name="action" value="update" />  
                <input type="hidden" name="page_options" value="ff_action,ff_showicon,ff_ qbgcolor,ff_abgcolor,ff_pbgcolor" /> 
                <input type="submit" name="Submit" value="Update" />
            </p>
            </form>

        </div>';
    echo $html;
}
?>