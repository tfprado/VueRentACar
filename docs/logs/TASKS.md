# Completed Tasks

## 2019 Tasks




## 2018 TASKS
Finished setting up `thedeployer` user for pushing changes to testing server. Basic Capfile can be found in root of project. Tasks sent to server are in `config/deploy.rb` and `config/deploy/dev.rb`

My current october project has two config settings, the standard files in `config` folder and my local development settings in the `config/dev` folder.
* Having a `.env` file with a `APP_ENV=dev` tells october to use the `config/dev` files instead.


> `dev.rb`
>* Sets where the project will be deployed to (server ip), and what user/roles will be doing the deploying.
>* `thedeployer` user was set up ahead of time. Created the original project directory on the server and changed permission to allow 'thedeployer' to run commands without needing sudo/passwords. 


> `deploy.rb`
>* Where the capistrano version is specified (originally installed Cap 3, so using Capistrano version 3.11)
>* This file sets what stage of deployment the project is on, default stage, ssh options and github repository capistrano is linked with/branch used.
>* Tasks for capistrano are created here.


> Current deployment tasks:
> * Capistrano creates a new `releases` directory in project root and attempts to clone from previously specified github directory.
> * If successful will attempt to use composer to install vendor files and update october.
> * Then Capistrano will update permissions for the newly created releases folder.
> * Print out server name.
> * Symlinks `releases` folder to `current` folder (`var/www/octobercms/current` is the website root on nginx config)
> * Cleanups up extra releases (currently keeping the default 5 latest versions) and logs changes.




## Task 1.0

Adding slugs and pagination

#### adding slugs to a plugin

> switching service single page from using id to slugs
- Went back into the builder plugin and added another column to my services plugin (submenu database)
    - slug | String | Nullable
- Then went to submenu models/forms/fields.yaml
    - Add one more fild, a text field with field name slug, Label slug
        - *remember to open advanced and set Preset Field to name and type Slug* 
- Went back to CMS and switch the Services Single page and changed url from /services/:id -> /services/:slug
- Changed record details component to match (identifier value and key column changed to slug).
- Also change Services page components from id to slug

#### pagination

> You can set up how many record are shows under the pagination tab in the actual component in the page.
- When opening the component click the pagination tab
- set record per page and page number (ie. 1 and >_ :page)
- set url to services/:page
*IMPORTANT* > make sure pages don't conflict (ie. services/:page and services/:slug)
- changed url again to *service/:page*
- pagination code is then added to service.htm (or whatever page name you added it to) file at the bottom and can be changed with CSS.


## Task 1.1

Images and Galleries


#### adding image/file upload to a plugin

> You can go straight into the builder plugin, choose your plugin -> models -> forms -> fields.yaml
- No need to add a database column as October already has systems for images
    - Add field name/label and make sure to open file upload tab and set mode (image) and width/height. That is the size of the img being displayed on the admin panel.
- Then switch to code editor -> author namespace -> plugin name -> models to update plugin model
    - To attach image I added a relations section
        - * Relations public $attachOne = ['image' => 'System\Models\File'];* 
- Return to service single (or whatever page you are displaying your plugin) to addd the image.
    - ADD this to records loop ```html <img src="{{ record.image.path }}">```

#### Gallery

> Adding a gallery to our plugin; builder plugin, choose your plugin -> models -> forms -> fields.yaml
- No need to add a database column as October already has systems for images
- Add field name/label and make sure to open file upload tab and set mode (image_gallery) and width/height. That is the size of the img being displayed on the admin panel.
- Then switch to code editor -> author namespace -> plugin name -> models to update plugin model
*IMPORTANT* > public $attachMany = [ 'image' => 'System\Models\File'];
- Return to service single (or whatever page you are displaying your plugin) to addd the image gallery (or links or whatever else).

> ADD this to records loop 
```html
<ul class="gallery clearfix">

    {% for image in record.image_gallery %}
    <li>
       <a href="{{ image.path }}"><img src="{{ image.thumb(80,80, {'mode':'crop'}) }}"></a>
    </li>
    {% endfor %}
    
</ul>
```

## Task 1.2

Relations


#### creating a tag model

> You can go straight into the builder plugin, choose your plugin -> add new database
- Added 3 columns id, tag_title and slug
- Switch to models and add a Tag model that is pointing to the new database.
- Add another form with two controls, a text box with tag_title left aligned and a slug field right aligned.
    - *important* > Open advanced/Presets and add field tag_title and type Slug
- Add another list of tags for the backend. First field will be tag_title, with a label and type Text. Searchable and Sortable
- Head over to backend menu in builder plugin to add a side menu for tags. *LEAVE URL FOR NOW*
- Add a new controller next. It will be called Tags in this example (base model Tag, active menu Tags). Check all the control behaviors.
- Return to backend menu to add ULR. it will auto complete to kensingtonhealth/services/tasks
> Tags are now ready to be added under the services menu 
- No way to display the tags just yet on the actual service page => create Pivot Table to serve as link between models
    - Relations in October are similar to Laravel
- Go back to builder and create a new database table (ie. kensingtonhealth_services_services_tags)
    - *Only need two columns: 
        - service_id|integer|primary key
        - tag_id|integer|pk
> you have now created your pivot table
- you dont need a model or controller, it only serves as a link between services and tags.
- Go back to builder => models => service => forms to add another form field
    - Add relation widget. For this example: Field name = tag | Label = Tag
    - Open relation sub-tab to change name column. For this example: tag_title

