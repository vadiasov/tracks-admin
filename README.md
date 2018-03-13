# vadiasov/tracks-admin

## Goals
This package is very specific package.

This package: 
* creates DB table tracks (music tracks)
* uploads tracks with package vadiasov/uploads
* outputs an index of tracks of a selected album
* except standard features the index page includes 
    * player with controls for each track
    * button "Tracks Ordering" to order tracks with vadiasov/ordering.
     
## Using
Package has own routes.

## Installation
1.Create row in the application root composer:
````
"require": {
      ...
        "vadiasov/tracks-admin": "^x.x.x",
      ...  
    },
````
2.Run in your terminal:
````
cd your_application_root
composer update
````
3.This package is developed with discovery feature. So it must itself to create row in a config/app.com about ServiceProvider:
````
/*
 * Package Service Providers...
 */
...
Vadiasov\TracksAdmin\TracksServiceProvider::class,
````
