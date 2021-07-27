<?php
namespace Larc\QrCodeGen\DataType;

use Larc\QrCodeGen\Interfaces\dataTypeInterface;

final class Url implements dataTypeInterface
{
	private $url;

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     *
     * @return self
     */
    public function setUrl( string $url )
    {
        $this->url = $url;

        return $this;
    }

    /**
	 * Devuelve la información
	 * @return string Data formateada
	 */
	public function getData(): string
	{
		return $this->getUrl();
	}
}
?>