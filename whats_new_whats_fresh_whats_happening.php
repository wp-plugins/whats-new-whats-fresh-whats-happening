<?php
/*
Plugin Name: Whats New Whats Fresh Whats Happening...
Plugin URI: http://www.bochgoch.com/?p=wp
Description: Provide a window onto what is happening on your blog (posts & comments) that can be embedded into any page on any site or displayed as a widget.
Version: 1.4
Author: bochgoch
Author URI: http://www.bochgoch.com
*/

/*  Copyright 2007  Martin Ford  (email : wordpress@bochgoch.com)

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
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/
add_option('wnwfwh_numberOfPosts', '5', 'The number of links to posts generated by the Whats New Whats Fresh Whats Happening plugin', 'yes');
add_option('wnwfwh_numberOfComments', '5', 'The number of links to comments generated by the Whats New Whats Fresh Whats Happening plugin', 'yes');
add_option('wnwfwh_orderBy', 'rand()', 'The selection method for the related items generated by the Whats New Whats Fresh Whats Happening plugin', 'yes');
add_option('wnwfwh_showPostSentence', 'Y', 'Flag to select if a sentence of the post will be shown after the link by the Whats New Whats Fresh Whats Happening plugin', 'yes');
add_option('wnwfwh_showCommentSentence', 'Y', 'Flag to select if a sentence of the comment will be shown after the link by the Whats New Whats Fresh Whats Happening plugin', 'yes');
add_option('wnwfwh_postsHeading', 'Latest Posts', 'Heading shown above the posts links by the Whats New Whats Fresh Whats Happening plugin', 'yes');
add_option('wnwfwh_commentsHeading', 'Latest Comments', 'Heading shown above the comments links by the Whats New Whats Fresh Whats Happening plugin', 'yes');
add_option('wnwfwh_excludeCategories', '', 'Categories excluded by the Whats New Whats Fresh Whats Happening plugin', 'yes');

add_option('wnwfwh_divStyle', '', 'Inline style for the container DIV used by the Whats New Whats Fresh Whats Happening plugin', 'yes');
add_option('wnwfwh_h5Style', '', 'Inline style for the header H5 used by the Whats New Whats Fresh Whats Happening plugin', 'yes');
add_option('wnwfwh_pStyle', '', 'Inline style for the paragraph P used by the Whats New Whats Fresh Whats Happening plugin', 'yes');
add_option('wnwfwh_aStyle', '', 'Inline style for the link anchor A used by the Whats New Whats Fresh Whats Happening plugin', 'yes');
add_option('wnwfwh_ulStyle', '', 'Inline style for the unordered list UL used by the Whats New Whats Fresh Whats Happening plugin', 'yes');
add_option('wnwfwh_liStyle', '', 'Inline style for the list item LI used by the Whats New Whats Fresh Whats Happening plugin', 'yes');

function wnwfwh_plugin_menu() {
  $message = null;
  $message_updated = __("Whats New Whats Fresh Whats Happening Updated.");
  
  // update options
  if ($_POST['action'] && $_POST['action'] == 'wnwfwh_update') {
  	$message = $message_updated;
  
  	update_option('wnwfwh_numberOfPosts', $_POST['wnwfwh_numberOfPosts']);
  	update_option('wnwfwh_numberOfComments', $_POST['wnwfwh_numberOfComments']);
  	update_option('wnwfwh_orderBy', $_POST['wnwfwh_orderBy']);
  	update_option('wnwfwh_showPostSentence', $_POST['wnwfwh_showPostSentence']);
  	update_option('wnwfwh_showCommentSentence', $_POST['wnwfwh_showCommentSentence']);
  	update_option('wnwfwh_postsHeading', $_POST['wnwfwh_postsHeading']);
  	update_option('wnwfwh_commentsHeading', $_POST['wnwfwh_commentsHeading']);
  	update_option('wnwfwh_excludeCategories', $_POST['wnwfwh_excludeCategories']);
		
  	update_option('wnwfwh_divStyle', $_POST['wnwfwh_divStyle']);
  	update_option('wnwfwh_h5Style', $_POST['wnwfwh_h5Style']);
  	update_option('wnwfwh_pStyle', $_POST['wnwfwh_pStyle']);
  	update_option('wnwfwh_aStyle', $_POST['wnwfwh_aStyle']);
  	update_option('wnwfwh_ulStyle', $_POST['wnwfwh_ulStyle']);
  	update_option('wnwfwh_liStyle', $_POST['wnwfwh_liStyle']);
  	wp_cache_flush();
  }
  if ($message) : ?>
  <div id="message" class="updated fade"><p><?php echo $message; ?></p></div>
  <?php endif; ?>
  <div id="dropmessage" class="updated" style="display:none;"></div>
  <div class="wrap">
  <h2><?php _e('Whats New Whats Fresh Whats Happening Plugin Options'); ?></h2>
  <p><?php _e('With queries, questions or suggestions <a title="Bochgoch Home for Wordpress Plugins" href="http://www.bochgoch.com/?p=wp">Visit Bochgoch</a>.') ?></p>
  <form name="dofollow" action="" method="post">
  <table>

  <tr>
  <th scope="row" style="text-align:right; vertical-align:top;"><?php _e('The heading to display above the linked posts:')?></td>
  <td>
  <input size="80" name="wnwfwh_postsHeading" value="<?php echo stripcslashes(get_option('wnwfwh_postsHeading')); ?>"/>
  </td>
  </tr>
  <tr>
  <th scope="row" style="text-align:right; vertical-align:top;"><?php _e('The heading to display above the linked comments:')?></td>
  <td>
  <input size="80" name="wnwfwh_commentsHeading" value="<?php echo stripcslashes(get_option('wnwfwh_commentsHeading')); ?>"/>
  </td>
  </tr>
  <tr>
  <th scope="row" style="text-align:right; vertical-align:top;"><?php _e('The number of post links to display:')?></td>
  <td>
  <input size="2" name="wnwfwh_numberOfPosts" value="<?php echo stripcslashes(get_option('wnwfwh_numberOfPosts')); ?>"/>
  </td>
  </tr>
  <tr>
  <th scope="row" style="text-align:right; vertical-align:top;"><?php _e('The number of comment links to display:')?></td>
  <td>
  <input size="2" name="wnwfwh_numberOfComments" value="<?php echo stripcslashes(get_option('wnwfwh_numberOfComments')); ?>"/>
  </td>
  </tr>
  <tr>
  <th scope="row" style="text-align:right; vertical-align:top;"><?php _e('Ordering method for the displayed posts &amp; comments:')?></td>
  <td>
  <input type="radio" name="wnwfwh_orderBy" value="rand()" <?php if (get_option('wnwfwh_orderBy')=='rand()') echo "checked"; ?>> Random<br>
  <input type="radio" name="wnwfwh_orderBy" value="post_date asc" <?php if (get_option('wnwfwh_orderBy')=='post_date asc') echo "checked"; ?>> Date of post - ascending<br>
  <input type="radio" name="wnwfwh_orderBy" value="post_date desc" <?php if (get_option('wnwfwh_orderBy')=='post_date desc') echo "checked"; ?>> Date of post - descending<br>
  <input type="radio" name="wnwfwh_orderBy" value="post_title asc" <?php if (get_option('wnwfwh_orderBy')=='post_title asc') echo "checked"; ?>> Title of post - ascending<br>
  <input type="radio" name="wnwfwh_orderBy" value="post_title desc" <?php if (get_option('wnwfwh_orderBy')=='post_title desc') echo "checked"; ?>> Title of post - descending<br>
  </td>
  </tr>
  <tr>
  <th scope="row" style="text-align:right; vertical-align:top;"><?php _e('Show the first sentence of linked posts:')?></td>
  <td>
  <input size="1" name="wnwfwh_showPostSentence" value="<?php echo stripcslashes(get_option('wnwfwh_showPostSentence')); ?>"/> (Y/N)
  </td>
  </tr>
  <tr>
  <th scope="row" style="text-align:right; vertical-align:top;"><?php _e('Show the first sentence of linked comments:')?></td>
  <td>
  <input size="1" name="wnwfwh_showCommentSentence" value="<?php echo stripcslashes(get_option('wnwfwh_showCommentSentence')); ?>"/> (Y/N)
  </td>
  </tr>
  <tr>
  <th scope="row" style="text-align:right; vertical-align:top;"><?php _e('A comma separated list of categories for which links will not be displayed:')?></td>
  <td>
  <input size="12" name="wnwfwh_excludeCategories" value="<?php echo stripcslashes(get_option('wnwfwh_excludeCategories')); ?>"/>
  </td>
  </tr>

  <tr>
  <th scope="row" style="text-align:right; vertical-align:top;"><?php _e('In-line CSS style for container DIV')?></td>
  <td>
  <input size="30" name="wnwfwh_divStyle" value="<?php echo stripcslashes(get_option('wnwfwh_divStyle')); ?>"/>
  </td>
  </tr>
  <tr>
  <th scope="row" style="text-align:right; vertical-align:top;"><?php _e('In-line CSS style for heading H5')?></td>
  <td>
  <input size="30" name="wnwfwh_h5Style" value="<?php echo stripcslashes(get_option('wnwfwh_h5Style')); ?>"/>
  </td>
  </tr>
  <tr>
  <th scope="row" style="text-align:right; vertical-align:top;"><?php _e('In-line CSS style for post & comment P')?></td>
  <td>
  <input size="30" name="wnwfwh_pStyle" value="<?php echo stripcslashes(get_option('wnwfwh_pStyle')); ?>"/>
  </td>
  </tr>
  <tr>
  <th scope="row" style="text-align:right; vertical-align:top;"><?php _e('In-line CSS style for link A')?></td>
  <td>
  <input size="30" name="wnwfwh_aStyle" value="<?php echo stripcslashes(get_option('wnwfwh_aStyle')); ?>"/>
  </td>
  </tr>
  <tr>
  <th scope="row" style="text-align:right; vertical-align:top;"><?php _e('In-line CSS style for unordered list UL')?></td>
  <td>
  <input size="30" name="wnwfwh_ulStyle" value="<?php echo stripcslashes(get_option('wnwfwh_ulStyle')); ?>"/>
  </td>
  </tr>
  <tr>
  <th scope="row" style="text-align:right; vertical-align:top;"><?php _e('In-line CSS style for list item LI')?></td>
  <td>
  <input size="30" name="wnwfwh_liStyle" value="<?php echo stripcslashes(get_option('wnwfwh_liStyle')); ?>"/>
  </td>
  </tr>


  </table>
  <p class="submit">
  <input type="hidden" name="action" value="wnwfwh_update" /> 
  <input type="submit" name="Submit" value="<?php _e('Update Options')?> &raquo;" /> 
  </p>
  </form>
  </div>
  <?php
}

function whats_new_whats_fresh_whats_happening() {
    include 'whats_new_whats_fresh_whats_happening_o.php';			
}

add_action('plugins_loaded', 'my_init');
function my_init() {
    if (!function_exists('register_sidebar_widget')) { return; }
    register_sidebar_widget('Whats New Whats Fresh Whats Happening', 'whats_new_whats_fresh_whats_happening'); 
}

// mt_add_pages() is the sink function for the 'admin_menu' hook
function wnwfwh_add_pages() {
    // Add a new menu under Options:
    add_options_page('Whats new whats fresh whats happening options', 'Whats New Whats Fresh Whats Happening', 8, 'whats_new_whats_fresh_whats_happening.php', 'wnwfwh_plugin_menu');
}
add_action('admin_menu', 'wnwfwh_add_pages');

?>