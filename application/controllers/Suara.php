<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Vehicles (VehiclesController)
 * Vehicle Class to control all user related operations.



 */
class Suara extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('suara_model');
        $this->isLoggedIn(); 
    }
    
    /**
     * This function used to load the first screen of the Vehicle
     */
    public function index()
    { 
        $this->global['pageTitle'] = 'Quick Count Jateng : Dashboard';
        
        $this->loadViews("back_end/dashboard", $this->global, NULL , NULL);
    }
    
    /**
     * This function is used to load the Vehicles list
     */
    function vehicleListing()
    {
        if($this->isAllAccess() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
			$this->global['searchBody'] = 'Yes';
			
            $data['vehicleRecords'] = $this->suara_model->vehicleListing();
            $this->global['pageTitle'] = 'Quick Count Jateng : Vehicle Listing';
            
            $this->loadViews("back_end/suara/vehicles", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addNewVehi($tpsId = null, $status_submit = 0)
    {
        if($this->isAllAccess() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('suara_model');
			$data = "";
            $this->global['tps'] = $this->suara_model->selectTps($tpsId);
            $this->global['caleg'] = $this->suara_model->calegListing($tpsId, $this->global['tps']->status_submit);
            $this->global['partai'] = $this->suara_model->partaiListing($tpsId, $this->global['tps']->status_submit);
            $this->global['result_suara'] = $this->suara_model->resultSuara($tpsId);
            if($this->vendorId == 1){
                $this->global['status_submit'] = 0;
            }else{
                $this->global['status_submit'] = $status_submit;
            }
            
            $this->global['tpsId'] = $tpsId;
			
            $this->global['pageTitle'] = 'Quick Count Jateng : Add New Vehicle';

            $this->loadViews("back_end/suara/addVehicle", $this->global, $data, NULL);
        }
    }

    function selectTps()
    {
        if($this->isAllAccess() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('suara_model');
            $this->load->model('user_model');
			$data = "";
            
            $user = $this->user_model->getDetailUser($this->vendorId);

            if($this->role == 1){
                $this->global['kelurahan'] = $this->suara_model->getKelurahan($user->id_kecamatan, $this->role);
                $this->global['kabupaten'] = $this->suara_model->getKabupaten($user->id_kecamatan, $this->role);
                $this->global['kecamatan'] = $this->suara_model->getKecamatan($user->id_kecamatan, $this->role);
            }else{
                $this->global['kelurahan'] = $this->suara_model->getKelurahan($user->id_kecamatan, $this->role);
            }
            $this->global['role'] = $this->role;
            // print_r($this->global['kelurahan']); die;
			
            $this->global['pageTitle'] = 'Quick Count Jateng : Add New Vehicle';

            $this->loadViews("back_end/suara/selectTps", $this->global, $data, NULL);
        }
    }
    /**
     * This function is used to add new Vehicle to the system
     */
    function addNewVehicle()
    {
        if($this->isAllAccess() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            $this->load->model('suara_model');
			$type = $this->security->xss_clean($this->input->post('type'));

            if($type == 'select')
            {
                $tpsId = $this->security->xss_clean($this->input->post('tps_id'));
                $tps = $this->suara_model->selectTps($tpsId);
                $status_submit = $this->security->xss_clean($tps->status_submit);
                $this->addNewVehi($tpsId, $status_submit);
            }
            else
            {
                $total = $_POST['total'];
                $id_caleg = $_POST['id_caleg'];
                $id_input = $_POST['id_input'];
                $tps_id = $this->security->xss_clean($this->input->post('tps_id'));
                
                
                $tps = $this->suara_model->selectTps($tps_id);
                $result = $this->suara_model->addSuara($total, $id_caleg, $tps_id, $tps->status_submit, $id_input);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'suara berhasil disimpan');
                }
                else
                {
                    $this->session->set_flashdata('error', 'suara gagal disimpan, mohon coba kembali');
                }
                
                redirect('selectTps');
            }
        }
    }

    
    /**
     * This function is used load Vehicle edit information
     * @param number $vehiclesId : Optional : This is vehicle id
     */
    function modifyVehicle($vehicleId = NULL)
    {
         if($this->isAllAccess() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($vehicleId == null)
            {
                redirect('vehicleListing');
            }
            $data['vehicleInfo'] = $this->suara_model->getVehicleInfo($vehicleId);
			
			$this->global['edit_customers'] = $this->suara_model->getCustomersName();

            $this->global['pageTitle'] = 'Quick Count Jateng : Edit Vehicle';
            
            $this->loadViews("back_end/suara/modifyVehicle", $this->global, $data, NULL);
        }
    }
    
    
	
	  /**
     * This function is used load vehicle view information
     * @param number $vehicleId : Optional : This is vehicle id
     */
    function viewVehicle($vehicleId = NULL)
    {
        if($this->isAllAccess() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($vehicleId == null)
            {
                redirect('vehicleListing');
            }
            $data = "";
            $this->global['vehicleInfo'] = $this->suara_model->getVehicleInfoById($vehicleId);
            
            $this->global['pageTitle'] = 'Quick Count Jateng : View Vehicle';
            
            $this->loadViews("back_end/suara/viewVehicle", $this->global, $data, NULL);
        }
    }
    
	
    /**
     * This function is used to edit the Vehicle information
     */
    function editVehicle()
    {
        if($this->isAllAccess() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            //$data = "";
			//$data['customers'] = $this->suara_model->getCustomersName();
			//pre($data['customers']);
			//$str = $this->db->last_query();
            //pre($str);
			//exit;
            $this->load->library('form_validation');
            
			
			$vehicleId = $this->input->post('vehicleId');
			
            //$this->form_validation->set_rules('cid','Customer Name','required|in_list['.implode(array_keys($data["customers"]),',').']');
			$this->form_validation->set_rules('vehiclemake','Vehicle Make','trim|required');
			$this->form_validation->set_rules('vehiclemodel','Vehicle Model','trim|required');
			$this->form_validation->set_rules('vehicleregistrationnumber','Vehicle Registration Number','trim|required');
			$this->form_validation->set_rules('vehiclenumber','Vehicle Number','trim|required');
			$this->form_validation->set_rules('gpskitinstalldate','GPS Kit Install Date','trim|required');
			$this->form_validation->set_rules('eminumber','EMI Number','trim|required');
			$this->form_validation->set_rules('gpskitmobilenumber','GPS Kit Mobile Number','trim|required');
			$this->form_validation->set_rules('erpportalassociation','ERP Portal Association','trim|required');
			$this->form_validation->set_rules('erpportalusername','ERP Portal Username','trim|required');
			
			$this->load->library('form_validation');
            
            $vehicleId = $this->input->post('vehicleId');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->modifyVehicle($vehicleId);
            }
            else
            {   //pre($_POST);
                $cid = $this->security->xss_clean($this->input->post('cid'));
                $vehiclemake = $this->security->xss_clean($this->input->post('vehiclemake'));
                $vehiclemodel = $this->security->xss_clean($this->input->post('vehiclemodel'));
				$vehiclemadeyear = $this->security->xss_clean($this->input->post('vehiclemadeyear'));
				$vehicleregistrationnumber = $this->security->xss_clean($this->input->post('vehicleregistrationnumber'));
				$vehiclenumber = $this->security->xss_clean($this->input->post('vehiclenumber'));
				$ownername = ucwords(strtolower($this->security->xss_clean($this->input->post('ownername'))));
				$gpskitinstalldate = $this->security->xss_clean($this->input->post('gpskitinstalldate'));
				$eminumber = $this->security->xss_clean($this->input->post('eminumber'));
				$gpskitmobilenumber = $this->security->xss_clean($this->input->post('gpskitmobilenumber'));
				$gpsdevicemodelnumber = $this->security->xss_clean($this->input->post('gpsdevicemodelnumber'));
				$erpportalassociation = $this->security->xss_clean($this->input->post('erpportalassociation'));
				$erpportalusername = $this->security->xss_clean($this->input->post('erpportalusername'));
				$nextrenewaldate = $this->security->xss_clean($this->input->post('nextrenewaldate'));
				$installbystaff = ucwords(strtolower($this->security->xss_clean($this->input->post('installbystaff'))));
				$communication = $this->security->xss_clean($this->input->post('communication'));
				$address = $this->security->xss_clean($this->input->post('address'));
                
                $vehicleInfo = array();
                
                if($vehiclemake)
                {
                    									
				$vehicleInfo = array('cid'=> $cid, 'vehiclemake'=>$vehiclemake, 'vehiclemodel'=>$vehiclemodel, 'vehiclemadeyear'=> $vehiclemadeyear, 'vehicleregistrationnumber'=> $vehicleregistrationnumber, 'vehiclenumber'=> $vehiclenumber, 'ownername'=> $ownername, 'gpskitinstalldate'=> $gpskitinstalldate, 'eminumber'=> $eminumber, 'gpskitmobilenumber'=> $gpskitmobilenumber, 'gpsdevicemodelnumber'=> $gpsdevicemodelnumber, 'erpportalassociation'=> $erpportalassociation, 'erpportalusername'=> $erpportalusername, 'nextrenewaldate'=> $nextrenewaldate, 'installbystaff'=> $installbystaff, 'communication'=> $communication, 'address'=> $address, 'updated_at'=>date('Y-m-d H:i:s'));
                }
               
                $result = $this->suara_model->editVehicle($vehicleInfo, $vehicleId);
			
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Vehicle updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Vehicle updation failed');
                }
                
                redirect('suara/modifyVehicle/'.$vehicleId.'');
            }
        }
    }


    /**
     * This function is used to delete the Vehicle using vehicleId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteVehicle()
    {
        if($this->isAllAccess() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $id = $this->input->post('id');
            
            $result = $this->suara_model->deleteVehicle($id);
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }

    public function listTps()
    {
        $kelurahan = $this->input->post('kelurahan');

        echo '<option value="">Pilih TPS</option>';
        foreach ($this->suara_model->tpsListing($kelurahan, $this->role) as $tps) :
            $tpsName = $tps->name;
            echo '<option value="' . $tps->id . '"  >' . $tpsName . '</option>';
        endforeach;
    }

    public function listKecamatan()
    {
        $kabupaten = $this->input->post('kabupaten');

        echo '<option value="">Pilih Kecamatan</option>';
        foreach ($this->suara_model->getKecamatan($kabupaten, $this->role) as $tps) :
            $tpsName = $tps->name;
            echo '<option value="' . $tps->id . '"  >' . $tpsName . '</option>';
        endforeach;
    }

    public function listKelurahan()
    {
        $kecamatan = $this->input->post('kecamatan');

        echo '<option value="">Pilih Kelurahan</option>';
        foreach ($this->suara_model->getKelurahan($kecamatan, $this->role) as $tps) :
            $tpsName = $tps->name;
            echo '<option value="' . $tps->id . '"  >' . $tpsName . '</option>';
        endforeach;
    }
    
}

?>