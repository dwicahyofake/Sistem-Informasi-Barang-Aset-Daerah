<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Master_penggunaan_model extends CI_Model
{

  public $table = 'tbl_master_penggunaan';
  public $id = 'id_master_penggunaan';
  public $order = 'DESC';

  function __construct()
  {
    parent::__construct();
  }

  // datatables
  function json() {
    $this->datatables->select('id_master_penggunaan,description,created_at,updated_at');
    $this->datatables->from('tbl_master_penggunaan');
    //add this line for join
    //$this->datatables->join('table2', 'tbl_master_penggunaan.field = table2.field');
    // $this->datatables->add_column('action', anchor(base_url('master_penggunaan/read/$1'),'Read')." | ".anchor(base_url('master_penggunaan/update/$1'),'Update')." | ".anchor(base_url('master_penggunaan/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_master_penggunaan');
    $this->datatables->add_column('action',anchor(base_url('master_data/master_penggunaan/update/$1'),'<span class="fa fa-edit" style="font-size:18px;"></span>'), 'id_master_penggunaan');
    return $this->datatables->generate();
  }

  // get all
  function get_all()
  {
    $this->db->order_by($this->id, $this->order);
    return $this->db->get($this->table)->result();
  }

  // get data by id
  function get_by_id($id)
  {
    $this->db->where($this->id, $id);
    return $this->db->get($this->table)->row();
  }

  // get total rows
  function total_rows($q = NULL) {
    $this->db->like('id_master_penggunaan', $q);
    $this->db->or_like('description', $q);
    $this->db->or_like('created_at', $q);
    $this->db->or_like('updated_at', $q);
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }

  // get data with limit and search
  function get_limit_data($limit, $start = 0, $q = NULL) {
    $this->db->order_by($this->id, $this->order);
    $this->db->like('id_master_penggunaan', $q);
    $this->db->or_like('description', $q);
    $this->db->or_like('created_at', $q);
    $this->db->or_like('updated_at', $q);
    $this->db->limit($limit, $start);
    return $this->db->get($this->table)->result();
  }

  // insert data
  function insert($data)
  {
    $this->db->insert($this->table, $data);
  }

  // update data
  function update($id, $data)
  {
    $this->db->where($this->id, $id);
    $this->db->update($this->table, $data);
  }

  // delete data
  function delete($id)
  {
    $this->db->where($this->id, $id);
    $this->db->delete($this->table);
  }

}

/* End of file Master_penggunaan_model.php */
/* Location: ./application/models/Master_penggunaan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-09-16 06:27:50 */
/* http://harviacode.com */
