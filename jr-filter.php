<?php
/*
Plugin Name: JR Filter
Plugin URI: http://www.jakeruston.co.uk/2010/04/wordpress-plugin-jr-filter/
Description: Replaces profanity words with a word of your choice!
Version: 1.0.6
Author: Jake Ruston
Author URI: http://www.jakeruston.co.uk
*/

/*  Copyright 2010 Jake Ruston - the.escapist22@gmail.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Hook for adding admin menus
add_action('admin_menu', 'jr_Filter_add_pages');

// action function for above hook
function jr_Filter_add_pages() {
    add_options_page('JR Filter', 'JR Filter', 'administrator', 'jr_Filter', 'jr_Filter_options_page');
}
if (!defined("ch"))
{
function setupch()
{
$ch = curl_init();
$c = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
return($ch);
}
define("ch", setupch());
}

if (!function_exists("curl_get_contents")) {
function curl_get_contents($url)
{
$c = curl_setopt(ch, CURLOPT_URL, $url);
return(curl_exec(ch));
}
}
register_activation_hook(__FILE__,'Filter_choice');

function Filter_choice () {
if (get_option("jr_Filter_links_choice")=='') {


$content = curl_get_contents("http://www.jakeruston.co.uk/pluginslink4.php");

if ($content!="") {
update_option("jr_Filter_links_choice", $content);
}
}
}

// jr_effects_options_page() displays the page content for the Test Options submenu
function jr_Filter_options_page() {

    // variables for the field and option names
    $opt_name_1 = 'mt_Filter_bannedwords';	
    $opt_name_5 = 'mt_Filter_plugin_support';
	$opt_name_6 = 'mt_Filter_replacewords';
    $hidden_field_name = 'mt_Filter_submit_hidden';
	$data_field_name_1 = 'mt_Filter_bannedwords';
    $data_field_name_5 = 'mt_Filter_plugin_support';
	$data_field_name_6 = 'mt_Filter_replacewords';

    // Read in existing option value from database
	$opt_val_1 = get_option($opt_name_1);
    $opt_val_5 = get_option($opt_name_5);
	$opt_val_6 = get_option($opt_name_6);
    
if (!$_POST['feedback']=='') {
$my_email1="the.escapist22@gmail.com";
$plugin_name="JR Filter";
$blog_url_feedback=get_bloginfo('url');
$user_email=$_POST['email'];
$user_email=stripslashes($user_email);
$subject=$_POST['subject'];
$subject=stripslashes($subject);
$name=$_POST['name'];
$name=stripslashes($name);
$response=$_POST['response'];
$response=stripslashes($response);
$category=$_POST['category'];
$category=stripslashes($category);
if ($response=="Yes") {
$response="REQUIRED: ";
}
$feedback_feedback=$_POST['feedback'];
$feedback_feedback=stripslashes($feedback_feedback);
if ($user_email=="") {
$headers1 = "From: feedback@jakeruston.co.uk";
} else {
$headers1 = "From: $user_email";
}
$emailsubject1=$response.$plugin_name." - ".$category." - ".$subject;
$emailmessage1="Blog: $blog_url_feedback\n\nUser Name: $name\n\nUser E-Mail: $user_email\n\nMessage: $feedback_feedback";
mail($my_email1,$emailsubject1,$emailmessage1,$headers1);
?>

<div class="updated"><p><strong><?php _e('Feedback Sent!', 'mt_trans_domain' ); ?></strong></p></div>

<?php
}

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
		$opt_val_1 = $_POST[$data_field_name_1];
        $opt_val_5 = $_POST[$data_field_name_5];
		$opt_val_6 = $_POST[$data_field_name_6];

        // Save the posted value in the database
		update_option( $opt_name_1, $opt_val_1 );
        update_option( $opt_name_5, $opt_val_5 );
		update_option( $opt_name_6, $opt_val_6 );

        // Put an options updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Options saved.', 'mt_trans_domain' ); ?></strong></p></div>
<?php

    }

    // Now display the options editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'JR Filter Plugin Options', 'mt_trans_domain' ) . "</h2>";
$blog_url_feedback=get_bloginfo('url');
	$donated=curl_get_contents("http://www.jakeruston.co.uk/p-donation/index.php?url=".$blog_url_feedback);
	if ($donated=="1") {
	?>
		<div class="updated"><p><strong><?php _e('Thank you for donating!', 'mt_trans_domain' ); ?></strong></p></div>
	<?php
	} else {
	if ($_POST['mtdonationjr']!="") {
	update_option("mtdonationjr", "444");
	}
	
	if (get_option("mtdonationjr")=="") {
	?>
	<div class="updated"><p><strong><?php _e('Please consider donating to help support the development of my plugins!', 'mt_trans_domain' ); ?></strong><br /><br /><form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="ULRRFEPGZ6PSJ">
<input type="image" src="https://www.paypal.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form></p><br /><form action="" method="post"><input type="hidden" name="mtdonationjr" value="444" /><input type="submit" value="Don't Show This Again" /></form></div>
<?php
}
}

    // options form
    
    $change3 = get_option("mt_Filter_plugin_support");

if ($change3=="Yes" || $change3=="") {
$change3="checked";
$change31="";
} else {
$change3="";
$change31="checked";
}
    ?>
	<iframe src="http://www.jakeruston.co.uk/plugins/index.php" width="100%" height="20%">iframe support is required to see this.</iframe>
<form name="form1" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p><?php _e("Words (One per line):", 'mt_trans_domain' ); ?> 
<textarea name="<?php echo $data_field_name_1; ?>"><?php echo $opt_val_1; ?></textarea> => <textarea name="<?php echo $data_field_name_6; ?>"><?php echo $opt_val_6; ?></textarea>
</p>

<p><?php _e("Show Plugin Support?", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_5; ?>" value="Yes" <?php echo $change3; ?>>Yes
<input type="radio" name="<?php echo $data_field_name_5; ?>" value="No" <?php echo $change31; ?> id="Please do not disable plugin support - This is the only thing I get from creating this free plugin!" onClick="alert(id)">No
</p>

<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'mt_trans_domain' ) ?>" />
</p><hr />

</form>
<script type="text/javascript">
function validate_required(field,alerttxt)
{
with (field)
  {
  if (value==null||value=="")
    {
    alert(alerttxt);return false;
    }
  else
    {
    return true;
    }
  }
}

function validateEmail(ctrl){

var strMail = ctrl.value
        var regMail =  /^\w+([-.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;

        if (regMail.test(strMail))
        {
            return true;
        }
        else
        {

            return false;

        }
					
	}

function validate_form(thisform)
{
with (thisform)
  {
  if (validate_required(subject,"Subject must be filled out!")==false)
  {email.focus();return false;}
  if (validate_required(email,"E-Mail must be filled out!")==false)
  {email.focus();return false;}
  if (validate_required(feedback,"Feedback must be filled out!")==false)
  {email.focus();return false;}
  if (validateEmail(email)==false)
  {
  alert("E-Mail Address not valid!");
  email.focus();
  return false;
  }
 }
}
</script>
<h3>Submit Feedback about my Plugin!</h3>
<p><b>Note: Only send feedback in english, I cannot understand other languages!</b><br /><b>Please do not send spam messages!</b></p>
<form name="form2" method="post" action="" onsubmit="return validate_form(this)">
<p><?php _e("Your Name:", 'mt_trans_domain' ); ?> 
<input type="text" name="name" /></p>
<p><?php _e("E-Mail Address (Required):", 'mt_trans_domain' ); ?> 
<input type="text" name="email" /></p>
<p><?php _e("Message Category:", 'mt_trans_domain'); ?>
<select name="category">
<option value="General">General</option>
<option value="Feedback">Feedback</option>
<option value="Bug Report">Bug Report</option>
<option value="Feature Request">Feature Request</option>
<option value="Other">Other</option>
</select>
<p><?php _e("Message Subject (Required):", 'mt_trans_domain' ); ?>
<input type="text" name="subject" /></p>
<input type="checkbox" name="response" value="Yes" /> I want e-mailing back about this feedback</p>
<p><?php _e("Message Comment (Required):", 'mt_trans_domain' ); ?> 
<textarea name="feedback"></textarea>
</p>
<p class="submit">
<input type="submit" name="Send" value="<?php _e('Send', 'mt_trans_domain' ); ?>" />
</p><hr /></form>
</div>
<?php } ?>
<?php
if (get_option("jr_Filter_links_choice")=="") {
Filter_choice();
}

function show_Filter($content) {
$bannedwords=get_option("mt_Filter_bannedwords");
$replacewords=get_option("mt_Filter_replacewords");

$bannedwords=preg_replace('/\r?\n/', '$*�&$^�&$^�&^', $bannedwords); 
$replacewords=preg_replace('/\r?\n/', '$*�&$^�&$^�&^', $replacewords); 

$bannedwords=explode("$*�&$^�&$^�&^", $bannedwords);
$replacewords=explode("$*�&$^�&$^�&^", $replacewords);
$counter=0;
	foreach($bannedwords as $row)
	{
	
	if ($replacewords[$counter]=="") {
	$replacewords[$counter]="****";
	}
	
		$content = eregi_replace($row,$replacewords[$counter],$content);
		$counter ++;
	}
$supportplugin=get_option("mt_Filter_plugin_support");
if ($supportplugin=="" || $supportplugin=="Yes") {
add_action('wp_footer', 'Filter_footer_plugin_support');
}

	return $content;
}

function Filter_footer_plugin_support() {
  echo "<p style='font-size:x-small'>Filter Plugin created by Jake Ruston's <a href='http://www.jakeruston.co.uk'>Wordpress Plugins</a> - ".get_option('jr_Filter_links_choice')."</p>";
}

add_filter('the_content','show_Filter');
add_filter('comment_text','show_Filter');
?>
