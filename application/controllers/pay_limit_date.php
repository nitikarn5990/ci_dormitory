<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class pay_limit_date extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {

        parent::__construct();

        if ($this->session->userdata('is_logged_in') == '') {

            $this->session->set_userdata('url_back', current_url());
            redirect('auth/login');
        }
    }


    public function edit($id) {

        $this->db->select('*');
        $this->db->from('pay_limit_date');
        $this->db->where('id = ' . $id);
        $this->db->limit(1);
        $this->db->order_by("id", "asc");
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
//
            // $row = $query->row_array();

            $row = $query->row_array();

            $data = array(
                'id' => $row['id'],
                'day' => $row['day'],
            
            );


            $data = array(
                'content' => $this->load->view('pay_limit_date/edit', $data, true),
            );
            $this->load->view('main_layout', $data);
        } else {
             $data = array(
                'content' => $this->load->view('pay_limit_date/edit', '', true),
            );
            $this->load->view('main_layout', $data);
        }
    }


    public function update() {

        if ($this->input->post('btn_submit') == 'บันทึก' || $this->input->post('btn_submit') == 'บันทึกและแก้ไขต่อ') {

            if ($this->input->post('btn_submit') == 'บันทึก') {
                $redirect = true;
            } else {
                $redirect = false;
            }

            $dataInsert = array(
                'day' => $this->input->post('day'),
                'updated_at' => DATE_TIME,
            );

            $this->db->where('id', $this->input->post('id'));
            if ($this->db->update('pay_limit_date', $dataInsert)) {

                $this->session->set_flashdata('message_success', 'แก้ไขข้อมูลแล้ว');
               

                    redirect('pay_limit_date/edit/' . $this->input->post('id'));
                
            }
        }
     
    }
}
