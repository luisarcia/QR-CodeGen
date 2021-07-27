<?php
namespace Larc\QrCodeGen\DataType;

use Larc\QrCodeGen\Interfaces\dataTypeInterface;

final class Tel implements dataTypeInterface
{
	private $number;

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     *
     * @return self
     */
    public function setNumber( string $number )
    {
        $this->number = $number;

        return $this;
    }

    /**
	 * Devuelve la información
	 * @return string Data formateada
	 */
	public function getData(): string
	{
		return sprintf('tel:%s', $this->getNumber());
	}
}
?>