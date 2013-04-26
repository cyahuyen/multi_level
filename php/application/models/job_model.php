<?php

/*
  This model provides all interfaces for job management
 */

class Job_model extends CI_Model {

    function __construct() {
        $this->load->database();
    }

    function add($data) {

        $data['created_by_id'] = $this->session->jobdata('id');
        $data['created_date'] = date('Y-m-d');
        $data['status'] = 'open';

        $this->db->insert('job', $data);
        $id = $this->db->insert_id();
        return $id;
    }

    public function update($data, $id) {
        $dataJob['created_by_id'] = $this->session->userdata('userid');
        $dataJob['created_date'] = date('Y-m-d');
        $dataJob['status'] = 'open';
        $dataJob['title'] = $data['title'];
        $dataJob['customer'] = $data['customer'];
        $dataJob['start_date'] = $data['start_date'];
        $dataJob['days'] = $data['days'];
        $dataJob['location'] = $data['location'];
        $dataJob['details'] = $data['details'];
        $this->db->where('id', $id);
        $this->db->update('job', $dataJob);
        
        $customer = $this->getCustomer($data['customer']);
        if (empty($customer)) {
            $this->insertCustomer($data['customer']);
        }
        $this->db->delete('assigned_staff', array('job_id' => $id));
        if (!empty($data['staff_id'])) {
            $this->insertAssignedStaff($data['staff_id'], $id);
        }
        $this->db->delete('job_product', array('job_id' => $id));
        if (!empty($data['product'])) {
            $this->insertJobProduct($data['product'], $id);
        }

    }

    public function insert($data) {
        $dataJob['created_by_id'] = $this->session->userdata('userid');
        $dataJob['created_date'] = date('Y-m-d');
        $dataJob['status'] = 'open';
        $dataJob['title'] = $data['title'];
        $dataJob['customer'] = $data['customer'];
        $dataJob['start_date'] = $data['start_date'];
        $dataJob['days'] = $data['days'];
        $dataJob['location'] = $data['location'];
        $dataJob['details'] = $data['details'];

        $this->db->insert('job', $dataJob);
        $id = $this->db->insert_id();
        $customer = $this->getCustomer($data['customer']);
        if (empty($customer)) {
            $this->insertCustomer($data['customer']);
        }

        $this->db->delete('assigned_staff', array('job_id' => $id));
        if (!empty($data['staff_id'])) {
            $this->insertAssignedStaff($data['staff_id'], $id);
        }
        
        $this->db->delete('job_product', array('job_id' => $id));
        if (!empty($data['product'])) {
            $this->insertJobProduct($data['product'], $id);
        }

        return $id;
    }

    public function insertAssignedStaff($data, $id) {
        
        foreach ($data as $staff_id) {
            $this->db->insert('assigned_staff', array('staff_id' => $staff_id, 'job_id' => $id));
        }
    }

    public function insertJobProduct($data, $id) {
        
        foreach ($data as $product) {
            $jproduct['product_id'] = $product['id'];
            $jproduct['job_id'] = $id;
            $jproduct['sent'] = $product['sent'];
            $jproduct['used'] = $product['used'];
            $this->db->insert('job_product', $jproduct);

            $cProduct['code'] = $product['code'];
            $cProduct['title'] = $product['title'];
            $this->db->where('id', $product['id']);
            $this->db->update('product', $cProduct);
        }
    }

    public function getCustomerByName($name) {
        $this->db->select("*");
        $this->db->from("customer");
        $this->db->where("name", $name);
        $query = $this->db->get();
        return $query->result();
    }

    public function insertCustomer($name) {
        $this->db->insert('customer', array('name' => $name));
    }

    function close($id) {

        $this->db->where('id', $id);

        $data['closed_by_id'] = $this->session->jobdata('id');
        $data['closed_date'] = date('Y-m-d');
        $data['status'] = 'closed';

        $this->db->update('job', $data);
        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }
    
    public function deactive($id) {
        $this->db->where('id', $id);
        $this->db->update('job', array('status' => 'closed','closed_date' => date('Y-m-d',  time()),'closed_by_id' => $this->session->userdata('userid')));
    }
    public function active($id) {
        $this->db->where('id', $id);
        $this->db->update('job', array('status' => 'open'));
    }

    function get($jobid, $filter = 'all', $search = '', $limit = '', $start = '', $sortby = 'id', $order = 'desc') {

        $this->db->select('*');
        $this->db->from('job');

        if ($filter != 'all')
            $this->db->where('status', $filter);

        if ($search != '')
            $this->db->like('title', $search);

        if ($limit != '' && $start != '')
            $this->db->limit($limit, $start);

        $this->db->order_by($sortby, $order);

        $query = $this->db->get();
        return $query->result();
    }

    public function listJob($data, $limit = null, $start = null, $sort = null) {
        $this->db->select("*");
        $this->db->from("job");

        if (!empty($data)) {
            foreach ($data as $key => $val) {
                if ($key == 'searchby') {

                    $where = "( title LIKE '%" . $val . "%' OR location LIKE '%" . $val . "%')";
                    $this->db->where($where);
                }else
                    $this->db->where($key, $val);
            }
        }

        if ($limit)
            $this->db->limit((int) $limit);

        if ($limit && $start)
            $this->db->limit((int) $limit, (int) $start);

        if (!empty($sort)) {
            foreach ($sort as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function totalJob($data) {
        $this->db->select("*");
        $this->db->from("job");
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                if ($key == 'searchby') {
                    $where = "( title LIKE '%" . $val . "%' OR location LIKE '%" . $val . "%')";
                    $this->db->where($where);
                }else
                    $this->db->where($key, $val);
            }
        }


        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getJobById($id) {
        $this->db->select("*");
        $this->db->from("job");
        $this->db->where('id', $id);

        $query = $this->db->get();
        $result = $query->result();
        return $result[0];
    }

    public function getProductByJobId($id) {
        $this->db->select("product.*");
        $this->db->select("job_product.job_id");
        $this->db->select("job_product.sent");
        $this->db->select("job_product.used");
        $this->db->from("product");
        $this->db->join("job_product", "product.id = job_product.product_id");
        $this->db->where('job_product.job_id', $id);
        $this->db->where('product.status', 1);

        $query = $this->db->get();
        return $query->result();
    }

    public function getProductByProductId($id) {
        $this->db->select("product.*");
        $this->db->select("job_product.job_id");
        $this->db->select("job_product.sent");
        $this->db->select("job_product.used");
        $this->db->from("product");
        $this->db->join("job_product", "product.id = job_product.product_id", 'left');
        $this->db->where('product.id', $id);
        $this->db->where('product.status', 1);

        $query = $this->db->get();
        $result = $query->result();
        return $result[0];
    }

    public function getStaffByJobId($id) {
        $this->db->select("staff.*");
        $this->db->from("staff");
        $this->db->join("assigned_staff", "staff.id = assigned_staff.staff_id");
        $this->db->where('assigned_staff.job_id', $id);
        $this->db->where('staff.status', 1);

        $query = $this->db->get();
        return $query->result();
    }

    public function getStaffByListStaffId($listId) {
        $this->db->select("staff.*");
        $this->db->from("staff");
        $this->db->where_in('staff.id', $listId);

        $query = $this->db->get();
        return $query->result();
    }

    public function getCustomer($name) {
        $this->db->select("DISTINCT(`customer`)");
        $this->db->from("job");
        $this->db->like("customer", $name);
        $query = $this->db->get();
        return $query->result();
    }

}