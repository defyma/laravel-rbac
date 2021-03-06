Laravel RBAC package
==============

1 Introduction
----------------------------

**LaraRbac** -- Package for the Laravel 6 framework with [AdminLTE](https://github.com/jeroennoten/Laravel-AdminLTE) template, which provides management with the next data:
- Roles
- Permissions
- Assign roles for users

2 Dependencies
----------------------------

- php >= 7.1
- composer
- MySql >= 5.5
- Laravel >= 6

3 Installation
----------------------------

### 3.1 General installation from remote repository

Via composer:

```composer require "defyma/laravel-rbac"```

or in section **require** of composer.json file set the following:
```
"require": {
    "defyma/laravel-rbac": "dev-master"
}
```
and command ```composer install```, if you install laravel project extensions first,

or command ```composer update```, if all laravel project extensions are already installed.

### 3.2 If you are testing this package from local server directory

In application ```composer.json``` file set the repository, like in example:

```
"repositories": [
    {
        "type": "path",
        "url": "../laravel-rbac"
    }
],
```

Here,

**laravel-rbac** - directory name, which hase the same directory level like application and contains LaRbac package.

Then run command:

```composer require itstructure/laravel-rbac:dev-master --prefer-source```

### 3.3 App config

Add to application ```config/app.php``` file to section **providers**: ```defyma\LaraRbac\RbacServiceProvider::class```

### 3.4 Next internal installation steps

1. Run command to publish files of dependency packages and LaRbac package:

    ```php artisan rbac:install```
    
2. Configure published ```config/rbac.php``` file:
    
    change ```userModelClass``` if it is needed;
    
    set ```adminUserId``` which you wanted to be with the role of administrator;
    
3. Run command to run migrations and seeds:

    ```php artisan rbac:database```
    
4. Run command to set Admin role for user with identifier, defined in 2 point:

    ```php artisan rbac:admin```
    
5. Do not forget to configure the package AdminLTE. For that there are: published ```config/adminlte.php``` file, templates in ```resources/views/vendor/adminlte```, and another data.
See [AdminLTE](https://github.com/jeroennoten/Laravel-AdminLTE).

4 Configuration recommendations
----------------------------

### 4.1 AdminLTE

Menu config example according with the LaRbac routes:

```php
'menu' => [
    'MAIN NAVIGATION',
    [
        'text' => 'Roles',
        'icon' => 'fa fa-user-circle-o',
        'url'  => '/rbac/roles',
    ],
    [
        'text' => 'Permissions',
        'icon' => 'fa fa-user-secret',
        'url'  => '/rbac/permissions',
    ],
    [
        'text' => 'Users',
        'icon' => 'fa fa-users',
        'url'  => '/rbac/users',
    ],
],
```

### 4.2 User application model

According with the ```defyma\LaraRbac\Contracts\User``` use functions from ```defyma\LaraRbac\Models\Administrable``` trait like in example:

```php
namespace App;


```

```php
class User extends Authenticatable implements RbacUserContract
{
    use Notifiable, Administrable;

    protected $fillable = [
        'name', 'email', 'password', 'roles'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
```

License
----------------------------

Copyright © 2018 Andrey Girnik girnikandrey@gmail.com.

Licensed under the [MIT license](http://opensource.org/licenses/MIT). See LICENSE.txt for details.
