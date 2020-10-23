# Testing the APP
How to test the APP:
1. Migrate database tables:
```
$ php artisan migrate
```
or recreate database tables:
```
$ php artisan migrate:refresh
```
2. Run phpunit:
```
$ vendor/bin/phpunit
```

## Installation via Laravel/Homestead
If the installation was done using homestead, you will have to do the following (make sure you are on the project folder):
- Connect to the virtual machine: 
```
$ vagrant ssh
```
- Go to project folder in the virtual machine: 
```
$ cd path/to/project
```
- Migrate database tables: 
```
$ php artisan migrate
```
- Run phpunit: 
```
$ phpunit
```
