"""
============================================================
SKRIP PENGISI DATA CONTOH (SEED DATA)
============================================================
INOVASI: agar website tidak kosong saat pertama dibuka,
jalankan skrip ini SATU KALI untuk mengisi:
  - Akun admin (username: admin, password: animeblog123)
  - 4 kategori anime
  - 6 postingan contoh lengkap dengan rating

Cara menjalankan (dari dalam folder anime_blog):
    python isi_data_contoh.py

Skrip ini AMAN dijalankan berulang — data yang sudah ada
tidak akan diduplikasi (memakai get_or_create).
"""

import os

import django

# Dua baris ini wajib ada agar skrip Python biasa bisa
# mengakses model Django di luar perintah manage.py.
os.environ.setdefault('DJANGO_SETTINGS_MODULE', 'anime_blog.settings')
django.setup()

from django.contrib.auth.models import User  # noqa: E402

from blog.models import Category, Post  # noqa: E402


def buat_admin():
    """Buat akun admin default jika belum ada."""
    if not User.objects.filter(username='admin').exists():
        User.objects.create_superuser('admin', 'admin@aniblog.local', 'animeblog123')
        print('[OK] Akun admin dibuat  ->  username: admin | password: animeblog123')
    else:
        print('[--] Akun admin sudah ada, dilewati.')


def buat_kategori():
    """Buat kategori/genre anime dasar."""
    nama_kategori = ['Shonen', 'Isekai', 'Slice of Life', 'Berita Anime']
    hasil = {}
    for nama in nama_kategori:
        kategori, dibuat = Category.objects.get_or_create(name=nama)
        hasil[nama] = kategori
        print(f'[{"OK" if dibuat else "--"}] Kategori: {nama}')
    return hasil


