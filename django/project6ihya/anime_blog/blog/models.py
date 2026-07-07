"""
============================================================
MODEL DATABASE UNTUK BLOG ANIME
============================================================
File ini mendefinisikan struktur tabel database.
Ada 3 model utama:
  1. Category  -> kategori/genre anime (Action, Romance, dll)
  2. Post      -> artikel/postingan blog tentang anime
  3. Comment   -> komentar pembaca pada setiap postingan
"""

import math

from django.db import models
from django.urls import reverse
from django.utils.text import slugify


class Category(models.Model):
    """Kategori/genre anime, misalnya: Shonen, Isekai, Slice of Life."""

    name = models.CharField('Nama Kategori', max_length=100, unique=True)
    slug = models.SlugField(max_length=120, unique=True, blank=True)

    class Meta:
        verbose_name = 'Kategori'
        verbose_name_plural = 'Kategori'
        ordering = ['name']

    def save(self, *args, **kwargs):
        # INOVASI: SLUG OTOMATIS
        # Slug adalah versi URL dari nama, misal "Slice of Life"
        # otomatis menjadi "slice-of-life". Admin tidak perlu
        # mengetiknya manual — dibuat otomatis saat disimpan.
        if not self.slug:
            self.slug = slugify(self.name)
        super().save(*args, **kwargs)

    def __str__(self):
        return self.name


class Post(models.Model):
    """Postingan blog: review, berita, atau rekomendasi anime."""

    title = models.CharField('Judul', max_length=200)
    slug = models.SlugField(max_length=220, unique=True, blank=True)
    category = models.ForeignKey(
        Category,
        verbose_name='Kategori',
        on_delete=models.SET_NULL,   # Jika kategori dihapus, post tidak ikut terhapus
        null=True,
        related_name='posts',
    )
    author = models.CharField('Penulis', max_length=100, default='Admin')
    # INOVASI: GAMBAR SAMPUL FLEKSIBEL
    # Bisa diisi link internet (https://...) ATAU path gambar lokal
    # di dalam folder proyek (/static/img/anime/...). Gambar lokal
    # ikut terbawa saat folder dipindahkan ke laptop lain dan tetap
    # tampil walau tanpa koneksi internet.
    cover_url = models.CharField(
        'Gambar Sampul',
        max_length=300,
        blank=True,
        help_text='Link internet (https://...) atau path lokal (/static/img/anime/nama.jpg).',
    )
    excerpt = models.TextField(
        'Ringkasan',
        max_length=300,
        blank=True,
        help_text='Ringkasan singkat yang tampil di halaman depan.',
    )
    content = models.TextField('Isi Artikel')

    # INOVASI: SISTEM RATING ANIME
    # Setiap review anime bisa diberi skor 0.0 - 10.0 seperti
    # di MyAnimeList, lalu ditampilkan sebagai badge bintang.
    rating = models.DecimalField(
        'Rating Anime (0-10)',
        max_digits=3,
        decimal_places=1,
        null=True,
        blank=True,
        help_text='Skor anime versi penulis, contoh: 8.7',
    )

    # INOVASI: PENGHITUNG JUMLAH DILIHAT (VIEW COUNTER)
    # Bertambah +1 setiap kali halaman detail dibuka,
    # dipakai untuk menampilkan "Postingan Terpopuler".
    views = models.PositiveIntegerField('Jumlah Dilihat', default=0)

    is_published = models.BooleanField(
        'Terbitkan?',
        default=True,
        help_text='Hilangkan centang untuk menyimpan sebagai draf.',
    )
    created_at = models.DateTimeField('Dibuat', auto_now_add=True)
    updated_at = models.DateTimeField('Diperbarui', auto_now=True)

    class Meta:
        verbose_name = 'Postingan'
        verbose_name_plural = 'Postingan'
        ordering = ['-created_at']   # Postingan terbaru tampil paling atas

    def save(self, *args, **kwargs):
        # Slug otomatis dari judul (sama seperti pada Category).
        if not self.slug:
            self.slug = slugify(self.title)
        # Jika ringkasan kosong, otomatis ambil 40 kata pertama
        # dari isi artikel — penulis tidak wajib mengisinya.
        if not self.excerpt:
            words = self.content.split()
            self.excerpt = ' '.join(words[:40]) + ('...' if len(words) > 40 else '')
        super().save(*args, **kwargs)

    def get_absolute_url(self):
        # URL kanonik postingan, dipakai template & tombol
        # "LIHAT DI SITUS" di halaman admin.
        return reverse('blog:post_detail', kwargs={'slug': self.slug})

    @property
    def reading_time(self):
        """
        INOVASI: ESTIMASI WAKTU BACA
        Menghitung perkiraan lama membaca artikel berdasarkan
        jumlah kata (rata-rata orang membaca ~200 kata/menit).
        Ditampilkan sebagai "5 menit baca" seperti di Medium.
        """
        total_kata = len(self.content.split())
        menit = max(1, math.ceil(total_kata / 200))
        return menit

    @property
    def approved_comments(self):
        """Hanya komentar yang sudah disetujui admin yang tampil."""
        return self.comments.filter(is_approved=True)

    def __str__(self):
        return self.title


class Comment(models.Model):
    """
    Komentar pembaca. Pembaca TIDAK perlu membuat akun/login —
    cukup isi nama dan komentarnya (ramah untuk pengunjung baru).
    """

    post = models.ForeignKey(
        Post,
        on_delete=models.CASCADE,    # Komentar ikut terhapus jika post dihapus
        related_name='comments',
    )
    name = models.CharField('Nama', max_length=100)
    body = models.TextField('Komentar')

    # INOVASI: MODERASI KOMENTAR
    # Komentar baru berstatus "belum disetujui" (is_approved=False)
    # dan baru tampil di website setelah admin menyetujuinya.
    # Ini mencegah spam/komentar kasar muncul secara otomatis.
    is_approved = models.BooleanField('Disetujui?', default=False)
    created_at = models.DateTimeField('Dikirim', auto_now_add=True)

    class Meta:
        verbose_name = 'Komentar'
        verbose_name_plural = 'Komentar'
        ordering = ['created_at']

    def __str__(self):
        return f'Komentar dari {self.name} di "{self.post.title}"'
