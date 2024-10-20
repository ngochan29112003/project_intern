## NOTE. progress
````
    - Người dùng tài chính mới vào được bảng lương 
    - Nếu loại nhân viên là tâp su thì mặc định sẽ có hsl là 2.34
    - https://api.nosomovo.xyz/ethnic/getalllist?_gl=1*1guycdt*_ga*MTI1NDMyMjUzNS4xNzI0MTcwMTI0*_ga_XW6CMNCYH8*MTcyNDE3MDEyMy4xLjEuMTcyNDE3MDE0OC4wLjAuMA..
    - 
````


#### 1. Cấu hình Laravel

Laravel là một PHP Framework mã nguồn mở miễn phí, được phát triển bởi Taylor Otwell với phiên bản đầu tiên được ra mắt vào tháng 6 năm 2011. Laravel ra đời nhằm mục đích hỗ trợ phát triển các ứng dụng web, dựa trên mô hình MVC (Model – View – Controller).

**Link** https://github.com/laravel/laravel

##### 2. Cấu hình ban đầu
Chạy lệnh `php composer.phar install`

Copy file `.env.example` -> `.env` 


##### 3. Quy định về kiến trúc

###### a. Thư mục giao diện `resources/views/auth`

- Mỗi thư mục tương ứng với một tính năng trên giao diện

Ví dụ: `resources/views/auth/don-vi/don-vi.blade.php`

Trong đó `don-vi` là thư mục và `don-vi.blade.php` là giao diện sử dụng

###### b. Quy định đặt tên

- `resources/views/auth`: Đặt tên tiếng việt, không dấu mỗi từ cách nhau dấu gạch nối, ví dụ như `don-vi.blade.php`
- `app/Models/*`: Đặt tên theo database và in hoa chữ cái đầu mỗi từ và có hậu tố **Model**  `DonViModel.php`
- `app/Http/Controllers/*`: Đặt tên theo database và in hoa chữ cái đầu mỗi từ và có hậu tố **Controller** `DonViCOntroller.php`

#### 4. Laravel mySQL

Sử dụng Laravel SQL RAW https://laravel.com/docs/8.x/database#running-a-select-query

#### 5. Laravel tạo Controller

```
php artisan make:controller DemoController
```

#### 6. Laravel Tạo Model

```
php artisan make:model DemoModel
```
#### 7. Lưu ý

```
+ Sử dụng PHP version 8.1
+ Cú pháp: Đường dẫn đến thư mục public
    muốn sử dụng "bootstrap.min.css" nằm trong public ta phải thêm {{asset('')}} xong trỏ bắt đầu từ thư mục sau thư mục public là assets bỏ trong href
    ví du: <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
```

#### 8. Khởi chạy web
```
php artisan ser
```

#### 9. cài đặt composer (có sẵn thư viện im/export excel)
```
composer require "ext-gd:*" --ignore-platform-reqs
composer require "ext-fileinfo:*" --ignore-platform-reqs
composer require phpoffice/phpspreadsheet --ignore-platform-reqs
```


