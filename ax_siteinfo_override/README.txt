About:
This module alters the existing drupal "site information" form.

* A new form text field named "Site API Key" gets added to the "Site Information" form with the default value of “No API Key yet”.
* When this form is submitted, the value that the user entered for this field gets saved as the system variable named "siteapikey".
* A Drupal message informs the user that the Site API Key has been saved with that value.
* When this form is visited after the "Site API Key" is saved, the field is populated with the correct value.
* The text of the "Save configuration" button gets change to "Update Configuration".
* This module also provides a URL that responds with a JSON representation of a given node with the content type "page" only if the previously submitted API Key and a node id (nid) of an appropriate node are present, otherwise it will respond with "access denied".

## Example URL
http://localhost/page_json/FOOBAR12345/17
Absolute Path: /page_json/FOOBAR12345/17

Where 17 is the nid.

======================================================================================================================
List of resources/references used:

1) Get config syntax help
https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Config%21Config.php/function/Config%3A%3Aget/8.2.x

2) Submit handler syntax help
https://drupal.stackexchange.com/questions/223342/add-custom-submit-handler-to-form

3) Access Denied help
https://atendesigngroup.com/blog/restricting-access-drupal-8-controllers

4) Serialize object help
https://drupal.stackexchange.com/questions/191419/drupal-8-node-serialization-to-json

5) JSON response help
https://gist.github.com/signalpoint/97bfd628f47a5ddaeb05
