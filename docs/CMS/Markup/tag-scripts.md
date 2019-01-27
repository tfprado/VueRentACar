The `{% scripts %}` tag inserts JavaScript file references to scripts injected by the application. The tag is commonly defined before the closing BODY tag:

```html
<body>
    ...
    {% scripts %}
</body>
```

>    Note: This tag should appear once only in a given page cycle to prevent duplicated references.

# <a name="injecting-scripts" class="anchor" href="#injecting-scripts"></a>Injecting scripts

Links to JavaScript files can be programmatically injected in PHP either by [components](../../plugin/components.md#component-assets) or [pages](../Pages.md#injecting-assets).

    function onStart()
    {
        $this->addJs('assets/js/app.js');
    }

You can also inject raw markup to the {% scripts %} tag by using the **scripts** anonymous [placeholder](../Layouts.md#placeholder). Use the `{% put %}` tag in pages or layouts to add content to the placeholder:

```html
{% put scripts %}
    <script type="text/javascript" src="/themes/demo/assets/js/menu.js"></script>
{% endput %}
```
