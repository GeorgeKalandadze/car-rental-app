<div style="display:flex; align-items: center">
  <h1 style="position:relative; top: -6px" >Car Rental Project</h1>
</div>

---

The Car Rental Project is a robust and scalable web application developed using the Laravel framework. This project is designed to provide a comprehensive platform for managing car rentals, including features for authentication, user management, car and part inventory management, and company operations. The application leverages Laravel's powerful features such as polymorphic relationships, mailing, and more to ensure a seamless user experience.

#

### Features

- **Authentication**:  User Authentications system.
  - **API Token Authentication**: Securing API endpoints with Laravel Sanctum.
    
  - **Manage Auth Functionality**: Managed with Laravel Breeze.
- **Car Management**: Users can add, view, update, and delete cars from the inventory.
- **Car Parts Management**: CRUD Operations for Car Parts, Manage the inventory of car parts, including adding, viewing, updating, and deleting parts.
- **Company Management**: Manage company profiles, including creating, updating, and deleting company records, When a company is created, it can add cars to its fleet, managing a separate inventory of cars for each company.
- **Polymorphic Relationships**: Implementing polymorphic relationships to manage complex data associations.

- **Mailing**: Integrate Mailing system.
  - **Email Notifications**: Automated email notifications for various events such as user registration, booking confirmations, password resets, and more.
    
  - **Car Likes Notification**: When a user likes a car, the car owner receives a notification via email.
  - **Mailtrap Integration**: Integration with Mailtrap SMTP to test and debug email notifications in a safe, simulated environment before sending them to real users.
- **Form Request Validation**: Enhanced form request validation using Laravel form request Classes.
- **API Resources**: Used for transforming and formatting API responses, providing a consistent structure for the API endpoints.
- **Seeders and Factories**:  Provide initial data for testing and development environments, Generate realistic fake data for models.

  
#

### Used Packages And Docs
- [Sanctum](https://laravel.com/docs/11.x/sanctum): Securing API endpoints with Laravel Sanctum.
- [Laravel Breeze](https://laravel.com/docs/11.x/starter-kits): A minimalistic authentication scaffolding for Laravel applications.
- [Polymorphic Relationships](https://laravel.com/docs/11.x/eloquent-relationships#polymorphic-relationships): A polymorphic relationship allows the child model to belong to more than one type of model using a single association.
- [Mailtrap](https://mailtrap.io/): A SMTP service which can use to test and debug email notifications in a safe.

#

### Project setup
```bash
git clone https://github.com/GeorgeKalandadze/Social-Media-web-Backend.git
```
```bash
cp .env.example .env
```
```bash
composer install
```
```bash
php artisan key:generate
```
```bash
php artisan migrate:fresh --seed
```
```bash
php artisan serve
```

#

### And now you should provide **.env** file all the necessary environment variables:

**MYSQL:**

> DB_CONNECTION=mysql

> DB_HOST=127.0.0.1

> DB_PORT=3306

> DB_DATABASE=**\***

> DB_USERNAME=**\***

> DB_PASSWORD=**\***

#

**Mailtrap:**

> MAIL_MAILER=smtp

> MAIL_HOST=smtp.mailtrap.io

> MAIL_PORT=2525

> MAIL_USERNAME=**\***

> MAIL_PASSWORD=**\***

> MAIL_ENCRYPTION=null

> MAIL_FROM_ADDRESS=no-reply@carrental.com

> MAIL_FROM_NAME="${APP_NAME}"
