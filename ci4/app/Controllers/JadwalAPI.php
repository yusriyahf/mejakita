<?php 

namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\JadwalModel;
 
class JadwalAPI extends ResourceController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new JadwalModel();
        $data = $model->where('isDeleted', 0)->findAll();
        return $this->respond($data, 200);
    }
 
    // get single product
    public function show($id = null)
    {
        $model = new JadwalModel();
        $data = $model->getWhere(['id' => $id])->getResult();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
    }
 
    // create a product
    public function create()
    {
        $model = new JadwalModel();
        $data = [
            'userId' => $this->request->getPost('userId'),
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'jenisTugas' => $this->request->getPost('jenisTugas'),
            'start' => $this->request->getPost('start'),
            'deadline' => $this->request->getPost('deadline'),
        ];
        $data = json_decode(file_get_contents("php://input"));
        // $data = $this->request->getPost();
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];
         
        return $this->respondCreated($data, 201);
    }
 
    // update product
    public function update($id = null)
    {
        $model = new JadwalModel();
        $json = $this->request->getJSON();
        if($json){
            $data = [
                'userId' => $json->userId,
                'judul' => $json->judul,
                'deskripsi' => $json->deskripsi,
                'jenisTugas' => $json->jenisTugas,
                'start' => $json->start,
                'deadline' => $json->deadline,
            ];
        }else{
            $input = $this->request->getRawInput();
            $data = [
                'userId' => $input['userId'],
                'judul' => $input['judul'],
                'deskripsi' => $input['deskripsi'],
                'jenisTugas' => $input['jenisTugas'],
                'start' => $input['start'],
                'deadline' => $input['deadline'],
            ];
        }
        // Insert to Database
        $model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }
 
    // delete product
    public function delete($id = null)
    {
        $model = new JadwalModel();
        $data = $model->find($id);
        $data['isDeleted'] = TRUE;
        if($data){
            $model->update($id, $data);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];
            
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
         
    }
 
}