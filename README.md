# Editable Content Area for Laravel

Adds an editable content area directive to the Laravel Blade templating engine.

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
```php
Cirruslab\LaravelContentArea\ContentAreaServiceProvider::class
```

Run the publish command which will publish the config file and assets.
```bash
php artisan vendor:publish --tag=contentarea
```

And migrate the database.
```bash
php artisan migrate
```

Setup permissions for who has permissions to edit the content areas in `app/config/contentarea.php` and adding a list of email addresses to the `$editors` array. Alternatively you can modify the `can_edit` function to integrate with your existing user authorization system. 

## Usage
Include the CKEditor javascript file in the head of your application layout file.
```
    <script src="/js/ckeditor/ckeditor.js"></script>
````

Now you can simply use the `@content_area('area_name')` tag in your Blade template file. Note that the 'area_name' needs to be unique for each separate area, but you can add as many areas on a page as you want. 

__Note:__ If you change an area name, you will need to remove the cached Blade views in order for the changes to show up. You can do this by running the following command. 
```bash
php artisan view:clear
```
