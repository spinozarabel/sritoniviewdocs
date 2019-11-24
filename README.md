# sritoniviewdocs
This is a block for use in Moodle, developed by SriToni Learning Services - Used to display links of user documents in dashboard.
The block assumes that there is a user profile field containing a text string with JSON encoded data array.
The array data should have key as document name and value as any valid URL that the user has permissions to view and download.
The shortname of this user profile field needs to be set in the config settings of this plugin. The default is 'documentlinks'
The reason for this block is that Moodle core does not have any means of pushing individualized user documents to users.
Moodle can push a common document to users but not individualized documents such as for example: reports, etc.
The pushing of individualized documents to users can be done several ways as for example: From a webapp such as a Google Apps Script, etc., and is a separate topic.
Here we are only concerned about a user being able to view her documents that have been already pushed to her user profile.
The user simply installs the block on her dashboard page and can automatically see all her documents if there are any.
No checks are done of any kind such as for example: Number of documents, order of documents, etc.
Whatever is JSON encoded data is published.
