=== iTrigga FeedWordPress Duplicate Post Filter  ===
Contributors: iTrigga, mrallen1
Tags: duplicate posts, feedwordpress
Requires at least: 2.8
Tested up to: 2.9
Stable tag: 1.0

A FeedWordPress syndicated post filter that checks for duplicates before posting items from your feeds.

== Description ==
This is a filter for the FeedWordPress plugin. **If you don't use FeedWordPress this plugin will not be useful to you.**

It's heavily based on the original FeedWordPress Duplicate Post Filter by Mark R. Allen. However, lots of people reported that it wasn't working, and we found that even with this plugin we were still getting duplicates.
So we wrote our own version.

For each potential post, the filter compares the (escaped) post title, and either the post guid, or the year-month-day (e.g., 2008-04-12) of the `post_date_gmt` attributes.  If it finds a match of both the title and either the guid or date, it tells FeedWordPress to skip that potential post.  Otherwise, it tells FeedWordPress to continue processing it however you have syndication set up on your blog.

== Installation ==
1. Download the plugin and uncompress it.
2. Plop it in the same directory as feedwordpress.php
3. Enable this filter in WordPress by visiting the "Plugin" menu and activating it.

== Important Note ==
This filter can only check future syndication posts.  Whatever duplicates are already present in your WordPress installation you'll have to remove/clean-up on your own.

== Changelog ==
1.0 - initial release. Now explicitly uses the post_date_gmt element rather than previous, seemingly non-functional epoch shenanigans which led to every date check looking for '1970-01-01%'

== License ==
Copyright (c) 2012 by iTrigga

Original copyright notice:
Copyright (C) 2008, 2009 by Mark R. Allen
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

* Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
* Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
* Neither the name of Mark Allen nor the names of any contributors may be used to endorse or promote products derived from this software without specific prior written permission.
