<?php

require_once '../../../config/DataBase.php';

class Reportes {
	
public $db;


public function __construct() {
$this->db = Database::connect();
}
public function MostrarInformacionEmpresa() {
$sql = "SELECT * FROM datos_empresa ";
$resul = $this->db->query($sql);
return $resul;
}

public function ReportesCompras($fechaInicial,$fechaFinal) {

		
if($fechaInicial == $fechaFinal){
$sql = "SELECT s.nombre, t.*, SUM(t.total) AS total FROM traslado_mercancia t INNER JOIN sucursal s ON t.id_sucursal=s.id AND fecha  LIKE '%$fechaFinal%' GROUP BY  t.id_sucursal";
			
} else {
			
$fechaActual = new DateTime();
$fechaActual->add(new DateInterval("P1D"));
$fechaActualMasUno = $fechaActual->format("Y-m-d");

$fechaFinal2 = new DateTime($fechaFinal);
$fechaFinal2->add(new DateInterval("P1D"));
$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

if ($fechaFinalMasUno == $fechaActualMasUno) {

$sql = "SELECT s.nombre, t.*, SUM(t.total) AS total FROM traslado_mercancia t INNER JOIN sucursal s ON t.id_sucursal=s.id AND fecha BETWEEN  '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY  t.id_sucursal";
} else {
$sql = "SELECT s.nombre, t.*, SUM(t.total) AS total FROM traslado_mercancia t INNER JOIN sucursal s ON t.id_sucursal=s.id AND fecha BETWEEN  '$fechaInicial' AND '$fechaFinal'GROUP BY  t.id_sucursal";
}
}
		
		
$resul = $this->db->query($sql);
return $resul;
}

}


//require_once '../../../controllers/ClienteController.php';
//require_once '../../../controllers/InventarioController.php';
class imprimirReporte{

public $fechaInicial;
public $fechaFinal;

public function traerImpresionReporte(){
$fechaInicial = $this->fechaInicial;
$fechaFinal = $this->fechaFinal;

$reporte = new Reportes();
$detalles = $reporte->ReportesCompras($fechaInicial,$fechaFinal);
$fechaI = $_GET['fechaInicial'];

$datosEmpresa = $reporte->MostrarInformacionEmpresa();

foreach ($datosEmpresa as $key => $valueE) {
$nomEmpresa = $valueE['nombre'];
$nitEmpresa = $valueE['nit'];
$dirEmpresa = $valueE['direccion'];
$ciuEmpresa = $valueE['ciudad'];
$depEmpresa = $valueE['departamento'];
$telEmpresa = $valueE['telefono'];
}

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//$pdf->setPrintHeader(false);
//$pdf->setPrintFooter(false);
$pdf->startPageGroup();

$pdf->AddPage();

$bloque1 = <<<EOF
<table>
		
		<tr>
			
			<td style="width:170px">
				
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
									
					<h3>$nomEmpresa</h3>				
					
				</div>
			</td>

			<td style="background-color:white; width:120px">
				
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					NIT: $nitEmpresa

					<br>
					$dirEmpresa

				</div>

			</td>

			<td style="background-color:white; width:120px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					Teléfono: $telEmpresa
					
					<br>
					$ciuEmpresa -- $depEmpresa

				</div>
				
			</td>

			<td style="background-color:white; width:120px; text-align:center; color:red">
				<br><br>
					Reporte de compras por proveedor
					<div style="font-size:8.5px; text-align:right; line-height:15px;">
					Fecha Inicio: $fechaI
					<br>
					
					Fecha Final: $fechaFinal
					

				</div>
					
		
				</td>

		</tr>
		

	</table>

		
EOF;

$pdf->writeHTML($bloque1 ,false, false, false, false, '');
// ---------------------------------------------------------

// ---------------------------------------------------------


$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px; border: 1px solid #666;">

		<tr>
		<th style="border: 1px solid #666; background-color:white; width:60px; text-align:center; font-weight: bold">Codigo</th>
		<th style="border: 1px solid #666; background-color:white; width:240px; text-align:center; font-weight: bold">Nombre proveedor</th>
		<th style="border: 1px solid #666; background-color:white; width:85px; text-align:center; font-weight: bold">-------</th>
		<th style="border: 1px solid #666; background-color:white; width:75px; text-align:center; font-weight: bold">-------</th>
		<th style="border: 1px solid #666; background-color:white; width:75px; text-align:center; font-weight: bold">Valor</th>						
	

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');


foreach ($detalles as $key => $value) {

$id = $value['id_sucursal'];
$nombre = $value['nombre'];
$venta = number_format($value['total']);


$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			<td style="color:#333; background-color:white; width:60px; text-align:left">
			$id
			</td>
		
			<td style="color:#333; background-color:white; width:240px; text-align:left">
			$nombre
			</td>
		
			<td style=" color:#333; background-color:white; width:85px; text-align:center">
			
			</td>
			<td style=" color:#333; background-color:white; width:75px; text-align:center">
			
			-------
			</td>
		
			<td style=" color:#333; background-color:white; width:75px; text-align:center">
			$venta
			</td>
		


		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');
}
// ---------------------------------------------------------

$bloque5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">
		<tr>
		
			<td style=" color:#333; background-color:white; width:535px; text-align:left"></td>
		</tr>
		<tr>
		<td style="border: 1px solid #666; background-color:white; width:535px; text-align:center; font-weight: bold">
			reporte compras por sucursal
		</td>			

		</tr>

	</table>

EOF;
$pdf->writeHTML($bloque5, false, false, false, false, '');
//SALIDA DEL ARCHIVO 
$pdf->Output('factura.pdf');
}

}

$reporte = new imprimirReporte();
$reporte-> fechaInicial = $_GET["fechaInicial"];
$reporte-> fechaFinal = $_GET["fechaFinal"];

$reporte ->traerImpresionReporte();

?>
