<?php
/*
Plugin Name: Tweefind
Plugin URI: http://www.tweefind.com/
Description: Displays tweets related to your posts, ordered by rank. Admin <a href="options-general.php?page=tweefindid.php">Options -&gt; Tweefind</a>.
Version: 0.8
Author: Tweefind.com
*/

//0.1 first release
//0.2 added admin panel (width and height options)
//0.3 added ability to modify number of tweets shown
//0.5 added ability to show/hide searchbox, change color, hide logo, stop live search, show/hide play/pause button
//0.7 added link to admin panel from WP plugin page, added new available size, ability to change the default tag 
//0.8 minor bug fixes

function add_tweefind_widget($content) 
{ 
   $posttags = get_the_tags();
   $options = get_option('tweeoption');
   
   if (!isset($options['twee_type'])) $options['twee_type'] = 1;
   if (!isset($options['twee_tag'])) $options['twee_tag'] = 'tweefind';
   if (!isset($options['twee_width'])) $options['twee_width'] = 574;
   if (!isset($options['twee_height'])) $options['twee_height'] = 350;
   if (!isset($options['twee_slots'])) $options['twee_slots'] = 3;
   if (!isset($options['twee_searchbox'])) $options['twee_searchbox'] = 'yes';
   if (!isset($options['twee_livesearch'])) $options['twee_livesearch'] = 'yes';
   if (!isset($options['twee_displaybuttons'])) $options['twee_displaybuttons'] = 'yes';
   if (!isset($options['twee_logo'])) $options['twee_logo'] = 0;
   if (!isset($options['twee_color'])) $options['twee_color'] = 'DE6770';
   
   
   $tweetag = 'tweefind';
   $tweetype = 1;
   $count=0;
   
   if (is_single()) {
   
   if ($posttags) 
     {
       foreach($posttags as $thetag) 
       { 
          $count++;
          if (1 == $count) 
           {
             $tweetag=$thetag->name;
           }
       }
      }
    else {
     $tweetag=$options['twee_tag'];
     }
    
   if (isset($options['twee_type'])) $tweetype=$options['twee_type'];    
   
   if ($tweetype==1) {
   $content.= "<iframe frameborder=0 width='".$options['twee_width']."px' height='".$options['twee_height']."px' src=\"http://www.tweefind.com/widgets/bigwidget.php?slots=".$options['twee_slots']."&searchbox=".$options['twee_searchbox']."&livesearch=".$options['twee_livesearch']."&displaybuttons=".$options['twee_displaybuttons']."&logo=".$options['twee_logo']."&color=".$options['twee_color']."&tag=$tweetag\"></iframe>";
   }
   
   else{
   $content.= "<iframe frameborder=0 width='".$options['twee_width']."px' height='".$options['twee_height']."px' src=\"http://www.tweefind.com/widgets/sidewidget.php?slots=".$options['twee_slots']."&searchbox=".$options['twee_searchbox']."&livesearch=".$options['twee_livesearch']."&displaybuttons=".$options['twee_displaybuttons']."&logo=".$options['twee_logo']."&color=".$options['twee_color']."&tag=$tweetag\"></iframe>";
   }

   
   
   } //issingle
    
    return $content;
  
}
 
function tweefind_menu() {
  add_options_page('Tweefind Options', 'Tweefind', 8, 'tweefindid', 'tweefind_options');
}

