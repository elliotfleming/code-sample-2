<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Boils_Model extends CI_Model
{
    private $numBoils;

    public function getBoils($orderByField = 'datetime', $ascDesc = 'asc')
    {
        $this->db->cache_on();

        //$this->db->where('datetime >=', date("Y-m-d H:i:s"));
        $this->db->where('datetime >=', date("Y-m-d"));
        $this->db->order_by($orderByField, $ascDesc);
        $query = $this->db->get('boils');
        $this->numBoils = $query->num_rows();
        return $query->result();
    }

    public function getNumBoils()
    {
        return $this->numBoils;
    }

    public function addBoil()
    {
        clear_query_cache();
        $this->output->clear_all_cache();

        $datetime    = date('Y-m-d H:i:s', strtotime($this->input->post('date') . ' ' . $this->input->post('time')));
        $description = $this->input->post('description') ? $this->input->post('description') : NULL;
        $website     = $this->input->post('website') ? $this->input->post('website') : NULL;
        $email       = $this->input->post('email') ? $this->input->post('email') : NULL;
        $phone       = $this->input->post('phone') ? $this->input->post('phone') : NULL;
        $price       = $this->input->post('price') ? $this->input->post('price') : NULL;
        $twitter     = $this->input->post('twitter') ? $this->input->post('twitter') : NULL;


        $data = array(
            'name'        => ucwords($this->input->post('name')),
            'datetime'    => $datetime,
            'address'     => ucwords($this->input->post('address')),
            'city'        => ucwords($this->input->post('city')),
            'state'       => strtoupper($this->input->post('state')),
            'zip'         => $this->input->post('zip'),
            'description' => ucfirst($description),
            'website'     => $website,
            'email'       => $email,
            'phone'       => $phone,
            'price'       => $price,
            'twitter'     => $twitter
        );

        return $this->db->insert('boils', $data);
    }
}
