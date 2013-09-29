<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Boils extends CI_Controller
{
    private $data = array();

    public function __construct()
    {
        parent::__construct();
        
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
        //cache_it();
        
        $this->data['page_title'] = 'CrawFinder';
        $this->data['dateFormat'] = 'M j, Y';
        $this->data['timeFormat'] = 'g:i a';
        $this->data['boils']      = $this->boils_model->getBoils();
        $this->data['numBoils']   = $this->boils_model->getNumBoils();

        $this->load->view('head', $this->data);
        $this->load->view('boils_view');
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

    public function addBoil()
    {        
        $this->load->helper(array('form'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name',        'Event Name',  'trim|required|xss_clean');
        $this->form_validation->set_rules('date',        'Date',        'trim|required|xss_clean');
        $this->form_validation->set_rules('time',        'Time',        'trim|required|xss_clean');
        $this->form_validation->set_rules('address',     'Address',     'trim|required|xss_clean');
        $this->form_validation->set_rules('city',        'City',        'trim|required|xss_clean');
        $this->form_validation->set_rules('state',       'State',       'trim|required|alpha|exact_length[2]|xss_clean');
        $this->form_validation->set_rules('zip',         'Zip',         'trim|required|numeric|exact_length[5]|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
        $this->form_validation->set_rules('website',     'Website',     'trim|prep_url|xss_clean');
        $this->form_validation->set_rules('email',       'Email',       'trim|valid_email|xss_clean');
        $this->form_validation->set_rules('phone',       'Phone',       'trim|alpha_dash|xss_clean');
        $this->form_validation->set_rules('price',       'Price',       'trim|is_natural|xss_clean');
        $this->form_validation->set_rules('twitter',     'Twitter',     'trim|xss_clean');

        $this->data['page_title'] = 'CrawFinder &mdash; Add Boil';

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['status'] = FALSE;
        }
        elseif ($this->boils_model->addBoil())
        {
            $this->data['status'] = TRUE;
        }
        else
        {
            $this->data['insertError'] = TRUE;
            $this->data['status']      = FALSE;
        }

        $this->load->view('head', $this->data);
        $this->load->view('boils_add');
        $this->load->view('footer');
    }
}
