"""
============================================================
VIEWS (LOGIKA HALAMAN) BLOG ANIME
============================================================
Setiap fungsi di sini menangani satu jenis halaman:
  - home         : halaman depan (daftar postingan + pencarian)
  - post_detail  : halaman baca artikel + komentar
  - category_posts : daftar postingan per kategori/genre
"""

from django.contrib import messages
from django.core.paginator import Paginator
from django.db.models import F, Q
from django.shortcuts import get_object_or_404, redirect, render

from .forms import CommentForm
from .models import Category, Post


def _sidebar_context():
    """
    Data yang dibutuhkan sidebar di semua halaman:
    daftar kategori dan 5 postingan terpopuler.
    Dibuat sebagai fungsi terpisah agar tidak menulis
    kode yang sama berulang-ulang (prinsip DRY).
    """
    return {
        'categories': Category.objects.all(),
        # INOVASI: WIDGET "TERPOPULER" — diurutkan berdasarkan
        # jumlah dilihat (views) yang dihitung otomatis.
        'popular_posts': Post.objects.filter(is_published=True).order_by('-views')[:5],
    }


def home(request):
    """Halaman depan: daftar semua postingan yang sudah terbit."""
    posts = Post.objects.filter(is_published=True)

    # INOVASI: FITUR PENCARIAN
    # Pembaca bisa mencari anime lewat kotak pencarian.
    # Objek Q memungkinkan pencarian di BEBERAPA kolom sekaligus
    # (judul ATAU isi artikel), mirip mesin pencari sederhana.
    query = request.GET.get('q', '').strip()
    if query:
        posts = posts.filter(
            Q(title__icontains=query) | Q(content__icontains=query)
        )

    # INOVASI: PAGINASI (PEMBAGIAN HALAMAN)
    # Menampilkan maksimal 6 postingan per halaman agar
    # halaman depan tetap ringan walau artikel sudah ratusan.
    paginator = Paginator(posts, 6)
    page_obj = paginator.get_page(request.GET.get('page'))

    context = {
        'page_obj': page_obj,
        'query': query,
        **_sidebar_context(),
    }
    return render(request, 'blog/home.html', context)


def post_detail(request, slug):
    """Halaman baca satu artikel lengkap dengan komentarnya."""
    post = get_object_or_404(Post, slug=slug, is_published=True)

    # INOVASI: PENGHITUNG VIEWS ANTI RACE-CONDITION
    # F('views') + 1 membuat penambahan dilakukan LANGSUNG di
    # database, bukan di Python. Jadi jika dua pengunjung membuka
    # halaman bersamaan, hitungannya tetap akurat (tidak saling
    # menimpa nilai lama).
    Post.objects.filter(pk=post.pk).update(views=F('views') + 1)
    post.refresh_from_db(fields=['views'])

    # Proses pengiriman komentar (metode POST = form dikirim).
    if request.method == 'POST':
        form = CommentForm(request.POST)
        if form.is_valid():
            comment = form.save(commit=False)  # Jangan simpan dulu...
            comment.post = post                # ...pasangkan ke post ini
            comment.save()
            # Beri tahu pembaca bahwa komentarnya menunggu moderasi.
            messages.success(
                request,
                'Komentar terkirim! Akan tampil setelah disetujui admin.',
            )
            # Pola "redirect setelah POST" mencegah komentar
            # terkirim dua kali saat halaman di-refresh.
            return redirect(post.get_absolute_url() + '#komentar')
    else:
        form = CommentForm()

    # INOVASI: REKOMENDASI "ARTIKEL TERKAIT"
    # Menampilkan 3 postingan lain dari kategori yang sama,
    # agar pembaca betah menjelajah (seperti rekomendasi YouTube).
    related_posts = (
        Post.objects.filter(is_published=True, category=post.category)
        .exclude(pk=post.pk)[:3]
    )

    context = {
        'post': post,
        'form': form,
        'related_posts': related_posts,
        **_sidebar_context(),
    }
    return render(request, 'blog/post_detail.html', context)


def category_posts(request, slug):
    """Daftar postingan dalam satu kategori/genre anime."""
    category = get_object_or_404(Category, slug=slug)
    posts = category.posts.filter(is_published=True)

    paginator = Paginator(posts, 6)
    page_obj = paginator.get_page(request.GET.get('page'))

    context = {
        'category': category,
        'page_obj': page_obj,
        **_sidebar_context(),
    }
    return render(request, 'blog/category.html', context)
