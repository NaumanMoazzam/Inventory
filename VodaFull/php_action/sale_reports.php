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
        11                  => 'Eleven',
        12                  => 'Twelve',
        13                  => 'Thirteen',
        14                  => 'Fourteen',
        15                  => 'Fifteen',
        16                  => 'Sixteen',
        17                  => 'Seventeen',
        18                  => 'Eighteen',
        19                  => 'Nineteen',
        20                  => 'Twenty',
        30                  => 'Thirty',
        40                  => 'Fourty',
        50                  => 'Fifty',
        60                  => 'Sixty',
        70                  => 'Seventy',
        80                  => 'Eighty',
        90                  => 'Ninety',
        100                 => 'Hundred',
        1000                => 'Thousand',
        1000000             => 'Million',
        1000000000          => 'Billion',
        1000000000000       => 'Trillion',
        1000000000000000    => 'Quadrillion',
        1000000000000000000 => 'Quintillion'
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
$pdf->Text(100,15,'SALE INVOICE',0,1,'C');
$pdf->SetFont('Arial','',16);
$pdf->Line(10,10,200,10);
$pdf->Line(10,10,10,290);
$pdf->Image('VodaComm.png',84,18,50,5);
$pdf->SetFont('Arial','',8,'U','I');
$pdf->Text(95,26,'Shop 128 - Sareena Tower',0,1,'C');
$pdf->Text(91,30,'Sakhi Hassan Chowrangi, Karachi',0,1,'C');
$pdf->Text(97,34,'https://thevoda.com.pk',0,1,'C');
$pdf->Line(65,60,65,40);
$pdf->Line(10,60,200,60);
$pdf->SetFont('Arial','B',8,'U','I');
$pdf->Text(15,45,'M/s,',0,1,'L');
$pdf->SetFont('Arial','',8,'U','I');
$query1="SELECT client_name,client_address,client_nic FROM sale where sale_id=$orderId";
$res1=mysqli_query($connect,$query1);
$row1=mysqli_fetch_array($res1);
$nic ='';
$contac = '';
if($row1=="")
{    
$pdf->Text(15,50,'XYZ Super Store',0,1,'L');
}
else
{    
$pdf->Text(15,50,$row1[0],0,1,'L');
$nic = $row1[2];
$contac = $row1[1];
}
$pdf->SetFont('Arial','',8,'U','I');
$pdf->Text(180,26,'0334-2539344',0,0,'R');
$pdf->SetFont('Arial','B',8,'U','I');
$pdf->Text(77,46,'INVOICE No . ',0,0,'R');
$pdf->SetFont('Arial','B',8,'U','I');
$pdf->Text(140,46,'DATE : ',0,0,'R');
$pdf->SetFont('Arial','',8,'U','I');
$pdf->Text(163,46,''. date("d-M-Y"),0,0,'R');
$pdf->SetFont('Arial','B',8,'U','I');
$pdf->Text(77,54,'Time  :',0,0,'R');
$pdf->SetFont('Arial','B',8,'U','I');
$pdf->Text(140,54,'Contact No : ',0,0,'R');
date_default_timezone_set("Asia/Karachi");
$today = date("h:i:sa"); 
$pdf->SetFont('Arial','',8,'U','I');
$invoice_no=$orderId;
$pdf->Text(110,46,$invoice_no,0,0,'R');
$pdf->Text(110,54,$today,0,0,'R');
$pdf->Text(163,54,$contac,0,0,'R');

$pdf->SetFont('Arial','B',8,'U','I');
$pdf->Text(15,66,'S.N',0,0,'C');
$pdf->Text(30,66,'Product Code',0,0,'C');
$pdf->Text(70,66,'Product Name',0,0,'C');
$pdf->Text(184,66,'Rate',0,0,'C');

$pdf->Text(30,70,' ',0,0,'R');
$pdf->Text(30,80,' ',0,0,'R');
$pdf->Text(30,90,' ',0,0,'R');
$pdf->Text(30,100,' ',0,0,'R');

$pdf->Line(10,70,200,70);
$pdf->Line(25,60,25,200);
$pdf->Line(65,60,65,200);
$pdf->Line(180,60,180,200);
$pdf->Line(10,200,200,200);
$pdf->Line(90,220,200,220);
$pdf->Line(90,230,200,230);
$pdf->Line(10,250,200,250);
$pdf->Line(10,260,200,260);
$pdf->Line(10,40,200,40);

$pdf->Line(200,10,200,290);
$pdf->Line(10,290,200,290);




$pdf->SetFont('Arial','B',10);

$pdf->Text(1,10,' ',0,0,'R'); /* ALLIGN FOR BASIC AMOUNT*/
$query1="SELECT sale.grand_total,SUM(sale_details.rate)  as Total, sale.vat, sale.discount, sale.due, sale.paid, sale.vat FROM sale inner join sale_details ON sale.sale_id=sale_details.sale_id where sale.sale_id=$orderId";
$res1=mysqli_query($connect,$query1);
$row1=mysqli_fetch_assoc($res1);
$pdf->Text(114,218,'DUE                         Rs.       '.$row1['due'],0,1,'R');
$pdf->Text(15,228,'VAT:	 Rs.       '.$row1['vat'],0,1,'R'); 
$pdf->Text(114,228,'DISCOUNT:	            Rs.       '.$row1['discount'],0,1,'R'); 

$pdf->Text(15,238,'PAID: Rs.       '.$row1['paid'],0,1,'R'); 
$pdf->Text(114,238,'TOTAL:			                Rs.       '.$row1['Total'],0,1,'R'); 

$pdf->Text(120,255,'GRAND TOTAL                         Rs.       '.$row1['grand_total'],0,1,'R');




$pdf->Text(11,255,'AMOUNT IN WORDS : ',0,1,'C');
$pdf->SetFont('Arial','',10);
$pdf->Text(11,259,convert_number_to_words($row1['grand_total']),0,1,'R');
$pdf->SetFont('Arial','B',10);
$pdf->Text(11,265,'Terms and Conditions :',0,0,'C'); 
$pdf->Text(130,265,' For VODACOM',0,0,'C'); 
$pdf->SetFont('Arial','',10);
$pdf->Text(168,278,'Auth.Signatory',0,0,'C');
$pdf->Text(11,270,'Items without slip can not be exchanged or claim');
$pdf->Text(11,274,'Accessories once sold will not be exchanged or return');
$pdf->Text(11,278,'Items should be checked at the time of purchase',0,1,'C');
$res=mysqli_query($connect,"SELECT sale_details.rate, product.product_name,sale_details.prd_code from sale_details inner join product_detail on sale_details.prd_code = product_detail.prd_code inner join product on product_detail.prd_id = product.product_id WHERE sale_details.sale_id=$orderId");
$count=1;
    $x=17;
    $y=76;
    
  
    
    
while($row=mysqli_fetch_array($res))
{
   
$pdf->Text(17, $y , $count,0,0,'R');
$pdf->Text(30, $y,$row['prd_code'],0,0,'R');
$pdf->Text(70, $y,$row['product_name'].'',0,0,'R');
$pdf->Text(184, $y,$row['rate'],0,0,'R');

$count++;
$y+=10;
}

$pdf->Text(10,285,'Generated By Leminscate Pvt. Ltd.' ,0,0,'R');
$pdf->Output();
?>

