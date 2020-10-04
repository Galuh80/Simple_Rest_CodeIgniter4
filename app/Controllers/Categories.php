<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Categories extends ResourceController
{
    protected $format = 'JSON';
    protected $modelName = 'App\Models\Category_model';

    public function index()
    {
        return $this->respond($this->model->findAll(), 200);
    }

    public function create()
    {
        $validation = \Config\Services::validation();

        $name = $this->request->getPost('category_name');
        $status = $this->request->getPost('category_status');

        $data = [
            'category_name'     => $name,
            'category_status'   => $status
        ];

        if ($validation->run($data, 'category') == false) {
            $response = [
                'status'    => 500,
                'error'     => true,
                'data'      => $validation->getErrors()
            ];
            return $this->respond($response, 500);
        } else {
            $simpan = $this->model->insertCategory($data);
            if ($simpan) {
                $msg = ['message' => 'Created Category Success'];
                $response = [
                    'status'    => 200,
                    'error'     => false,
                    'data'      => $msg
                ];
                return $this->respond($response, 200);
            }
        }
    }

    public function show($id = null)
    {
        $get = $this->model->getCategory($id);
        if ($get) {
            $code = 200;
            $response = [
                'status'    => $code,
                'error'     => false,
                'data'      => $get
            ];
        } else {
            $code = 401;
            $msg = ['message' => 'Value Not Found'];
            $response = [
                'status'    => $code,
                'error'     => true,
                'data'      => $msg
            ];
        }
        return $this->respond($response, $code);
    }

    public function edit($id = null)
    {
        $get = $this->model->getCategory($id);
        if ($get) {
            $code = 200;
            $response = [
                'status'    => $code,
                'error'     => false,
                'data'      => $get
            ];
        } else {
            $code = 401;
            $msg = ['message' => 'Value Not Found'];
            $response = [
                'status'    => $code,
                'error'     => true,
                'data'      => $msg
            ];
        }
        return $this->respond($response, $code);
    }

    public function update($id = null)
    {
        $validation = \Config\Services::validation();
        // $name = $this->request->getRawInput('category_name');
        // $status = $this->request->getRawInput('category_status');
        // $data = [
        //     'category_name'     => $name,
        //     'category_status'   => $status
        // ];
        $data = $this->request->getRawInput();

        if ($validation->run($data, 'category') == false) {
            $response = [
                'status'    => 500,
                'error'     => true,
                'data'      => $validation->getErrors(),
            ];
            return $this->respond($response, 500);
        } else {
            $simpan = $this->model->updateCategory($data, $id);
            if ($simpan) {
                $msg = ['message' => 'Data Updated Succesfully'];
                $response = [
                    'status'    => 200,
                    'error'     => true,
                    'data'      => $msg
                ];
                return $this->respond($response, 200);
            }
        }
    }

    public function delete($id = null)
    {
        $hapus = $this->model->deleteCategory($id);
        if ($hapus) {
            $code = 200;
            $msg = ['message' => 'Deleted Category Successfully'];
            $response = [
                'status'    => $code,
                'error'     => false,
                'data'      => $msg
            ];
        } else {
            $code = 401;
            $msg = ['message' => 'Data Not Found'];
            $response = [
                'status'    => $code,
                'error'     => true,
                'data'      => $msg
            ];
        }
        return $this->respond($response, $code);
    }
}
