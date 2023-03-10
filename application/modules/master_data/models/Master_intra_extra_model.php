<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Master_intra_extra_model extends CI_Model{

  public $table = 'tbl_master_intra_extra';
  public $id = 'id_master_intra_extra';
  public $order = 'DESC';

  function __construct(){
    parent::__construct();
  }

  // datatables
  function json() {
    $this->load->helper('my_datatable');
    $this->datatables->select('A.id_master_intra_extra,A.kode_jenis,A.value, concat(A.kode_jenis," - ",B.nama_jenis) as kib');
    $this->datatables->from('tbl_master_intra_extra A');

    $this->datatables->join('tbl_master_jenis B', 'A.kode_jenis = B.kode_jenis', 'left');
    // $this->datatables->add_column('action', anchor(base_url('master_intra_extra/read/$1'),'Read')." | ".anchor(base_url('master_intra_extra/update/$1'),'Update')." | ".anchor(base_url('master_intra_extra/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_master_intra_extra');
    $this->datatables->add_column('action', anchor(base_url('master_data/master_intra_extra/update/$1'),'<span class="fa fa-edit" style="font-size:18px;"></span>'), 'id_master_intra_extra');
    $this->datatables->edit_column('value','$1','format_number(value)');
    return
    $this->datatables->generate();
    // die($this->db->last_query());
  }

  // get all
  function get_all(){
    $this->db->order_by($this->id, $this->order);
    return $this->db->get($this->table)->result();
  }

  // get data by id
  function get_by_id($id){
    $this->db->select('A.*, concat(A.kode_jenis," - ",B.nama_jenis) as kib');
    $this->db->from($this->table.' A');
    $this->db->join('tbl_master_jenis B', 'A.kode_jenis = B.kode_jenis', 'left');
    $this->db->where($this->id, $id);
    return $this->db->get()->row();
  }

  // get total rows
  function total_rows($q = NULL) {
    $this->db->like('id_master_intra_extra', $q);
    $this->db->or_like('kode_jenis', $q);
    $this->db->or_like('value', $q);
    $this->db->or_like('created_at', $q);
    $this->db->or_like('updated_at', $q);
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }

  // get data with limit and search
  function get_limit_data($limit, $start = 0, $q = NULL) {
    $this->db->order_by($this->id, $this->order);
    $this->db->like('id_master_intra_extra', $q);
    $this->db->or_like('kode_jenis', $q);
    $this->db->or_like('value', $q);
    $this->db->or_like('created_at', $q);
    $this->db->or_like('updated_at', $q);
    $this->db->limit($limit, $start);
    return $this->db->get($this->table)->result();
  }

  // insert data
  function insert($data){
    $this->db->insert($this->table, $data);
  }

  // update data
  function update($id, $data){
    $this->db->where($this->id, $id);
    $this->db->update($this->table, $data);
  }

  // delete data
  function delete($id){
    $this->db->where($this->id, $id);
    $this->db->delete($this->table);
  }

}

/* End of file Master_intra_extra_model.php */
/* Location: ./application/models/Master_intra_extra_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-09-26 20:46:54 */
/* http://harviacode.com */
