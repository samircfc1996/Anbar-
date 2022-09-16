<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


$con=mysqli_connect("localhost","samir","12345","anbar");
$tarix=date("Y-m-d H:i:s");

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B2', '#')
            ->setCellValue('C2', 'Ad')
            ->setCellValue('D2', 'Soyad')
            ->setCellValue('E2', 'Brend')
            ->setCellValue('F2', 'Məhsul')
            ->setCellValue('G2', 'Alış')
            ->setCellValue('H2', 'Satış')
            ->setCellValue('I2', 'Miqdar')
            ->setCellValue('J2', 'Sifariş')
            ->setCellValue('K2', 'Tarix');


$sec=mysqli_query($con,"SELECT brand.ad AS bad,
						product.ad AS pad, product.alis, product.satis, product.miqdar AS pmiqdar,
						client.ad AS cad, client.soyad,
						orders.id, orders.miqdar AS smiqdar, orders.tarix, orders.tesdiq
 						FROM brand, product, client, orders
 						WHERE 
 						 brand.id=product.brand AND
 						product.id=orders.product_id AND 
 						client.id=orders.client_id");

$info=mysqli_fetch_array($sec);

$i=0;
$n=2;

do{

	$i++;
	$n++;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$n, $i)
            ->setCellValue('C'.$n, $info['cad'])
            ->setCellValue('D'.$n, $info['soyad'])
            ->setCellValue('E'.$n, $info['bad'])
            ->setCellValue('F'.$n, $info['pad'])
            ->setCellValue('G'.$n, $info['alis'])
            ->setCellValue('H'.$n, $info['satis'])
            ->setCellValue('I'.$n, $info['pmiqdar'])
            ->setCellValue('J'.$n, $info['smiqdar'])
            ->setCellValue('K'.$n, $info['tarix']);
}
while($info=mysqli_fetch_array($sec));

 						


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="sifaris-'.$tarix.'.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
