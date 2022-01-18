<?php
namespace Larc\QrCodeGen\DataType;

use Larc\QrCodeGen\Interfaces\dataTypeInterface;
use Larc\QrCodeGen\Common\UUID;

final class vCard //implements dataTypeInterface
{
	private $prodid 	= '-//weblarc, S.A.//Luis Arcia//ES';
	private $properties = [];
	public $charset 	= 'utf-8';

	/**
	 * Añade el nombre
	 * @param string $firstName     	Primer nombre
	 * @param string $secondName    	Segundo nombre (opcional)
	 * @param string $firstSurname  	Primer apellido
	 * @param string $secondSurname 	Segundo apellido (Opcional)
	 * @param string $prefix        	Prefijo.
	 * @param string $prefix        	Sufijo.
	 * @return void
	 */
	public function addName( string $firstName = '', string $secondName = null, string $firstSurname = '', string $secondSurname = null, string $prefix = null, string $suffix = null ): void
	{
		$surname = [];

		$surname[] = !is_null($firstSurname) ? $firstSurname : null;
		$surname[] = !is_null($secondSurname) ? $secondSurname : null;

		$surname = array_filter( $surname );

		$surname = !empty($surname) ?
			( count($surname) > 1 ? implode(' ', $surname) : $surname[0] ) :
			$surname = '';

		$values = array_filter([
			$prefix,
			$firstName,
			$secondName,
			$firstSurname,
			$secondSurname,
			$suffix
		]);

		$this->setProperty('fullname', 'FN', implode(' ', $values));
		$this->setProperty('name', 'N', sprintf('%s;%s;%s;%s;%s;', $surname, $firstName, $secondName, $prefix, $suffix));
	}


	/**
	 * Agrega un alias
	 * @param string $nickname	Alias de la persona
	 */
	public function addNickname( string $nickname )
	{
		$this->setProperty(
			'nickname',
			'NICKNAME',
			$nickname
		);
	}

	/**
	 * Añade email
	 * @param string $email Email
	 * @param string $type  Tipo. PREF | WORK | HOME \ o puede combinar, ejemplo: "PREF;WORK"
	 * @return void
	 */
	public function addEmail( string $email, string $type = '' ): void
	{
		$this->setProperty(
			'email',
			'EMAIL' . ($type != '' ? ';TYPE='. $type : ''),
			$email 
		);
	}

	/**
	 * Añade teléfono de contacto
	 * @param string $email Email
	 * @param string $type  Tipo. PREF | WORK | HOME | VOICE | FAX | MSG | CELL | PAGER | BBS | CAR | MODEM | ISDN | VIDEO | o puede combinar, ejemplo: "PREF;WORK;VOICE"
	 * @return void
	 */
	public function addPhoneNumber( string $phone, string $type = '' ): void
	{
		$this->setProperty(
			'phoneNumber',
			'TEL' . ($type != '' ? ';TYPE='. $type : ''),
			$phone 
		);
	}

	/**
	 * [addCompany description]
	 * @param string $company [description]
	 * @param string $type    [description]
	 */
	public function addCompany( string $company, string $department = ''): void
	{
		$this->setProperty(
			'company',
			'ORG',
			$company . ($department != '' ? ';' . $department : '')
		);
	}

	/**
	 * Agrega el puesto de la persona en la empresa
	 * @param string $jobtitle 	Puesto de la persona
	 */
	public function addJobTitle( string $jobtitle = '' )
	{
		$this->setProperty(
			'jobtitle',
			'TITLE',
			$jobtitle
		);
	}

	/**
	 * Agrega la URL de la página principal
	 * @param string $url	Url de la página
	 * @param string $type 	Tipo WORK | HOME 
	 */
	public function addUrl( string $url, string $type = '' )
	{
		$this->setProperty(
			'url',
			'URL' . ($type != '' ? ';TYPE='. $type : ''),
			$url
		);
	}

	/**
	 * Añade la propiedades al archivo final
	 * @param string $element 	Nombre del elemento que se va agregar
	 * @param string $key     	Código del elemento
	 * @param string $value   	Valor del elemento
	 */
	private function setProperty( string $element, string $key, string $value )
	{
		$this->properties[$key] = $value;
	}

	/**
	 * Construye el vCard
	 * @return string
	 */
    private function buildVCard(): string
    {
    	$string = '';
		$string .= 'BEGIN:VCARD' . PHP_EOL;
		$string .= 'VERSION:3.0' . PHP_EOL;
		$string .= 'PRODID:' . $this->prodid . PHP_EOL;
		$string .= 'UID:' . UUID::v4() . PHP_EOL; 

		foreach ($this->properties as $key => $value) {
			$string .= $key . ':'. $value . PHP_EOL;
		}
		
		$string .= 'END:VCARD';

		return $string;
    }

     /**
	 * Devuelve la información
	 * @return string Data formateada
	 */
	public function getData()
	{
	 	return $this->buildVCard();
	}
}
?>