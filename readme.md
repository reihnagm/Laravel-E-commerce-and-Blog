### Simple E-commerce Laravel 5.6

## Feature Include's

### Profile
- **default ava gravatar** 
- **update profile ava (vue js)**
- **chat realtime with all (public)**
- **notification _no realtime_ (user commment a blog, getting a like and unlike and user voting emotion)**

### Blog
- **crud**
- **have image**
- **have tags**
- **have slug**
- **pagination with different url**
- **have a single page**
- **emotions vote with percentage bar (vue js)**
- **comments realtime (crud (vue js), like and unlike (vue js), pagination use collection)**
- **summer note lite version text editor for crud blog (desc)**

### Product
- **crud**
- **have image**
- **have categories**
- **have slug**
- **pagination with different url**
- **multiple input dollar and idr** 
- **discount & coupons**
- **summer note lite version text editor for crud product (desc)**
- **checkout as guest**

### Integrate Payment
- **Stripe**
- **Paypal**

### Other 
- **multiple conversion currencies (IDR and USD)**
- **package admin laravel voyager(modified)**
- **login use google**
- **login use facebook**

### Install 
- composer install
- php artisan key:generate
- php artisan migrate --seed

### Common Issues
- Specified key was too long (migrate)  
  **Go to App/Providers/AppServiceProvider.php**  

  **Add this on public function boot()**  
  **Schema::defaultStringLength('191');**
  
  
