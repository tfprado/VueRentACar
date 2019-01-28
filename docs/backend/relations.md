*   [Introduction](#introduction)
*   [Configuring the relation behavior](#configuring-relation)
*   [Relationship types](#relationship-types)
    *   [Has many](#has-many)
    *   [Belongs to many](#belongs-to-many)
    *   [Belongs to many (with Pivot Data)](#belongs-to-many-pivot)
    *   [Belongs to](#belongs-to)
    *   [Has one](#has-one)
*   [Displaying a relation manager](#relation-display)
*   [Extending relation behavior](#extend-relation-behavior)

<a name="introduction"></a>

# Introduction

`Relation behavior` is a controller modifier used for easily managing complex [model](../database/model.md) relationships on a page. Not to be confused with [List relation columns](lists#column-types) or [Form relation fields](forms.md#widget-relation) that only provide simple management.

Relation behavior depends on [relation definitions](#relation-definitions). In order to use the relation behavior you should add the `Backend.Behaviors.RelationController` definition to the `$implement` field of the controller class. Also, the `$relationConfig` class property should be defined and its value should refer to the YAML file used for [configuring the behavior options](#configuring-relation).

    namespace Acme\Projects\Controllers;

    class Projects extends Controller
    {
        public $implement = [
            'Backend.Behaviors.FormController',
            'Backend.Behaviors.RelationController',
        ];

        public $formConfig = 'config_form.yaml';
        public $relationConfig = 'config_relation.yaml';
    }

> **Note:** Very often the relation behavior is used together with the [form behavior](forms.md).

<a name="configuring-relation"></a>

# Configuring the relation behavior

The configuration file referred in the `$relationConfig` property is defined in YAML format. The file should be placed into the controller's [views directory](controllers-ajax.md/#introduction). The required configuration depends on the [relationship type](#relationship-types) between the target model and the related model.

The first level field in the relation configuration file defines the relationship name in the target model. For example:

    class Invoice {
        public $hasMany = [
            'items' => ['Acme\Pay\Models\InvoiceItem'],
        ];
    }

An _Invoice_ model with a relationship called `items` should define the first level field using the same relationship name:

    # ===================================
    #  Relation Behavior Config
    # ===================================

    items:
        label: Invoice Line Item
        view:
            list: $/acme/pay/models/invoiceitem/columns.yaml
            toolbarButtons: create|delete
        manage:
            form: $/acme/pay/models/invoiceitem/fields.yaml
            recordsPerPage: 10

The following options are then used for each relationship name definition:

Option  | Description
--------|------------
label  | a label for the relation, in the singular tense, required.
view  | configuration specific to the view container, see below.
manage  | configuration specific to the management popup, see below.
pivot  | a reference to form field definition file, used for relations with pivot table data.
emptyMessage  | a message to display when the relationship is empty, optional.
readOnly  | disables the ability to add, update, delete or create relations. default: false
deferredBinding  | defers all binding actions using a session key when it is available. default: false

These configuration values can be specified for the view or manage options, where applicable to the render type of list, form or both.

Option  | Type  | Description
--------|-------|------------
form  | Form  | a reference to form field definition file, see backend form fields.
list  | List  | a reference to list column definition file, see backend list columns.
showSearch  | List  | display an input for searching the records. Default: false
showSorting  | List  | displays the sorting link on each column. Default: true
defaultSort  | List  | sets a default sorting column and direction when user preference is not defined. Supports a string or an array with keys column and direction.
recordsPerPage  | List  | maximum rows to display for each page.
conditions  | List  | specifies a raw where query statement to apply to the list model query.
scope  | List  | specifies a query scope method defined in the related form model to apply to the list query always. The model that this relationship will be attached to (i.e. the parent model) is passed to this scope method as the second parameter ($query is the first).

These configuration values can be specified only for the view options.

Option  | Type  | Description
--------|-------|------------
showCheckboxes  | List  | displays checkboxes next to each record.
recordUrl  | List  | link each list record to another page. Eg: users/update/:id. The :id part is replaced with the record identifier.
recordOnClick  | List  | custom JavaScript code to execute when clicking on a record.
toolbarPartial  | Both  | a reference to a controller partial file with the toolbar buttons. Eg: _relation_toolbar.htm. This option overrides the toolbarButtons option.
toolbarButtons  | Both  | the set of buttons to display, can be an array or a pipe separated string. Set to false to show no buttons. Available options are: add, create, update, delete, remove, link, unlink. Eg: add|remove

These configuration values can be specified only for the manage options.

Option  | Type  | Description
--------|-------|------------
title  | Both  | a popup title, can refer to a localization string.
context  | Form  | context of the form being displayed. Can be a string or an array with keys: create, update.

<a name="relationship-types"></a>

# Relationship types

How the relation manager is displayed depends on the relationship definition in the target model. The relationship type will also determine the configuration requirements, these are shown in **bold**. The following relationship types are available:

*   [Has many](#has-many)
*   [Belongs to many](#belongs-to-many)
*   [Belongs to Many (with Pivot Data)](#belongs-to-many-pivot)
*   [Belongs to](#belongs-to)
*   [Has one](#has-one)

<a name="has-many"></a>

## Has many

1.  Related records are displayed as a list (**view.list**).
2.  Clicking a record will display an update form (**manage.form**).
3.  Clicking _Add_ will display a selection list (**manage.list**).
4.  Clicking _Create_ will display a create form (**manage.form**).
5.  Clicking _Delete_ will destroy the record(s).
6.  Clicking _Remove_ will orphan the relationship.

For example, if a _Blog Post_ has many _Comments_, the target model is set as the blog post and a list of comments is displayed, using columns from the **list** definition. Clicking on a comment opens a popup form with the fields defined in **form** to update the comment. Comments can be created in the same way. Below is an example of the relation behavior configuration file:

    # ===================================
    #  Relation Behavior Config
    # ===================================

    comments:
        label: Comment
        manage:
            form: $/acme/blog/models/comment/fields.yaml
            list: $/acme/blog/models/comment/columns.yaml
        view:
            list: $/acme/blog/models/comment/columns.yaml
            toolbarButtons: create|delete

<a name="belongs-to-many"></a>

## Belongs to many

1.  Related records are displayed as a list (**view.list**).
2.  Clicking _Add_ will display a selection list (**manage.list**).
3.  Clicking _Create_ will display a create form (**manage.form**).
4.  Clicking _Delete_ will destroy the pivot table record(s).
5.  Clicking _Remove_ will orphan the relationship.

For example, if a _User_ belongs to many _Roles_, the target model is set as the user and a list of roles is displayed, using columns from the **list** definition. Existing roles can be added and removed from the user. Below is an example of the relation behavior configuration file:

    # ===================================
    #  Relation Behavior Config
    # ===================================

    roles:
        label: Role
        view:
            list: $/acme/user/models/role/columns.yaml
            toolbarButtons: add|remove
        manage:
            list: $/acme/user/models/role/columns.yaml
            form: $/acme/user/models/role/fields.yaml

<a name="belongs-to-many-pivot"></a>

## Belongs to many (with Pivot Data)

1.  Related records are displayed as a list (**view.list**).
2.  Clicking a record will display an update form (**pivot.form**).
3.  Clicking _Add_ will display a selection list (**manage.list**), then a data entry form (**pivot.form**).
4.  Clicking _Remove_ will destroy the pivot table record(s).

Continuing the example in _Belongs To Many_ relations, if a role also carried an expiry date, clicking on a role will open a popup form with the fields defined in **pivot** to update the expiry date. Below is an example of the relation behavior configuration file:

    # ===================================
    #  Relation Behavior Config
    # ===================================

    roles:
        label: Role
        view:
            list: $/acme/user/models/role/columns.yaml
        manage:
            list: $/acme/user/models/role/columns.yaml
        pivot:
            form: $/acme/user/models/role/fields.yaml

Pivot data is available when defining form fields and list columns via the `pivot` relation, see the example below:

    # ===================================
    #  Relation Behavior Config
    # ===================================

    teams:
        label: Team
        view:
            list:
                columns:
                    name:
                        label: Name
                    pivot[team_color]:
                        label: Team color
        manage:
            list:
                columns:
                    name:
                        label: Name
        pivot:
            form:
                fields:
                    pivot[team_color]:
                        label: Team color

> **Note:** Pivot data is not supported by [deferred bindings](relations.md#deferred-binding) at this time, so the parent model should exist.

<a name="belongs-to"></a>

## Belongs to

1.  Related record is displayed as a preview form (**view.form**).
2.  Clicking _Create_ will display a create form (**manage.form**).
3.  Clicking _Update_ will display an update form (**manage.form**).
4.  Clicking _Link_ will display a selection list (**manage.list**).
5.  Clicking _Unlink_ will orphan the relationship.
6.  Clicking _Delete_ will destroy the record.

For example, if a _Phone_ belongs to a _Person_ the relation manager will display a form with the fields defined in **form**. Clicking the Link button will display a list of People to associate with the Phone. Clicking the Unlink button will dissociate the Phone with the Person.

    # ===================================
    #  Relation Behavior Config
    # ===================================

    person:
        label: Person
        view:
            form: $/acme/user/models/person/fields.yaml
            toolbarButtons: link|unlink
        manage:
            form: $/acme/user/models/person/fields.yaml
            list: $/acme/user/models/person/columns.yaml

<a name="has-one"></a>

## Has one

1.  Related record is displayed as a preview form (**view.form**).
2.  Clicking _Create_ will display a create form (**manage.form**).
3.  Clicking _Update_ will display an update form (**manage.form**).
4.  Clicking _Link_ will display a selection list (**manage.list**).
5.  Clicking _Unlink_ will orphan the relationship.
6.  Clicking _Delete_ will destroy the record.

For example, if a _Person_ has one _Phone_ the relation manager will display form with the fields defined in **form** for the Phone. When clicking the Update button, a popup is displayed with the fields now editable. If the Person already has a Phone the fields are update, otherwise a new Phone is created for them.

    # ===================================
    #  Relation Behavior Config
    # ===================================

    phone:
        label: Phone
        view:
            form: $/acme/user/models/phone/fields.yaml
            toolbarButtons: update|delete
        manage:
            form: $/acme/user/models/phone/fields.yaml
            list: $/acme/user/models/phone/columns.yaml

<a name="relation-display"></a>

# Displaying a relation manager

Before relations can be managed on any page, the target model must first be initialized in the controller by calling the `initRelation` method.

    $post = Post::where('id', 7)->first();
    $this->initRelation($post);

> **Note:** The [form behavior](forms.md) will automatically initialize the model on its create, update and preview actions.

The relation manager can then be displayed for a specified relation definition by calling the `relationRender` method. For example, if you want to display the relation manager on the [Preview](forms.md#form-preview-view) page, the **preview.htm** view contents could look like this:

    <?= $this->formRenderPreview() ?>

    <?= $this->relationRender('comments') ?>

You may instruct the relation manager to render in read only mode by passing the option as the second argument:

    <?= $this->relationRender('comments', ['readOnly' => true]) ?>

<a name="extend-relation-behavior"></a>

# Extending relation behavior

Sometimes you may wish to modify the default relation behavior and there are several ways you can do this.

*   [Extending relation configuration](#extend-relation-config)
*   [Extending the view widget](#extend-view-widget)
*   [Extending the manage widget](#extend-manage-widget)
*   [Extending the pivot widget](#extend-pivot-widget)
*   [Extending refresh results](#extend-refresh-results)

<a name="extend-relation-config"></a>

## Extending relation configuration

Provides an opportunity to manipulate the relation configuration. The following example can be used to inject a different columns.yaml file based on a property of your model.

    public function relationExtendConfig($config, $field, $model)
    {
        // Make sure the model and field matches those you want to manipulate
        if (!$model instanceof MyModel || $field != 'myField')
            return;

        // Show a different list for business customers
        if ($model->mode == 'b2b') {  
            $config->view['list'] = '$/author/plugin_name/models/mymodel/b2b_columns.yaml';
        }
    }

<a name="extend-view-widget"></a>

## Extending the view widget

Provides an opportunity to manipulate the view widget.

> **Note**: The view widget has not yet fully initialized, so not all public methods will work as expected! For more information read [How to remove a column](#remove-column).

For example you might want to toggle showCheckboxes based on a property of your model.

    public function relationExtendViewWidget($widget, $field, $model)
    {
        // Make sure the model and field matches those you want to manipulate
        if (!$model instanceof MyModel || $field != 'myField')
            return;

        if ($model->constant) {
            $widget->showCheckboxes = false;
        }
    }

<a name="remove-column"></a>

## How to remove a column

Since the widget has not completed initializing at this point of the runtime cycle you can't call $widget->removeColumn(). The addColumns() method as described in the [ListController documentation](/docs/backend/lists#extend-list-columns) will work as expected, but to remove a column we need to listen to the 'list.extendColumns' event within the relationExtendViewWidget() method. The following example shows how to remove a column:

    public function relationExtendViewWidget($widget, $field, $model)
    {               
        // Make sure the model and field matches those you want to manipulate
        if (!$model instanceof MyModel || $field != 'myField')
            return;

        // Will not work!
        $widget->removeColumn('my_column');

        // This will work
        $widget->bindEvent('list.extendColumns', function () use($widget) {
            $widget->removeColumn('my_column');
        });
    }

<a name="extend-manage-widget"></a>

## Extending the manage widget

Provides an opportunity to manipulate the manage widget of your relation.

    public function relationExtendManageWidget($widget, $field, $model)
    {
        // Make sure the field is the expected one
        if ($field != 'myField')
            return; 

        // manipulate widget as needed
    }

<a name="extend-pivot-widget"></a>

## Extending the pivot widget

Provides an opportunity to manipulate the pivot widget of your relation.

    public function relationExtendPivotWidget($widget, $field, $model)
    {
        // Make sure the field is the expected one
        if ($field != 'myField')
            return; 

        // manipulate widget as needed
    }

<a name="extend-refresh-results"></a>

## Extending the refresh results

The view widget is often refreshed when the manage widget makes a change, you can use this method to inject additional containers when this process occurs. Return an array with the extra values to send to the browser, eg:

    public function relationExtendRefreshResults($field)
    {
        // Make sure the field is the expected one
        if ($field != 'myField')
            return;

        return ['#myCounter' => 'Total records: 6'];
    }

Next: [Sorting records](reorder.md)

Previous: [Lists](lists.md)