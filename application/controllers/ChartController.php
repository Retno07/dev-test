<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 class ChartController extends CI_Controller {  
    /** 
     * This method is used to get all the data. 
     * 
     * @It will return Response 
    */  
    public function __construct() {  
       parent::__construct();  
       $this->load->database();  
       $this->load->model('ChartModels');
    }   
    
    /** 
     * This method is used to get all the data. 
     * 
     * @It will return Response 
    */  
    public function index()  
    {  
        $query = $this->db->query("
            WITH compliance AS (
                SELECT d.area_id,d.area_name,sum(a.compliance) AS compliance
                FROM report_product a
                JOIN store b ON a.store_id = b.store_id
                JOIN product c ON a.product_id = c.product_id
                JOIN store_area d ON b.area_id = d.area_id
                GROUP BY d.area_id 
            ), region AS (
                SELECT compliance,(SELECT SUM(compliance) FROM report_product) AS all_region
                FROM compliance
            ), hasil AS (
                SELECT (compliance / all_region * 100) AS hasil
                FROM region
            ) SELECT CONVERT(hasil,DECIMAL(20,2)) as total FROM hasil;
        ");
        $data['chart'] = json_encode(array_column($query->result(), 'total'),JSON_NUMERIC_CHECK);

        $query2 = $this->db->query("
            WITH dki AS (
                SELECT e.brand_name,sum(a.compliance) AS jakarta
                FROM report_product a
                JOIN store b ON a.store_id = b.store_id
                JOIN product c ON a.product_id = c.product_id
                JOIN store_area d ON b.area_id = d.area_id
                JOIN product_brand e ON c.brand_id = e.brand_id
                WHERE d.area_id = 1
                GROUP BY e.brand_id
            ), jabar AS (
                SELECT e.brand_name,sum(a.compliance) AS jabar
                FROM report_product a
                JOIN store b ON a.store_id = b.store_id
                JOIN product c ON a.product_id = c.product_id
                JOIN store_area d ON b.area_id = d.area_id
                JOIN product_brand e ON c.brand_id = e.brand_id
                WHERE d.area_id = 2
                GROUP BY e.brand_id
            ), kalimantan AS (
                SELECT e.brand_name,sum(a.compliance) AS kalimantan
                FROM report_product a
                JOIN store b ON a.store_id = b.store_id
                JOIN product c ON a.product_id = c.product_id
                JOIN store_area d ON b.area_id = d.area_id
                JOIN product_brand e ON c.brand_id = e.brand_id
                WHERE d.area_id = 3
                GROUP BY e.brand_id
            ), jateng AS (
                SELECT e.brand_name,sum(a.compliance) AS jateng
                FROM report_product a
                JOIN store b ON a.store_id = b.store_id
                JOIN product c ON a.product_id = c.product_id
                JOIN store_area d ON b.area_id = d.area_id
                JOIN product_brand e ON c.brand_id = e.brand_id
                WHERE d.area_id = 4
                GROUP BY e.brand_id
            ), bali AS (
                SELECT e.brand_name,sum(a.compliance) AS bali
                FROM report_product a
                JOIN store b ON a.store_id = b.store_id
                JOIN product c ON a.product_id = c.product_id
                JOIN store_area d ON b.area_id = d.area_id
                JOIN product_brand e ON c.brand_id = e.brand_id
                WHERE d.area_id = 5
                GROUP BY e.brand_id
            )
            SELECT a.brand_name,a.jakarta,b.jabar,c.kalimantan,d.jateng,e.bali
            FROM dki a
            JOIN jabar b ON a.brand_name = b.brand_name
            JOIN kalimantan c ON a.brand_name = c.brand_name
            JOIN jateng d ON a.brand_name = d.brand_name
            JOIN bali e ON a.brand_name = e.brand_name;
        ");

        $data['grid'] = $query2->result();
     
        $this->load->view('my_chart', $data);  
    }  
}  