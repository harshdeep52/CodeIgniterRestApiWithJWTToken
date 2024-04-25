<?php
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Product extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('Authorization_Token');
        $this->load->model('Product_model');
    }

    public function index_get($id = 0)
    {
        $headers = $this->input->request_headers();
        $decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
        if ($decodedToken['status']) {
            if (!empty($id)) {
                $data = $this->Product_model->show($id);
            } else {
                $data = $this->Product_model->show();
            }
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response($decodedToken);
        }
    }

    public function index_post()
    {
        $headers = $this->input->request_headers();
        $decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
        if ($decodedToken['status']) {
            $input = $this->input->post();
            $data = $this->Product_model->insert($input);

            $this->response(['Product created successfully.'], REST_Controller::HTTP_OK);
            // ------------- End -------------
        } else {
            $this->response($decodedToken);
        }
    }
    public function index_put($id)
    {
        $headers = $this->input->request_headers();
        $decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
        if ($decodedToken['status']) {
            $headers = $this->input->request_headers();
            $data['name'] = $headers['name'];
            $data['price'] = $headers['price'];
            $response = $this->Product_model->update($data, $id);

            $response > 0 ? $this->response(['Product updated successfully.'], REST_Controller::HTTP_OK) : $this->response(['Not updated'], REST_Controller::HTTP_OK);
        } else {
            $this->response($decodedToken);
        }
    }

    public function index_delete($id)
    {

        $headers = $this->input->request_headers();
        $decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
        if ($decodedToken['status']) {
            $response = $this->Product_model->delete($id);

            $response > 0 ? $this->response(['Product deleted successfully.'], REST_Controller::HTTP_OK) : $this->response(['Not deleted'], REST_Controller::HTTP_OK);
        } else {
            $this->response($decodedToken);
        }
    }
}
