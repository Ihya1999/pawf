"""
============================================================
PENGATURAN (SETTINGS) PROYEK ANIME BLOG
============================================================
File ini adalah pusat konfigurasi Django. Semua pengaturan
database, aplikasi, template, bahasa, dan file statis
diatur di sini.
"""

from pathlib import Path

# BASE_DIR = folder utama proyek. Semua path lain dibangun
# relatif terhadap folder ini, sehingga proyek TETAP JALAN
# meskipun dipindahkan ke laptop lain (portabel).
BASE_DIR = Path(__file__).resolve().parent.parent


# PERINGATAN KEAMANAN: untuk produksi (website online sungguhan),
# ganti SECRET_KEY ini dan simpan di environment variable.
SECRET_KEY = 'django-insecure-yf^8)ew4#82$6*(ogafup^tru9he@b5!xm5y93%6q!2*k7ylv*'

# DEBUG = True hanya untuk pengembangan/belajar.
# Ubah menjadi False saat website di-online-kan.
DEBUG = True

ALLOWED_HOSTS = []


# Daftar aplikasi yang aktif di proyek ini.
INSTALLED_APPS = [
    'django.contrib.admin',          # Halaman admin bawaan Django
    'django.contrib.auth',           # Sistem login/autentikasi
    'django.contrib.contenttypes',
    'django.contrib.sessions',
    'django.contrib.messages',
    'django.contrib.staticfiles',    # Pengelola file CSS/JS/gambar
    'blog',                          # <-- Aplikasi blog anime buatan kita
]

MIDDLEWARE = [
    'django.middleware.security.SecurityMiddleware',
    'django.contrib.sessions.middleware.SessionMiddleware',
    'django.middleware.common.CommonMiddleware',
    'django.middleware.csrf.CsrfViewMiddleware',   # Perlindungan CSRF pada form
    'django.contrib.auth.middleware.AuthenticationMiddleware',
    'django.contrib.messages.middleware.MessageMiddleware',
    'django.middleware.clickjacking.XFrameOptionsMiddleware',
]

ROOT_URLCONF = 'anime_blog.urls'

TEMPLATES = [
    {
        'BACKEND': 'django.template.backends.django.DjangoTemplates',
        # Folder 'templates' di level proyek, agar template global
        # (misal base.html) mudah ditemukan.
        'DIRS': [BASE_DIR / 'templates'],
        'APP_DIRS': True,
        'OPTIONS': {
            'context_processors': [
                'django.template.context_processors.request',
                'django.contrib.auth.context_processors.auth',
                'django.contrib.messages.context_processors.messages',
            ],
        },
    },
]

WSGI_APPLICATION = 'anime_blog.wsgi.application'


# DATABASE: menggunakan SQLite (file db.sqlite3).
# INOVASI PORTABILITAS: SQLite tidak butuh server database terpisah,
# seluruh data tersimpan dalam SATU file sehingga folder proyek ini
# bisa langsung dipindahkan ke laptop lain tanpa konfigurasi tambahan.
DATABASES = {
    'default': {
        'ENGINE': 'django.db.backends.sqlite3',
        'NAME': BASE_DIR / 'db.sqlite3',
    }
}


# Validasi kekuatan password untuk akun admin.
AUTH_PASSWORD_VALIDATORS = [
    {'NAME': 'django.contrib.auth.password_validation.UserAttributeSimilarityValidator'},
    {'NAME': 'django.contrib.auth.password_validation.MinimumLengthValidator'},
    {'NAME': 'django.contrib.auth.password_validation.CommonPasswordValidator'},
    {'NAME': 'django.contrib.auth.password_validation.NumericPasswordValidator'},
]


# INTERNASIONALISASI: bahasa antarmuka diatur ke Bahasa Indonesia
# dan zona waktu ke Asia/Jakarta (WIB), sehingga halaman admin
# dan format tanggal otomatis berbahasa Indonesia.
LANGUAGE_CODE = 'id'
TIME_ZONE = 'Asia/Jakarta'
USE_I18N = True
USE_TZ = True


# FILE STATIS (CSS, JavaScript, gambar tema).
STATIC_URL = 'static/'
# Folder 'static' di level proyek untuk menampung CSS tema anime.
STATICFILES_DIRS = [BASE_DIR / 'static']

# FILE MEDIA (gambar sampul anime yang di-upload lewat admin).
MEDIA_URL = 'media/'
MEDIA_ROOT = BASE_DIR / 'media'

# Tipe primary key default untuk semua model.
DEFAULT_AUTO_FIELD = 'django.db.models.BigAutoField'
