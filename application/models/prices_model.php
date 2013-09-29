<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prices_Model extends CI_Model
{
    private $numResults;

    public function getPrices($orderByField = 'boiled_price', $ascDesc = 'asc')
    {
        $this->db->order_by($orderByField, $ascDesc);
        $query = $this->db->get('master');
        $this->numResults = $query->num_rows();
        return $query->result();
    }

    public function getNumResults()
    {
        return $this->numResults;
    }
}
