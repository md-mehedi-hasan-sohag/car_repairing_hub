# Car Repairing Hub - Laravel Project

A comprehensive web-based platform connecting vehicle owners with automobile repair shops.

## Features Implemented

### User Roles
1. **Customer** - Browse shops, book services, make payments, write reviews
2. **Shop Owner** - Manage shop details, add services with pricing, view ratings
3. **Admin** - Manage users, shops, and master service list

### Core Functionality
- ✅ Multi-role authentication (Customer, Shop Owner, Admin)
- ✅ Forgot Password / Reset Password
- ✅ Change Password (for logged-in users)
- ✅ Shop Discovery (search by name/location/service)
- ✅ Service Catalog Management
- ✅ Shopping Cart functionality
- ✅ Digital Payment System
- ✅ Review & Rating System
- ✅ User Profile Management
- ✅ Admin Content Moderation

## Tech Stack
- Laravel 12
- MySQL Database
- Blade Templates
- MVC Architecture
- Custom CSS (no framework dependencies)

## Database Structure

### Tables Created:
1. **users** - All user accounts with role differentiation
2. **shops** - Shop information linked to shop owners
3. **services** - Master list of available services
4. **offered_services** - Services offered by specific shops with pricing
5. **selects** - Cart/booking system
6. **payments** - Payment transaction records
7. **reviews** - Customer reviews and ratings
8. **password_reset_tokens** - Password reset management
9. **sessions** - Session management

## Setup Instructions

### 1. Create MySQL Database
```sql
CREATE DATABASE car_repairing_hub;
```

### 2. Configure Environment
The `.env` file is already configured with:
- Database: car_repairing_hub
- DB User: root
- DB Password: (empty - update if needed)

### 3. Run Migrations and Seeders
```bash
php artisan migrate:fresh --seed
```

### 4. Start Development Server
```bash
php artisan serve
```

### 5. Access the Application
- URL: http://localhost:8000
- Login with seeded accounts:

**Admin Account:**
- Email: admin@carrepair.com
- Password: password

**Customer Account:**
- Email: customer@test.com
- Password: password

**Shop Owner Account:**
- Email: shop@test.com
- Password: password

## Project Structure

### Controllers
```
app/Http/Controllers/
├── Auth/
│   └── AuthController.php         # Login, Register, Password Reset
├── Customer/
│   ├── DashboardController.php    # Customer home
│   ├── ShopController.php         # Browse shops
│   ├── CartController.php         # Shopping cart
│   ├── PaymentController.php      # Payment processing
│   ├── ReviewController.php       # Submit reviews
│   └── ProfileController.php      # Profile management
├── ShopOwner/
│   ├── DashboardController.php    # Shop owner home
│   ├── ShopController.php         # Manage shop details
│   ├── ServiceController.php      # Manage offered services
│   └── ProfileController.php      # Profile management
└── Admin/
    ├── DashboardController.php    # Admin home
    ├── UserController.php         # User management
    ├── ShopController.php         # Shop moderation
    └── ServiceController.php      # Service catalog management
```

### Models
```
app/Models/
├── User.php                       # User model with role helpers
├── Shop.php                       # Shop model
├── Service.php                    # Service model
├── OfferedService.php             # Pivot model for shop-service
├── Select.php                     # Cart/booking model
├── Payment.php                    # Payment model
└── Review.php                     # Review model
```

### Routes Summary
```
Guest Routes:
- GET  /login
- POST /login
- GET  /register
- POST /register
- GET  /forgot-password
- POST /forgot-password
- GET  /reset-password
- POST /reset-password

Customer Routes (prefix: /customer):
- GET  /dashboard
- GET  /shops
- GET  /shops/{id}
- GET  /cart
- POST /cart/add
- GET  /payment/checkout
- POST /payment
- GET  /payment/history
- POST /reviews/{shop}
- GET  /profile

Shop Owner Routes (prefix: /shop-owner):
- GET  /dashboard
- GET  /shop/create
- POST /shop
- GET  /shop/edit
- PUT  /shop
- GET  /services
- POST /services
- PUT  /services/{id}
- DELETE /services/{id}

Admin Routes (prefix: /admin):
- GET  /dashboard
- GET  /users
- DELETE /users/{id}
- GET  /shops
- DELETE /shops/{id}
- GET  /services
- POST /services
- PUT  /services/{id}
- DELETE /services/{id}
```

### Middleware
- **RoleMiddleware** - Protects routes based on user type
- Usage: `middleware(['auth', 'role:customer'])`

## Seeded Data

### Services (10 pre-loaded):
1. Oil Change
2. Brake Repair
3. Tire Rotation
4. Engine Diagnostics
5. AC Service
6. Battery Replacement
7. Wheel Alignment
8. Transmission Service
9. Suspension Repair
10. Paint and Body Work

### Users (3 accounts):
1. Admin User
2. Test Customer
3. Test Shop Owner

## Next Steps / Extensions

To expand the project further:

1. **Additional Views** - Create more detailed views for:
   - Customer shop browsing
   - Cart management
   - Payment checkout
   - Review submission
   - Shop owner service management
   - Admin management panels

2. **Features to Add**:
   - Appointment scheduling
   - Real-time notifications
   - Image upload for shops
   - Google Maps integration
   - Email notifications
   - Dark mode
   - Export payment history to PDF

3. **Frontend Enhancement**:
   - Reference the GitHub repo design
   - Add more interactive JavaScript
   - Responsive design improvements

## Testing the Application

1. **As Customer**:
   - Register → Browse shops → Add services to cart → Checkout → Write review

2. **As Shop Owner**:
   - Register → Create shop → Add services with prices → View ratings

3. **As Admin**:
   - Login → View dashboard → Manage users/shops/services

## Key Files Modified

- `.env` - Database configuration
- `bootstrap/app.php` - Middleware registration
- `routes/web.php` - All application routes
- `database/migrations/` - Database schema
- `app/Models/` - Eloquent models with relationships
- `app/Http/Controllers/` - Business logic
- `resources/views/` - Blade templates
- `public/css/style.css` - Custom styling

## Database Relationships

- User → Shop (One to One)
- User → Reviews (One to Many)
- User → Payments (One to Many)
- Shop → Offered Services (One to Many)
- Shop → Reviews (One to Many)
- Service → Offered Services (One to Many)
- Offered Service → Selects (One to Many)

## Security Features

- Password hashing
- CSRF protection
- Role-based access control
- SQL injection protection (Eloquent ORM)
- XSS protection (Blade templating)
- Session management

## Notes

- The project follows Laravel 12 conventions
- Follows MVC architecture strictly
- Uses Eloquent ORM for database operations
- Implements RESTful routing patterns
- Mobile-responsive CSS included

For questions or issues, refer to Laravel documentation: https://laravel.com/docs
EOF

cat PROJECT_SETUP.md
