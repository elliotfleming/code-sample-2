<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prices extends CI_Controller
{
    private $data = array();

    public function __construct()
    {
        parent::__construct();

        // cach_it();

        $this->auth = new stdClass;
        $this->load->library('flexi_auth');

        $this->data['logged_in'] = $this->flexi_auth->is_logged_in();
        if ($this->data['logged_in']) {
            $this->data['email'] = $this->flexi_auth->get_user_identity();
        }

        $messages_array = $this->session->flashdata('messages_array') ? $this->session->flashdata('messages_array') : $this->flexi_auth->get_messages_array();
        $this->data['status_messages'] = $messages_array['status'];
        $this->data['error_messages'] = $messages_array['errors'];
    }

    public function index()
    {
        $this->data['page_title']   = 'CrawFinder &mdash; Prices';
        $this->data['dateFormat']   = 'F j, Y';
        $this->data['timeFormat']   = 'g:i a';
        $this->data['orderByField'] = 'price';
        $this->data['ascDesc']      = 'asc';
        $this->data['prices']       = $this->prices_model->getPrices();
        $this->data['numResults']   = $this->prices_model->getNumResults();

        $this->load->view('head', $this->data);
        $this->load->view('prices_view');
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

    public function sortBy($orderByField = 'boiled_price', $ascDesc = 'asc')
    {
        $this->data['page_title']   = 'CrawFinder &mdash; Prices';
        $this->data['dateFormat']   = 'F j, Y';
        $this->data['timeFormat']   = 'g:i a';
        $this->data['orderByField'] = $orderByField;
        $this->data['ascDesc']      = $ascDesc;
        $this->data['prices']       = $this->prices_model->getPrices($orderByField, $ascDesc);
        $this->data['numResults']   = $this->prices_model->getNumResults();

        $this->load->view('head', $this->data);
        $this->load->view('prices_view');
        $this->load->view('footer');
    }
}
