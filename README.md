# PHP SDK for ResellerClub GSuite API
PHP SDK for ResellerClub GSuite API

Available API requests: 
* Orders
* GSuite

## Installation
```console
composer require rtraselbd/resellerclub-gsuite-php-api
```

## Usage Example
```php
use RT\ResellerClub\ResellerClub;


/**
* Location [1 = India, 2 = South East Asia & Egypt, 3 = Global]
* Plan ID India, South East Asia & Egypt, Global [Business Starter = (1660,1663,1657), Business Standard = (1661,1664,1658), Business Plus = (1662,1665,1659), Enterprise Plus = (1554, 1560, 1557)]
*/

$resellerClub = new ResellerClub('<userId>', '<apiKey>');
$resellerClub->gsuite()->add('rtrasel3.com', 1, 1, 1, 'NoInvoice', 3, 1657);
```
Note: All functions return a raw response from API.


### Disclaimer
This repository based on his [ResellerClub PHP SDK](https://github.com/afbora/resellerclub-php-sdk "ResellerClub PHP SDK") repository.
