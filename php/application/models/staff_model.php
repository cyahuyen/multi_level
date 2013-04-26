<?php

/*
  This model provides all interfaces for staff management
 */

class Staff_model extends CI_Model {

    public function listStaff($data, $limit = null, $start = null, $sort = null) {
        $this->db->select("*");
        $this->db->from("staff");

        if (!empty($data)) {
            foreach ($data as $key => $val) {
                if ($key == 'searchby') {
                    $where = "( name LIKE '%" . $val . "%' OR mobile LIKE '%" . $val . "%' OR phone LIKE '%" . $val . "%' OR email LIKE '%" . $val . "%' )";
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

    public function totalStaff($data) {
        $this->db->select("*");
        $this->db->from("staff");

        if (!empty($data)) {
            foreach ($data as $key => $val) {
                if ($key == 'searchby') {
                    $where = "( name LIKE '%" . $val . "%' OR mobile LIKE '%" . $val . "%' OR phone LIKE '%" . $val . "%' OR email LIKE '%" . $val . "%' )";
                    $this->db->where($where);
                }else
                    $this->db->where($key, $val);
            }
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function totalStaffHistory($data) {

        $this->db->select("*");
        $this->db->from("staff");
        $this->db->join("assigned_staff", "staff.id = assigned_staff.staff_id");
        $this->db->join("job", "job.id = assigned_staff.job_id");

        if (!empty($data)) {
            foreach ($data as $key => $val) {
                if ($key == 'searchby') {
                    $where = "( job.title LIKE '%" . $val . "%' OR job.location LIKE '%" . $val . "%' )";
                    $this->db->where($where);
                }else
                    $this->db->where($key, $val);
            }
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function listStaffHistory($data, $limit = null, $start = null, $sort = null) {
        $this->db->select("assigned_staff.*");
        $this->db->select("job.created_date");
        $this->db->select("job.created_by_id");
        $this->db->select("job.closed_date");
        $this->db->select("job.closed_by_id");
        $this->db->select("job.status");
        $this->db->select("job.title");
        $this->db->select("job.customer");
        $this->db->select("job.start_date");
        $this->db->select("job.days");
        $this->db->select("job.location");
        $this->db->from("staff");
        $this->db->join("assigned_staff", "staff.id = assigned_staff.staff_id");
        $this->db->join("job", "job.id = assigned_staff.job_id");

        if (!empty($data)) {
            foreach ($data as $key => $val) {
                if ($key == 'searchby') {
                    $where = "( job.title LIKE '%" . $val . "%' OR job.location LIKE '%" . $val . "%' )";
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

    public function getStaffById($id) {
        $this->db->select("*");
        $this->db->from("staff");
        $this->db->where('id', $id);

        $query = $this->db->get();
        $result = $query->result();
        return $result[0];
    }

    public function insert($data) {


        $this->db->insert('staff', $data);

        $staff_id = $this->db->insert_id();

        return $staff_id;
    }

    public function update($data, $id) {

        $this->db->where('id', $id);
        $this->db->update('staff', $data);
    }

    public function deactive($id) {
        $this->db->where('id', $id);
        $this->db->update('staff', array('status' => 0));
    }
    public function history_deactive($id) {
        $this->db->delete('assigned_staff', array('id' => $id));
    }

    public function active($id) {
        $this->db->where('id', $id);
        $this->db->update('staff', array('status' => 1));
    }

}

?>
