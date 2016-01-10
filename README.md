# Tell Me About My Browser

You know how it can be so difficult to get people to tell you the specifics of their browser when troubleshooting?  So annoying!  What OS do you have? What browser? Do you have any plugins installed?

This is easily remedied by telling that person to visit <http://tellmeaboutmybrowser.com> and then sending you the link from their address bar.  There is also a link to just email it directly to you.

## How does this work?

First, the site determines if the visitor is trying to view an existing item.  If so, it'll retrieve that data from the database and show it.  That's how you can share a link and have it not polluted with your own browser information.

If it's just the base URL, a new record is created, and the user is redirected to that URL.  Any information that PHP can gather is associated with that request.  Finally, after the page loads, a bit of javascript reads in the client-side details and then sends them via AJAX to update the record.  The next time the link is visited (or refreshed) it will show only the data it recorded at the time.

Pretty sweet, huh? :)
