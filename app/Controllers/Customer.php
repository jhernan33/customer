<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\CustomerModel;

class Customer extends ResourceController{
    use ResponseTrait;

    public function __construct()
    {
       $this->db = \Config\Database::connect();
    }
    
    /**
     * Method Index List Customer
     */
    public function index()
    {
        $model = new CustomerModel();
        //$data = $model->orderBy('id','DESC')->findAll();
        $data = $model->findAll();
        return $this->respond($data);
    }

    /**
     * Method Create Customer
     */
    public function create(){
        $customer = new CustomerModel();
        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
        ];
        $customer->insert($data);
        $response = [
            'status' => 201,
            'error' => null,
            'message' => ['success' => 'Customer Created']
        ];
        return $this->respondCreated($response);
    }

    /**
     * Method Show Customer for Id
     */
    public function getCustomer($id = null){
        $customer = new CustomerModel();
        $data = $customer->where('id', $id)->first();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('Customer Id does not Register');
        }
    }

    /**
     * Method Update Customer
     */
    public function update($id = null)
    {
        $customer = new CustomerModel();
        $id = $this->request->getVar('id');
        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
        ];
        $customer->update($id, $data);
        $response = [
            'status' => 200,
            'error' => null,
            'message' => ['success' => 'Customer Updated']
        ];
        return $this->respond($response);
    }

    /**
     * Method Delete Customer
     */
    public function delete($id = null)
    {
        $customer = new CustomerModel();
        $data = $customer->where('id', $id)->delete($id);
        if($data){
            $customer->delete($id);
            $response = [
                'status' => 200,
                'error' => null,
                'message' => [
                    'sucess' => 'Customer Deleted'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('Customer Id does not Register');
        }
    }
}