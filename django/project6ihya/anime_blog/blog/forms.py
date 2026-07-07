"""
============================================================
FORMULIR (FORMS) BLOG ANIME
============================================================
Form komentar untuk pembaca. Django ModelForm otomatis:
  - membuat input HTML dari field model,
  - memvalidasi data (nama tidak kosong, dll),
  - melindungi dari serangan CSRF (bersama {% csrf_token %}).
"""

from django import forms

from .models import Comment


class CommentForm(forms.ModelForm):
    class Meta:
        model = Comment
        # Hanya nama & isi komentar yang diisi pembaca.
        # Field 'is_approved' sengaja TIDAK dimasukkan agar
        # pengunjung tidak bisa menyetujui komentarnya sendiri.
        fields = ['name', 'body']
        widgets = {
            # Atribut class & placeholder agar tampilan form
            # menyatu dengan tema anime di CSS.
            'name': forms.TextInput(attrs={
                'class': 'form-input',
                'placeholder': 'Nama kamu...',
            }),
            'body': forms.Textarea(attrs={
                'class': 'form-input',
                'rows': 4,
                'placeholder': 'Tulis komentarmu tentang anime ini...',
            }),
        }
