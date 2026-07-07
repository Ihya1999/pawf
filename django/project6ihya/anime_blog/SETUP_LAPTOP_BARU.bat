@echo off
REM ============================================================
REM SKRIP PERSIAPAN DI LAPTOP BARU (klik dua kali file ini)
REM ============================================================
REM Syarat: Python sudah terpasang (python.org, centang "Add to PATH")
echo === [1/3] Memasang Django ===
pip install -r requirements.txt

echo === [2/3] Menyiapkan database ===
python manage.py migrate

echo === [3/4] Mengisi data contoh (aman diulang) ===
python isi_data_contoh.py

echo === [4/4] Memasang gambar sampul anime ===
REM Gambar sudah ikut tersalin di static/img/anime/, jadi langkah ini
REM hanya memasangkannya ke postingan - TIDAK butuh internet.
python ambil_gambar_anime.py

echo.
echo Selesai! Jalankan JALANKAN_SERVER.bat untuk memulai website.
pause
