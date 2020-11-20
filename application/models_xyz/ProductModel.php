 	

<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class ProductModel extends CI_Model

	{
	public $userInfo = '';

	public

	function __construct()
		{
		parent::__construct();
		$this->userInfo = $this->data['userInfo'];
		}

	public

	function company_show_20($where = NULL)
		{
		$this->db->join('app_register_companies', 'app_register_companies.id=pos_companies.user_company_id');
		if ($where):
			$this->db->where($where);
		endif;
		$this->db->limit('20', '0');
		$this->db->order_by('pos_companies.comp_id', 'desc');
		return $this->db->get('pos_companies')->result();
		}

	public

	function company_show_search($where = NULL, $like = NULL)
		{
		$this->db->join('app_register_companies', 'app_register_companies.id=pos_companies.user_company_id');
		if ($where):
			$this->db->where($where);
		endif;
		if ($like):
			$this->db->like('comp_name', $like);
		endif;
		$this->db->order_by('comp_name', 'asc');
		return $this->db->get('pos_companies')->result();
		}

	public

	function product_show_20($where = NULL)
		{
		$this->db->join('pos_companies', 'pos_companies.comp_id=pos_products.pro_compId');
		$this->db->join('app_register_companies', 'app_register_companies.id=pos_products.user_company_id');
		if ($where):
			$this->db->where($where);
		endif;
		$this->db->limit('20', '0');
		$this->db->order_by('pos_products.pro_id', 'desc');
		return $this->db->get('pos_products')->result();
		}

	public

	function product_show_search($where = NULL, $like = NULL)
		{
		$this->db->join('pos_companies', 'pos_companies.comp_id=pos_products.pro_compId');
		$this->db->join('app_register_companies', 'app_register_companies.id=pos_products.user_company_id');
		if ($where):
			$this->db->where($where);
		endif;
		if ($like):
			$this->db->like('pro_name', $like);
			$this->db->or_like('comp_name', $like);
		endif;
		$this->db->order_by('pro_name', 'asc');
		$this->db->order_by('comp_name', 'asc');
		return $this->db->get('pos_products')->result();
		}

	public

	function customer_show_20($where = NULL)
		{
		$this->db->join('app_register_companies', 'app_register_companies.id=pos_customer.user_company_id');
		if ($where):
			$this->db->where($where);
		endif;
		$this->db->limit('20', '0');
		$this->db->order_by('pos_customer.cust_id', 'desc');
		return $this->db->get('pos_customer')->result();
		}

	public

	function customer_show_search($where = NULL, $like = NULL)
		{
		$this->db->join('app_register_companies', 'app_register_companies.id=pos_customer.user_company_id');
		if ($where):
			$this->db->where($where);
		endif;
		if ($like):
			$this->db->like('cust_name', $like);
		endif;
		$this->db->order_by('cust_name', 'asc');
		return $this->db->get('pos_customer')->result();
		}
	}

 

 

