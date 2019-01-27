# Set Up

[Setting up a new contact form](Forms.md)

After getting your contact form component finished and registered with a plugin, you can add mail templates directly to the `view/mail` folder. This is some sample code for sending mail with the template under `view/mail/message.htm`

```php
Mail::send('thiagoprado.contact::mail.message', $vars, function($message) {

                $message->to('tprado@kensingtonhealth.org', 'Thiago Prado');
                $message->subject('New message from test contact form');

});
```


If you added a new template called `response.htm`, you could use it like this:

```php
Mail::send('thiagoprado.contact::mail.response', $vars, function($message)
```


