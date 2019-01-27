Content blocks are text, HTML or [Markdown](http://daringfireball.net/projects/markdown/syntax) blocks that can be edited separately from the page or layout. They are designed to hold static content only and support basic templating variables. [Partials](Partials.md) are more flexible and should be used for generating dynamic content.

# <a name="introduction" class="anchor" href="#introduction"></a>Introduction

Content blocks files reside in the **/content** subdirectory of a theme directory. The following extensions are supported for content files:

|**Extension** |**Description**
|-----------|:--------------------------
|htm	    |   Used for HTML markup.
|txt 	    |   Used for plain text.
|md 	    |   Used for Markdown syntax.

The extension affects the way content blocks are displayed in the back-end user interface (with a WYSIWYG editor or with a plain text editor) and how the blocks are rendered on the website. Markdown blocks are converted to HTML before they are displayed.

# <a name="rendering-content-blocks" class="anchor" href="#rendering-content-block"></a>Rendering content blocks

Use the `{% content 'file.htm' %}` tag to render a content block in a [page](Pages.md), [partial](Partials.md) or [layout](Layouts.md). Example of a page rendering a content block:

url = "/contacts"
==
<div class="contacts">
    {% content 'contacts.htm' %}
</div>

# <a name="content-variables" class="anchor" href="#content-variables"></a>Passing variables to content blocks

Sometimes you may need to pass variables to a content block from the external code. While content blocks do not support the use of Twig markup, they do support using variables with a basic syntax. You can pass variables to content blocks by specifying them after the content block name in the `{% content %}` tag:

    {% content 'welcome.htm' name='John' %}

Inside the content block, variables can be accessed using singular *curly brackets:*

```html
<h1>This is a demo for {name}</h1>
```

More information can be found [in the Markup guide](Markup/tag-content.md).

# <a name="content-global-variables" class="anchor" href="#content--global-variables"></a>Global variables

You may register variables that are globally available to all content blocks with the `View::share` method.

    View::share('site_name', 'OctoberCMS');

This code could be called inside the register or boot method of a [plugin registration file](../plugins/registration.md). Using the above example, the variable `{site_name}` will be available inside all content blocks.