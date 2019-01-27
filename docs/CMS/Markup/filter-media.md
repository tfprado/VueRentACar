The `|media` filter returns an address relative to the public path of the [media manager library](../media-manager.md). The result is a URL to the media file specified in the filter parameter.

    <img src="{{ 'banner.jpg'|media }}" />

If the media manager address is **[http://cdn.octobercms.com](http://cdn.octobercms.com)** the above example would output the following:

    <img src="http://cdn.octobercms.com/banner.jpg" />


Next: [|md](filter-md.md)

Previous: [|theme](filter-theme.md)
