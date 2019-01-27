The `{% styles %}` tag renders CSS links to stylesheet files injected by the application. The tag is commonly defined in the HEAD section of a page or layout:

```html
<head>
    ...
    {% styles %}
</head>
```

>    Note: This tag should appear once only in a given page cycle to prevent duplicated references.

# Injecting styles

Links to StyleSheet files can be injected in PHP either by [components](../../plugins/components.md#injecting-assets) or [pages programmatically](../Pages.md#injecting-assets).

    function onStart()
    {
        $this->addCss('assets/css/hello.css');
    }

You can also inject raw markup to the `{% styles %}` tag by using the **styles** anonymous [placeholder](../Layouts.md#placeholders). Use the `{% put %}` tag in pages or layouts to add content to the placeholder:

```html
{% put styles %}
    <link href="/themes/demo/assets/css/page.css" rel="stylesheet" />
{% endput %}
```
