# アニBlog — Website Blog Anime dengan Django

Website blog anime berbahasa Indonesia dengan tema gelap neon khas anime.
Seluruh kode diberi **komentar penjelasan berbahasa Indonesia**.

## Fitur & Inovasi

| Fitur | Penjelasan | Lokasi Kode |
|---|---|---|
| Sistem rating anime (0–10) | Badge skor ala MyAnimeList di setiap kartu review | `blog/models.py` (field `rating`) |
| Penghitung jumlah dilihat | +1 tiap artikel dibuka, aman dari race-condition (pakai `F()`) | `blog/views.py` (`post_detail`) |
| Widget "Terpopuler" | 5 artikel paling banyak dilihat, otomatis berubah | `blog/views.py` (`_sidebar_context`) |
| Estimasi waktu baca | "5 menit baca" dihitung dari jumlah kata | `blog/models.py` (`reading_time`) |
| Pencarian artikel | Cari di judul & isi sekaligus (objek `Q`) | `blog/views.py` (`home`) |
| Artikel terkait | Rekomendasi 3 post dari kategori yang sama | `blog/views.py` (`post_detail`) |
| Komentar + moderasi | Pembaca komentar tanpa login; tampil setelah disetujui admin | `blog/models.py` (`Comment`), `blog/admin.py` |
| Slug & ringkasan otomatis | URL cantik dan ringkasan dibuat otomatis dari judul/isi | `blog/models.py` (metode `save`) |
| Gambar poster otomatis | Poster asli tiap anime diunduh dari API Jikan (MyAnimeList) lalu disimpan lokal agar portabel & bisa offline | `ambil_gambar_anime.py` |
| Paginasi | Maksimal 6 artikel per halaman | `blog/views.py` |
| Tema anime responsif | Dark mode neon, CSS variables, tampil rapi di HP | `static/css/style.css` |

## Cara Menjalankan (laptop ini)

```
cd anime_blog
python manage.py runserver
```

Lalu buka browser:
- Website : http://127.0.0.1:8000
- Admin   : http://127.0.0.1:8000/admin

**Akun admin bawaan:** username `admin`, password `animeblog123`
(ganti password ini lewat halaman admin jika website akan dipakai sungguhan).

## Cara Memindahkan ke Laptop Lain

1. **Salin seluruh folder `anime_blog`** ke laptop tujuan (flashdisk / Google Drive / zip).
   File database `db.sqlite3` ikut tersalin, jadi semua artikel & akun admin tetap ada.
2. Pastikan **Python 3.10+** terpasang di laptop tujuan
   (unduh dari python.org, centang *"Add Python to PATH"* saat instalasi).
3. Klik dua kali **`SETUP_LAPTOP_BARU.bat`** (memasang Django & menyiapkan database).
4. Klik dua kali **`JALANKAN_SERVER.bat`** lalu buka http://127.0.0.1:8000

Atau lewat terminal secara manual:

```
pip install -r requirements.txt
python manage.py migrate
python manage.py runserver
```

## Struktur Folder

```
anime_blog/
├── manage.py               # Pintu masuk perintah Django
├── db.sqlite3              # Database (SATU file — mudah dipindah)
├── requirements.txt        # Daftar library yang dibutuhkan
├── isi_data_contoh.py      # Skrip pengisi artikel & akun admin contoh
├── ambil_gambar_anime.py   # Pengunduh poster anime (API Jikan/MyAnimeList)
├── SETUP_LAPTOP_BARU.bat   # Persiapan otomatis di laptop baru
├── JALANKAN_SERVER.bat     # Menjalankan website dengan sekali klik
├── anime_blog/             # Konfigurasi proyek (settings, urls)
├── blog/                   # Aplikasi blog (models, views, forms, admin)
├── templates/              # Halaman HTML (base, home, detail, kategori)
├── static/css/style.css    # Tema anime modern "Aurora Glass"
└── static/img/anime/       # Gambar poster anime (tersimpan lokal)
```

## Mengelola Konten

Masuk ke http://127.0.0.1:8000/admin untuk:
- Menulis/mengedit postingan (slug terisi otomatis dari judul)
- Menambah kategori/genre anime
- **Moderasi komentar**: pilih komentar → aksi *"Setujui komentar terpilih"*
