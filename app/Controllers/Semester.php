<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Semester extends ResourceController
{
    protected $format = 'JSON';
    protected $modelName = 'App\Models\Semester_model';

    public function index()
    {
        return $this->respond($this->model->findAll(), 200);
    }

    public function create()
    {
        $validation = \Config\Services::validation();

        $name = $this->request->getPost('nama_semester');
        
        $data = [
            'nama_semester'     => $nama,
        ];

        if ($validation->run($data, 'semester') == false) {
            $response = [
                'status'    => 500,
                'error'     => true,
                'data'      => $validation->getErrors()
            ];
            return $this->respond($response, 500);
        } else {
            $simpan = $this->model->insertSemester($data);
            if ($simpan) {
                $msg = ['message' => 'Data Berhasil Disimpan'];
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
        $get = $this->model->getSemester($id);
        if ($get) {
            $code = 200;
            $response = [
                'status'    => $code,
                'error'     => false,
                'data'      => $get
            ];
        } else {
            $code = 401;
            $msg = ['message' => 'Data Tidak Ditemukan'];
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
        $get = $this->model->getSemester($id);
        if ($get) {
            $code = 200;
            $response = [
                'status'    => $code,
                'error'     => false,
                'data'      => $get
            ];
        } else {
            $code = 401;
            $msg = ['message' => 'Data Tidak Ditemukan'];
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

        $data = $this->request->getRawInput();

        if ($validation->run($data, 'semester') == false) {
            $response = [
                'status'    => 500,
                'error'     => true,
                'data'      => $validation->getErrors(),
            ];
            return $this->respond($response, 500);
        } else {
            $simpan = $this->model->updateSemester($data, $id);
            if ($simpan) {
                $msg = ['message' => 'Data Berhasil di Update'];
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
        $hapus = $this->model->deleteSemester($id);
        if ($hapus) {
            $code = 200;
            $msg = ['message' => 'Data Berhasil di Hapus'];
            $response = [
                'status'    => $code,
                'error'     => false,
                'data'      => $msg
            ];
        } else {
            $code = 401;
            $msg = ['message' => 'Data Tidak Ditemukan'];
            $response = [
                'status'    => $code,
                'error'     => true,
                'data'      => $msg
            ];
        }
        return $this->respond($response, $code);
    }
    
}
