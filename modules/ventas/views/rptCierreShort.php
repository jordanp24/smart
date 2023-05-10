<?php
include '../../include/fpdf/fpdf.php';
include '../../include/fpdf/font/courier.php';
include "../../../db/conection.php";


$inventario = "SELECT
d.articulo,
a.nombre,
SUM(
  CASE
    WHEN d.cantidad > 0 THEN d.cantidad 
    ELSE 0
  END
) AS cantarticulos,
SUM(
  CASE
    WHEN d.preciofinal > 0 THEN d.preciofinal
    ELSE 0
  END
) AS subtotal
,
( (sum(d.cantidad) * a.precio) - ( a.preciocompra * sum(d.cantidad) ) )  as ganancia
FROM
detalleventa d
INNER JOIN articulo a ON a.idarticulo = d.articulo
WHERE d.created BETWEEN (SELECT DATE_FORMAT(NOW(), '%Y-%m-%d')) and (SELECT DATE_FORMAT(DATE_ADD(NOW(), INTERVAL 1 DAY ), '%Y-%m-%d')) and
d.preciofinal
GROUP BY d.articulo;";


// $result1 = $mysqli->query($query1);

// $num_results1 = $result1->num_rows;
// if ($num_results1) {

//   while ($row1 = $result1->fetch_assoc()) {
    class pdf extends FPDF
    {
    }
    $sim;
    $fecha = date("d/m/Y");
    $fechaCierre = date("Y-m-d");
    $fechaCierreFin = date('Y-m-d', strtotime($fechaCierre. ' + 1 days'));
    $pdf = new pdf('P', 'mm', 'Letter');
    $pdf->AddPage();
    $pdf->Image('../../../img/logo.jpeg', 10, 5, 35, 25, 'jpeg', 0);

    $pdf->SetTextColor(010, 010, 010); // color de texto RGB
    $pdf->SetFont('arial', 'B', 10);
    $pdf->Cell(82, 6, '', 0);
    $pdf->Cell(52, 6, 'SMART', 0);
    $pdf->SetFillColor(27, 94, 32); //color de relleno RGB
    $pdf->SetTextColor(0, 0, 0); // color de texto RGB

    $pdf->SetTextColor(255, 255, 255); // color de texto RGB
    $pdf->cell(30, 5, utf8_decode('Cierre:'), 1, 0, 1, 1);
    $pdf->cell(30, 5, $fecha, 1, 0, 'C', 1);
    $pdf->SetTextColor(010, 010, 010); // color de texto RGB
    $pdf->SetFont('arial', '', 10);
    $pdf->ln();
    $pdf->Cell(62, 6, '', 0);
    // $pdf->Cell(69, 6, '', 0);
    $pdf->Cell(75, 6, 'Email: SMARTlosamigos@gmail.com', 0);
    // $pdf->cell(60, 5, utf8_decode('Admin: '), 1, 0, 1, 0); 
    $pdf->ln();
    $pdf->Cell(59, 6, '', 0);
    $pdf->Cell(75, 4, 'Servicio la cliente: 30387286 | 33153681', 0);
    // $pdf->cell(60, 5, utf8_decode('Fecha: ' . $fecha), 1, 0, 1, 0);

    // $pdf->cell(30, 5, $row1['fecha'], 1, 0, 'C', 0);
    $pdf->ln();
    $pdf->SetFont('Arial', 'I', 8);
    $pdf->Cell(68, 4, '', 0);
    $pdf->SetFont('arial', '', 10);

    $pdf->SetFont('Arial', 'I', 8);

    $pdf->ln();
    $pdf->Cell(75, 5, '', 0);




    // $pdf->ln(30);
    // $pdf->SetFont('Arial', '', 10);
    // $pdf->Cell(18, 5, 'Cliente: ', 0, 0, 'L');
    // $pdf->Cell(195, 5, $row1['cliente'], 0, 1, 'L');
    // $pdf->Cell(18, 5, utf8_decode('Dirección: '), 0, 0, 'L');
    // $pdf->Cell(195, 5, $row1['direccion'], 0, 1, 'L');
    // $pdf->Cell(18, 5, utf8_decode('DPI: '), 0, 0, 'L');
    // $pdf->Cell(195, 5, $row1['dpi'], 0, 1, 'L');
    // $pdf->Cell(18, 5, utf8_decode('Teléfono: '), 0, 0, 'L');
    // $pdf->Cell(195, 5, $row1['telefono'], 0, 1, 'L');
    // $pdf->Cell(17, 5, 'Direccion: ', 0, 0, 'L');
    // $pdf->Cell(195, 5, $row1['clidir'], 0, 1, 'L')

    $pdf->ln(3);
    // if (file_exists($row1['reimagen'])) {
    //   $extension = pathinfo($row1['reimagen'], PATHINFO_EXTENSION);
    //   $pdf->Image($row1['reimagen'],78,30,50,0,$extension);
    // }
    // $pdf->ln(3);
    // $pdf->SetFont('Arial', 'B', 10);
    // $pdf->Cell(195, 6, utf8_decode('Preparación'), 1, 1, 'C');
    // $pdf->SetFont('Arial', '', 10);
    // $desc = explode(". ", $row1['repreparacion']);
    $contador = 0;
    // while($contador<count($desc)){
    //   $pdf->Cell(195, 7, $desc[$contador], 'LR', 1, 'L');
    //   // if($contador<count($desc)) 
    //   $contador = $contador+1;
    // }
    // $pdf->cell(195, 0, '', 'LRB', 1, 'R');
    $pdf->SetFillColor(27, 94, 32); //color de relleno RGB 
    $pdf->SetTextColor(255, 255, 255); // color de texto RGB
    $pdf->SetFont('Arial', 'B', 10);
  // }




  $pdf->ln(4);
  $pdf->Cell(10, 4, 'NO.', 1, 0, 'C', 1);
  $pdf->Cell(100, 4, utf8_decode('NOMBRE ARTÍCULO'), 1, 0, 'C', 1);
  $pdf->Cell(45, 4, 'CANTIDAD', 1, 0, 'C', 1);
  $pdf->Cell(40, 4, 'SUBTOTAL Q.', 1, 0, 'C', 1);
  // $pdf->Cell(30, 4, 'Precio Unitario', 1, 0, 'C', 1);
  // $pdf->Cell(30, 4, 'Importe', 1, 1, 'C', 1);
  $pdf->ln();
  if (mysqli_connect_errno()) {
    echo "Error: No se Puede Conectar con la Base de Datos";
    exit;
  }
  $item = 0;
  $total = 0;
  $totalCant = 0;
  $ganancia = 0;

  $result2 = $mysqli->query($inventario);
  $num_results2 = $result2->num_rows;
  if ($num_results2) {

    while ($row2 = $result2->fetch_assoc()) {
      $pdf->SetTextColor(010, 010, 010);
      $pdf->SetFont('arial', '', 9);
      $item = $item + 1;

      // $total = $total + (($row2['detpedcantidad']) * ($row2['detpedprecio']));
      // $iva = $iva + (($row2['totaliva']));
      // $envio = (($row2['envio']));
      $pdf->cell(10, 5, $item, 'L', 0, 'C');
      $pdf->cell(100, 5, $row2['nombre'], 'L', 0, 'C');
      $pdf->cell(45, 5, round($row2['cantarticulos'], 2), 'LR', 0, 'C', 0);
      $pdf->cell(40, 5, round($row2['subtotal'] * 100) / 100, 'LR', 0, 'C', 0);
      $totalCant = $row2['cantarticulos'] + $totalCant;
      $total = $row2['subtotal'] + $total;
      $ganancia = $row2['ganancia'] + $ganancia;

      $pdf->ln();
      $pdf->cell(195, 0, '', 'LRB', 1, 'R');
      // $pdf->cell(30, 5, $row2['detrecantidad'], 'L', 0, 'R', 0);
      // $pdf->cell(30, 5, $row2['detrecantidad'], 'LR', 1, 'R');
    }
    // $pdf->cell(195, 5, '', 'LRB', 1, 'R');
  }
  $pdf->ln(5);
  // $pdf->Cell(10, 5, '', 1, 0, 'C', 1);
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->SetFillColor(27, 94, 32); //color de relleno RGB
  $pdf->SetTextColor(255, 255, 255);
  $pdf->cell(140, 5, utf8_decode('Total de artículos: '), 1, 0, 'R', 1);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->cell(55, 5, $totalCant, 1, 0, 'L');
  $pdf->ln();
  $pdf->SetFillColor(27, 94, 32); //color de relleno RGB
  $pdf->SetTextColor(255, 255, 255);
  $pdf->cell(140, 5, 'Total de ventas: ', 1, 0, 'R', 1);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->cell(55, 5, $total, 1, 0, 'L');
  $pdf->ln();

  // $pdf->SetFillColor(27, 94, 32); //color de relleno RGB
  // $pdf->SetTextColor(255, 255, 255);
  // $pdf->cell(140, 5, 'Ganancia Total: ', 1, 0, 'R', 1);
  // $pdf->SetTextColor(0, 0, 0);
  // $pdf->cell(55, 5, $ganancia, 1, 0, 'L');
  // $pdf->ln(10);
  // $pdf->SetFont('arial', '', 10);

  $mysqli->query("start transaction");

  $cierres = $mysqli->query("SELECT c.* FROM cierre c WHERE c.created BETWEEN '$fechaCierre' AND '$fechaCierreFin';");
  $cierre = $cierres->fetch_assoc();

  if ($cierres->num_rows) {
    $mysqli->query("update cierre set total = $total, updated = CURRENT_TIMESTAMP()  where id = ".$cierre['id']);
  } else {
    $mysqli->query("insert into cierre(total) values($total)");
  }
  $mysqli->query("commit");
  $pdf->SetTextColor(0, 0, 0);
  $pdf->ln(7);
  $pdf->cell(80, 5, '', 0);
  $pdf->cell(50, 5, utf8_decode('*** Última Línea ***'), 0, 1);
  $pdf->ln(3);
  $pdf->Output('Cierre de fecha_' . $fechaCierre . '.pdf', 'I');
// }
