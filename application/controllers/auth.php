<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
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
        
        if ($this->flexi_auth->is_logged_in() && strpos(uri_string(), 'auth/logout') !== 0)
        {
            if ($this->session->flashdata('messages_array')) { $this->session->keep_flashdata('messages_array'); }
            
            if ($this->flexi_auth->is_admin())
            {
                redirect('/admin');
            }
            else
            {
                redirect('/account');
            }
        }

        $messages_array = $this->session->flashdata('messages_array') ? $this->session->flashdata('messages_array') : $this->flexi_auth->get_messages_array();
        $this->data['status_messages'] = $messages_array['status'];
        $this->data['error_messages'] = $messages_array['errors'];
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

    public function index()
    {
        $this->login();
        /*$this->data['page_title'] = 'CrawFinder &mdash; Login/Register';

        if ($this->input->post('login_user'))
        {
            $this->form_validation->set_rules('email',    'Email',    'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

            if ($this->form_validation->run())
            {
                $remember_user = ($this->input->post('remember_me') == 1);

                $response = $this->flexi_auth->login($this->input->post('email'), $this->input->post('password'), $remember_user);

                if ($response)
                {
                    $this->session->set_flashdata('messages_array', $this->flexi_auth->get_messages_array());

                    redirect('auth');
                }
            }
        }

        if ($this->input->post('register_user'))
        {
            $this->form_validation->set_rules('email',            'Email',            'trim|required|valid_email|identity_available|xss_clean');
            $this->form_validation->set_rules('password',         'Password',         'trim|required|xss_clean|validate_password');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean|matches[password]');

            if ($this->form_validation->run())
            {
                if ($this->flexi_auth->insert_user($this->input->post('email'), FALSE, $this->input->post('password')))
                {
                    $this->session->set_flashdata('messages_array', $this->flexi_auth->get_messages_array());
                    
                    $this->flexi_auth->login($this->input->post('email'), $this->input->post('password'));
                    
                    redirect('auth');
                }

                $this->session->set_flashdata('messages_array', $this->flexi_auth->get_messages_array());
            }
        }

        $messages_array = $this->session->flashdata('messages_array') ? $this->session->flashdata('messages_array') : $this->flexi_auth->get_messages_array();
        $this->data['status_messages'] = $this->data['status_messages'] ? $this->data['status_messages'] : $messages_array['status'];
        $this->data['error_messages'] = $this->data['error_messages'] ? $this->data['error_messages'] : $messages_array['errors'];

        $this->load->view('head', $this->data);
        $this->load->view('auth/login_or_register_view');
        $this->load->view('footer');*/
    }

    public function login()
    {
        $this->data['page_title'] = 'CrawFinder &mdash; Login';

        if ($this->input->post('login_user'))
        {
            $this->form_validation->set_rules('email',    'Email',    'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

            if ($this->form_validation->run())
            {
                $remember_user = ($this->input->post('remember_me') == 1);

                $response = $this->flexi_auth->login($this->input->post('email'), $this->input->post('password'), $remember_user);

                if ($response)
                {
                    $this->session->set_flashdata('messages_array', $this->flexi_auth->get_messages_array());

                    redirect('auth');
                }
            }
        }

        $messages_array = $this->session->flashdata('messages_array') ? $this->session->flashdata('messages_array') : $this->flexi_auth->get_messages_array();
        $this->data['status_messages'] = $this->data['status_messages'] ? $this->data['status_messages'] : $messages_array['status'];
        $this->data['error_messages'] = $this->data['error_messages'] ? $this->data['error_messages'] : $messages_array['errors'];

        $this->load->view('head', $this->data);
        $this->load->view('auth/login_view');
        $this->load->view('footer');
    }

    function login_via_ajax()
    {
        if ($this->input->is_ajax_request())
        {
            $response = $this->flexi_auth->login($this->input->post('email'), $this->input->post('password'), ($this->input->post('remember_me') == 1));

            $status_messages = $this->flexi_auth->get_messages_array();

            if ($response) {
                $data = array('message' => $status_messages, 'email' => $this->flexi_auth->get_user_identity());
                die(json_encode($data));
            } else {
                $data = array('message' => $status_messages);
                die(json_encode($data));
            }
        }
        else
        {
            $this->load->view('auth/login', $this->data);
        }
    }

    public function register()
    {
        $this->data['page_title'] = 'CrawFinder &mdash; Register';

        if ($this->input->post('register_user'))
        {
            $this->form_validation->set_rules('email',            'Email',            'trim|required|valid_email|identity_available|xss_clean');
            $this->form_validation->set_rules('password',         'Password',         'trim|required|xss_clean|validate_password');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean|matches[password]');

            if ($this->form_validation->run())
            {
                if ($this->flexi_auth->insert_user($this->input->post('email'), FALSE, $this->input->post('password')))
                {
                    // This is an example 'Welcome' email that could be sent to a new user upon registration.
                    // Bear in mind, if registration has been set to require the user activates their account, they will already be receiving an activation email.
                    // Therefore sending an additional email welcoming the user may be deemed unnecessary.
                    //$email_data = array('identity' => $email);
                    //$this->flexi_auth->send_email($email, 'Welcome', 'registration_welcome.tpl.php', $email_data);
                                        
                    $this->session->set_flashdata('messages_array', $this->flexi_auth->get_messages_array());
                    
                    $this->flexi_auth->login($this->input->post('email'), $this->input->post('password'));
                    
                    redirect('auth');
                }

                $this->session->set_flashdata('messages_array', $this->flexi_auth->get_messages_array());
            }
        }
        
        $messages_array = $this->session->flashdata('messages_array') ? $this->session->flashdata('messages_array') : $this->flexi_auth->get_messages_array();
        $this->data['status_messages'] = $this->data['status_messages'] ? $this->data['status_messages'] : $messages_array['status'];
        $this->data['error_messages'] = $this->data['error_messages'] ? $this->data['error_messages'] : $messages_array['errors'];

        $this->load->view('head', $this->data);
        $this->load->view('auth/register_view');
        $this->load->view('footer');
    }

    public function logout()
    {
        // By setting the logout functions argument as 'TRUE', all browser sessions are logged out.
        $this->flexi_auth->logout(FALSE);

        $this->session->set_flashdata('messages_array', $this->flexi_auth->get_messages_array());

        redirect('auth/login');
    }

    public function logout_via_ajax()
    {
        $this->flexi_auth->logout(FALSE);

        $status_messages = $this->flexi_auth->get_messages_array();

        $data = array('message' => $status_messages);
        die(json_encode($data));
    }
}
