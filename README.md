## Install Project

WARNING: This package is not installable via Composer 1.x, please make sure you upgrade to Composer 2+

`composer require andreaortu/admproject`

Insert your db settings in your .env

`php artisan migrate`

## Store People and Planet Data

`php artisan store:people-and-planet`

## Api

### Retrieve all people

``api/people``

### Sort

`api/people?sortBy={column}&direction={asc|desc}`

Es: `api/people?sortBy=name&direction=desc`

### Filter
`api/people?filter=["{column}", "{value}"]`

Es: `api/people?filter=["eye_color", "brown"]`

### Retrieve People
``api/people/{id}``

## Test
All tests are in ``tests/Feature/PeopleTest.php``
