<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller
{
    private $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('account_model');

        $this->auth = new stdClass;
        $this->load->library('flexi_auth_lite', FALSE, 'flexi_auth');

        $this->data['logged_in'] = $this->flexi_auth->is_logged_in();
        if ($this->data['logged_in']) {
            $this->data['email'] = $this->flexi_auth->get_user_identity();
        } else {
            redirect('/');
        }
        
        $messages_array = $this->session->flashdata('messages_array') ? $this->session->flashdata('messages_array') : $this->flexi_auth->get_messages_array();
        $this->data['status_messages'] = $messages_array['status'];
        $this->data['error_messages'] = $messages_array['errors'];
    }

    public function index()
    {

        $this->load->view('head', $this->data);
        $this->load->view('account_view.php');
        $this->load->view('footer');
    }

    public function _remap($method, $params = array())
    {
        if ($method != 'index') {

            $method = $method;

            if (method_exists($this, $method))
            {
                return call_user_func_array(array($this, $method), $params);
            }
            show_404();
        }
        $this->index();
    }
}
