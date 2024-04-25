<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ValidateToken
{
    public $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    function validate()
    {
        $class = $this->CI->router->fetch_class();
        $method = $this->CI->router->fetch_method();
        if ($class != "User" && $method != "register") {

            $this->CI->load->library('Authorization_Token');
            $response  = new stdClass;
            $headers = $this->CI->input->request_headers();
            //$data = [];
            // $data['uid'] = 1;
            // $data['username'] = "harshdeep52"; 
            // echo $this->CI->authorization_token->generateToken($data);
            if (isset($headers['Authorization'])) {
                $decodedToken = $this->CI->authorization_token->validateToken($headers['Authorization']);
                if ($decodedToken['status'] == false) {
                    $response = [$decodedToken];
                    echo json_encode($response);
                    exit(1);
                }
            } else {
                $response = ['Authentication failed'];
                echo json_encode($response);
                exit(1);
            }
        }
    }
}
