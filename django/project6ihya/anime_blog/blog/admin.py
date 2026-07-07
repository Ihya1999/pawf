"""
============================================================
KONFIGURASI HALAMAN ADMIN
============================================================
Django menyediakan halaman admin GRATIS di /admin/ untuk
mengelola postingan, kategori, dan komentar tanpa perlu
membuat halaman CRUD sendiri. File ini mengatur tampilannya.
"""

from django.contrib import admin

from .models import Category, Comment, Post


@admin.register(Category)
class CategoryAdmin(admin.ModelAdmin):
    list_display = ('name', 'slug')
    # Slug terisi otomatis saat mengetik nama (langsung di form admin).
    prepopulated_fields = {'slug': ('name',)}


@admin.register(Post)
class PostAdmin(admin.ModelAdmin):
    # Kolom yang tampil di tabel daftar postingan.
    list_display = ('title', 'category', 'rating', 'views', 'is_published', 'created_at')
    # INOVASI: filter & pencarian di admin — memudahkan mengelola
    # ratusan artikel: saring per kategori/status, cari per judul.
    list_filter = ('is_published', 'category')
    search_fields = ('title', 'content')
    prepopulated_fields = {'slug': ('title',)}
    # Status terbit bisa diubah langsung dari tabel tanpa membuka form.
    list_editable = ('is_published',)
    date_hierarchy = 'created_at'


@admin.register(Comment)
class CommentAdmin(admin.ModelAdmin):
    list_display = ('name', 'post', 'is_approved', 'created_at')
    list_filter = ('is_approved',)
    search_fields = ('name', 'body')

    # INOVASI: AKSI MASSAL MODERASI KOMENTAR
    # Admin bisa memilih banyak komentar sekaligus lalu
    # menyetujui/menyembunyikan semuanya dengan satu klik.
    actions = ['approve_comments', 'hide_comments']

    @admin.action(description='Setujui komentar terpilih')
    def approve_comments(self, request, queryset):
        queryset.update(is_approved=True)

    @admin.action(description='Sembunyikan komentar terpilih')
    def hide_comments(self, request, queryset):
        queryset.update(is_approved=False)


# Ubah judul halaman admin agar sesuai tema blog.
admin.site.site_header = 'Admin Blog Anime'
admin.site.site_title = 'Blog Anime'
admin.site.index_title = 'Kelola Konten Blog Anime'
