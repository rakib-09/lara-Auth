<p align="center"><a href="https://github.com/rakib-09/lara-auth" target="_blank"><img src="./icon.svg" width="200">
</a></p>
<p align="center">
    Laravel Package for changing the view of typical Laravel Auth.
</p>
### Features
* It Just default Laravel Auth.
* It will just change the User Login Page View. 
* Easy way to make Authentication in Your Laravel Application. 

### Installation
Go to terminal and run this command

```shell
composer require rakib/lara-auth
```

Wait for few minutes. Composer will automatically install this package for your project.
Below **Laravel 5.5** open `config/app` and add this line in `providers` section

```php
Rakib\LaraAuth\LaraAuthServiceProvider::class,
```
Now run this command in your terminal to publish this package resources:

```
php artisan vendor:publish 
```
Then Find out The number of 
`Rakib\LaraAuth\LaraAuthServiceProvider` 
That's it !! 
You Are Done.
Let's Have fun with new login process.

## Credits
- [Rakibul Hasan](https://github.com/rakib-09)
- Thanks to [Appzgear](https://www.flaticon.com/authors/appzgear) for icon.
- [All Contributors](../../contributors)

### Security Vulnerabilities
If you discover a security vulnerability within LaraAuth, please send an e-mail to Rakibul Hasan via [rakib_rumi09@live.com](mailto:rakib_rumi09@live.com).

### License
The LaraAuth package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
