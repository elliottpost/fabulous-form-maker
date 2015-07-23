##Fabulous Form Maker
Contributors: Ellytronic Media, Elliott Post, Parina Madaan  
Tags: form, custom, contact, email, connect, easy, ellytronic  
Requires at least: 3.0  
Tested up to: 4.2  
Stable tag: 2.0.0  
License: GPLv2  
  
A custom form maker that allows users to build their own forms easily and without any knowledge of coding or progamming. 

## Description
A custom form maker that allows users to build their own forms easily and without any knowledge of coding or progamming. Users can create text boxes, passwords fields, drop down select boxes, radio boxes, checkboxes, and text areas.  Once the plugin is activated, the form and its settings can be found and edited under the "Pages" menu.  Call the form by using the shortcode [etm_contact_form].  
  
NOTE: This plugin currently supports only one form per website.
  
## Support 
* [Read about installation instructions](http://wordpress.org/extend/plugins/fabulous-form-maker/installation)  
* [Submit issues to the author](mailto:support@ellytronic.media)  

## Features
* Users can add a variety of input boxes, textareas, and select boxes.  
* Users can completely style form elements by calling the form id before the targeted elements in their CSS.  
* Supports required textboxes and password fields.  

## Installation
1. Follow the typical [WordPress plugin installation steps](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins)  
2. If you are unfamiliar with shortcode usage, [learn about shortcodes](http://codex.wordpress.org/Shortcode_API)  
3. After installing, on the admin menu, visit the new link under "Pages" titled "Contact Form"  
4. Change the default settings if needed and create the form on there.  
5. Call the form whereever needed by using the shortcode.  NOTE: This plugin can be called multiple times on the website; however, only once per page.  

__IMPORTANT!__  
* Prior to plugin updates its always a good idea to backup event data. Select a plugin from the WordPress Plugins Repository that can backup and restore custom (non-WordPress)   tables.  

## Frequently Asked Questions

### Overriding the CSS
Unhappy with the default CSS? You can override the CSS by adding a few lines of code to your theme's stylesheet. Replace the MY-CSS (Default: ___) with a value that matches your theme.
  `#ellytronic-contact label,`   
  `#ellytronic-contact input,`  
  `#ellytronic-contact select,`  
  `#ellytronic-contact textarea {`  
    &nbsp;&nbsp;`display: MY-CSS (default: block);`  
  `}`  
  `#ellytronic-contact input,`  
  `#ellytronic-contact select,`  
  `#ellytronic-contact textarea {`  
    &nbsp;&nbsp;`margin-bottom: MY-CSS (default: 1em);`  
  `}`  
  `#ellytronic-contact input[type="radio"],`  
  `#ellytronic-contact input[type="checkbox"] {`  
    &nbsp;&nbsp;`display: MY-CSS (default: inline);`  
    &nbsp;&nbsp;`margin: MY-CSS (default: 0);`  
  `}`  
  `#ellytronic-contact label {`  
    &nbsp;&nbsp;`margin-top: MY-CSS (default: 0.8em);`  
  `}`  
  `.etm_padTop {`  
    &nbsp;&nbsp;`padding-top: MY-CSS (default: 1.5em);`  
  `}`  

## Screenshots   
### Steps to create a form  
User can login to their wp-admin portal after successful installation of the FabulousFormMaker Plugin.   
1. Navigate to Plugins  
2. Click on Installed Plugins  
3. Activate FabulousFormMaker.   
4. Navigate to Contact Form (Note: User will be able to see their Custom Contact Form)    
  
####**Save Settings**  
1. **Address the contact form to the following name**: User can enter the name in the textbox.   
2. **Send the contact form to this email address**: User can enter the email address of the person who will receive the form.   
3. Click on Save Settings will save the entry made to the above fields with the message on top as “Settings Updated”  
  
####Step 1  
After entering necessary information in Settings, user can create the form by choosing fields from the drop down list.  
Choose item to add in the contact form  
1. Click on the drop down list,  
2. User can choose any of the six options (Single-Line Text Box, Selection Box, Large Text Box, Password Text Box, Radio Box (Choose one Option Style), Check Boxes (Choose Multiple Option Style).  
3. User has the ability to delete any of the option.  
![Step1](https://github.com/elliottpost/fabulous-form-maker/blob/elly-dev/FM/Screenshots/Step1-SaveSettings.png)  
  
####Step 2  
**Single-Line Text Box**  
1. On selection of Single-Line Text Box option, user can add Text to print before this single line text box: making this field as ‘Required’ (a check box), Finish this element and add to form or Cancel adding this element.  
2. If user selects ‘Required’ check box, then this text box becomes required field in the contact form.   
3. User can Finish this element and add to form or user can Cancel adding this element in the form.  
![Step2](https://github.com/elliottpost/fabulous-form-maker/blob/elly-dev/FM/Screenshots/Step2-SingleLineTextBox.png)  
  
####Step 3  
**Selection Box**  
1. User selects Selection Box option from the drop down list.   
2. User can add entry in Text to print before this drop down select box, make a field Required or not required, add options to the Next select box option, Your Select Box So Far displays  the options, Finish this element and add to form or Cancel adding this element.  
![Step3](https://github.com/elliottpost/fabulous-form-maker/blob/elly-dev/FM/Screenshots/Step3-SelectionBox.png)  
  
####Step 4  
**Large Text Box**  
1. User selects Large Text Box option from drop down list.   
2. On selection of Large Text Box option, user can add Text to print before this large text box: making this field as ‘Required’ (a check box)or not required, Finish this element and add to form or Cancel adding this element.  
![Step4](https://github.com/elliottpost/fabulous-form-maker/blob/elly-dev/FM/Screenshots/Step4-LargeTextBox.png)  
  
####Step 5  
**Password Text Box**  
1. User selects Password Text Box option from drop down list.  
2. On selection of Password Text Box option, user can add Text to print before this password style box: making this field as Required (a check box)   or not required, Finish this element and add to form or Cancel adding this element.  
![Step5](https://github.com/elliottpost/fabulous-form-maker/blob/elly-dev/FM/Screenshots/Step5-PasswordTextBox.png)  
  
####Step 6  
**Radio Box**  
1. User selects Radio Box option from drop down list.  
2. On selection of Radio Box option, user can add Text to print before this list of choices:, make this field as Required or not Required, Label for this choice, Finish this element  and add  to form or Cancel adding this element.  
![Step6](https://github.com/elliottpost/fabulous-form-maker/blob/elly-dev/FM/Screenshots/Step6-RadioBox.png)  
  
####Step 7  
**Check Boxes**  
1. User selects Check Boxes option from drop down list.  
2. On selection of Check Boxes option, user can add Text to print before this list of choices:, make this field as Required or not Required, Label for this choice, Finish this element  and add  to form or Cancel adding this element.  
![Step7](https://github.com/elliottpost/fabulous-form-maker/blob/elly-dev/FM/Screenshots/Step7-CheckBoxes.png)  
  
####Step 8  
View of form after click on Save Form.  
![Step8](https://github.com/elliottpost/fabulous-form-maker/blob/elly-dev/FM/Screenshots/Step8-YourFormSoFar1.png)  
![Step9](https://github.com/elliottpost/fabulous-form-maker/blob/elly-dev/FM/Screenshots/Step9-YourFormSoFar2.png)  

####Step 10
1. To view form on the front end, user will enter the contact url  
2. User can gives the required input  
![UIForm](https://github.com/elliottpost/fabulous-form-maker/blob/elly-dev/FM/Screenshots/UIForm.png)  
3. Once user clicks on Submit button, a Thank you messgae is displayed.  
![SubmitMessage](https://github.com/elliottpost/fabulous-form-maker/blob/elly-dev/FM/Screenshots/SubmitMessage.png)  
4. An email is sent to the administrator will the filled out contact form.  
![Email](https://github.com/elliottpost/fabulous-form-maker/blob/elly-dev/FM/Screenshots/Email.png)  
   
## Resources
[Link for how to get SVN for WordPress (specific to WP) and git](http://code.tutsplus.com/tutorials/publishing-wordpress-plug-ins-with-git--wp-25235)  
  
## Changelog

### 2.0 
Plugin is now object orienteded.  
Plugin is now compatible with/extensible for multiple Content Management Systems provided a new adapter is created which implements the I_Adapter interface. (See developers docs for more details)
Unit tests added for all non-CMS-dependent methods.  
ReadMe updated with screenshots show front and back-end use  

### 1.1.0
Now sends HTML emails instead of text based. Fixed an issue with slashes appearing before certain special characters.

### 1.0.9.2 
Remembered I'm using SVN and not git...fixed a botched upload..

### 1.0.9 
Fixed bug of checkboxes not always sending the correct data via email. 
Improved menu system which also increased compatability between plugins using the same javascript function names.

### 1.0.8
Repaired plugin after SVN package failure

### 1.0.7
1.0.6 package was corrupted or not uploaded correctly. Reuploading.

### 1.0.6
Fixed a typo in the features list. 

### 1.0.5 
Added support for required radio inputs.
Added support for required textareas.
Added support for required select boxes.
Fixed a problem that would cause the shortcode to print instead of return data.

### 1.0.4 
Fixed stable tag to display readme correctly.

### 1.0.3 
Updated change log on readme.txt

### 1.0.2
Corrected description to meet character limit on readme.txt

### 1.0.1 
Edited tags on readme.txt

### 1.0.0
Requested plugin to be added to repository

## Developers
As of version 2.0, this plugin is now extensible without modifying source code.  This plugin can be extended to work on multiple Content Mangement Systems.  Additionally, the CSS can all be overrided (see FAQ).  

### Extending the plugin for other CMS
1. An adapter needs to be created for the CMS you wish to extend this plugin for. The adapter must implement /FM/I_Adapter.  
2. The adapter should follow a namespacing pattern such as \FM\MyCMSName. See the WordPress Adapter (default adapter) for an example.  
3. The directory structure must **exactly** match the namespace, case-sensitivity included (see again the WordPress adapter for an example).  
4. Update the config.json file such that the object adapter now specifies the directory (sub-namespace) for your adapter.
5. Additionally, if your CMS needs support that is separate from the adapter, create a file called support.php inside the sub-namespace directory. See the WordPress adapter as an example.  
