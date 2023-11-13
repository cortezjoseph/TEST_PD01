<?php
try{
$pdo = new PDO("mysql:host=localhost;dbname=u690288683_pos_main","u690288683_pos_main","Pharmaciadimaano01.");

}catch(PDOException $f){
    
    echo $f->getmessage();
}

require("fpdf182/fpdf.php");



include_once "connectdb.php";

$id=$_GET['id'];

$select=$pdo->prepare("select * from tbl_invoice where invoice_id=$id");
$select->execute();
$row=$select->fetch(PDO::FETCH_OBJ);



$pdf = new FPDF ('P','mm',array(80,145));

$pdf->AddPage();


$pdf->SetFont('Arial','B',14);

$pdf->Cell(60,8,'Pharmacia Dimaano',1,1,'C');

$pdf->SetFont('Arial','B',6);

$pdf->Cell(60,5,'Sitio Lamao, Barangay Libjo Bats. City',0,1,'C');
$pdf->Cell(60,5,'Contact : +92 3222563301',0,1,'C');
$pdf->Cell(60,5,'E-mail Address : pharmaciadimaano@gmail.com',0,1,'C');


//Line(x1,y1,x2,y2);
$pdf->Line(7,38,70,38);




//Line break
$pdf->Ln(8);


$pdf->SetFont('Arial','B',6);
$pdf->Cell(20,4,'Bill To: ',0,0,'');

$pdf->SetFont('Arial','B',6);
$pdf->Cell(10,4,$row->customer_name,0,1,'');


$pdf->SetFont('Arial','B',6);
$pdf->Cell(20,4,'Invoice no: ',0,0,'');

$pdf->SetFont('Arial','B',6);
$pdf->Cell(40,4,$row->invoice_id,0,1,'');

$pdf->SetFont('Arial','B',6);
//$pdf->Cell(20,4,'Date : ',0,0,'');
$pdf->Cell(8,4,'Date : ',0,0,'');
//$pdf->SetFont('Arial','BI',8);
$pdf->Cell(20,4,$row->order_date,0,0,'');


//$pdf->SetFont('Arial','BI',8);
$pdf->Cell(10,4,'Time : ',0,0,'');

$pdf->SetFont('Arial','B',8);
$pdf->Cell(20,4,$row->order_time,0,1,'');

/////////////////////////
$pdf->Ln(3);


$pdf->SetX(7);
$pdf->SetFont('Courier','B',8);
$pdf->SetFillColor(208,208,208);
$pdf->Cell(34,5,'PRODUCT',1,0,'C'); //100
$pdf->Cell(11,5,'QTY',1,0,'C');
$pdf->Cell(8,5,'PRC',1,0,'C');
$pdf->Cell(12,5,'TOTAL',1,1,'C');


$select=$pdo->prepare("select * from table_invoice_details where invoice_id=$id");
$select->execute();
//$item=$select->fetch(PDO::FETCH_OBJ)
    
    
    while($item=$select->fetch(PDO::FETCH_OBJ)){
        
     $pdf->SetX(7);   
        $pdf->SetFont('Helvetica','B',8);
$pdf->Cell(34,5,$item->product_name,1,0,'C'); //100
$pdf->Cell(11,5,$item->qty,1,0,'C');
$pdf->Cell(8,5,$item->price,1,0,'C');
$pdf->Cell(12,5,$item->price*$item->qty,1,1,'C');
        
    }


//Line break
$pdf->Ln(2);


$pdf->SetX(7);
$pdf->SetFont('courier','B',10);
$pdf->Cell(20,5,'',0,0,'L'); //100
//$pdf->Cell(20,5,'',0,0,'C');
$pdf->Cell(25,5,'GRANDTOTAL',1,0,'C');
$pdf->Cell(20,5,$row->total,1,1,'C');


$pdf->SetX(7);
$pdf->SetFont('courier','B',8);
$pdf->Cell(20,5,'',0,0,'L'); //100
////$pdf->Cell(20,5,'',0,0,'C');
$pdf->Cell(25,5,'PAID',1,0,'C');
$pdf->Cell(20,5,$row->paid,1,1,'C');



$pdf->SetX(7);
$pdf->SetFont('courier','B',8);
$pdf->Cell(20,5,'',0,0,'L'); //100
////$pdf->Cell(20,5,'',0,0,'C');
$pdf->Cell(25,5,'CHANGE',1,0,'C');
$pdf->Cell(20,5,$row->due,1,1,'C');


$pdf->SetX(7);
$pdf->SetFont('courier','B',8);
$pdf->Cell(20,5,'',0,0,'L'); //100
//$pdf->Cell(20,5,'',0,0,'C');
$pdf->Cell(25,5,'PAYMENT TYPE',1,0,'C');
$pdf->Cell(20,5,$row->payment_type,1,1,'C');


//$pdf->Cell(60,5,'Invoice',0,1,'C');

//$pdf->SetFont('Arial','',8);
//$pdf->Cell(85,5,'Invoice :' .$row->invoice_id,0,1,'R');
//
//$pdf->SetFont('Arial','',8);
//$pdf->Cell(87,5,'Date : '.$row->order_date,0,1,'R');





$pdf->Cell(20,5,'',0,1,'');

$pdf->SetX(7);
$pdf->SetFont('Courier','B',8);
$pdf->Cell(65,5,'Thankyou for choosing',0,1,'C');//100


$pdf->SetX(3);
$pdf->SetFont('Courier','B',8);
$pdf->Cell(75,5,'Pharmacia Dimaano',0,1,'C');


$pdf->Output();
?>