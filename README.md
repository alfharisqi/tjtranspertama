<p align="center"><img src="../main/public/images/LogoSonic.png" width="600" alt="Aplikasi Logo"></p>

<br><br>

# Web Developer
| NIM | Nama Anggota | Role |
|-----|-----------|------|
|231402001|[Brisbane Jovan Rivaldi Sihombing](http://instagram.com/banejrs)| Back-end |
|231402046|[Mayadi Alamsyah Putra Silalahi](http://instagram.com/mydisllhi)| Back-end |
|231402070|[Petra Igor Keliat](http://instagram.com/petra_ik)| Front-end |
|231402128|[Paskal Irvaldi Manik](http://instagram.com/paskalmanikk)| Back-end |
|231402134|[Syuja Aqilsyah](http://instagram.com/syujaaql)| Front-end |


<br><br><br><br>


# About Sonic
Aplikasi Web ***Sonic*** merupakan **Aplikasi pemesanan _tiket kereta api_**.
Aplikasi Sonic bertujuan untuk menyajikan proses transaksi pemesanan tiket yang nyaman serta efisien.


<br><br><br><br>


# Fitur dalam Sonic

- <h3>Login Multilevel User</h3>
     Aplikasi ini dapat login multilever user menggunakan 2 role, yaiut customer dan admin.

- <h3>Forgot Password</h3>
     Kami memungkinkan pengguna untuk mendapat email untuk mereset password jika pengguna melupakan password akun.
     
- <h3>Email Verification</h3>
     Email untuk verifikasi akun yang bertujuan untuk autentikasi akan dikirim setelah melakukan registrasi akun

- <h3>Update Profile</h3>
     Pengguna dapat memperbarui data profil.
     
 - <h3>Hapus Akun</h3>
     Admin dapat menghapus akun beserta datanya jika diperlukan.
     
- <h3>Pemesanan Tiket Kereta</h3>
     Pengguna dapat memesan tiket kereta api yang tersedia di aplikasi.
     
- <h3>Saran/Report</h3>
     Pengguna dapat mengirimkan pesan kepada admin berupa saran maupun report berdasarkan pengalaman menggunakan aplikasi.

- <h3>Printing</h3>
     Admin dapat mencetak data users, tiket, kereta api, dan jadwal keberangkatan.
     
     Sedangkan untuk pengguna, dapat mencetak data tiket.
  
- <h3>Pembuatan Jadwal Keberangkatan</h3>
     Admin dapat membuat jadwal Keberangkatan Kereta Api.
     
- <h3>Pagination</h3>

<br><br><br>

# Panduan Menjalankan Source Code

- <h3>Key:Generate</h3>

     Command -> `php artisan key:generate</h2>`
     
- <h3>Jalankan Migrate</h3>

     Command -> `php artisan key:migrate`

- <h3>Modifikasi File Seeder dan Jalankan</h3>
    Dalam File Seeder, Ubah email admin mayadisilalahi@gmailcom menjadi email yang anda miliki.
    
    Command jalankan Seeder -> ` php artisan db:seed --class=DummyUsersSeeder `
