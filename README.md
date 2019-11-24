# sritoniviewdocs
This is a block for use in Moodle, developed by SriToni Learning Services - Used to display links of user documents in dashboard.

The block assumes that there is a user profile field containing a text string with JSON encoded data array.

The data in the array before JSON encoding should be as follows:

    Array
    (
    [0] => Array
        (
            [documentName] => Annual Report 2018-19
            [fileId] => Some Google File ID
        )

    [1] => Array
        (
            [documentName] => Annual Report 2017-18
            [fileId] => Some other Google file ID
        )

)

The reason for this block is that Moodle core does not have any means of pushing individualized user documents to users.
Moodle can push a common document to users but not individualized documents such as for example: reports, etc.
The pushing of individualized documents to users can be done several ways as for example: From a webapp such as a Google Apps Script, etc., and is a separate topic.

Here we are only concerned about a user being able to view her documents that have been already pushed to her user profile.
The user simply installs the block on her dashboard page and can automatically see all her documents if there are any.
No checks are done of any kind such as for example: Number of documents, order of documents, etc.
Whatever is JSON encoded data is published.
