<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manageproduct extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('product','',TRUE);
		$this->load->model('category','',TRUE);
		$this->load->library('form_validation');
		if (!($this->session->userdata('sessusername'))) redirect('login', 'refresh');
	}
	function index()
	{

		$query = $this->category->getCat();
		if($query){
			$data['cat_array'] =  $query;
		}else{
			$data['cat_array'] = array();
		}

		$data['product_array'] = array();
		$data['page'] = 0;
		
		$data['title'] = "Pradit and Friends - Product Management";
		$this->load->view('product_view',$data);
		
	 
	}
	
	function viewSelectedCat() {
		$catid = $this->uri->segment(3);
		
		$query = $this->category->getCat();
		if($query){
			$data['cat_array'] =  $query;
		}else{
			$data['cat_array'] = array();
		}
		
		if (isset($catid)) {
			$query = $this->product->getOneCat($catid);
			if($query){
				$data['product_array'] =  $query;
			}else{
				$data['product_array'] = array();
			}
		}else{
			$data['product_array'] = array();
		}
		$data['page'] = 1;
		$data['title'] = "Pradit and Friends - Product Management";
		$this->load->view('product_view',$data);
	}
	
	public function getdatabyajax()
	{
		$catid = $this->uri->segment(3);
		$this->load->library('Datatables');
		$this->datatables
		->select("standardID, supplierID, product.name as pname, category.name as cname, product.id as pid")
		->from('product')
		->join('category', 'product.categoryID = category.id')
		->where('category.id', $catid)
		//->edit_column("pid","$1","pid");
		
		->edit_column("pid",'<div class="tooltip-demo">
	<a href="'.site_url("manageproduct/viewproduct/$1").'" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a>
	<a href="'.site_url("manageproduct/editproduct/$1").'" class="btn btn-primary btn-xs" data-title="Edit" data-toggle="tooltip" data-target="#edit" data-placement="top" rel="tooltip" title="แก้ไข"><span class="glyphicon glyphicon-pencil"></span></a>
	<button class="btnDelete btn btn-danger btn-xs" onclick="del_confirm($1)" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip" title="ลบข้อมูล"><span class="glyphicon glyphicon-trash"></span></button>
	</div>',"pid");
		
		echo $this->datatables->generate(); 
	}

	
	function addproduct()
	{
		$this->load->helper(array('form'));
		
		$query = $this->category->getCat();
		if($query){
			$data['cat_array'] =  $query;
		}else{
			$data['cat_array'] = array();
		}
		
		$data['title'] = "Pradit and Friends - Add Product";
		$this->load->view('addproduct_view',$data);
	}
	
	function id_is_exist($id)
    {
        
        if($this->id_validate($id)>0)
        {
			$this->form_validation->set_message('id_is_exist', 'รหัสสินค้านี้มีอยู่ในระบบแล้ว');
            return FALSE;
        }
        else {
            return TRUE;
        }
    }
	
	function id_validate($id)
    {
        $this->db->where('standardID', $this->input->post('standardid'));
        $query = $this->db->get('product');
        return $query->num_rows();
    }
	
	function barcode_is_exist($id)
    {
        
        if($this->barcode_validate($id)>0)
        {
			$this->form_validation->set_message('barcode_is_exist', 'Barcode สินค้านี้มีอยู่ในระบบแล้ว');
            return FALSE;
        }
        else {
            return TRUE;
        }
    }
	
	function barcode_validate()
    {
        $this->db->where('barcode', $this->input->post('barcode'));
        $query = $this->db->get('product');
        return $query->num_rows();
    }
	
	function is_money($str)
	{
		return (bool) preg_match('/^[\-+]?[0-9]+[\.,][0-9]+$/', $str);
	}
	
    function save()
	{
		$this->form_validation->set_rules('standardid', 'standardid', 'trim|xss_clean|required|callback_id_is_exist');
		$this->form_validation->set_rules('supplierid', 'supplierid', 'trim|xss_clean|required');
		$this->form_validation->set_rules('barcode', 'barcode', 'trim|xss_clean|required|callback_barcode_is_exist');
		$this->form_validation->set_rules('name', 'Name', 'trim|xss_clean|required');
		$this->form_validation->set_rules('unit', 'unit', 'trim|xss_clean|required');
		$this->form_validation->set_rules('cost', 'cost', 'trim|xss_clean|required|call_is_money');
		$this->form_validation->set_rules('pricenovat', 'pricenovat', 'trim|xss_clean|required|call_is_money');
		$this->form_validation->set_rules('pricevat', 'pricevat', 'trim|xss_clean|required|call_is_money');
		$this->form_validation->set_rules('lowestprice', 'lowestprice', 'trim|xss_clean|required|call_is_money');
		//$this->form_validation->set_rules('pricediscount', 'pricediscount', 'trim|xss_clean|required|call_is_money');
		$this->form_validation->set_rules('detail', 'detail', 'trim|xss_clean|required');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_message('numeric', 'กรุณาใส่เฉพาะตัวเลขเท่านั้น');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
		
		if($this->form_validation->run() == TRUE) {
			$standardid= ($this->input->post('standardid'));
			$supplierid= ($this->input->post('supplierid'));
			$name= ($this->input->post('name'));
			$categoryid= ($this->input->post('categoryid'));
			$unit= ($this->input->post('unit'));
			$cost= str_replace(",", "", ($this->input->post('cost')));
			$pricenovat= str_replace(",", "", ($this->input->post('pricenovat')));
			$pricevat= str_replace(",", "", ($this->input->post('pricevat')));
			//$pricediscount= str_replace(",", "", ($this->input->post('pricediscount')));
			$detail= ($this->input->post('detail'));
			// add new column 05072014
			$lowestprice = str_replace(",", "", ($this->input->post('lowestprice')));
			$shelf = ($this->input->post('shelf'));
			
			$barcodeid= ($this->input->post('barcode'));

			$product = array(
				'standardID' => $standardid,
				'supplierID' => $supplierid,
				'barcode' => $barcodeid,
				'name' => $name,
				'categoryID' => $categoryid,
				'unit' => $unit,
				'costPrice' => $cost,
				'priceNoVAT' => $pricenovat,
				'priceVAT' => $pricevat,
				//'priceDiscount' => $pricediscount,
				'detail' => $detail,
				'lowestprice' => $lowestprice,
				'shelf' => $shelf
			);

			$result = $this->product->addProduct($product);
			if ($result) 
				$this->session->set_flashdata('showresult', 'success');
			else
				$this->session->set_flashdata('showresult', 'fail');
			redirect(current_url());
		}
		
		$query = $this->category->getCat();
		if($query){
			$data['cat_array'] =  $query;
		}else{
			$data['cat_array'] = array();
		}
		
		
			$data['title'] = "Pradit and Friends - Add Product";
			
			$this->load->view('addproduct_view',$data);
	}
	
	function delete()
	{
		
		$id = $this->uri->segment(3);
		$result = $this->product->delProduct($id);
		
		redirect('manageproduct', 'refresh');
	}
	
	function viewproduct()
	{
		$id = $this->uri->segment(3);
		$query = $this->product->getOneProduct($id);
		if($query){
			$data['product_array'] =  $query;
		}
		
		$this->load->model('branch','',TRUE);
		$query = $this->branch->getBranch();
		if($query){
			$data['branch_array'] =  $query;
		}else{
			$data['branch_array'] = array();
		}
		
		$this->load->model('category','',TRUE);
		$query = $this->category->getCat();
		if($query){
			$data['cat_array'] =  $query;
		}else{
			$data['cat_array'] = array();
		}
		
		$data['title'] = "Pradit and Friends - View Product";
		$this->load->view('viewproduct_view',$data);
	}
	
	function viewproduct_iframe()
	{
		$id = $this->uri->segment(3);
		$query = $this->product->getOneProduct($id);
		if($query){
			$data['product_array'] =  $query;
		}
		
		$data['title'] = "Pradit and Friends - View Product";
		$this->load->view('viewproduct_view_iframe',$data);
	}
	
	function editproduct()
	{
		$this->load->helper(array('form'));

		
		$data['title'] = "Pradit and Friends - Edit Product";
		
		$id = $this->uri->segment(3);
		$query = $this->product->getOneProduct($id);
		if($query){
			$data['product_array'] =  $query;
		}
		
		$query = $this->category->getCat();
		if($query){
			$data['cat_array'] =  $query;
		}else{
			$data['cat_array'] = array();
		}
		
		$data['id'] = $id;
		$this->load->view('editproduct_view',$data);

	}
	
	function update()
	{
		
		//$this->form_validation->set_rules('standardid', 'standardid', 'trim|xss_clean|required|callback_id_is_exist');
		$this->form_validation->set_rules('supplierid', 'supplierid', 'trim|xss_clean|required');
		//$this->form_validation->set_rules('barcode', 'barcode', 'trim|xss_clean|required|callback_barcode_is_exist');
		$this->form_validation->set_rules('name', 'Name', 'trim|xss_clean|required');
		$this->form_validation->set_rules('unit', 'unit', 'trim|xss_clean|required');
		$this->form_validation->set_rules('cost', 'cost', 'trim|xss_clean|required|call_is_money');
		$this->form_validation->set_rules('pricenovat', 'pricenovat', 'trim|xss_clean|required|call_is_money');
		$this->form_validation->set_rules('pricevat', 'pricevat', 'trim|xss_clean|required|call_is_money');
		$this->form_validation->set_rules('lowestprice', 'lowestprice', 'trim|xss_clean|required|call_is_money');
		//$this->form_validation->set_rules('pricediscount', 'pricediscount', 'trim|xss_clean|required|call_is_money');
		$this->form_validation->set_rules('detail', 'detail', 'trim|xss_clean|required');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_message('numeric', 'กรุณาใส่เฉพาะตัวเลขเท่านั้น');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
		
		$id= ($this->input->post('id'));
		
		if($this->form_validation->run() == TRUE) {
			$supplierid= ($this->input->post('supplierid'));
			$name= ($this->input->post('name'));
			$categoryid= ($this->input->post('categoryid'));
			$unit= ($this->input->post('unit'));
			$cost= str_replace(",", "", ($this->input->post('cost')));
			$pricenovat= str_replace(",", "", ($this->input->post('pricenovat')));
			$pricevat= str_replace(",", "", ($this->input->post('pricevat')));
			//$pricediscount= str_replace(",", "", ($this->input->post('pricediscount')));
			$detail= ($this->input->post('detail'));
			// add new column 05072014
			$lowestprice = str_replace(",", "", ($this->input->post('lowestprice')));
			$shelf = ($this->input->post('shelf'));
			
			//$barcodeid= ($this->input->post('barcode'));

			$product = array(
				'id' => $id,
				'supplierID' => $supplierid,
				//'barcode' => $barcodeid,
				'name' => $name,
				'categoryID' => $categoryid,
				'unit' => $unit,
				'costPrice' => $cost,
				'priceNoVAT' => $pricenovat,
				'priceVAT' => $pricevat,
				//'priceDiscount' => $pricediscount,
				'detail' => $detail,
				'lowestprice' => $lowestprice,
				'shelf' => $shelf
			);

			$result = $this->product->editProduct($product);
			if ($result) 
				$this->session->set_flashdata('showresult', 'success');
			else
				$this->session->set_flashdata('showresult', 'fail');
				
			$this->session->set_flashdata('id', $categoryid);
			redirect(current_url());
		}
			$query = $this->product->getOneProduct($id);
			if($query){
				$data['product_array'] =  $query;
			}
			
			$query = $this->category->getCat();
			if($query){
				$data['cat_array'] =  $query;
			}else{
				$data['cat_array'] = array();
			}
			
			$data['title'] = "Pradit and Friends - Edit Product";
			
			$this->load->view('editproduct_view',$data);
	}
	
     function barcode() 
     {
		$barcodeid = $this->uri->segment(3);
		$this->load->library('my_barcode');
        $this->my_barcode->save_path = "barcode/";
 
        $this->my_barcode->getBarcodePNGPath($barcodeid,'C128',2,120);
		$data['barcodepath'] = base_url()."/barcode/".$barcodeid.".png";
		$data['barcodeid'] = $barcodeid;
		$data['title'] = "Pradit and Friends - Barcode printing";
		$this->load->view('barcode_view',$data);
     } 
	 
	
    function jquerybarcode() 
    {
		$data['barcodeid'] = $this->uri->segment(3);
		$data['pname'] = $this->uri->segment(4);
		$data['price'] = $this->uri->segment(5);
		
		$data['title'] = "Pradit and Friends - Barcode printing";
		$this->load->view('barcode_view',$data);
    } 
}