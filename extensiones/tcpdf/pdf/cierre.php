<?php

require_once '../../../config/DataBase.php';

class ListaFactura {
	
public $db;


public function __construct() {
$this->db = Database::connect();
}
public function MostrarInformacionEmpresa() {
$sql = "SELECT * FROM datos_empresa ";
$resul = $this->db->query($sql);
return $resul;
}
public function VerVentaCodigo($codigo) {
$sql = "SELECT * FROM iniciar_punto_venta WHERE id = $codigo";
$resul = $this->db->query($sql);
return $resul;
}
public function MostrarSucursalId($id) {
$sql = "SELECT * FROM sucursal WHERE id = $id";
$resul = $this->db->query($sql);
return $resul;
}
public function AbonosDiarios($fechaInicial, $fechaFinal,$id_sucursal) {


if ($fechaInicial == $fechaFinal) {

$sql = "SELECT SUM(valor) as total FROM abono_entregados_prestamos_sucursal WHERE fecha like '%$fechaFinal%' AND id_sucursal = $id_sucursal";
} else {

$fechaActual = new DateTime();
$fechaActual->add(new DateInterval("P1D"));
$fechaActualMasUno = $fechaActual->format("Y-m-d");

$fechaFinal2 = new DateTime($fechaFinal);
$fechaFinal2->add(new DateInterval("P1D"));
$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

if ($fechaFinalMasUno == $fechaActualMasUno) {

$sql = "SELECT SUM(valor) as total FROM abono_entregados_prestamos_sucursal WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND id_sucursal = $id_sucursal";
} else {

$sql = "SELECT SUM(valor) as total FROM abono_entregados_prestamos_sucursal WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' AND id_sucursal = $id_sucursal";
}
}


$resul = $this->db->query($sql);
return $resul;
}	

public function VentasProductos($fechaInicial, $fechaFinal,$id_sucursal) {

if ($fechaInicial == $fechaFinal) {

$sql = "SELECT SUM(totalventa) as total FROM venta_producto WHERE fecha like '%$fechaFinal%'  AND id_sucursal = $id_sucursal ";
} else {

$fechaActual = new DateTime();
$fechaActual->add(new DateInterval("P1D"));
$fechaActualMasUno = $fechaActual->format("Y-m-d");

$fechaFinal2 = new DateTime($fechaFinal);
$fechaFinal2->add(new DateInterval("P1D"));
$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

if ($fechaFinalMasUno == $fechaActualMasUno) {

$sql = "SELECT SUM(totalventa) as total FROM venta_producto WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND id_sucursal = $id_sucursal";
} else {

$sql = "SELECT SUM(totalventa) as total FROM venta_producto WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' AND id_sucursal = $id_sucursal ";
}
}


$resul = $this->db->query($sql);
return $resul;
}
	
public function VentasServicios($fechaInicial, $fechaFinal,$id_sucursal) {


if ($fechaInicial == $fechaFinal) {

$sql = "SELECT SUM(valorinterno) as total FROM venta_servicio WHERE fecha like '%$fechaFinal%'  AND id_sucursal = $id_sucursal ";
} else {

$fechaActual = new DateTime();
$fechaActual->add(new DateInterval("P1D"));
$fechaActualMasUno = $fechaActual->format("Y-m-d");

$fechaFinal2 = new DateTime($fechaFinal);
$fechaFinal2->add(new DateInterval("P1D"));
$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

if ($fechaFinalMasUno == $fechaActualMasUno) {

$sql = "SELECT SUM(valorinterno) as total FROM venta_servicio WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND id_sucursal = $id_sucursal ";
} else {

$sql = "SELECT SUM(valorinterno) as total FROM venta_servicio WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' AND id_sucursal = $id_sucursal ";
}
}


$resul = $this->db->query($sql);
return $resul;
}
}


