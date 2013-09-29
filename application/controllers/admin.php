<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{
    private $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');

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
        cache_it();

        $lastUpdated = $this->admin_model->getLastUpdate();
        $lastUpdated = prettyDate($lastUpdated);

        $this->data['page_title']  = 'CrawFinder &mdash; Admin';
        $this->data['boils']       = $this->admin_model->getBoils();
        $this->data['numBoils']    = $this->admin_model->getNumBoils();
        $this->data['prices']      = $this->admin_model->getPrices();
        $this->data['numPrices']   = $this->admin_model->getNumPrices();
        $this->data['lastUpdated'] = $lastUpdated;

        $this->load->view('head', $this->data);
        $this->load->view('admin/index_view');
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

    public function boils($filter = 'all', $sort = FALSE, $sortType = 'datetime', $sortValue = 'asc')
    {
        cache_it();
        
        if ($sortType == 'datetime') {
            $sortDate = TRUE;
            $sortDateValue = $sortValue == 'asc' ? 'desc' : 'asc';
        } else {
            $sortDate = FALSE;
            $sortDateValue = 'asc';
        }

        if ($sortType == 'name') {
            $sortName = TRUE;
            $sortNameValue = $sortValue == 'asc' ? 'desc' : 'asc';
        } else {
            $sortName = FALSE;
            $sortNameValue = 'asc';
        }

        $this->data['page_title']    = 'CrawFinder &mdash; Admin > Boils';
        $this->data['dateFormat']    = 'm-d-Y';
        $this->data['timeFormat']    = 'g:i a';
        $this->data['filter']        = $filter;
        $this->data['sortType']      = $sortType;
        $this->data['sortDate']      = $sortDate;
        $this->data['sortName']      = $sortName;
        $this->data['sortDateValue'] = $sortDateValue;
        $this->data['sortNameValue'] = $sortNameValue;
        $this->data['boils']         = $this->admin_model->getBoils($filter, $sortType, $sortValue);
        $this->data['numBoils']      = $this->admin_model->getNumBoils();
        $this->data['sorted']        = $sort ? TRUE : FALSE;

        $this->load->view('head', $this->data);
        $this->load->view('admin/boils_view');
        $this->load->view('footer');
    }

    public function prices($filter = 'all', $sort = FALSE, $sortType = 'datetime', $sortValue = 'asc')
    {
        cache_it();

        if ($sortType == 'datetime') {
            $sortDate = TRUE;
            $sortDateValue = $sortValue == 'asc' ? 'desc' : 'asc';
        } else {
            $sortDate = FALSE;
            $sortDateValue = 'asc';
        }

        if ($sortType == 'name') {
            $sortName = TRUE;
            $sortNameValue = $sortValue == 'asc' ? 'desc' : 'asc';
        } else {
            $sortName = FALSE;
            $sortNameValue = 'asc';
        }

        $this->data['page_title']    = 'CrawFinder &mdash; Admin > Prices';
        $this->data['dateFormat']    = 'm-d-Y';
        $this->data['timeFormat']    = 'g:i a';
        $this->data['filter']        = $filter;
        $this->data['sortType']      = $sortType;
        $this->data['sortDate']      = $sortDate;
        $this->data['sortName']      = $sortName;
        $this->data['sortDateValue'] = $sortDateValue;
        $this->data['sortNameValue'] = $sortNameValue;
        $this->data['prices']        = $this->admin_model->getPrices();
        $this->data['numPrices']     = $this->admin_model->getNumPrices();

        $this->load->view('head', $this->data);
        $this->load->view('admin/prices_view');
        $this->load->view('footer');
    }

    public function editBoil($id = FALSE)
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

        $this->data['page_title'] = 'CrawFinder &mdash; Admin > Edit Boil';
        $this->data['dateFormat'] = 'm/d/Y';
        $this->data['timeFormat'] = 'g:i a';
        $this->data['id']         = $id;
        $this->data['boil']       = $this->admin_model->getBoil($id);
        $this->data['numBoils']   = $this->admin_model->getNumBoils();

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['status'] = FALSE;
        }
        elseif ($this->admin_model->updateBoil($id))
        {
            $this->data['status'] = TRUE;
        }
        else
        {
            $this->data['insertError'] = TRUE;
            $this->data['status']      = FALSE;
        }

        $this->load->view('head', $this->data);
        $this->load->view('admin/edit_view');
        $this->load->view('footer');
    }

    public function deleteBoil($id, $confirm = FALSE)
    {
        $this->data['page_title'] = 'CrawFinder &mdash; Admin > Delete Boil';
        $this->data['id']         = $id;
        $this->data['boil']       = $this->admin_model->getBoil($id);

        if ($confirm == FALSE)
        {
            $this->data['status'] = FALSE;
        }
        elseif ($this->admin_model->deleteBoil($id))
        {
            $this->data['status'] = TRUE;
        }
        else
        {
            $this->data['insertError'] = TRUE;
            $this->data['status']      = FALSE;
        }

        $this->load->view('head', $this->data);
        $this->load->view('admin/delete_view');
        $this->load->view('footer');
    }
}
