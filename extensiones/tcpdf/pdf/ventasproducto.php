<?php

require_once '../../../config/DataBase.php';

class Reportes {
	
public $db;


public function __construct() {
$this->db = Database::connect();
}	

public function ReportesCompras($fechaInicial,$fechaFinal) {

		
if($fechaInicial == $fechaFinal){
$sql = "SELECT * FROM venta_producto WHERE fecha LIKE '%$fechaFinal%'";
			
} else {
			
$fechaActual = new DateTime();
$fechaActual->add(new DateInterval("P1D"));
$fechaActualMasUno = $fechaActual->format("Y-m-d");

$fechaFinal2 = new DateTime($fechaFinal);
$fechaFinal2->add(new DateInterval("P1D"));
$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

if ($fechaFinalMasUno == $fechaActualMasUno) {

$sql = "SELECT * FROM venta_producto WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'";
} else {
$sql = "SELECT * FROM venta_producto WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
}
}
		
		
$resul = $this->db->query($sql);
return $resul;
}
public function MostrarSucursalId($id) {
$sql = "SELECT * FROM sucursal WHERE id = $id";
$resul = $this->db->query($sql);
return $resul;
}
public function MostrarInformacionEmpresa() {
$sql = "SELECT * FROM datos_empresa ";
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


while ($row = $detalles-> fetch_object()) {
$id_sucursal = $row->id_sucursal;


$total = $row->totalventa;
$totalcotos = $row->totalcosto;
$totalUtilidad = $row->utilidad;

$arraytotal[] = array('valor' => (int)$total);
$arraycosto[] = array('valor' => (int)$totalcotos);
$arrayutilidad[] = array('valor' => (int)$totalUtilidad);

}

$valorTotal =  array_column($arraytotal, 'valor');
$TotalT = number_format(array_sum($valorTotal));

$valorTotalcosto =  array_column($arraycosto, 'valor');
$TotalCosto = number_format(array_sum($valorTotalcosto));

$valorTotalUtilidad =  array_column($arrayutilidad, 'valor');
$TotalUtilidad = number_format(array_sum($valorTotalUtilidad));




require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//$pdf->setPrintHeader(false);
//$pdf->setPrintFooter(false);
$pdf->startPageGroup();

$pdf->AddPage('L', 'A4');

$bloque1 = <<<EOF
<table>
		
		<tr>
			
			<td style="width:200px">
				
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
									
					<h3>$nomEmpresa</h3>				
					
				</div>
			</td>

			<td style="background-color:white; width:140px">
				
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					NIT: $nitEmpresa

					<br>
					$dirEmpresa

				</div>

			</td>

			<td style="background-color:white; width:140px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					Teléfono: $telEmpresa
					
					<br>
					$ciuEmpresa -- $depEmpresa

				</div>
				
			</td>

			<td style="background-color:white; width:210px; text-align:center; color:red">
				<br><br>
					Reporte de ventas por periodo
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
		<th style="border: 1px solid #666; background-color:white; width:90px; text-align:center; font-weight: bold">N°Fact</th>
		<th style="border: 1px solid #666; background-color:white; width:240px; text-align:center; font-weight: bold">Nombre</th>
		<th style="border: 1px solid #666; background-color:white; width:85px; text-align:center; font-weight: bold">Direccion</th>
		<th style="border: 1px solid #666; background-color:white; width:75px; text-align:center; font-weight: bold">fecha</th>
		<th style="border: 1px solid #666; background-color:white; width:75px; text-align:center; font-weight: bold">Costo</th>							
		<th style="border: 1px solid #666; background-color:white; width:75px; text-align:center; font-weight: bold">Utilidad</th>
		<th style="border: 1px solid #666; background-color:white; width:75px; text-align:center; font-weight: bold">Total</th>
		<th style="border: 1px solid #666; background-color:white; width:45px; text-align:center; font-weight: bold"></th>		

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');


foreach ($detalles as $key => $value) {

$datosReporte = $reporte->MostrarSucursalId($value['id_sucursal']);
while ($row1 = $datosReporte->fetch_object()) {
$nombreC = $row1->nombre;
$nit = $row1->direccion;
}

$factura = $value['num_factura'];
$fecha = $value['fecha'];
$costo = number_format($value['totalcosto']);
$utilidad = number_format($value['utilidad']);
$total = number_format($value['totalventa']);


$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			<td style="color:#333; background-color:white; width:90px; text-align:left">
			$factura
			</td>
		
			<td style="color:#333; background-color:white; width:240px; text-align:left">
			$nombreC
			</td>
		
			<td style=" color:#333; background-color:white; width:85px; text-align:center">
			$nit
			</td>
			<td style=" color:#333; background-color:white; width:75px; text-align:center">
			
			$fecha
			</td>
		
			<td style=" color:#333; background-color:white; width:75px; text-align:center">
			$costo
			</td>
		
			<td style=" color:#333; background-color:white; width:75px; text-align:center">
			$utilidad
			</td>
		
			<td style=" color:#333; background-color:white; width:75px; text-align:center">
			$total
			</td>

			<td style=" color:#333; background-color:white; width:45px; text-align:center"> 
				
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
		<th style=" background-color:white; width:90px; text-align:center; font-weight: bold"></th>
		<th style=" background-color:white; width:240px; text-align:center; font-weight: bold"></th>
		<th style=" background-color:white; width:85px; text-align:center; font-weight: bold"></th>
		<th style=" background-color:white; width:75px; text-align:center; font-weight: bold"></th>		
		<th style=" background-color:white; width:75px; text-align:center; font-weight: bold">$TotalCosto</th>							
		<th style=" background-color:white; width:75px; text-align:center; font-weight: bold">$TotalUtilidad</th>
		<th style=" background-color:white; width:75px; text-align:center; font-weight: bold">$TotalT</th>
		<th style=" background-color:white; width:75px; text-align:center; font-weight: bold"></th>		

		</tr>		

	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');
// ---------------------------------------------------------

// ---------------------------------------------------------


$bloque6 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">
		<tr>
		
			<td style=" color:#333; background-color:white; width:760px; text-align:left"></td>
		</tr>
		<tr>
		<td style="border: 1px solid #666; background-color:white; width:760px; text-align:center; font-weight: bold">
			reporte ventas de productos
		</td>			

		</tr>

	</table>

EOF;
$pdf->writeHTML($bloque6, false, false, false, false, '');
//SALIDA DEL ARCHIVO 
$pdf->Output('factura.pdf');
}

}

$reporte = new imprimirReporte();
$reporte-> fechaInicial = $_GET["fechaInicial"];
$reporte-> fechaFinal = $_GET["fechaFinal"];


$reporte ->traerImpresionReporte();

?>