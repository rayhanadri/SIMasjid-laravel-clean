---


---

<h1 id="sistem-informasi-masjid-ibnu-sina-clean-laravel-source-code">Sistem Informasi Masjid Ibnu Sina (Clean Laravel Source Code)</h1>
<p><img src="http://simasjid.my.id/public/dist/assets/img/ibnusina.jpg" alt=""></p>
<h1 id="live-demo">Live Demo</h1>
<p>Kunjungi link berikut untuk live demo.</p>
<blockquote>
<p><a href="http://clean.simasjid.my.id">http://clean.simasjid.my.id</a></p>
</blockquote>
<p>| username: ketua<br>
| password: password</p>
<h1 id="modul---fitur-tersedia">Modul &amp;  Fitur Tersedia</h1>
<ul>
<li class="task-list-item"><input type="checkbox" class="task-list-item-checkbox" checked="true" disabled=""> Full Autentikasi (Login, Logout, Register, dan Reset Password)</li>
<li class="task-list-item"><input type="checkbox" class="task-list-item-checkbox" checked="true" disabled=""> Manajemen Keanggotaan</li>
<li class="task-list-item"><input type="checkbox" class="task-list-item-checkbox" checked="true" disabled=""> Update Profile</li>
<li class="task-list-item"><input type="checkbox" class="task-list-item-checkbox" checked="true" disabled=""> Pengaturan Akun</li>
</ul>
<h1 id="instalasi">Instalasi</h1>
<h2 id="import-database">Import Database</h2>
<ol>
<li>Buat New Database di phpmyadmin dengan nama: <code>simasjid</code></li>
<li>Pilih menu import dan pilih file <code>simasjid-clean-min.sql</code> yang terdapat di folder utama.</li>
</ol>
<h2 id="install-composer">Install Composer</h2>
<ol>
<li>Masuk direktori project laravel<br>
<code>cd SIMasjid-laravel-clean</code></li>
<li>Install composer di folder laravel<br>
<code>composer install</code></li>
<li>Copy .env.example dan rename ke .env<br>
<code>cp .env.example .env</code></li>
<li>Generate application key<br>
<code>php artisan key:generate</code></li>
</ol>
<h2 id="replace-authenticateusers.php">Replace AuthenticateUsers.php</h2>
<ol>
<li>Copy dan replace file <code>AuthenticateUsers.php</code> dari direktori utama <code>SIMasjid-laravel-clean</code> ke  <code>SIMasjid-laravel-clean/vendor/laravel/framework/src/Illuminate/Foundation/Auth/AuthenticateUsers.php</code></li>
</ol>
<h2 id="setting-environment">Setting Environment</h2>
<ol>
<li>Buka file <code>.env</code> di direktori project laravel</li>
<li>Ubah line 12-14 sesuaikan dengan database mysql</li>
</ol>
<blockquote>
<p>DB_DATABASE=simasjid<br>
DB_USERNAME=root<br>
DB_PASSWORD=</p>
</blockquote>
<h2 id="setting-reset-password">Setting Reset Password</h2>
<ol>
<li>Buka file .env di direktori project laravel</li>
<li>Ubah line bagian mail driver sesuai dengan setting email SMTP</li>
<ol>
<blockquote>
MAIL_DRIVER=smtp<br>
MAIL_HOST=nama.host.com<br>
MAIL_PORT=465<br>
MAIL_USERNAME=alama_email@host.com<br>
MAIL_PASSWORD=password_email<br>
MAIL_ENCRYPTION=ssl<br>
</blockquote>
<h1 id="errors">Errors</h1>
<h2 id="gambar-tidak-ter-load-error-filemtime-error-navbar-profile-picture">Gambar tidak ter-load, error filemtime, error navbar profile picture</h2>
<ol>
<li>Delete folder storage di<br>
<code>SIMasjid-laravel-clean/public/storage</code></li>
<li>buat symbolic link dengan command di cmd/git bash/terminal<br>
<code>php artisan storage:link</code></li>
</ol>
<h2 id="page-expired">419 Page Expired, file tidak terupdate, route tidak terupdate</h2>
<ol>
<li>Refresh page <code>Ctrl+F5</code></li>
<li>Jika masih terjadi refresh cache laravel</li>
</ol>
<blockquote>
<p>php artisan cache:clear<br>
php artisan route:clear<br>
php artisan config:clear<br>
php artisan view:clear</p>
</blockquote>
<h2 id="error-lainnya">Error Lainnya</h2>
<p>Jika menemui error yang sulit diatasi, silakan lakukan hard reset git ke HEAD.</p>
<blockquote>
<p>git reset --hard HEAD</p>
</blockquote>

///////
