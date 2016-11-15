# Editable Content Area for Laravel

Adds an editable content area to Laravel.

## Installation
Require the package in your composer.json file
```json
{
    "require": {
        "cirruslab/laravel-content-area": "dev-master"
    },
}
```

Then run `composer update` from your command line

Add the following to the list of service providers in `app/config/app.php`
```
'providers' => array(
    ...
    'CirrusLab\LaravelContentArea\ContentAreaServiceProvider'
)
```

Run the publish command which will publish the config file and assets.
```bash
php artisan vendor:publish --tag=contentarea
```

And migrate the database.
```bash
php artisan migrate
```

## Usage
Include the CKEditor javascript file in the head of your application layout file.
    <script src="/js/ckeditor/ckeditor.js"></script>

Configure config.