- Then switch to code editor -> author namespace -> plugin name -> models to update plugin model. In this example: Service.php
    - Added to relations section: 
public $belongsToMany =[
    'tags' => [          
        "Kensingtonhealth\Services\Models\Tag",
        'table' => "kensingtonhealth_services_services_tags",
        'order' => 'tag_title'
    ]
];
> Service sections now works with TAGS on the backend! To display them on the page you must now add that code to the 'service single' page in this example

#### Adding html to services-single page

> ADD this to records loop 

```html
<!-- Tag Section -->
<h3>Tags</h3>
{% for tag in record.tags %}
{{ tag.tag_title }}<br>
{% endfor %}
```

## Task 1.3

Inverse Relations - Adding links to tags


#### creating tag page

> This example page will be created in the CMS menu of october
- Added page with title = Tags | url = /tags/:slug and with the builder record details component
    - Class for this example is Tag, changed the identifier value to slug and key column slug. Display column tag title.
> *Remember to go into page and click on the component to fork it before saving the page to have access to all fo the code.*

#### Creating Links to tag page

> start at your page.htm in code view (for this example services-single.htm and tags.htm)
- Added this code to services-single.htm to display tags

```html
<!-- Tag Section -->
<h3>Tags</h3>
{% for tag in record.tags %}
<a href="/tags/{{ tag.slug }}">{{ tag.tag_title }}<br></a>
{% endfor %}
```

#### Creating Inverse Relations

> Plugin overview
    .
    └── plugins                   
        └── author-space (ie. kensingtonhealth)  
            ├── plugin-name (ie. services)           
            │   ├── classes         
            │   ├── controllers
            │   ├── lang
            │   ├── models
            │   │   ├── service 
            │   │   ├── tag
            │   │   ├── Service.php       
            │   │   └── Tag.php                         # Inverse relation added here
            │   └── updates                
            ├── Plugin.php
            └── plugin.yaml

> Code for inverse relation
public $belongsToMany =[

        'services' => [
            
            "Kensingtonhealth\Services\Models\Service",
            'table' => "kensingtonhealth_services_services_tags",
            'order' => 'name'


        ]

    ];

#### Adding working links to tags page

- Added this code to tags.htm to add proper links

```html
<!-- Start of record loop -->
{% if record %}
    <!-- Changes for tags page-->
    <h2>{{ attribute(record, displayColumn) }}</h2>

    <!-- Loop for adding links -->
    {% for service in record.services %}
    <a href="/services/{{ service.slug }}">{{ service.name }}<br></a>
    {% endfor %}

{% else %}
    {{ notFoundMessage }}
{% endif %}
```
> Reverse of the service-single.htm loop

## Task 1.4 Repeater Field

Set of fields you can repeat across models
> For this example I will be adding a getting ready section to the services page, it allow the user to add what to expect and what kind of tests exist for that service.

#### Create a database for our expectation section.

> Starting off in the builder plugin again. Adding a new column to my original kensingtonhealth_services database table
- Column = expectations | type = text | nullable => save and apply
- Next go to models and field (in this example the service form) to add a new field (widget called repeater)
    - Field name = expectations | Label = What to expect |
> *YOU CAN ADD MORE FIELDS TO THE REPEATER FIELD.*
    - added two text boxes and two rich editors. expectations_type, expectations_type_description, expectations_expect, expectations_expect_description


#### Making expectations array jsonable

> Go to code editor to add some code to Service.php

    .
    └── plugins                   
        └── author-space (ie. kensingtonhealth)  
            ├── plugin-name (ie. services)           
            │   ├── classes         
            │   ├── controllers
            │   ├── lang
            │   ├── models
            │   │   ├── service 
            │   │   ├── tag
            │   │   ├── Service.php                 # new code will go in here
            │   │   └── Tag.php                         
            │   └── updates                
            ├── Plugin.php
            └── plugin.yaml

Added this code under the database table used by model
> protected $jsonable = ['expectations'];
*YOU CAN NOW SEE AND SAVE THE FIELDS IN THE SERVICES MENU*
w
#### Displaying Data in front-end

> Theme overview

    .
    └── themes                   
        └── author-space (ie. kensingtonhealth)             
            │   ├── assets         
            │   ├── content
            │   ├── layouts
            │   ├── pages
            │   │   └── services-single.htm         # Code Goes Here
            │   └── partials                       
            │                  
            └── theme.yaml

> Code displaying repeater field
```html
<!-- Repeater Section (What to expect) -->
<h3>Getting Ready</h3>
{% for expectation in record.expectations %}

    <h4>{{ expectation.expectations_type }}</h4>
    {{ expectation.expectations_type_description|raw }}
    <h4>{{ expectation.expectations_expect }}</h4>
    {{ expectation.expectations_expect_description|raw }}
{% endfor %}
```

## Task 1.5 Creating Custom Form Widgets

> For this example I will be adding a separate database table for expectations and a custom widget. 

#### Creating the correct folder structure

> The plugin will use select2 css and js and will be set up like this

    .
    └── plugins                   
        └── author-space (ie. kensingtonhealth)  
            ├── plugin-name (ie. services)           
            │   ├── classes         
            │   ├── controllers
            │   ├── formwidgets 
            │   │   └── expectationbox     
            │   │       └── assets 
            │   │           ├── css
            │   ├── lang    │   └── select2.css 
            │   ├── models  └── js
            │   │   ├── service └── select2.js  
            │   │   ├── tag
            │   │   ├── Service.php                 
            │   │   └── Tag.php                         
            │   └── updates                
            ├── Plugin.php
            └── plugin.yaml
