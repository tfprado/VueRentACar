Functions prefixed with `str_` perform tasks that are useful when dealing with strings. The helper maps directly to the `Str` PHP class and its methods. For example:

    {{ str_camel() }}

is the PHP equivalent of the following:

    <?= Str::camel() ?>

> **Note**: Methods in _camelCase_ should be converted to _snake_case_.

# str_limit()

Limit the number of characters in a string.

    {{ str_limit('The quick brown fox...', 100) }}

To add a suffix when limit is applied, pass it as the third argument. Defaults to `...`.

    {{ str_limit('The quick brown fox...', 100, '... Read more!') }}

# str_words()

Limit the number of words in a string.

    {{ str_words('The quick brown fox...', 100) }}

To add a suffix when limit is applied, pass it as the third argument. Defaults to `...`.

    {{ str_words('The quick brown fox...', 100, '... Read more!') }}

# str_camel()

Convert a value to _camelCase_.

    // Outputs: helloWorld
    {{ str_camel('hello world') }}

# str_studly()

Convert a value to _StudlyCase_.

    // Outputs: HelloWorld
    {{ str_studly('hello world') }}

# str_snake()

Convert a value to _snake_case_.

    // Outputs: hello_world
    {{ str_snake('hello world') }}

The second argument can supply a delimiter.

    // Outputs: hello---world
    {{ str_snake('hello world', '---') }}

# str_plural()

Get the plural form of an English word.

    // Outputs: chickens
    {{ str_plural('chicken') }}

Next: [form()](function-form.md)

Previous: [|default](filter-default.md

