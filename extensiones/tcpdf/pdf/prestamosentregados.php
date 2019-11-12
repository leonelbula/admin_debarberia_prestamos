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

public function ReportesPrestamos($fechaInicial,$fechaFinal) {

		
if($fechaInicial == $fechaFinal){
$sql = "SELECT * FROM prestamos_cliente WHERE fecha_entrega LIKE '%$fechaFinal%'";
			
} else {
			
$fechaActual = new DateTime();
$fechaActual->add(new DateInterval("P1D"));
$fechaActualMasUno = $fechaActual->format("Y-m-d");

$fechaFinal2 = new DateTime($fechaFinal);
$fechaFinal2->add(new DateInterval("P1D"));
$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

if ($fechaFinalMasUno == $fechaActualMasUno) {

$sql = "SELECT * FROM prestamos_cliente WHERE fecha_entrega BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'";
} else {
$sql = "SELECT * FROM prestamos_cliente WHERE fecha_entrega BETWEEN '$fechaInicial' AND '$fechaFinal'";
}
}
		
		
$resul = $this->db->query($sql);
return $resul;
}
public function MostrarClienteId($id) {
$sql = "SELECT * FROM cliente_prestamo WHERE id = $id";
$resul = $this->db->query($sql);
return $resul;
}

}


//require_once '../../../controllers/ClienteController.php';
//require_once '../../../controllers/InventarioController.php';
class imprimirReporte{

public $fechaInicio;
public $fechaFinal;

public function traerImpresionReporte(){
$fechaInicial = $this->fechaInicio;
$fechaFinal = $this->fechaFinal;

$reporte = new Reportes();
$detalles = $reporte->ReportesPrestamos($fechaInicial,$fechaFinal);
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

$valor = $row->valor;
$arrayvalor[] = array('valor' => (int)$valor);
$utilidad = $row->utilidad;
$arrayutilidad[] = array('valor' => (int)$utilidad);
$valortotal = $row->valortotal;
$arraytotal[] = array('valor' => (int)$valortotal);

}

$valorTotal =  array_column($arrayvalor, 'valor');
$TotalValor = number_format(array_sum($valorTotal));

$valorUtilidad =  array_column($arrayutilidad, 'valor');
$TotalUtilidad = number_format(array_sum($valorUtilidad));

$valorT =  array_column($arraytotal, 'valor');
$TotalT = number_format(array_sum($valorT));

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
					Reporte de prestamos entregados
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
		<th style="border: 1px solid #666; background-color:white; width:40px; text-align:center; font-weight: bold">N°</th>
		<th style="border: 1px solid #666; background-color:white; width:210px; text-align:center; font-weight: bold">Nombre Cliente</th>
		<th style="border: 1px solid #666; background-color:white; width:70px; text-align:center; font-weight: bold">Interes %</th>
		<th style="border: 1px solid #666; background-color:white; width:75px; text-align:center; font-weight: bold">Fecha Entrega</th>
		<th style="border: 1px solid #666; background-color:white; width:60px; text-align:center; font-weight: bold">Plazo</th>						
		<th style="border: 1px solid #666; background-color:white; width:80px; text-align:center; font-weight: bold">Fecha Vencimiento</th>
		<th style="border: 1px solid #666; background-color:white; width:80px; text-align:center; font-weight: bold">Valor</th>
		<th style="border: 1px solid #666; background-color:white; width:80px; text-align:center; font-weight: bold">Utilidad</th>
		<th style="border: 1px solid #666; background-color:white; width:80px; text-align:center; font-weight: bold">Total</th>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');


foreach ($detalles as $key => $value) {

$id = $value['id'];

$datosReporte = $reporte->MostrarClienteId($value['id_cliente']);
while ($row1 = $datosReporte->fetch_object()) {
$nombreC = $row1->nombre;
}
$interes = $value['interes'];
$fechaEntrega = $value['fecha_entrega'];
$fechaVencimiento = $value['fecha_vencimiento'];
$plazo = number_format($value['num_cuotas']);
$valor = number_format($value['valor']);
$utilidad = number_format($value['utilidad']);
$valorTotal = number_format($value['valortotal']);


$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			<td style="color:#333; background-color:white; width:40px; text-align:left">
			$id
			</td>
		
			<td style="color:#333; background-color:white; width:210px; text-align:left">
			$nombreC
			</td>
		
			<td style=" color:#333; background-color:white; width:70px; text-align:center">
			$interes %
			</td>
			<td style=" color:#333; background-color:white; width:75px; text-align:center">
			
			$fechaEntrega
			</td>
		
			<td style=" color:#333; background-color:white; width:60px; text-align:center">
			$plazo
			</td>
		
			<td style=" color:#333; background-color:white; width:80px; text-align:center">
			$fechaVencimiento
			</td>
			<td style=" color:#333; background-color:white; width:80px; text-align:center">
			$valor
			</td>
			<td style=" color:#333; background-color:white; width:80px; text-align:center">
			$utilidad
			</td>
			<td style=" color:#333; background-color:white; width:80px; text-align:center">
			$valorTotal
			</td>

		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');
}
// ---------------------------------------------------------


$bloque5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px; border: 1px solid #666;">

		<tr>
		<th style=" background-color:white; width:40px; text-align:center; font-weight: bold"></th>
		<th style=" background-color:white; width:210px; text-align:center; font-weight: bold"></th>
		<th style=" background-color:white; width:70px; text-align:center; font-weight: bold"></th>
		<th style=" background-color:white; width:75px; text-align:center; font-weight: bold"></th>
		<th style=" background-color:white; width:60px; text-align:center; font-weight: bold"></th>						
		<th style=" background-color:white; width:80px; text-align:center; font-weight: bold"></th>
		<th style=" background-color:white; width:80px; text-align:center; font-weight: bold">$TotalValor</th>
		<th style=" background-color:white; width:80px; text-align:center; font-weight: bold">$TotalUtilidad</th>
		<th style=" background-color:white; width:80px; text-align:center; font-weight: bold">$TotalT</th>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');
// ---------------------------------------------------------

$bloque6 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">
		<tr>
		
			<td style=" color:#333; background-color:white; width:760px; text-align:left"></td>
		</tr>
		<tr>
		<td style="border: 1px solid #666; background-color:white; width:760px; text-align:center; font-weight: bold">
			reporte prestamos entregados
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
