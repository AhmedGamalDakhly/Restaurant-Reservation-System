# Restaurant-Reservation-System 
This is a Restaurant-Reservation-System developed using laravel 9 for  a restaurant to  let users surf 
and know about your restaurant and make reservations , 
it included front end pages for guests and also an admin panel to contol the website and it's content .

### home page

![home-page](https://user-images.githubusercontent.com/114573933/193540295-466110c8-5a42-462a-99f1-006e285585e0.PNG)

### new-reservation form 

![make-reservation-form](https://user-images.githubusercontent.com/114573933/193540401-1d812bb3-460c-49e3-8f07-432ebc09086b.PNG)

### admin panel

![admin-panel](https://user-images.githubusercontent.com/114573933/193540397-5970ffc3-2ddc-469a-a4b0-d579e9ac38de.PNG)


## Installing

First clone this repository, install the dependencies, and setup your .env file.

```
git clone git@github.com:AhmedGamalDakhly/Restaurant-Reservation-System.git  restaurant-reservation-system
composer install
cp .env.example .env
```

Then create the necessary database.

```
php artisan db
create database my_resturant
```

And run the initial migrations and seeders.

```
php artisan migrate --seed
```
### Credits
* [Ahmed Gamal Dakhly](https://github.com/AhmedGamalDakhly)

 
