<?php
require 'vendor/autoload.php';

use Larc\QrCodeGen\QR;
use Larc\QrCodeGen\DataType\vCard;

$vCard = new vCard();
$vCard->addName('primer_nombre', 'Segundo_nombre', 'Primer_apellido', 'Segundo_apellido');
$vCard->addNickname('The Boss');
$vCard->addEMail('example@mail.com', 'WORK');
$vCard->addPhoneNumber('60000000', 'PREF;WORK;VOICE');
$vCard->addCompany('Company, S.A.');
$vCard->addJobTitle('CEO');
$vCard->addUrl('https://www.example.com', 'WORK');

/*echo '<pre>';
echo $vCard->getData();*/

$qr = new QR( $vCard, 500 );
$qr->toPNG();
echo '<img src="'.$qr->Output().'">';

?>