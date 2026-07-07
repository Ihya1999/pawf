"""
============================================================
PETA URL UTAMA PROYEK
============================================================
  /admin/  -> halaman admin bawaan Django (kelola konten)
  /        -> seluruh halaman blog (diteruskan ke blog/urls.py)
"""

from django.contrib import admin
from django.urls import include, path

urlpatterns = [
    path('admin/', admin.site.urls),
    # include() meneruskan semua URL lain ke aplikasi blog,
    # sehingga peta URL blog terpisah rapi di file sendiri.
    path('', include('blog.urls')),
]
