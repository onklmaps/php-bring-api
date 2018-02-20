# PHP Bring API 

Use this API with any PHP application ( Magento, Wordpress, Drupal, etc. ).

Features:

- Forces request format to comply with Bring API
- Forces strict data types
- Validation before API request
- PSR-4 compliant
- Supports My bring authorization for API's that supports it ( meaning no rate limiting ).

See example folder for usage.


See [Bring Developer Section](http://developer.bring.com/) for info about the API and response array description.


## Install

Install using composer is the best way.

``` 
composer require markant-norge/bring-api@^1.0
```

## Supporting the following APIs:



- [x] Booking API (EDI)
    - [x] Book shipments. https://api.bring.com/booking/api
    - [x] Get Mybring customers. https://api.bring.com/booking/api/customers
- [x] Shipping Guide API  
    - [x] Get estimated prices for packages. 
- [x] Tracking API
    - [x] Track consignments
- [x] Easy Return Service API    
    
** API's marked with [x] is implemented**


## Test (cli)

See `example` folder for example scripts.

### Testing My bring booking API

Since the booking API requires authentication with My Bring, set some environment variables before running the test script.

UID / API key and Bring customer number is accessible in the mybring web interface.

```
cd example/
export BRING_UID="me@myemail.com" && export BRING_API_KEY="xxxxxx-xxxxx-xxx-xxxx" && export BRING_CUSTOMER="BRING__CUSTOMER_NUMBER" && php booking-api.php
```

## Contribute

Contributions are welcome.

## License

MIT
