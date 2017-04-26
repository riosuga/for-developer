<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oracle_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_oracle','oracle');
		$this->load->library('PHPExcel/PHPExcel');
	}

	public function index()
	{
		$data = $this->oracle->testGetData();
		var_dump($data);
	}

	public function caravan(){
		
	}

	public function testEdit(){
		$fileType = 'Excel2007';
		$fileName = './assets/resource_data/PIB Tidak ada di INSW dan ada di CEISA.xlsx';
		$mimes ='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
		$fileNameDownload = time().'- Laporan.xls'; //save our workbook as this file name

		try{
			$inputFileType = PHPExcel_IOFactory::identify($fileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			// $objReader->setLoadSheetsOnly($fileName);
			$objPHPExcel = $objReader->load($fileName);
			$objPHPExcel->createSheet();
			$j = 2;
			for($i=5701; $i<=5917; $i++){
				ini_set('max_execution_time', 300);
				$objPHPExcel->setActiveSheetIndex(0);
				// $car = 
				$listBarang = $this->oracle->getDataBarangByCar($objPHPExcel->getActiveSheet()->getCell('B'.$i)->getValue());

				foreach ($listBarang as $getto) {
					if(isset($getto['SEQ_PIB'])){
						$objPHPExcel->setActiveSheetIndex(1);
						$objPHPExcel->getActiveSheet()->SetCellValue('A'.$j,"'".$getto['CAR']);
						$objPHPExcel->getActiveSheet()->SetCellValue('B'.$j,"'".$getto['SEQ_PIB']);
						$objPHPExcel->getActiveSheet()->SetCellValue('C'.$j,"'".$getto['SERI_BRG']);
						$objPHPExcel->getActiveSheet()->SetCellValue('D'.$j,"'".$getto['HS_CODE']);
						$objPHPExcel->getActiveSheet()->SetCellValue('E'.$j,"'".$getto['TGL_HS']);
						$objPHPExcel->getActiveSheet()->SetCellValue('F'.$j,"'".$getto['UR_BRG']);
						$objPHPExcel->getActiveSheet()->SetCellValue('G'.$j,"'".$getto['NEG_ASAL']);
						$objPHPExcel->getActiveSheet()->SetCellValue('H'.$j,"'".$getto['JML_KMS']);
						$objPHPExcel->getActiveSheet()->SetCellValue('I'.$j,"'".$getto['JNS_KMS']);
						$objPHPExcel->getActiveSheet()->SetCellValue('J'.$j,"'".$getto['CIF']);
						$objPHPExcel->getActiveSheet()->SetCellValue('K'.$j,"'".$getto['NILAI_PABEAN']);
						$objPHPExcel->getActiveSheet()->SetCellValue('L'.$j,"'".$getto['NILAI_LAINNYA']);
						$objPHPExcel->getActiveSheet()->SetCellValue('M'.$j,"'".$getto['KD_SAT_HRG']);
						$objPHPExcel->getActiveSheet()->SetCellValue('N'.$j,"'".$getto['JML_SAT_HRG']);
						$objPHPExcel->getActiveSheet()->SetCellValue('O'.$j,"'".$getto['KD_SKEP_FAS']);
						$objPHPExcel->getActiveSheet()->SetCellValue('P'.$j,"'".$getto['NETTO']);
						$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$j,"'".$getto['FL_LARBTS']);
						$objPHPExcel->getActiveSheet()->SetCellValue('R'.$j,"'".$getto['FL_RAWAN']);
						$objPHPExcel->getActiveSheet()->SetCellValue('S'.$j,"'".$getto['FL_TAP_PEM']);
						$objPHPExcel->getActiveSheet()->SetCellValue('T'.$j,"'".$getto['NIP_UPD']);
						$objPHPExcel->getActiveSheet()->SetCellValue('U'.$j,"'".$getto['WK_UPD']);
						$objPHPExcel->getActiveSheet()->SetCellValue('V'.$j,"'".$getto['NIP_REKAM']);
						$objPHPExcel->getActiveSheet()->SetCellValue('W'.$j,"'".$getto['WK_REKAM']);
						$objPHPExcel->getActiveSheet()->SetCellValue('X'.$j,"'".$getto['MEREK']);
						$objPHPExcel->getActiveSheet()->SetCellValue('Y'.$j,"'".$getto['TYPE']);
						$objPHPExcel->getActiveSheet()->SetCellValue('Z'.$j,"'".$getto['MUTU']);
						$objPHPExcel->getActiveSheet()->SetCellValue('AA'.$j,"'".$getto['KONDISI_BRG']);
						$objPHPExcel->getActiveSheet()->SetCellValue('AB'.$j,"'".$getto['PERNYATAAN_LARTAS']);
						$j++;
					}else{
						$objPHPExcel->setActiveSheetIndex(1);
						$objPHPExcel->getActiveSheet()->SetCellValue('A'.$j,"'".$car);
						$objPHPExcel->getActiveSheet()->SetCellValue('B'.$j,"'".'Aju bermasalah, ERROR');
						$j++;
					}
				}
			}

			//start writing
			header("Content-Type: $mimes");
			header("Content-Disposition: attachment;filename=\"$fileNameDownload\"");
			header("Cache-Control: max-age=0");

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $fileType); 
			ob_end_clean(); //this for open fix it
			$objWriter->save('php://output');

		}catch(Exception $ex){
			die('Error loading file :"'.pathinfo($fileName, PATHINFO_BASENAME).'": '.$ex->getMessage());
		}
	}

	public function testRead(){
		//buat baca
		$inputFileName = "./assets/resource_data/PIB Tidak ada di INSW dan ada di CEISA.xlsx";
		// echo $inputFileName;
		try{
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
			// $sheetnames = $objReader->listWorksheetNames($inputFileName); for looking for sheet

		}catch(Exception $ex){
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$ex->getMessage());
		}
		
		//  Get worksheet dimensions
		// $objPHPExcel->getSheet(1);
		$objPHPExcel->setActiveSheetIndex(1); //ganti sheet

		for($i=2; $i<=5917; $i++){
			$getError =  $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getValue();
			if($getError == '#N/A'){
				$data = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getValue();
				echo "'".$data."',".'<br>';
			}else{
				continue;
			}
		}


		// $data = $objPHPExcel->getActiveSheet()->getCell('B20')->getValue();
		
	}

}

/* End of file Oracle_c.php */
/* Location: ./application/controllers/Oracle_c.php */