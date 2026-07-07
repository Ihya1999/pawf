"""
============================================================
SKRIP PENGUNDUH GAMBAR SAMPUL ANIME
============================================================
INOVASI: gambar poster diambil OTOMATIS dari API publik Jikan
(https://jikan.moe — API resmi tidak berbayar untuk data
MyAnimeList), lalu DISIMPAN LOKAL di static/img/anime/.

Keuntungan disimpan lokal (bukan sekadar hotlink):
  1. Gambar ikut terbawa saat folder dipindah ke laptop lain.
  2. Tetap tampil walau tanpa koneksi internet.
  3. Tidak bergantung pada server luar yang bisa mati/memblokir.

Cara menjalankan (butuh internet, cukup sekali):
    python ambil_gambar_anime.py

Aman dijalankan ulang — gambar yang sudah ada tidak diunduh lagi.
"""

import json
import os
import sys
import time
import urllib.parse
import urllib.request
from pathlib import Path

import django

# Konsol Windows lama memakai encoding cp1252 yang tidak mengenal
# karakter unik pada judul anime (contoh: "Yuru Camp△").
# Baris ini membuat output selalu UTF-8 agar skrip tidak error.
sys.stdout.reconfigure(encoding='utf-8', errors='replace')

os.environ.setdefault('DJANGO_SETTINGS_MODULE', 'anime_blog.settings')
django.setup()

from blog.models import Post  # noqa: E402

# Folder tujuan penyimpanan gambar (dibuat otomatis jika belum ada).
FOLDER_GAMBAR = Path(__file__).resolve().parent / 'static' / 'img' / 'anime'
FOLDER_GAMBAR.mkdir(parents=True, exist_ok=True)

# Pemetaan: potongan judul POST di blog -> kata kunci pencarian anime.
# Jika kamu menambah artikel baru, cukup tambahkan barisnya di sini
# lalu jalankan ulang skrip ini.
PETA_ANIME = {
    'Frieren':          {'cari': 'Sousou no Frieren',            'file': 'frieren.jpg'},
    'Isekai Terbaik':   {'cari': 'Re:Zero kara Hajimeru',        'file': 'isekai.jpg'},
    'Jujutsu Kaisen':   {'cari': 'Jujutsu Kaisen 2nd Season',    'file': 'jujutsu-kaisen.jpg'},
    'Slice of Life':    {'cari': 'Yuru Camp',                    'file': 'slice-of-life.jpg'},
    'Ghibli':           {'cari': 'Tonari no Totoro',             'file': 'ghibli.jpg'},
    # 'tipe': 'tv' memastikan yang diambil poster SERIAL TV,
    # bukan film layar lebar dengan judul mirip.
    'One Piece':        {'cari': 'One Piece', 'tipe': 'tv',      'file': 'one-piece.jpg'},
}

# Header User-Agent agar permintaan tidak ditolak server.
HEADERS = {'User-Agent': 'AniBlog/1.0 (blog pribadi; edukasi)'}


def cari_url_poster(kata_kunci, tipe=None):
    """Tanya API Jikan: 'anime ini posternya apa?' -> URL gambar."""
    url = (
        'https://api.jikan.moe/v4/anime?limit=1&q='
        + urllib.parse.quote(kata_kunci)
    )
    # Filter tipe (tv/movie/ova) agar hasil pencarian lebih akurat.
    if tipe:
        url += f'&type={tipe}'
    req = urllib.request.Request(url, headers=HEADERS)
    with urllib.request.urlopen(req, timeout=20) as resp:
        data = json.load(resp)
    hasil = data.get('data') or []
    if not hasil:
        return None, None
    anime = hasil[0]
    # 'large_image_url' = poster resolusi besar dari MyAnimeList.
    return anime['images']['jpg']['large_image_url'], anime.get('title')


def unduh(url_gambar, path_tujuan):
    """Unduh file gambar ke folder lokal."""
    req = urllib.request.Request(url_gambar, headers=HEADERS)
    with urllib.request.urlopen(req, timeout=30) as resp:
        path_tujuan.write_bytes(resp.read())


def utama():
    print('=== Mengunduh gambar sampul anime ===')
    for potongan_judul, info in PETA_ANIME.items():
        path_file = FOLDER_GAMBAR / info['file']
        path_web = f"/static/img/anime/{info['file']}"

        # Lewati unduhan jika file sudah ada (hemat kuota & waktu).
        if not path_file.exists():
            url_poster, judul_asli = cari_url_poster(info['cari'], info.get('tipe'))
            if not url_poster:
                print(f'[!!] Poster tidak ditemukan untuk: {info["cari"]}')
                continue
            unduh(url_poster, path_file)
            print(f'[OK] Unduh "{judul_asli}" -> {info["file"]}')
            # Jeda sopan: API Jikan membatasi ~3 permintaan/detik.
            time.sleep(1)
        else:
            print(f'[--] {info["file"]} sudah ada, unduhan dilewati.')

        # Pasangkan gambar ke postingan yang judulnya cocok.
        jumlah = Post.objects.filter(
            title__icontains=potongan_judul
        ).update(cover_url=path_web)
        print(f'     -> dipasang ke {jumlah} postingan (kata kunci: "{potongan_judul}")')

    print('=== Selesai! Muat ulang halaman untuk melihat gambar. ===')


if __name__ == '__main__':
    utama()
