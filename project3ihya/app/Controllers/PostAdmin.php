<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PostModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class PostAdmin extends BaseController
{
    // ================= LIST =================
    public function index()
    {
        $post = new PostModel();

        return view('admin/admin_post_list', [
            'posts' => $post->findAll()
        ]);
    }

    // ================= PREVIEW =================
    public function preview(int $id)
    {
        $post = new PostModel();
        $data['post'] = $post->find($id);

        if (!$data['post']) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('post_detail', $data);
    }

    // ================= CREATE FORM =================
    public function create()
    {
        return view('admin/admin_post_create');
    }

    // ================= STORE =================
    public function store()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'title' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', 'Judul wajib diisi');
        }

        $post = new PostModel();

        $post->insert([
            "title"   => $this->request->getPost('title'),
            "content" => $this->request->getPost('content'),
            "status"  => $this->request->getPost('status'),
            "slug"    => url_title($this->request->getPost('title'), '-', true),
            "author"  => session()->get('nama') ?? 'Admin'
        ]);

        return redirect()->to('admin/post')->with('success', 'Post berhasil dibuat!');
    }

    // ================= EDIT =================
    public function edit(int $id)
    {
        $post = new PostModel();
        $data['post'] = $post->find($id);

        if (!$data['post']) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('admin/admin_post_update', $data);
    }

    // ================= UPDATE =================
    public function update(int $id)
    {
        $post = new PostModel();

        $post->update($id, [
            "title"   => $this->request->getPost('title'),
            "content" => $this->request->getPost('content'),
            "status"  => $this->request->getPost('status')
        ]);

        return redirect()->to('admin/post')->with('success', 'Post berhasil diperbarui!');
    }

    // ================= DELETE =================
    public function delete(int $id)
    {
        $post = new PostModel();

        if (!$post->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        $post->delete($id);

        return redirect()->to('admin/post')->with('success', 'Post berhasil dihapus!');
    }

    // ================= UPLOAD IMAGE (SUMMERNOTE) =================
    public function uploadImage()
    {
        $file = $this->request->getFile('file');

        if ($file && $file->isValid() && !$file->hasMoved()) {

            // rename file biar aman
            $newName = $file->getRandomName();

            // simpan ke public/uploads
            $file->move('uploads', $newName);

            // return URL gambar
            return $this->response->setBody(
                base_url('uploads/' . $newName)
            );
        }

        return $this->response->setStatusCode(400, 'Upload gagal');
    }
}