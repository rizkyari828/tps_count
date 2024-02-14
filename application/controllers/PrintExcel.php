<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Login (LoginController)
 * Login class to control to authenticate user credentials and starts user's session.



 */
class PrintExcel extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('suara_model');
        $this->load->library('Excel');
        $this->isLoggedIn();
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            // $tpsId = 1;
            // $this->load->model('suara_model');
			$data = "";
            // $this->global['tps'] = $this->suara_model->selectTps($tpsId);
            // $this->global['caleg'] = $this->suara_model->calegListing($tpsId, $this->global['tps']->status_submit);
            // $this->global['partai'] = $this->suara_model->partaiListing($tpsId, $this->global['tps']->status_submit);
            // $this->global['result_suara'] = $this->suara_model->resultSuara($tpsId);

            // $this->global['tpsId'] = $tpsId;
			
            $this->global['pageTitle'] = 'Quick Count Jateng : Add New Vehicle';

            $this->loadViews("printExcel", $this->global, $data, NULL);
        }
    }

    public function print(){
        $type = $this->security->xss_clean($this->input->post('type'));

        if($type == 'Export Kota'){
            $this->kota();
        }else if($type == 'Export Kelurahan'){
            $this->kelurahan();
        }else if($type == 'Export Kabupaten/Kota'){
            $this->kota();
        }else if($type == 'Export Total'){
            $this->total();
        }else if($type == 'Export Jateng'){
            $this->jateng();
        }else{
            redirect('reportListing');
        }
    }

    function kelurahan(){
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Nama Caleg');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Partai');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Kelurahan');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Kecamatan');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Kota/Kabupaten');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Total Suara');
        date_default_timezone_set('Asia/Jakarta');
        $no = 1;
        $rowCount = 2;

        $partai = $this->suara_model->reportKelurahan();

        foreach ($partai as $key => $value) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $no);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $value->nama_caleg);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $value->partai);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $value->kelurahan);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $value->kecamatan);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $value->kota_kabupaten);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $value->total_suara_kelurahan);

            $no++;
            $rowCount++;
        }


        $filename = "Report Kelurahan.csv";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
        $objWriter->save('php://output');
    }

    function kecamatan(){
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Nama Caleg');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Partai');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Kecamatan');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Kota/Kabupaten');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Total Suara');
        date_default_timezone_set('Asia/Jakarta');
        $no = 1;
        $rowCount = 2;

        $partai = $this->suara_model->reportKecamatan();

        foreach ($partai as $key => $value) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $no);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $value->nama_caleg);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $value->partai);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $value->kecamatan);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $value->kota_kabupaten);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $value->total_suara_kecamatan);

            $no++;
            $rowCount++;
        }


        $filename = "Report Kelurahan.csv";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
        $objWriter->save('php://output');
    }

    function kota(){
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Nama Caleg');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Partai');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Kota/Kabupaten');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Total Suara');
        date_default_timezone_set('Asia/Jakarta');
        $no = 1;
        $rowCount = 2;

        $partai = $this->suara_model->reportKota();

        foreach ($partai as $key => $value) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $no);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $value->nama_caleg);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $value->partai);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $value->kota_kabupaten);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $value->total_suara_kota);

            $no++;
            $rowCount++;
        }

        $filename = "Report Kota.csv";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
        $objWriter->save('php://output');
    }

    function jateng(){
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Nama Caleg');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Partai');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Total Suara');
        date_default_timezone_set('Asia/Jakarta');
        $no = 1;
        $rowCount = 2;

        $partai = $this->suara_model->reportJateng();

        foreach ($partai as $key => $value) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $no);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $value->nama_caleg);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $value->partai);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $value->total_suara_jateng_X);

            $no++;
            $rowCount++;
        }

        $filename = "Report Jateng.csv";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
        $objWriter->save('php://output');
    }

    function total(){
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Partai');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Caleg');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Total Suara');
        date_default_timezone_set('Asia/Jakarta');
        $no = 1;
        $rowCount = 2;

        $partai = $this->suara_model->allPartaiListing();

        foreach ($partai as $key => $value) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $no);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $value->partai);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $value->name);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $value->total);

            $no++;
            $rowCount++;
        }

        $filename = "Report Total.csv";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
        $objWriter->save('php://output');
    }
}
?>