function tweefind_options() {

$options = get_option('tweeoption');
    if (!isset($options['twee_type'])) $options['twee_type'] = 1;
    if (!isset($options['twee_tag'])) $options['twee_tag'] = 'tweefind';
	if (!isset($options['twee_width'])) $options['twee_width'] = 574;
	if (!isset($options['twee_height'])) $options['twee_height'] = 350;
	if (!isset($options['twee_slots'])) $options['twee_slots'] = 3;
	if (!isset($options['twee_searchbox'])) $options['twee_searchbox'] = 'yes';
	if (!isset($options['twee_livesearch'])) $options['twee_livesearch'] = 'yes';
	if (!isset($options['twee_displaybuttons'])) $options['twee_displaybuttons'] = 'yes';
	if (!isset($options['twee_logo'])) $options['twee_logo'] = 0;
	if (!isset($options['twee_color'])) $options['twee_color'] = 'DE6770';
		
	$updated = false;
	if ( isset($_POST['submit']) ) {
		check_admin_referer();
		
		
		if (isset($_POST['twee_type'])) {
			$twee_type = $_POST['twee_type'];
			if ($twee_type != 0) $twee_type = $_POST['twee_type'];
		} else {
			$twee_type = 1;
		}
		
		if (isset($_POST['twee_tag'])) {
			$twee_tag = $_POST['twee_tag'];
			if ($twee_tag != 0) $twee_tag = $_POST['twee_tag'];
		} else {
			$twee_tag = tweefind;
		}
		
		if (isset($_POST['twee_width'])) {
			$twee_width = $_POST['twee_width'];
			if ($twee_width != 0) $twee_width = $_POST['twee_width'];
		} else {
			$twee_width = 574;
		}
		
		if (isset($_POST['twee_height'])) {
			$twee_height = $_POST['twee_height'];
			if ($twee_height != 0) $twee_height = $_POST['twee_height'];
		} else {
			$twee_height = 350;
		}
		
		if (isset($_POST['twee_slots'])) {
			$twee_slots = $_POST['twee_slots'];
			if ($twee_slots != 0) $twee_slots = $_POST['twee_slots'];
		} else {
			$twee_slots = 3;
		}
		
		if (isset($_POST['twee_searchbox'])) {
			$twee_searchbox = $_POST['twee_searchbox'];
			if ($twee_searchbox != 0) $twee_searchbox = $_POST['twee_searchbox'];
		} else {
			$twee_searchbox = yes;
		}
		
		if (isset($_POST['twee_livesearch'])) {
			$twee_livesearch = $_POST['twee_livesearch'];
			if ($twee_livesearch != 0) $twee_livesearch = $_POST['twee_livesearch'];
		} else {
			$twee_livesearch = yes;
		}
		
		if (isset($_POST['twee_displaybuttons'])) {
			$twee_displaybuttons = $_POST['twee_displaybuttons'];
			if ($twee_displaybuttons != 0) $twee_displaybuttons = $_POST['twee_displaybuttons'];
		} else {
			$twee_displaybuttons = yes;
		}
		
		if (isset($_POST['twee_logo'])) {
			$twee_logo = $_POST['twee_logo'];
		} else {
			$twee_logo = 0;
		}
		
		if (isset($_POST['twee_color'])) {
			$twee_color = $_POST['twee_color'];
			if ($twee_color != 0) $twee_color = $_POST['twee_color'];
		} else {
			$twee_color = DE6770;
		}
		
		$options['twee_type'] = $twee_type;
		$options['twee_tag'] = $twee_tag;
		$options['twee_width'] = $twee_width;
		$options['twee_height'] = $twee_height;
		$options['twee_slots'] = $twee_slots;
		$options['twee_searchbox'] = $twee_searchbox;
		$options['twee_livesearch'] = $twee_livesearch;
		$options['twee_displaybuttons'] = $twee_displaybuttons;
		$options['twee_logo'] = $twee_logo;
		$options['twee_color'] = $twee_color;
		
		update_option('tweeoption', $options);
		
		$updated = true;
	}
?>
<div class="wrap">
<?php
if ($updated) {
	echo "<div id='message' class='updated fade'><p>";
	_e('Configuration updated.');
	echo "</p></div>";
}
?>
<h2><?php _e('Tweefind Configuration'); ?></h2>

<div style="float: right; width: 350px">
	<h3>How does this work?</h3>
	<p><?php _e('This plugin automatically adds the most relevant and related tweets at the bottom of your blog posts (no homepage, single only).')?></p>
	<p><?php _e('Tweets are added live, so if new tweets that are more relevant (i.e. coming from users with higher rank, provided by Tweefind.com) than those diaplayed come out, the tweet/tweets displayed will be replaced with the new ones. You can pause the auto-update by pressing the pause button at anytime.');
	?></p>
</div>

<form action="" method="post" id="tweefind_options">

<h3>Options</h3>	
								
<input type="text" id="twee_type" name="twee_type" size="10" value="<?php echo $options['twee_type']; ?>"/><label for="twee_type"> Widget Type (1 = big, 2 = small)</label><br/>
	<br />	
	
<input type="text" id="twee_tag" name="twee_tag" size="10" value="<?php echo $options['twee_tag']; ?>"/><label for="twee_tag"> Default search keyword (to be used if no tags are set for a post)</label><br/>
	<br />	

<input type="text" id="twee_width" name="twee_width" size="10" value="<?php echo $options['twee_width']; ?>"/><label for="twee_width"> Width</label><br/>
	<br />	
			
<input type="text" id="twee_height" name="twee_height" size="10" value="<?php echo $options['twee_height']; ?>"/><label for="twee_height"> Height</label><br/>
	<br />
	
<input type="text" id="twee_slots" name="twee_slots" size="10" value="<?php echo $options['twee_slots']; ?>"/><label for="twee_slots"> Number of Tweets Shown</label><br/>
	<br />	
	
<input type="text" id="twee_searchbox" name="twee_searchbox" size="10" value="<?php echo $options['twee_searchbox']; ?>"/><label for="twee_searchbox"> Show Search Box (yes/no)</label><br/>
	<br />	
	
	
<input type="text" id="twee_livesearch" name="twee_livesearch" size="10" value="<?php echo $options['twee_livesearch']; ?>"/><label for="twee_livesearch"> Live Update (yes/no)</label><br/>
	<br />	
	
<input type="text" id="twee_displaybuttons" name="twee_displaybuttons" size="10" value="<?php echo $options['twee_displaybuttons']; ?>"/><label for="twee_displaybuttons"> Display Play/Pause Button for Live Update</label><br/>
	<br />	
	
<input type="text" id="twee_logo" name="twee_logo" size="10" value="<?php echo $options['twee_logo']; ?>"/><label for="twee_logo"> Display Tweefind logo</label><br/>
	<br />	
	
# <input type="text" id="twee_color" maxlenght="6" name="twee_color" size="10" value="<?php echo $options['twee_color']; ?>"/><label for="twee_color"> Links and Separators RGB color (default pink is DE6770) </label><br/>
	<br />	

<p class="submit" style="text-align: left"><input type="submit" name="submit" value="<?php _e('Save &raquo;'); ?>" /></p>
</form>
</div>
<?php
}

//admin panel
add_action('admin_menu', 'tweefind_menu');
// plugin
add_filter('the_content', 'add_tweefind_widget');
?>