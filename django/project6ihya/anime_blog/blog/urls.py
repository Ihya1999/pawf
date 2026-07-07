"""
============================================================
PETA URL APLIKASI BLOG
============================================================
Menghubungkan alamat URL dengan fungsi view:
  /                       -> halaman depan
  /post/<slug>/           -> detail artikel (URL cantik pakai slug)
  /kategori/<slug>/       -> daftar artikel per kategori
"""

from django.urls import path

from . import views

# app_name memungkinkan penulisan {% url 'blog:home' %} di template,
# sehingga link tidak rusak walau alamat URL diubah nanti.
app_name = 'blog'

urlpatterns = [
    path('', views.home, name='home'),
    # INOVASI: URL RAMAH-SEO menggunakan slug, contoh:
    # /post/review-frieren-beyond-journeys-end/
    # lebih mudah dibaca & disukai mesin pencari daripada /post/17/
    path('post/<slug:slug>/', views.post_detail, name='post_detail'),
    path('kategori/<slug:slug>/', views.category_posts, name='category'),
]
