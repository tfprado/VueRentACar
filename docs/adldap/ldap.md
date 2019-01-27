# Active Directory/AdLDAP2

## Getting Started

AdLDAP2 package added through the Kensington/LDAP plugin.

> Make sure to add a `LDAP_ADMIN_PASSWORD_KENSINGTON` and `LDAP_ADMIN_PASSWORD` passwords to your .env file!

### Folder Structure

    . Plugins
        |-> Kensington
            |-> LDAP
                |-> components
                |   |-> kensingtonlogin // Backend Authorization component
                |   |   |-> default.htm // Default markup for components
                |   |-> testldap        // Component for troubleshooting connection problems 
                |       |-> default.htm // default markup for component
                |-> lang                // Languages folder
                |   |-> en-ca
                |       |->lang.php
                |-> updates             // Plugin version updates can be added here
                |   |-> version.yaml
                |-> composer.json       // AdLDAP2 package version set here for composer update
                |-> Plugin.php          // Main registration file for plugin
                |-> plugin.yaml         // Plugin information for backend

### Testing Connection

I have added pages for testing LDAP Connection. Just add this to your docker url <br>
**Example**: [http://localhost:8000/test-adldap-component](http://localhost:8000/test-adldap-component)

* /test-adldap-components
* /test-adldap-kensington
* /test-adldap

#### Changing AdLDAP2 Config Options

On the test pages the configuration options are defined on the PHP section of the page. <br>
This is the standard configuration options that have worked for me.
                
```php
    $ad = new Adldap\Adldap();

    $config = [
        'hosts'            => ['app-ad1.kensingtonhealth.org', '10.10.31.70', 'app-ad2.kensingtonhealth.org', '10.10.31.72'],
        'base_dn'          => 'OU=Kensington Health,DC=kensingtonhealth,DC=org',
        'username'         => 'CN=LDAP LOOKUP,CN=Users,DC=KensingtonHealth,DC=org',
        'password'         => getenv('LDAP_ADMIN_PASSWORD_KENSINGTON'),

        // Optional Configuration Options
        'schema'           => Adldap\Schemas\ActiveDirectory::class,
        'account_prefix'   => '',
        //'account_suffix'   => ',DC=kensingtonhealth,DC=org',
        'account_suffix'   => '',
        'port'             => 389,
        'follow_referrals' => false,
        'use_ssl'          => false,
        'use_tls'          => false,
        'version'          => 3,
        'timeout'          => 5,

        // Custom LDAP Options
        'custom_options' => [
        // See: http://php.net/ldap_set_option
        //LDAP_OPT_X_TLS_REQUIRE_CERT => LDAP_OPT_X_TLS_HARD
        ]
    ];
    // Sets the connection name
    $connectionName = 'ldap-test';

    //Add new provider
    $ad->addProvider($config, $connectionName);
```
                
#### Start new connection

```php
    //Attempt connection to server
    try 
    {
        //Connection Works!
        $provider = $ad->connect($connectionName);
    }
    catch (Adldap\Auth\BindException $e) 
    {
        // Connection failed!
    }
```

#### Authenticate user

```php
        //Attempt to authenticate above user
        try 
        {
            if ($provider->auth()->attempt($username, $password)) 
            {
                // Passed.
            }

            else {
                // Failed.
            }
        } 
        catch (Adldap\Auth\UsernameRequiredException $e) 
        {
            // The user didn't supply a username.
        } 
        catch (Adldap\Auth\PasswordRequiredException $e) 
        {
            // The user didn't supply a password.
        }
```

## Using Backend Login Component

Adding the kensington login components to a page will add a section for a user to enter in a name and password. This is how the plugin takes that input and authenticates the user into October.

> Will add further code to add different roles to backend user depending LDAP groups. 


```php
    // Get user input from form
    $username = Input::get('name');
    $password = Input::get('password');

    //Attempt connection to server
    try
    {
        //Connection Works!
        $provider = $ad->connect($connectionName);
        
        // Attempt to authenticate user against LDAP server
        if ($provider->auth()->attempt($username, $password)) 
        {
            // User authenticated!
            
            //checks if user already exists in OctoberCMS
            $userExists = BackendAuth::findUserByLogin($username);
            if($userExists)
            {
                //User exists, authenticate and redirect to backend
                BackendAuth::authenticate([
                    'login' => $username,
                    'password' => $password
                ]);
                return Redirect::to('/backend');
            }
            else
            {
                // Create a new admin user, authenticate it and redirect to backend
                BackendAuth::register([
                    'name' => $username,
                    'login' => $username,
                    'email' => $email,
                    'password' => $password,
                    'password_confirmation' => $password,
                    'role' => '3'
                ]);
                BackendAuth::authenticate([
                    'login' => $username,
                    'password' => $password
                ]);
                return Redirect::to('/backend');
            }
        } 
        else 
        {
            // Failed to authenticate user.
            return Redirect::to('/');
        }
    } 
    catch (Adldap\Auth\BindException $e) 
    {
        // Connection to LDAP server failed!
        return Redirect::to('/');
    }
```