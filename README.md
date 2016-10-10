# RequestId

This library contains the class and the way a RequestId 
should be used between the microservices calls.

## Installation

To install the library, include the package as a requirement in your `composer.json` file.

```
composer require "vocento/request-id"
```

## Usage

To create a new request id, import the class and the call the method create.

```php
<?php
...
use Vocento\RequestId;

class Foo
{
    ...
    public function method()
    {
        ...
        // Create a new request id
        $requestId = RequestId::create();
            
        // Create a request id from var
        $requestId = RequestId::create($currentRequestId);
        
        // Create a request id from string
        $requestId = RequestId::create('my-own-request-id');
        
        // Get the request id value
        $requestId->getId();
        
        // Get the request id header name
        $headerName = RequestId::HEADER_NAME;
        $headerName = $requestId->getHeaderName();
        ...
    }
    ...
}
```