//require_once '../../../controllers/ClienteController.php';
//require_once '../../../controllers/InventarioController.php';
class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){

$reporte = new ListaFactura();
$datosEmpresa = $reporte->MostrarInformacionEmpresa();

foreach ($datosEmpresa as $key => $valueE) {
$nomEmpresa = $valueE['nombre'];
$nitEmpresa = $valueE['nit'];
$dirEmpresa = $valueE['direccion'];
$ciuEmpresa = $valueE['ciudad'];
$depEmpresa = $valueE['departamento'];
$telEmpresa = $valueE['telefono'];
}

$codigo = $this->codigo;
$factura = new ListaFactura();
$detalles = $factura->VerVentaCodigo($codigo);


while ($row = $detalles-> fetch_object()) {
$id_sucursal = $row->id_sucursal;
$fecha = $row->fecha_inicio;
$fechacierre = $row->fecha_cierre;
$gastos = number_format($row->totalgastos);
$montoentregado = number_format($row->montoentregado);
$total = number_format($row->totalingresos);
$diferencia  = number_format($row->diferencia);
}

$totalVentas = $factura->VentasProductos($fecha, $fechacierre,$id_sucursal);
while ($row1 = $totalVentas->fetch_object()) {
$ventatotal = (int) $row1->total;
}

$totalVentaServicio = $factura->VentasServicios($fecha, $fechacierre,$id_sucursal);
while ($row1 = $totalVentaServicio->fetch_object()) {
$ventatotalServicio = (int) $row1->total;
}

$totalAbonos = $factura->AbonosDiarios($fecha, $fechacierre, $id_sucursal);
while ($row3 = $totalAbonos->fetch_object()) {
$valorAbonos = $row3->total;
}

$datosCliente = $factura->MostrarSucursalId($id_sucursal);
while ($row1 = $datosCliente->fetch_object()) {
$nombreC = $row1->nombre;
$direccionC = $row1->direccion;
$departamentoC = $row1->departamento;
$ciudadC = $row1->ciudad;
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
			
			<td style="width:150px">
				<div style="font-size:8.5px; text-align:center; line-height:15px;">
					$nomEmpresa <br>
					$nitEmpresa <br> $dirEmpresa <br> $ciuEmpresa
				</div>
				<hr style="border: 2px solid #666; background-color:white; width:150px;"><br>
				<div style="background-color; font-size:8.5px; text-align:center; color:red ;"><br><br>CIERRE N.$codigo <br>
				<hr style="border: 2px solid #666; background-color:white; width:150px;">
				</div>
			</td>

			

			
		</tr>

	</table>

		
EOF;

$pdf->writeHTML($bloque1 ,false, false, false, false, '');
// ---------------------------------------------------------

$bloque2 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:150px"><br></td>
		
		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">
	
		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:150px; font-size:8.5px;">

				<strong>Nombre:</strong> $nombreC
				<br>				
				<strong>Direccion:</strong> $direccionC 
				<br>
				<strong>Departamento:</strong> $departamentoC  <strong>Ciudad:</strong> $ciudadC
				<br>
				<strong>Fecha  Inicio:</strong> $fecha
				<br>
				<strong>Fecha Cierre:</strong> $fechacierre

			</td>

			

		</tr>
		

		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:150px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------


$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		<th style="border: 1px solid #666; background-color:white; width:150px; text-align:center; font-weight: bold">Detalles Cierre</th>				

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			<td style="border: 1px solid #9B9B9B; color:#333; background-color:white; width:150px; text-align:left">
			<br>Total venta Producto.<br>$ $ventatotal
			<br>Total venta Servicio. <br>$ $ventatotalServicio
			<br>Abonos. : $	$valorAbonos
			<br>Diferencia. : $	$diferencia
			
			
			</td>
			
		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

// ---------------------------------------------------------

$bloque5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:150px; text-align:center"></td>
			
			

		</tr>
		
		<tr>
		
			

			<td style="border: 1px solid #666;  background-color:white; width:150px; text-align:center; font-weight: bold">
				SubTotal:  $total 
				<br> <br>
				Gastos: $gastos	
				<br><br>
				Total :  $montoentregado
			</td>

			

		</tr>

			


	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');
// ---------------------------------------------------------

// ---------------------------------------------------------


$bloque6 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">
		<tr>
		
			<td style=" color:#333; background-color:white; width:150px; text-align:left"></td>
		</tr>
		<tr>
		<td style=" font-size:6.5px; border: 1px solid #666; background-color:white; width:150px; text-align:center; font-weight: bold">
			
		</td>			

		</tr>

	</table>

EOF;
$pdf->writeHTML($bloque6, false, false, false, false, '');
//SALIDA DEL ARCHIVO 
$pdf->Output('factura.pdf');
}

}
$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>