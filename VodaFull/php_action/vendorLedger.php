<?php 
require_once 'core.php';

$orderId = $_GET['id'];

function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'Zero',
        1                   => 'One',
        2                   => 'Two',
        3                   => 'Three',
        4                   => 'Four',
        5                   => 'Five',
        6                   => 'Six',
        7                   => 'Seven',
        8                   => 'Eight',
        9                   => 'Nine',
        10                  => 'Ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}



require('fpdf.php');
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',8,'U','I');
$pdf->Text(100,15,'Vendor LEDGER',0,1,'C');
$pdf->SetFont('Arial','',16);
$pdf->Line(10,10,200,10);
$pdf->Line(10,10,10,290);
$pdf->Image('VodaComm.png',84,18,50,5);
$pdf->SetFont('Arial','',8,'U','I');
$pdf->Text(95,26,'Shop 128 - Sareena Tower',0,1,'C');
$pdf->Text(91,30,'Sakhi Hassan Chowrangi, Karachi',0,1,'C');
$pdf->Text(97,34,'Https://thevoda.com.pk',0,1,'C');

$pdf->Line(80,60,80,40);
$pdf->Line(10,60,200,60);
$pdf->SetFont('Arial','B',8,'U','I');
$pdf->Text(15,45,'M/s,',0,1,'L');
$pdf->SetFont('Arial','',8,'U','I');
$query1="SELECT * FROM vendor where vendor_id='$orderId' ";
$res1=mysqli_query($connect,$query1);
$row1=mysqli_fetch_array($res1);
$nic ='';
$address = '';
$invoice_no='';
if($row1=="")
{    
$pdf->Text(15,50,'XYZ Super Store',0,1,'L');
}
else
{    
$pdf->Text(15,50,$row1[1],0,1,'L');
$address  = $row1[2];
$nic = $row1[4];
}
$pdf->SetFont('Arial','',8,'U','I');
$pdf->Text(180,26,'0334-2539344',0,0,'R');
$pdf->SetFont('Arial','B',8,'U','I');
$pdf->Text(83,46,'VENDOR ID . ',0,0,'R');
$pdf->SetFont('Arial','B',8,'U','I');
$pdf->Text(140,46,'DATE : ',0,0,'R');
$pdf->SetFont('Arial','',8,'U','I');
$pdf->Text(163,46,''. date("d-M-Y"),0,0,'R');
$pdf->SetFont('Arial','B',8,'U','I');
$pdf->Text(83,54,'CNIC No . ',0,0,'R');
$pdf->SetFont('Arial','B',8,'U','I');
$pdf->Text(140,54,'Contact No : ',0,0,'R');

$pdf->SetFont('Arial','',8,'U','I');

$pdf->Text(110,46,$orderId,0,0,'R');
$pdf->Text(110,54,$nic,0,0,'R');
$pdf->Text(163,54,$address,0,0,'R');

$pdf->SetFont('Arial','B',8,'U','I');
$pdf->Text(13,66,'S.N',0,0,'C');
$pdf->Text(25,66,'Product ID',0,0,'C');
$pdf->Text(84,66,'Amount Paid',0,0,'C');
$pdf->Text(114,66,'Amount Due',0,0,'C');
$pdf->Text(149,66,'Date',0,0,'C');
$pdf->Text(175,66,'Total',0,0,'C');

$pdf->Text(30,70,' ',0,0,'R');
$pdf->Text(30,80,' ',0,0,'R');
$pdf->Text(30,90,' ',0,0,'R');
$pdf->Text(30,100,' ',0,0,'R');

$pdf->Line(10,70,200,70);
$pdf->Line(20,60,20,250);
$pdf->Line(80,60,80,250);
$pdf->Line(110,60,110,250);
$pdf->Line(145,60,145,250);
$pdf->Line(170,60,170,250);


$pdf->Line(10,250,200,250);
$pdf->Line(10,260,200,260);
$pdf->Line(10,40,200,40);

$pdf->Line(200,10,200,290);
$pdf->Line(10,290,200,290);


$pdf->SetFont('Arial','B',10);

$pdf->Text(1,10,' ',0,0,'R'); /* ALLIGN FOR BASIC AMOUNT*/


$pdf->SetFont('Arial','B',10);
$pdf->Text(11,265,'Terms and Conditions :',0,0,'C'); 
$pdf->Text(130,265,' For VODACOM',0,0,'C'); 
$pdf->SetFont('Arial','',10);
$pdf->Text(168,278,'Auth.Signatory',0,0,'C');
$pdf->Text(11,270,'Items without slip can not be exchanged or claim');
$pdf->Text(11,274,'Accessories once sold will not be exchanged or return');
$pdf->Text(11,278,'Items should be checked at the time of purchase',0,1,'C');

