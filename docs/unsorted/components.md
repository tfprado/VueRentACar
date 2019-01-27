# Building a new component

## Getting Started

You need to create a data access layout by creating 3 things:

1.  Plugin
2.  Database table  
3.  Model for accessing table data

> This can be done by using the builder plugin, copying another plugin or using scaffolding commands

## Using Scaffolding Commands

### 1. Create Plugin

    php artisan create:plugin AuthorName.PluginName

> For the example using `php artisan create:plugin Acme.Demo`

This will create the following folder structure:

    .Plugins
    |-> AuthorName
        |-> PluginName
            |-> updates
            |   |-> version.yaml    // Version History can be added here
            |-> Plugin.php          // Main plugin registration file

### 2. Create Model

    php artisan create:model AuthorName.PluginName ModelName

> For the example using `php artisan create:model Acme.Demo Task`

This will add the following files:

    .Plugins
        |-> AuthorName
            |-> PluginName
                |-> models
                |   |-> modelname
                |   |   |-> columns.yaml            // Used primarily in backend
                |   |   |-> fields.yaml             // Used primarily in backend
                |   |-> ModelName.php               // Simple model class
                |-> updates
                |   |-> create_modelName_table.php  // functions for creating and removing database table.
                |   |-> version.yaml    
                |-> Plugin.php          

### 3. Build up plugin to latest version. 

    php artisan plugin:refresh AuthorName.PluginName

> For this example using `php artisan plugin:refresh Acme.Demo`


### 4. Create Component

    php artisan create:component AuthorName.PluginName ComponentName

> For this example using `php artisan create:component Acme.Demo Task`

    This will add the following files:

    .Plugins
        |-> AuthorName
            |-> PluginName
                |-> components
                |   |-> componentname       
                |   |   |-> default.htm     // Partial file with default component markup
                |   |-> ComponentName.php   // ComponentName Class
                |-> models
                |-> updates
                |-> Plugin.php          

> Scaffolding command does not modify php files so we need to register the new component in the plugin registration file (`Plugin.php`).

```php
    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'AuthorName\PluginName\Components\ComponentName' => 'myComponent',
        ];
    }
```

## Ways components can interact with application 

### Adding these to your ComponentName.php file will allow the component to join in the page cycle

```php
public function onRun()
    {
        // This code will not Execute for AJAX events
    }

    public function init()
    {
        // This code will execute when the component is first 
        // initialized, including AJAX events.
    }
```

### Adding variables

```php
class Todo extends ComponentBase
{
    /**
     * This is a person name.
     * Variables here are available to the page as twig variables.
     * @var string
     */
    public $name;
```

### Accessing Variables

#### String

```php 
public function onRun()
    {     
        // {{ ComponentName.name }} (Strict)
        // Will not conflict with other names and allows to use the same component or others.
        $this->name = "Thiago";

        // {{ name }} (Relaxed)
        // Assumes component will be used by itself, injects the variable globally.
        $this->page['name'] = 'Thiago';

    }
```
> Using the strict method above you would add the following to default markup or page

```html
<h3> Tasks assigned to: {{ __SELF__.name }}</h3>
```
#### Array

In the markup
```php
// Setting local variable to global variable passed by component
{% set tasks = componentAlias.tasks %}

// Looping through array of items and display on page
<ul>
    {% for task in tasks %}
        <li>{{ tasks }}</li>
    {% endfor %}
</ul>
```

### Using AJAX

#### Example data-request function

Add this inside the `form` tag in the default markup or page.

```php
// Relaxed approach
data-request="onAddItem"  // Will look up the AJAX handler in the page first. Then cycle through 
                          // each component on the page untill it finds one with a handler with that name.

// Strict Approach
data-request="{{ __SELF__ }}::onAddItem" // Explicitly defines component alias calling SELF with :: 
```

```php
data-request-success="$('#inputItem').val('')"  // Jquery to clear input field and give feedback.
```

#### ComponentName.php file code

> Make sure the input you are targeting has the correct `name`!

```html
<input name="task" type="text" id="inputItem" class="form-control" value=""/>
```

> Also make sure to reference model namespace to use it

```php
<?php namespace Acme\Demo\Components;

use Cms\Classes\ComponentBase;
use Acme\Demo\Models\Task; //Referencing Task Model to use it on component

class Todo extends ComponentBase
{
```

```php
/**
 * The collection of tasks
 *
 * @var array
*/
public $tasks;

public function onAddItem()
    {
        $taskName = post('task');
        $task = new Task;
        $task->title = $taskName;
        $task->save();

        $this->page['tasks'] = Task::lists('title');
    }
```

## Using partial in component

    // Relaxed method
    {% set tasks = __SELF__.tasks %}
    {% partial 'tasks' %}               // Checks in theme partials, will not work
    {% partial '@tasks' %}              // Will check the components first
    {% partial __SELF__ ~ '::tasks' tasks=tasks %} // Strict Method with variable declaration 

    // Strict Method, no need to declare variable
    {% partial __SELF__ ~ '::tasks' tasks=__SELF__.tasks %}
