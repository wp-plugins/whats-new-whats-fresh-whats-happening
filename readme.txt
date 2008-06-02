=== Whats New Whats Fresh Whats Happening ===
Contributors: Martin Ford, Bochgoch
Donate link: http://www.bochgoch.com/?p=wp
Tags: posts,comments,links,categories
Requires at least: 2.2 (for widget)
Tested up to: 2.5.1
Stable tag: trunk

This plugin provides an overview of activity on a blog in the form of posts and comments. The plugin is widgetised, available on a Wordpress page and embeddable into any HTML page on any site of your choice.

== Description ==

This plugin provides configurable links to posts and comments from the blog it is installed into. The output from the plugin can either be displayed as
a widget in the sidebar on your Wordpress 2.2+ blog, as a page in your Wordpress blog OR embedded into ANY page on ANY PHP powered site.

Full styling and configuration options are available.

* Configure the number of items (posts and comments) and the method of selecting the items (alphabetically, newest, oldest or random) displayed.
* Highlight Posts: Show any of - post title, date and author and an excerpt of the post content.
* Highlight Comments: Show any of - comment date, author and an excerpt of the comment.
* Styling: allow your site’s styles to cascade or define inline styles in your admin options.

== Installation ==

1. Unzip into your `/wp-content/plugins/` directory
2. Activate 'Whats New Whats Fresh Whats Happening' through the 'Plugins' menu on the WordPress Admin page of your blog.
3. Go to the 'Whats New Whats Fresh Whats Happening' options page (Under 'Options' on the main admin menu) and configure!
4. To use as a widget click the 'Presentation' then 'Widgets' menu options and drag the 'Whats New Whats Fresh Whats Happening' into your sidebar.
5. To use embedded into another page:
	* Check that the page is hosted on a server that runs PHP - Whats New Whats Fresh Whats Happening needs PHP to run.
	* Add the following code to the page in the place you want Whats New Whats Fresh Whats Happening to appear:

	&lt;?php include $_SERVER['DOCUMENT_ROOT']."/wordpress/wp-content/plugins/whats_new_whats_fresh_whats_happening/whats_new_whats_fresh_whats_happening_i.php"; ?&gt;

	...this assumes that you have installed Wordpress into the subdirectory 'wordpress' from the root of your site. Amend if necessary.
	* That's it!

== Frequently Asked Questions ==

= Where can I leave feedback about the Whats New Whats Fresh Whats Happening plugin? =
Visit www.bochgoch.com

= Troubleshooting when embedded into another page: =
Ensure that the paths are correct. 
The plugin assumes that it has been installed into the directory path /wordpress/wp-content/plugins/whats_new_whats_fresh_whats_happening/ relative to the root page of the site. 
If that is not the case then you'll need to amend the WNWFWH code.