//$res=mysqli_query($connect,"SELECT product.product_id, product.rate, product.quantity, vendor_installment.amount, vendor_installment.installmentDate, vendor_installment.installment_type,product.product_name from vendor_installment INNER JOIN product On vendor_installment.prd_id = product.product_id where vendor_installment.vendor_id='$orderId'");
$res=mysqli_query($connect,"SELECT product.product_id, product.rate, product.quantity, vendor_installment.amount, vendor_installment.installmentDate, vendor_installment.installment_type,product.product_name, (Select  SUM(sale_details.rate) from product_detail inner join sale_details on sale_details.prd_code = product_detail.prd_code where product_detail.prd_id = product.product_id) as saleAmount  from vendor_installment INNER JOIN product On vendor_installment.prd_id = product.product_id  where vendor_installment.vendor_id='$orderId'");
$count=1;
    $x=17;
    $y=76;
	$due =0;
	$saleId = '';
	
	$amountPaid=0;
	$amountDue=0;
	$total=0;
	$tt=0;
	
$max_product_per_page = 18;
$j = 1;  
while($row=mysqli_fetch_array($res))
{
     if ($j > $max_product_per_page )
    {
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',8,'U','I');
        $pdf->Line(10,10,10,290);
     
        $pdf->Line(20,10,20,200);
        $pdf->Line(80,10,80,200);
        $pdf->Line(110,10,110,200);
        $pdf->Line(145,10,145,200);
        $pdf->Line(170,10,170,200);
        
        $pdf->Line(10,290,200,290);
        $pdf->Line(10,10,200,10);
        $pdf->Line(200,10,200,290);
         $pdf->Line(10,200,200,200);
            $y=20;
            $j = 1;
            $pdf->SetFont('Arial','B',10);
        $pdf->Text(11,265,'Terms and Conditions :',0,0,'C'); 
        $pdf->Text(130,265,' For VODACOM',0,0,'C'); 
        $pdf->SetFont('Arial','',10);
        $pdf->Text(168,278,'Auth.Signatory',0,0,'C');
        $pdf->Text(11,270,'Items without slip can not be exchanged or claim');
        $pdf->Text(11,274,'Accessories once sold will not be exchanged or return');
        $pdf->Text(11,278,'Items should be checked at the time of purchase',0,1,'C');
    }
  
    
    
    
    
	if ($count == 1)
	{
		$saleId = $row[0];
		$due =  ( $row[1] * $row[2] ) + $row[7];
		$tt = ( $row[1] * $row[2] ) + $row[7];
		$due =  $due - $row[3];
	}
	
	if ($saleId != $row[0] && $count > 1)
	{
		//$due = $row[0];
		$saleId = $row[0];
		$due =  ( ($row[1] * $row[2]) +  + $row[7] )  - $row[3];
		$tt = $tt + ( $row[1] * $row[2] ) + $row[7];
	}
	else if ($saleId == $row[0] && $count > 1)
	{
		$due = $due - $row[3];
	}
	
   
$pdf->Text(13, $y , $count,0,0,'R');
$pdf->Text(22, $y,$row[0] . ' - ' . $row[6],0,0,'R');
$pdf->Text(84, $y,$row[3] ,0,0,'R');
$pdf->Text(115, $y,$due,0,0,'R');
$pdf->Text(149, $y,$row[4],0,0,'R');
$pdf->Text(175, $y, ( $row[1] * $row[2] ) + $row[7],0,0,'R');

	$amountPaid= $amountPaid + $row[3];
	$amountDue= $amountDue + $due;
//	$total=$total + ($row[1] * $row[2] );

$count++;
$y+=10;
 
$j++;

}
/*
$pdf->Text(15, 255,'Total Amount Paid: ',0,0,'R');
$pdf->Text(50, 255,$amountPaid,0,0,'R');
$pdf->Text(85, 255,'Total Amount Due: ',0,0,'R');
$pdf->Text(115, 255,$amountDue,0,0,'R');
$pdf->Text(165, 255,'Total: ',0,0,'R');
$pdf->Text(175, 255,$tt,0,0,'R');
*/



$pdf->Text(15, 255,'Total Amount Paid: ',0,0,'R');
$pdf->Text(50, 255,$amountPaid,0,0,'R');
$pdf->Text(85, 255,'Total Amount Due: ',0,0,'R');
$pdf->Text(115, 255,$amountDue,0,0,'R');
$pdf->Text(165, 255,'Total: ',0,0,'R');
$pdf->Text(175, 255,$tt,0,0,'R');



$pdf->Text(10,285,'Generated By Leminscate Pvt. Ltd.' ,0,0,'R');
$pdf->Output();
?>

