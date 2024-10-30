=== Categories Recent Posts Widget ===
Contributors: The Medios, illuminatus7
Tags: recent posts, archive page, widget, sidebar, post
Requires at least: 3.1.0
Tested up to: 3.8.1
Stable tag: 1.1
License: GPLv2 or later

This widget displays the recent posts on a category page for that category


== Description ==

An easy to use Recent Posts Plugin. This plugin will allow you to display the recent posts in a sidebar only on a category page.

**New Features Added**

* Specify the number of posts to display in the sidebar
* Show/ hide excerpt
* Specify the number of words to be displayed in the excerpt
* Option to specify custom Read More text
* The Read More text is also a link to the posts permalink


== Installation ==

Installing is pretty easy takes only a minute or two.

1. Upload 'category-recent-posts-widget.zip' directory to your '/wp-content/plugins/' directory.

2. Activate the plugin through the 'Plugins' screen in WordPress.

3. On the 'Widgets' sub-menu of 'Appearance' you will find a new widget type called 'Category Recent Posts'.

4. Add one or more of these to your themes widget display areas.

5. For each widget you add, select a title.

6. For each widget you add, specify the number of posts to display in the widget, show/ hide excerpt or specify the number of words to display in excerpt

7. Specify the Read More text that will be displayed after the excerpt in the sidebar. This defaults to ellipses [...] if the field is left blank

8. Save your settings.

9. That's it.  Enjoy!

== Frequently Asked Questions ==

= Why cannot I see the widget in my Sidebar on the Home Page? =

The widget will be displayed only on the 'Category Archive Page'

= Can I style the my recent posts widget =

Yes. You can style it as required. The recent posts list are wrapped in an unordered HTML list having CSS class ".tm-recent". The excerpt is wrapped in a div tag with the CSS class ".tm-excerpt". The complete widget itself is wrapped in the CSS class ".tm-cat-recent-post"

= How can I style the Read More link =

The Read More link is wrapped in the CSS class ".tm-read-more-text". You can style this class n your stylesheet.

== Screenshots ==

1. Widget appearing in a sidebar on a category archive page

2. Widget settings option in the Dashboard

== Changelog ==

= 0.1 =

* Initial Release

= 0.2 =

* Added option to select the number of posts in widget settings
* Added default number of posts to 5
* Added option to select whether excert will be displayed or not
* Changed Domain to Gettext Calls to 'themedios'
* Fixed control options' width parameter to an integer instead of the previous string
* Changed old CSS class names

= 1.0 =

* Checked for 3.5 compatability. Looks good :)
* Added option to specify Read More text. Returns ellipses [...] if Read More text is empty
* Hyperlink to the posts permalink for Read More text.
* Added CSS class to style Read More text
* Updated screenshot for Widget Settings

== Upgrade Notice ==

= 0.2 =

There are some changes in widget options class names. Hence after the plugin upgrade, previous widget and its settings will disappear and a new instance of the widget will have to be created in the sidebar

= 1 =

Nothing that is known of