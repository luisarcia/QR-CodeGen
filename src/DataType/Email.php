<?php
namespace Larc\QrCodeGen\DataType;

use Larc\QrCodeGen\Interfaces\dataTypeInterface;

final class Email implements dataTypeInterface
{
	private $address;

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     *
     * @return self
     */
    public function setAddress( string $address )
    {
        $this->address = $address;

        return $this;
    }

    /**
	 * Devuelve la información
	 * @return string Data formateada
	 */
	public function getData(): string
	{
		return sprintf('mailto:%s', $this->getAddress() );
	}
}
?>