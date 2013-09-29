<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Model extends CI_Model
{
    private $numBoils;
    private $numPrices;
    private $lastUpdateBoils;
    private $lastUpdatePrices;

    public function getBoils($where = 'all', $orderByField = 'datetime', $ascDesc = 'asc')
    {
        $this->db->cache_on();

        if ($where == 'active') {
            $this->db->where('datetime >=', date("Y-m-d"));
        } elseif ($where == 'inactive') {
            $this->db->where('datetime <', date("Y-m-d"));
        }
        $this->db->order_by($orderByField, $ascDesc);
        $query = $this->db->get('boils');
        $this->numBoils = $query->num_rows();
        return $query->result();
    }

    public function getBoil($id = FALSE)
    {
        $this->db->cache_on();

        $this->db->where('boils_id', $id);
        $query = $this->db->get('boils');
        $this->numBoils = $query->num_rows();
        return $query->result();
    }

    public function getNumBoils()
    {
        return $this->numBoils;
    }

    public function updateBoil($id = FALSE)
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

        $this->db->where('boils_id', $id);
        return $this->db->update('boils', $data);
    }

    public function deleteBoil($id = FALSE)
    {
        clear_query_cache();
        $this->output->clear_all_cache();

        $this->db->where('boils_id', $id);
        return $this->db->delete('boils');
    }

    public function getPrices($orderByField = 'boiled_price', $ascDesc = 'asc')
    {
        $this->db->cache_on();

        $this->db->order_by($orderByField, $ascDesc);
        $query = $this->db->get('master');
        $this->numPrices = $query->num_rows();
        return $query->result();
    }

    public function getNumPrices()
    {
        return $this->numPrices;
    }

    public function getLastUpdate()
    {
        $this->db->cache_on();

        $this->db->order_by('timestamp', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('boils');
        $result = $query->result();
        $this->lastUpdateBoils = $result[0]->timestamp;

        $this->db->order_by('timestamp', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('master');
        $result = $query->result();
        $this->lastUpdatePrices = $result[0]->timestamp;

        $array = array('boils' => $this->lastUpdateBoils, 'prices' => $this->lastUpdatePrices);
        return $array;
    }
}
