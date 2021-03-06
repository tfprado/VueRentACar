# Simple Front-End form tutorial

## Making a contact form component

### Folder Structure

    PluginNamespace
    .
    ├── contact
    │   ├── components
    │   │   ├── contactform
    │   │   │   └── default.htm // Form HTML
    │   │   └── ContactForm.php // onSend() function here
    │   ├── lang
    │   │   └── en
    │   │       └── lang.php
    │   ├── updates
    │   │   └── version.yaml
    │   ├── views
    │   │   └── mail
    │   │       └── message.htm // Message Being sent
    │   ├── Plugin.php              
    │   └── plugin.yaml
    └── otherPlugins

### Creating a new form

In the components folder add a `contactFormName.php` and `contatcFormName` folder with a `default.htm`. The PHP file will have the onRun()/onSend() functions and the htm file will have the HTML mark-up.

#### Classes Used

```php
use CMS\Classes\ComponentBase;
use Input;
use Mail;
use Validator;
use Redirect;
```

#### Registering component details

```php
class ContactForm extends ComponentBase
{
    public function componentDetails(){

        return [
            'name' => 'Contact Form by Thiago',
            'description' => 'Simple demo contact form'
        ];
    }
```
#### Demo onSend() function with validation

```php
public function onSend(){

        $validator = Validator::make(
            [
                'name' => Input::get('name'),
                'email' => Input::get('email')
            ],
            [
                'name' => 'required',
                'email' => 'required|email'
            ]
        );

        if($validator->fails()){

            return Redirect::back()->withErrors($validator);
        }
        else{

            // These variables are available inside the message as Twig
            $vars = ['name' => Input::get('name'), 'email' => Input::get('email'), 'content' => Input::get('content')];

            // View being used to send message, add some-msg.htm file 
            // to view/mail and change mail.message to mail.some-message
            Mail::send('thiagoprado.contact::mail.message', $vars, function($message) {

                $message->to('tprado@kensingtonhealth.org', 'Thiago Prado');
                $message->subject('New message from test contact form');

            });
        }
    }
}
```

### [Validation Docs](services/validation.md)

### [Auto-Responder](AutoResponder.md)

