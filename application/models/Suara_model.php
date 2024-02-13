<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Suara_model extends CI_Model
{
    
	   /**
     * This function is used to get the vehicle listing 
     * @return array $result : This is result
     */
    function vehicleListing()
    {
        $this->db->select('BaseTbl.id, BaseTbl.cid, BaseTbl.ownername, BaseTbl.vehiclenumber, BaseTbl.erpportalusername, BaseTbl.gpskitmobilenumber, BaseTbl.created_at');
        $this->db->from('tbl_vehicles as BaseTbl');
        $this->db->where('BaseTbl.status', 'A');
        $this->db->order_by('BaseTbl.id', 'DESC');
        $query = $this->db->get();
        
        $result = $query->result();
        return $result;
    }

    function calegListing($id_tps, $status = 0)
    {
        $partai = ['Partai Kebangkitan Bangsa', 'Partai Demokrasi Indonesia Perjuangan', 'Partai Golongan Karya'];
        if($status == 0){
        $this->db->select('c.*');
        $this->db->from('tbl_caleg as c');
        $this->db->where_in('partai', $partai);
        $this->db->order_by('c.no_urut_partai', 'asc');
        $this->db->order_by('c.no_urut', 'asc');
        
        $query = $this->db->get();

        }else{
        $this->db->select('c.*, u.total_suara, u.id_tps, u.id as id_input');
        $this->db->from('tbl_caleg as c');
        $this->db->join('tbl_input_data as u', 'c.id = u.id_caleg', 'left');
        $this->db->where_in('c.partai', $partai);
        $this->db->where('u.id_tps', $id_tps);
        $this->db->order_by('c.no_urut_partai', 'asc');
        $this->db->order_by('c.no_urut', 'asc');
       
        $query = $this->db->get();
        }
        $result = $query->result();
        return $result;
    }

    function partaiListing($id_tps, $status = 0)
    {
        $partai = ['Partai Kebangkitan Bangsa', 'Partai Demokrasi Indonesia Perjuangan', 'Partai Golongan Karya'];
        if($status == 0){
        $this->db->select('c.*');
        $this->db->from('tbl_caleg as c');
        $this->db->where_not_in('partai', $partai);
        $this->db->order_by('c.no_urut_partai', 'asc');
        $this->db->order_by('c.no_urut', 'asc');
        
        $query = $this->db->get();

        }else{
        $this->db->select('c.*, u.total_suara, u.id_tps, u.id as id_input');
        $this->db->from('tbl_caleg as c');
        $this->db->join('tbl_input_data as u', 'c.id = u.id_caleg', 'left');
        $this->db->where_not_in('partai', $partai);
        $this->db->where('u.id_tps', $id_tps);
        $this->db->order_by('c.no_urut_partai', 'asc');
        $this->db->order_by('c.no_urut', 'asc');
        
        $query = $this->db->get();
        }
        $result = $query->result();
        return $result;
    }

    function allPartaiListing()
    {
        $this->db->select('c.*, SUM(DISTINCT u.total_suara) as total');
        $this->db->from('tbl_caleg as c');
        $this->db->join('tbl_input_data as u', 'c.id = u.id_caleg', 'left');
        $this->db->order_by('total', 'desc');
        $this->db->group_by('c.partai');
        $query = $this->db->get();
        
        $result = $query->result();
        return $result;
    }
    
    function dashboardCalegListing($status = 0)
    {
        $partai = ['Partai Kebangkitan Bangsa', 'Partai Demokrasi Indonesia Perjuangan', 'Partai Golongan Karya'];
        $this->db->select('c.*, SUM(DISTINCT u.total_suara) as total');
        $this->db->from('tbl_caleg as c');
        $this->db->join('tbl_input_data as u', 'c.id = u.id_caleg', 'left');
        if($status == 0){
            $this->db->where_not_in('partai', $partai);
        }else if($status == 1){
            $this->db->where_in('partai', $partai);
        }
        if($status == 2){
            $this->db->order_by('total', 'desc');
        }else{
            $this->db->order_by('c.no_urut_partai', 'asc');
            $this->db->order_by('c.no_urut', 'asc');
        }

        $this->db->group_by('u.id_caleg');

        $query = $this->db->get();
        
        $result = $query->result();
        return $result;
    }

    function dashboardPartaiListing($status = 0)
    {
        $partai = ['Partai Kebangkitan Bangsa', 'Partai Demokrasi Indonesia Perjuangan', 'Partai Golongan Karya'];
        $this->db->select('c.*, SUM(DISTINCT u.total_suara) as total');
        $this->db->from('tbl_caleg as c');
        $this->db->join('tbl_input_data as u', 'c.id = u.id_caleg', 'left');
        if($status == 0){
            $this->db->where_not_in('partai', $partai);
        }else if($status == 1){
            $this->db->where_in('partai', $partai);
        }
        if($status == 2){
            $this->db->order_by('total', 'desc');
        }else{
            $this->db->order_by('c.no_urut_partai', 'asc');
            $this->db->order_by('c.no_urut', 'asc');
        }

        $this->db->group_by('c.partai');

        $query = $this->db->get();
        
        $result = $query->result();
        return $result;
    }

    function perolehanKursiListing()
    {
        $this->db->select('c.*, SUM(DISTINCT u.total_suara) as total');
        $this->db->from('tbl_caleg as c');
        $this->db->join('tbl_input_data as u', 'c.id = u.id_caleg', 'left');
        $this->db->order_by('total', 'desc');
        $this->db->group_by('c.partai');
        $query = $this->db->get();
        
        $result = $query->result();
        return $result;
    }

    function dashboardSaintLeague()
    {
        $this->db->select('c.*, SUM(DISTINCT u.total_suara) as total');
        $this->db->from('tbl_caleg as c');
        $this->db->join('tbl_input_data as u', 'c.id = u.id_caleg', 'left');
        $this->db->order_by('total', 'desc');
        $this->db->group_by('u.id_caleg');
        $query = $this->db->get();
        
        $result = $query->result();
        return $result;
    }

    function selectTps($tpsId)
    {
        $this->db->select('*');
        $this->db->from('tbl_tps');
        // $this->db->order_by('partai', 'asc');
        $this->db->where('id', $tpsId);
        $query = $this->db->get();
        
        $result = $query->row();
        return $result;
    }


    function getKelurahan($id_kecamatan, $role)
    {
        $this->db->select('*');
        $this->db->from('tbl_kelurahan');
        $this->db->order_by('name', 'asc');
        // if($role != 1){
            $this->db->where('id_kecamatan', $id_kecamatan);
        // }
        $query = $this->db->get();
        
        $result = $query->result();
        return $result;
    }

    function getKecamatan($id, $role)
    {
        // echo $id; die;
        $this->db->select('*');
        $this->db->from('tbl_kecamatan');
        $this->db->order_by('name', 'asc');
        $this->db->where('id_kabupaten', $id);
        $query = $this->db->get();
        
        $result = $query->result();
        return $result;
    }

    function getKabupaten($id, $role)
    {
        $this->db->select('*');
        $this->db->from('tbl_kabupaten');
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        
        $result = $query->result();
        return $result;
    }

    function tpsListing($id_kelurahan, $role)
    {
        // echo $role; die;
        $this->db->select('*');
        $this->db->from('tbl_tps');
        $this->db->order_by('name', 'asc');
        $this->db->where('id_kelurahan', $id_kelurahan);
        // if($role != 1){
        //     $this->db->where('status_submit', 0);
        // }
        
        $query = $this->db->get();
        
        $result = $query->result();
        return $result;
    }

    function resultSuara($id_tps)
    {
        // echo $id_tps; die;
        $this->db->select('*');
        $this->db->from('tbl_input_data');
        $this->db->where('id_tps', $id_tps);
        
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
        
    /**
     * This function is used to add new vehicle to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewVehicle($vehicleInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_vehicles', $vehicleInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get vehicle information by id
     * @param number $userId : This is vehicle id
     * @return array $result : This is vehicle information
     */
    function getVehicleInfo($vehicleId)
    {
        $this->db->from('tbl_vehicles');
        $this->db->where('status', 'A');
        $this->db->where('id', $vehicleId);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    /**
     * This function is used to update the vehicle information
     * @param array $vehicleInfo : This is vehicles updated information
     * @param number $vehicleId : This is vehicle id
     */
    function editVehicle($vehicleInfo, $vehicleId)
    {
        $this->db->where('id', $vehicleId);
        $this->db->update('tbl_vehicles', $vehicleInfo);
        
        return TRUE;
    }
    
    /**
     * This function is used to delete the vehicle information
     * @param number $vehicleId : This is vehicle id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteVehicle($id)
    {
		$this->db->where('id', $id);
		$this->db->delete('tbl_vehicles');
        
        return $this->db->affected_rows();
    }

    /**
     * This function used to get vehicle information by id
     * @param number $vehicleId : This is vehicle id
     * @return array $result : This is vehicle information
     */
    function getVehicleInfoById($vehicleId)
    {
        $this->db->from('tbl_vehicles');
        $this->db->where('status', 'A');
        $this->db->where('id', $vehicleId);
        $query = $this->db->get();
        
        return $query->row();
    }


/**
     * This function used to get customer information by id
     * @param number $cid : This is customer id
     * @return array $result : This is Customer information
     */
    function getCustomerInfoById($cId)
    {
        $this->db->select('id, fullname');
        $this->db->from('tbl_customers');
        $this->db->where('status', 'A');
        $this->db->where('id', $cId);
        $query = $this->db->get();
        
        return $query->row();
    }

/**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    function getCustomersName()
    {
        $this->db->select('id, fullname');
        $this->db->from('tbl_customers');
		$this->db->order_by('fullname', 'ASC');
        $query = $this->db->get();
        
        return $query->result();
    }

    function inputDataListing()
    {
        $this->db->select('*');
        $this->db->from('tbl_input_data');
        $query = $this->db->get();
        
        $result = $query->result();
        return $result;
    }

    function addSuara($total, $id_caleg, $tps_id, $status_submit, $id_input){
        $allCaleg = $this->allPartaiListing();
        $countAllCaleg = count($allCaleg);
        $countTotal = [];

        foreach ($total as $key => $value) {
            if($value == 0 || $value == null){
            }else{
                array_push($countTotal,$value);
            }
        }

        $lengthTotal = count($countTotal);
        $statusComplete = 0;
        if($lengthTotal == $countAllCaleg){
            $statusComplete = 1;
        }

        foreach ($id_caleg as $key => $value) {
        //     echo '<pre>';
        // print_r($status_submit);
        // echo '</pre>';
        // die;
        // echo $total[$key];
            $data['total_suara'] = $total[$key];
            if($status_submit == 0){
                $data['id_caleg']   = $value;
                $data['id_tps']   = $tps_id;
                $q = $this->db->insert('tbl_input_data', $data);
            }else{
                $this->db->where('id', $id_input[$key]);
                $q = $this->db->update('tbl_input_data', $data);
            }
            
        }

        if($lengthTotal == $countAllCaleg){
            $status = array(
                'status_complete' => $statusComplete,
                'status_submit' => 1,
            );
        }else{
            $status = array(
                'status_submit' => 1,
            );
        }

        $this->db->where('id', $tps_id);
        $this->db->update('tbl_tps', $status);
        
        return $q;
    }

    function reportKelurahanListing()
    {
        $this->db->select('c.*, SUM(DISTINCT u.total_suara) as total, p.id_kelurahan, kl.name as nama_kelurahan, kc.name as nama_kecamatan, k.name as nama_kabupaten');
        $this->db->from('tbl_caleg as c');
        $this->db->join('tbl_input_data as u', 'c.id = u.id_caleg', 'left');
        $this->db->join('tbl_tps as p', 'u.id_tps = p.id', 'left');
        $this->db->join('tbl_kelurahan as kl', 'kl.id = p.id_kelurahan', 'left');
        $this->db->join('tbl_kecamatan as kc', 'kc.id = kl.id_kecamatan', 'left');
        $this->db->join('tbl_kabupaten as k', 'k.id = kc.id_kabupaten', 'left');

        $this->db->order_by('total', 'desc');
        $this->db->group_by('p.id_kelurahan');
        $query = $this->db->get();
        
        $result = $query->result();

        echo '<pre>';
        print_r($result);
        echo '</pre>';
        die;
        return $result;
    }

    function getStLeague()
    {
        $this->db->select('*');
        $this->db->from('hitung_st_league');
        $query = $this->db->get();
        
        $result = $query->result();
        return $result;
    }
}