# Backend Page Restriction

You can make a page only visible to logged in back end users with two methods:

## CMS 

After logging in as an administrator head over the the CMS/Pages tab. Clicking on a existing page or creating a new one will give you the option to set page title, URL, etc. There will be a checkbox for `Hidden`.

## Code view

Add `is_hidden = 1` to first section of the page

```htm
// Page variables
title = "Some Page"
url = "/some-page"
layout = "somelayout"
is_hidden = 1

==
<?php
    // PHP SECTION
?>
==
    // HTML SECTION
```
> You can change which users/groups have permission to set this or see it. 
### [More information on backend users](backend/users.md)

# Front End Restrictions

There is a great front end authentication plugin made by the OctoberCMS developers: [Users](https://octobercms.com/plugin/rainlab-user)

The plugin comes with components for setting up registration, login, and front-end sessions.

Adding the session component to layouts allows us to control who can see those pages. Individual Pages can overwrite those permissions