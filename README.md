# Restwork
A simple Rest API framework

# Requirements
PHP 5.5+

# Setup
Open "config/settings.php". You will need to set the variables in this file.

**cross_domain** : Are the incoming requests coming from a different domain?    
**requesting_domain**: If so, what is the domain? (FQD)        
**enable_rate_limiting**: If enabled, users will only be allowed to make X amount of requests per hour    
**max_requests_per_hour**: How many reuqests can a user make per hour? (if above is enabled)

# Basic Usage
All of your custom code will live inside the "actions" folder. This folder comes with two subfolders, get and post. All your code will for GET requests will live inside the get folder, and code for POST requests. Feel free to add your own directories here for other request verbs.

Your API endpoints will live inside these verb folders. **The name of the file corrosponds to the endpoint.** For example, if you wanted an endpoint at **GET http://somedomain.com/getuser**, you would create the file getuser.php in the 'actions/get' directory.

These endpoints can go as deep in this structure as needed. For example, if you wanted an endpoint at **POST http://somedomain.com/users/actions/delete**, you would create the file 'actions/post/users/actions/delete.php'.

##### The format of these files should be of the following:

1) Each file should contain a class which extends the **RestWork** class.
2) This class must override the **action** function
3) The **action** function must return a response
3) Each file must return a new instance of this class

Below is an example.

```php
    <?php
    class SomeClass extends RestWork {
        function action() {
            //some code here
            //response
        }
    }
    
    return new SomeClass();
```

##### Returning data to the client
The **RestWork** class comes built in with tools to help you return data to the client. To return a successful response, simply call 
```php
$this->generateSuccessResponse($data);
```

where $data is your return data. This data can be an object, array, or any other type of data.
To return an error response, simply call

```php
$this->generateErrorResponse($data);
```

Your success responses will look like this:

```json
{
    "status": "success",
    "response": "SOME DATA",
}
```

And your error responses will look like this:

```json
{
    "status": "error",
    "response": "SOME DATA",
}
```

That's the basics of using this framework! For more advanced usage, see below.

# Advanced Usage
This framework comes equiped with some commonly used API feautres built in.

### Access Keys
The **RestWork** class comes with some easy to use access key functions. Access keys can be used for a variety of things, and are used in most APIs. For example, if a user successfully logs in, they will be granted an access key, which must come with every request.

To generate an access token, use

```php
    $token = $this->getAccessToken();
```

$token will now contain a random access token, which can be returned to the client to use in future requests. 
This token will automatically be stored on the server for future usage.

To check if a request has a proper access token:
1) Get the access token from the client request
2) Check to see if it matches the servers access token

```php
    $token = $_POST['access_token'];
    if(!$this->checkAccessToken($token)) {
        //ACCESS TOKEN IS NOT VALID, OR MISSING
        //RETURN SOME ERROR HERE
    }
    
    //ACCESS TOKEN MATCHED
```

Use this system for whatever purposes you may need!