def buat_postingan(kategori):
    """Isi 6 postingan contoh tentang anime."""
    data_post = [
        {
            'title': 'Review Frieren: Beyond Journey\'s End — Petualangan Setelah Tamat',
            'category': kategori['Slice of Life'],
            'rating': '9.2',
            'content': (
                'Frieren: Beyond Journey\'s End (Sousou no Frieren) adalah anime yang '
                'memulai ceritanya justru ketika petualangan besar sudah selesai. '
                'Frieren, seorang elf penyihir yang hidup lebih dari seribu tahun, '
                'harus belajar memahami arti waktu dan kehilangan setelah rekan '
                'seperjalanannya wafat satu per satu.\n\n'
                'Kekuatan utama anime ini ada pada penulisan karakternya yang tenang '
                'namun menyentuh. Setiap episode terasa seperti perjalanan reflektif '
                'tentang kenangan, penyesalan, dan hubungan antar manusia.\n\n'
                'Animasi dari studio Madhouse tampil memukau, terutama pada adegan '
                'pertarungan sihir yang detail. Musik latar karya Evan Call juga '
                'memperkuat suasana melankolis yang menjadi ciri khas serial ini.\n\n'
                'Kesimpulan: wajib ditonton bagi siapa pun yang mencari anime fantasi '
                'dengan kedalaman emosi, bukan sekadar aksi.'
            ),
        },
        {
            'title': 'Rekomendasi 5 Anime Isekai Terbaik untuk Pemula',
            'category': kategori['Isekai'],
            'rating': None,
            'content': (
                'Genre isekai (dunia lain) adalah salah satu genre paling populer '
                'satu dekade terakhir. Bagi kamu yang baru mulai menonton anime, '
                'berikut lima judul isekai yang paling ramah untuk pemula.\n\n'
                '1. Re:Zero — kisah Subaru yang bisa mengulang waktu setiap kali mati, '
                'penuh misteri dan drama psikologis.\n\n'
                '2. Mushoku Tensei — reinkarnasi dengan pembangunan dunia (world '
                'building) paling rapi di genrenya.\n\n'
                '3. Konosuba — parodi isekai yang mengocok perut, cocok jika kamu '
                'ingin tertawa.\n\n'
                '4. The Rising of the Shield Hero — perjuangan pahlawan perisai yang '
                'difitnah dan bangkit dari titik terendah.\n\n'
                '5. That Time I Got Reincarnated as a Slime — santai, seru, dan penuh '
                'strategi membangun kerajaan monster.\n\n'
                'Mulailah dari judul yang genrenya paling dekat dengan seleramu!'
            ),
        },
        {
            'title': 'Review Jujutsu Kaisen Season 2: Puncak Animasi MAPPA',
            'category': kategori['Shonen'],
            'rating': '8.9',
            'content': (
                'Jujutsu Kaisen musim kedua membawa dua arc sekaligus: Hidden '
                'Inventory yang mengisahkan masa muda Gojo dan Geto, serta Shibuya '
                'Incident yang menjadi salah satu arc paling gelap dalam shonen '
                'modern.\n\n'
                'Studio MAPPA menampilkan kualitas animasi pertarungan yang luar '
                'biasa — koreografi cepat, sudut kamera dinamis, dan efek sihir '
                'kutukan yang memanjakan mata.\n\n'
                'Dari sisi cerita, Shibuya Incident berani mengambil risiko besar '
                'dengan mengorbankan karakter-karakter penting. Dampak emosionalnya '
                'terasa hingga episode terakhir.\n\n'
                'Skor 8.9/10: sedikit catatan hanya pada pacing di pertengahan musim '
                'yang terasa padat, namun secara keseluruhan ini tontonan wajib.'
            ),
        },
        {
            'title': 'Mengenal Genre Slice of Life: Kenapa Anime "Santai" Justru Bikin Nagih?',
            'category': kategori['Slice of Life'],
            'rating': None,
            'content': (
                'Slice of life sering dianggap genre yang "tidak terjadi apa-apa", '
                'padahal justru di situlah kekuatannya. Genre ini memotret kehidupan '
                'sehari-hari dengan jujur: persahabatan, sekolah, pekerjaan, hingga '
                'kesepian.\n\n'
                'Anime seperti K-On!, Barakamon, dan Laid-Back Camp membuktikan bahwa '
                'cerita sederhana bisa memberi kehangatan yang tidak ditemukan di '
                'genre aksi.\n\n'
                'Secara psikologis, slice of life berfungsi seperti "comfort food" — '
                'tontonan yang menenangkan setelah hari yang melelahkan. Ritmenya '
                'lambat, konfliknya kecil, tetapi karakternya terasa seperti teman '
                'sendiri.\n\n'
                'Jika kamu belum pernah mencoba genre ini, mulailah dari Laid-Back '
                'Camp dan rasakan sendiri ketenangannya.'
            ),
        },
        {
            'title': 'Berita: Studio Ghibli Umumkan Proyek Film Baru',
            'category': kategori['Berita Anime'],
            'rating': None,
            'content': (
                'Studio Ghibli kembali menjadi sorotan setelah mengumumkan proyek '
                'film terbarunya. Meskipun detail cerita masih dirahasiakan, pihak '
                'studio menyebut film ini akan melanjutkan tradisi animasi tangan '
                '(hand-drawn) yang menjadi identitas mereka.\n\n'
                'Penggemar berspekulasi bahwa proyek ini melibatkan generasi baru '
                'sutradara yang dibina langsung oleh studio. Ini menjadi sinyal '
                'positif bagi masa depan Ghibli pasca era Hayao Miyazaki.\n\n'
                'Perkembangan selanjutnya akan kami perbarui di blog ini. Pantau '
                'terus kategori Berita Anime!'
            ),
        },
        {
            'title': 'One Piece: Alasan Anime Sepanjang 1000+ Episode Masih Layak Diikuti',
            'category': kategori['Shonen'],
            'rating': '9.0',
            'content': (
                'Dengan lebih dari seribu episode, One Piece sering membuat calon '
                'penonton mundur sebelum mulai. Padahal, ada alasan kuat mengapa '
                'serial ini tetap dicintai selama lebih dari dua dekade.\n\n'
                'Pertama, pembangunan dunianya luar biasa konsisten — pulau, budaya, '
                'dan sejarah dunia One Piece saling terhubung rapi.\n\n'
                'Kedua, Eiichiro Oda mahir menanam misteri jangka panjang. Petunjuk '
                'yang muncul di episode awal bisa terjawab ratusan episode kemudian, '
                'memberi kepuasan luar biasa bagi penonton setia.\n\n'
                'Ketiga, tema persahabatan dan kebebasan yang diusungnya bersifat '
                'universal. Untuk pemula, tersedia panduan menonton yang melewati '
                'episode filler agar perjalanan lebih efisien.\n\n'
                'Kesimpulannya: tidak ada kata terlambat untuk berlayar bersama '
                'kru Topi Jerami.'
            ),
        },
    ]

    for data in data_post:
        post, dibuat = Post.objects.get_or_create(
            title=data['title'],
            defaults={
                'category': data['category'],
                'rating': data['rating'],
                'content': data['content'],
                'author': 'Admin AniBlog',
            },
        )
        print(f'[{"OK" if dibuat else "--"}] Post: {post.title[:50]}...')


if __name__ == '__main__':
    print('=== Mengisi data contoh AniBlog ===')
    buat_admin()
    buat_kategori_hasil = buat_kategori()
    buat_postingan(buat_kategori_hasil)
    print('=== Selesai! Jalankan: python manage.py runserver ===')
