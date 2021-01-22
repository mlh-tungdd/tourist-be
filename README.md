## Run on localhost

```
1, Install fe, run
- yarn install
- yarn watch
2. copy .env.example .env
3. Install be, run
- composer install
- php artisan key:generate
- php artisan jwt:secret
- php artisan migrate
- php artisan db:seed
4. Host
- client: http://localhost:8000
- admin: http://admin.localhost:8000
5. Create
5.1 Tạo migration
- php artisan make:migration create_products_table --create=products
5.2 Tạo model và controller
- php artisan make:controller Api/ProductController --api --model=Product
5.3
- Copy file service và serviceInterface
5.4
- Thêm service vào AppService
5.5
- Thêm vào routes
```
