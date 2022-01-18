# QRCodeGen v1.1
Permite generar códigos QR con diversos formatos, Wifi, Teléfono, Whatsapp, FaceTime, SMS, etc.



## Instalación

```bash
composer require larc/qrcodegen
```



## Tipos de data permitidos

#### Wifi

```php
use Larc\QrCodeGen\QR;
use Larc\QrCodeGen\DataType\Wifi;

$wifi = new Wifi();
$wifi->setAuthType( Wifi::WPA ); //Wifi::WEP | WIFI::WPA | WIFI::WPA2EAP | WIFI::NOPASS
$wifi->setSsid( 'NOMBRE DE LA RED / NETWORK NAME' );
$wifi->setPassword( 'PASSWORD' );
$wifi->setHidden( 'false' ); //true = SSID not visible, false = SSID visible

$qr = new QR( $wifi );
$qr->toPNG();
$qr->Output();
```



#### Whatsapp

```php
use Larc\QrCodeGen\QR;
use Larc\QrCodeGen\DataType\Whatsapp;

$whatsapp = new Whatsapp();
$whatsapp->setTel('+50760001000');
$whatsapp->setMessage('Hello World!');

$qr = new QR( $whatsapp );
$qr->toPNG();
$qr->Output();
```



#### Facetime ( Only Apple Device )

```php
use Larc\QrCodeGen\QR;
use Larc\QrCodeGen\DataType\Facetime;

$facetime = new Facetime();
$facetime->setContact('usuario@example.com');
$facetime->setType(Facetime::AUDIO); //Facetime::AUDIO | Facetime::VIDEO

$qr = new QR( $facetime );
$qr->toPNG();
$qr->Output();

```



#### Telephone

```php
use Larc\QrCodeGen\QR;
use Larc\QrCodeGen\DataType\Tel;

$tel = new Tel();
$tel->setNumber('60001000');

$qr = new QR( $tel );
$qr->toPNG();
$qr->Output();
```



#### SMS

```php
use Larc\QrCodeGen\QR;
use Larc\QrCodeGen\DataType\Sms;

$sms = new Sms();
$sms->setTel('60001000');
$sms->setMessage('Hello World!');

$qr = new QR( $sms );
$qr->toPNG();
$qr->Output();
```



#### Email

```php
use Larc\QrCodeGen\QR;
use Larc\QrCodeGen\DataType\Email;

$email = new Email();
$email->setAddress('luis.arcia@example.com');

$qr = new QR( $email );
$qr->toPNG();
$qr->Output();
```



**URL**

```php
use Larc\QrCodeGen\QR;
use Larc\QrCodeGen\DataType\Url;

$url = new Url();
$url->setUrl('https://google.com');

$qr = new QR( $url );
$qr->toPNG();
$qr->Output();
```



#### Text

```php
use Larc\QrCodeGen\QR;
use Larc\QrCodeGen\DataType\Text;

$text = new Text();
$text->setText('Hello World!');

$qr = new QR( $text );
$qr->toPNG();
$qr->Output();
```



#### vCard

```php
use Larc\QrCodeGen\QR;
use Larc\QrCodeGen\DataType\vCard;

$vCard = new vCard();
$vCard->addName('Primer_nombre', 'Segundo_nombre', 'Primer_apellido', 'Segundo_apellido');
$vCard->addNickname('The Boss');
$vCard->addEMail('example@mail.com', 'WORK');
$vCard->addPhoneNumber('60000000', 'PREF;WORK;VOICE');
$vCard->addCompany('Company, S.A.');
$vCard->addJobTitle('CEO');
$vCard->addUrl('https://www.example.com', 'WORK');

$qr = new QR( $vCard );
$qr->toPNG();
$qr->Output();
```



## FORMATO DE SALIDA

Estos son los formatos de salida: jpg, png, svg y eps


#### Ejemplo / Example:

```php
//PNG
$qr = new QR( object );
$qr->toPNG();
$qr->Output();

//JPG
$qr = new QR( object );
$qr->toJPG();
$qr->Output();

//SVG
$qr = new QR( object );
$qr->toSVG();
$qr->Output();

//EPS
$qr = new QR( object );
$qr->toEPS();
$qr->Output();
```



## Salida

Utilizar el método **output()** después de instanciar la clase **QR**:

**Output( [destination], [filename] )**

#### Parámetros / Parameters

```php
use Larc\QrCodeGen\Output\Destination;

Destination::FILE //Guarda el archivo en directorio / Save the file in directory
Destination::STRING_RETURN //Devuelve data en string / Returns data in string. DEFAULT
```

#### Ejemplo:

```php
use Larc\QrCodeGen\Output\Destination;

//Devolver string
$qr = new QR( object );
$qr->toPNG();
$qr->Output(); //Default: Destination:: STRING_RETURN

//Guardar en directorio
$qr = new QR( object );
$qr->toPNG();
$qr->Output(Destination::FILE, __DIR.__.'/name_file');
```



## Nota / Note

Se estarán agregando más tipo de data para convertir a QR.



