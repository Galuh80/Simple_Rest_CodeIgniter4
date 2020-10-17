<?php 

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\FakultasModel;

class Fakultas extends ResourceController {

    use ResponseTrait;

    public function index()
    {
        $model = new FakultasModel();
        $data = $model->findAll();
        return response($data, 200);
    }

    public function show($id = null)
    {
        $model = new FakultasModel();
        $data = $model->getWhere(['fakultas_id' => $id])->getResult();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('Data Yang Anda Cari Tidak Ada'.$data);
        }
    }

    public function create()
    {
        $model = new FakultasModel();
        $data = [
            'kode_fakultas' => $this->request->getPost('kode_fakultas');
            'nama_fakultas' => $this->request->getPost('nama_fakultas');
        ];
        $data = json_decode(file_get_contents("php://input"));
        $model->insert($data);
        $response = [
            'status' => 201,
            'error' => null,
            'message' => [
                'success' => 'Data Berhasil di Simpan'
            ]
        ];

        return $this->respondCreated($data, 201);
    }

    public function update($id = null)
    {
        $model = new FakultasModel();
        $json = $this->request->getJSON();
        if($json){
            $data = [
                'kode_fakultas' => $json->kode_fakultas,
                'nama_fakultas' => $json->nama_fakultas,
            ];
        }else{
            $input = $this->request->getRawInput();
            $data = [
                'kode_fakultas' => $input['kode_fakultas'],
                'nama_fakultas' => $input['nama_fakultas'],
            ];
        }
        $model->update($id, $data);
        $response = [
            'status' => 200,
            'error' => null,
            'message' => [
                'success' => 'Data Berhsail di Update'
            ]
        ];

        $this->respond($response);
    }

    public function delete($id = null)
    {
        $model = new FakultasModel();
        $data = $model->find($id);
        if($data){
            $model->delete($id);
            $response = [
                'status' => 200,
                'error' => null,
                'message' => [
                    'success' => 'Data Berhasil di Hapus'
                ]
            ];
            return $this->respondDeleted($response);
        }else {
            return $this->failNotFound('Data Tidak di Temukan'.$id);
        }
    }

}

/* End of file Product.php */
/* Location: ./application/controllers/Product.php */