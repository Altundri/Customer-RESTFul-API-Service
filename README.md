# Customer RESTFul API Service

[![Visual Studio Code](https://img.shields.io/badge/--007ACC?logo=visual%20studio%20code&logoColor=ffffff)](https://code.visualstudio.com/)

## Features Laravel Rest API

- getAllCustomer
- getCustomerById
- PostCustomer
- PatchCustomer
- DeleteCustomer
- getAllAddress
- getAddressById
- PostAddress
- PatchAddress
- DeleteAddress

## Tech
Aplikasi ini dibangun dengan menggunakan :
- [Laravel Framework](https://laravel.com/) - Laravel adalah kerangka kerja aplikasi web berbasis PHP yang sumber terbuka, menggunakan konsep Model-View-Controller. Laravel berada dibawah lisensi MIT, dengan menggunakan GitHub sebagai tempat berbagi kode.
- [XAMPP](https://www.apachefriends.org/download.html) -  Aplikasi XAMPP merupakan sebuah paket perangkat lunak (software) komputer yang berfungsi sebagai server lokal untuk mengampu berbagai jenis data website yang sedang dalam proses pengembangan.
- [Visual Studio Code](https://code.visualstudio.com/) - Visual Studio Code adalah perangkat lunak penyunting kode-sumber buatan Microsoft untuk Linux, macOS, dan Windows. Visual Studio Code menyediakan fitur seperti penyorotan sintaksis, penyelesaian kode, kutipan kode, merefaktor kode, pengawakutuan, dan Git.
- [Google Chrome](https://www.google.com/chrome) - Aplikasi Google Chrome adalah browser web cepat yang tersedia tanpa biaya yang merupakan tools penting dalam membuat sebuah halaman website, dsb.
- [Postman](https://www.postman.com/)- Postman adalah alat yang luar biasa ketika mencoba membedah RESTful API yang dibuat oleh orang lain atau menguji yang Anda buat sendiri. Ini menawarkan antarmuka pengguna yang sederhana untuk membuat permintaan HTML, tanpa melalui banyak kerumitan menulis banyak code hanya untuk menguji fungsionalitas API.
- [PHP](https://www.php.net/docs.php) - PHP (Hypertext Preprocessor) adalah sebuah bahasa pemograman server side scripting yang bersifat open source.
- [Docker](https://www.docker.com/) - Docker adalah sekumpulan platform sebagai produk layanan yang menggunakan virtualisasi tingkat OS untuk mengirimkan perangkat lunak dalam paket yang disebut kontainer. Layanan ini memiliki tingkatan gratis dan premium. Perangkat lunak yang menampung kontainer disebut Docker Engine.


## Requirement
- XAMPP 7.4.28 
- PHP 7.4 
- Laravel 8 
- Postman
- Docker (Opsional)

## Structure
```
.laravel_test
📦app
 ┣ 📂Console
 ┃ ┗ 📜Kernel.php
 ┣ 📂Exceptions
 ┃ ┗ 📜Handler.php
 ┣ 📂Http
 ┃ ┣ 📂Controllers
 ┃ ┃ ┣ 📜AddressController.php
 ┃ ┃ ┣ 📜Controller.php
 ┃ ┃ ┗ 📜CustomerController.php
 ┃ ┣ 📂Middleware
 ┃ ┃ ┣ 📜Authenticate.php
 ┃ ┃ ┣ 📜EncryptCookies.php
 ┃ ┃ ┣ 📜PreventRequestsDuringMaintenance.php
 ┃ ┃ ┣ 📜RedirectIfAuthenticated.php
 ┃ ┃ ┣ 📜TrimStrings.php
 ┃ ┃ ┣ 📜TrustHosts.php
 ┃ ┃ ┣ 📜TrustProxies.php
 ┃ ┃ ┗ 📜VerifyCsrfToken.php
 ┃ ┗ 📜Kernel.php
 ┣ 📂Models
 ┃ ┣ 📜Address.php
 ┃ ┣ 📜Customer.php
 ┃ ┗ 📜User.php
 ┗ 📂Providers
 ┃ ┣ 📜AppServiceProvider.php
 ┃ ┣ 📜AuthServiceProvider.php
 ┃ ┣ 📜BroadcastServiceProvider.php
 ┃ ┣ 📜EventServiceProvider.php
 ┃ ┗ 📜RouteServiceProvider.php
 📦bootstrap
 ┣ 📂cache
 ┃ ┣ 📜.gitignore
 ┃ ┣ 📜packages.php
 ┃ ┗ 📜services.php
 ┗ 📜app.php
 📦config
 ┣ 📜app.php
 ┣ 📜auth.php
 ┣ 📜broadcasting.php
 ┣ 📜cache.php
 ┣ 📜cors.php
 ┣ 📜database.php
 ┣ 📜filesystems.php
 ┣ 📜hashing.php
 ┣ 📜logging.php
 ┣ 📜mail.php
 ┣ 📜queue.php
 ┣ 📜sanctum.php
 ┣ 📜services.php
 ┣ 📜session.php
 ┗ 📜view.php
 📦config
 ┣ 📜app.php
 ┣ 📜auth.php
 ┣ 📜broadcasting.php
 ┣ 📜cache.php
 ┣ 📜cors.php
 ┣ 📜database.php
 ┣ 📜filesystems.php
 ┣ 📜hashing.php
 ┣ 📜logging.php
 ┣ 📜mail.php
 ┣ 📜queue.php
 ┣ 📜sanctum.php
 ┣ 📜services.php
 ┣ 📜session.php
 ┗ 📜view.php
 📦public
 ┣ 📜.htaccess
 ┣ 📜favicon.ico
 ┣ 📜index.php
 ┗ 📜robots.txt
 📦resources
 ┣ 📂css
 ┃ ┗ 📜app.css
 ┣ 📂js
 ┃ ┣ 📜app.js
 ┃ ┗ 📜bootstrap.js
 ┣ 📂lang
 ┃ ┗ 📂en
 ┃ ┃ ┣ 📜auth.php
 ┃ ┃ ┣ 📜pagination.php
 ┃ ┃ ┣ 📜passwords.php
 ┃ ┃ ┗ 📜validation.php
 ┗ 📂views
 ┃ ┗ 📜welcome.blade.php
 📦resources
 ┣ 📂css
 ┃ ┗ 📜app.css
 ┣ 📂js
 ┃ ┣ 📜app.js
 ┃ ┗ 📜bootstrap.js
 ┣ 📂lang
 ┃ ┗ 📂en
 ┃ ┃ ┣ 📜auth.php
 ┃ ┃ ┣ 📜pagination.php
 ┃ ┃ ┣ 📜passwords.php
 ┃ ┃ ┗ 📜validation.php
 ┗ 📂views
 ┃ ┗ 📜welcome.blade.php
 📦storage
 ┣ 📂app
 ┃ ┣ 📂public
 ┃ ┃ ┗ 📜.gitignore
 ┃ ┗ 📜.gitignore
 ┣ 📂framework
 ┃ ┣ 📂cache
 ┃ ┃ ┣ 📂data
 ┃ ┃ ┃ ┣ 📂c0
 ┃ ┃ ┃ ┃ ┗ 📂71
 ┃ ┃ ┃ ┃ ┃ ┗ 📜c071422490d526a8aada046adf3a9c9fa0593468
 ┃ ┃ ┃ ┣ 📂ec
 ┃ ┃ ┃ ┃ ┗ 📂c4
 ┃ ┃ ┃ ┃ ┃ ┗ 📜ecc49f49f4da6b940dcde13f0571e79c299871e6
 ┃ ┃ ┃ ┗ 📜.gitignore
 ┃ ┃ ┗ 📜.gitignore
 ┃ ┣ 📂sessions
 ┃ ┃ ┣ 📜.gitignore
 ┃ ┃ ┣ 📜dNT3ZZezkb4AIzrJbvHNvb54YO33XeE27rYZ8dGZ
 ┃ ┃ ┗ 📜iyKlJQfMHg0vPoPlHtd1fXMfGVCMJAwN0QoIzSAk
 ┃ ┣ 📂testing
 ┃ ┃ ┗ 📜.gitignore
 ┃ ┣ 📂views
 ┃ ┃ ┣ 📜.gitignore
 ┃ ┃ ┣ 📜55f471d0af5e9e1af78e09a7581bcd4c273c3965.php
 ┃ ┃ ┣ 📜b43bc5779a7c0e40056108f0eb5830e4e26f71a9.php
 ┃ ┃ ┣ 📜dfcb1af85360d338916563637895c0b1df7eb445.php
 ┃ ┃ ┗ 📜e64fa4a2dee243afc2773e813dd24fa666fc3fc0.php
 ┃ ┗ 📜.gitignore
 ┗ 📂logs
 ┃ ┣ 📜.gitignore
 ┃ ┗ 📜laravel.log
 📦tests
 ┣ 📂Feature
 ┣ 📂Unit
 ┃ ┣ 📜AddressTest.php
 ┃ ┗ 📜CustomerTest.php
 ┣ 📜CreatesApplication.php
 ┗ 📜TestCase.php
 📦tests
 ┣ 📂Feature
 ┣ 📂Unit
 ┃ ┣ 📜AddressTest.php
 ┃ ┗ 📜CustomerTest.php
 ┣ 📜CreatesApplication.php
 ┗ 📜TestCase.php
 
```
## Instalation
Pindahkan folder laravel_test ke dalam folder : 
```
C:\Xampp\htdocs\
```
Start apache pada XAMPP

Buka postman dan akses dengan url :


```
http://localhost/customer/      *GET
http://localhost/customer/(id)  *GET BY ID
http://localhost/customer/      *POST
http://localhost/customer/(id)  *PATCH
http://localhost/customer/(id)  *DELETE
http://localhost/address/       *GET
http://localhost/address/(id)   *GET BY ID
http://localhost/address/       *POST
http://localhost/address/(id)   *PATCH
http://localhost/address/(id)   *DELETE
```

## Note 
Aplikasi belum bisa dijalankan menggunakan docker container dikarenakan konfigurasi yang belum diselesaikan .
Aplikasi tetap dapat dijalankan menggunakan artisan

## Credit
> Altundri Wahyu Hidayatullah
