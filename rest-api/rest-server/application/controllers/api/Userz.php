<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Userz extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Userz_model','userz');
    }
    public function index_get()
    {
        $userid = $this->get('userid');
        if ($userid === null) {
            $userz = $this->userz->getUserz();
        } else {
            $userz = $this->userz->getUserz($userid);
        }
        
        if($userz){
            $this->response([
                'status' => TRUE,
                'data' => $userz
            ], REST_Controller::HTTP_OK);
        }
        else {
            $this->response([
                'status' => FALSE,
                'message' => 'ID Not Found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function index_delete()
    {
        $userid= $this->delete('userid');
        if ($userid === null) {
            $this->response([
                'status' => FALSE,
                'message' => 'Provide an ID!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        else {
            if($this->userz->deleteUserz($userid) > 0 ) {
                //ok
                $this->response([
                    'status' => TRUE,
                    'userid' => $userid,
                    'message' => 'Success Deleted'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'ID Not Found!'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }
    public function index_post()
    {
        $data = [
            'username' =>  $this->post('username'),
            'password' =>  $this->post('password'),
            'name' =>  $this->post('name'),
            'email' =>  $this->post('email'),
            'telephone' =>  $this->post('telephone'),
            'userstat' =>  $this->post('userstat')
        ];
        if($this->userz->createUserz($data) > 0) {
            $this->response([
                'status' => TRUE,
                'message' => 'New User Added'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Failed to add user!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function index_put()
    {
        $userid = $this->put('userid');
        $data = [
            'username' =>  $this->put('username'),
            'password' =>  $this->put('password'),
            'name' =>  $this->put('name'),
            'email' =>  $this->put('email'),
            'telephone' =>  $this->put('telephone'),
            'userstat' =>  $this->put('userstat')
        ];
        if($this->userz->updateUserz($data,$userid) > 0) {
            $this->response([
                'status' => TRUE,
                'message' => 'Success to update data'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Failed to update data!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}