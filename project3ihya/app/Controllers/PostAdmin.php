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
        $postModel = new PostModel();
        $data['posts'] = $postModel->findAll();

        return view('admin/admin_post_list', $data);
    }

    // ================= PREVIEW =================
    public function preview($id)
    {
        $postModel = new PostModel();
        $data['post'] = $postModel->find($id);

        if (!$data['post']) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('post_detail', $data);
    }

    // ================= CREATE =================
    public function create()
    {
        if ($this->request->getMethod() === 'post') {

            $postModel = new PostModel();

            $postModel->insert([
                "title"   => $this->request->getPost('title'),
                "content" => $this->request->getPost('content'),
                "status"  => $this->request->getPost('status'),
                "slug"    => url_title($this->request->getPost('title'), '-', true)
            ]);

            return redirect()->to('/admin/post');
        }

        return view('admin/admin_post_create');
    }

    // ================= EDIT =================
    public function edit($id)
    {
        $postModel = new PostModel();

        $data['post'] = $postModel->find($id);

        // ❗ kalau data tidak ada
        if (!$data['post']) {
            throw PageNotFoundException::forPageNotFound();
        }

        // kalau submit
        if ($this->request->getMethod() === 'post') {

            $postModel->update($id, [
                "title"   => $this->request->getPost('title'),
                "content" => $this->request->getPost('content'),
                "status"  => $this->request->getPost('status')
            ]);

            return redirect()->to('/admin/post');
        }

        return view('admin/admin_post_update', $data);
    }

    // ================= DELETE =================
    public function delete($id)
    {
        $postModel = new PostModel();
        $postModel->delete($id);

        return redirect()->to('/admin/post');
    }
}
