<?php
namespace Larc\QrCodeGen\DataType;

use Larc\QrCodeGen\Interfaces\dataTypeInterface;

final class Whatsapp implements dataTypeInterface
{
	private $tel;
	private $message;

    /**
     * @return mixed
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param mixed $tel
     *
     * @return self
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     *
     * @return self
     */
    public function setMessage( string $message = '' )
    {
        $this->message = strlen( $message ) > 0 ? $message : null;

        return $this;
    }

    /**
	 * Devuelve la información
	 * @return string Data formateada
	 */
	public function getData(): string
	{
		return is_null($this->getMessage()) ?
			sprintf('https://wa.me/%s', $this->getTel()) :
			sprintf('https://wa.me/%s?text=%s', $this->getTel(), $this->getMessage());
	}
}
?>