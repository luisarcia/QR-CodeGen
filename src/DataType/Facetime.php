<?php
namespace Larc\QrCodeGen\DataType;

use Larc\QrCodeGen\Interfaces\dataTypeInterface;

final class Facetime implements dataTypeInterface
{
	public const VIDEO 	= 'facetime';
	public const AUDIO 	= 'facetime-audio';
	private $contact;
	private $type;

    /**
     * @return mixed
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param mixed $contact
     *
     * @return self
     */
    public function setContact( string $contact )
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     *
     * @return self
     */
    public function setType( string $type = Facetime::VIDEO )
    {
        $this->type = $type;

        return $this;
    }

    /**
	 * Devuelve la información
	 * @return string Data formateada
	 */
	public function getData(): string
	{
		return $this->getType() == Facetime::VIDEO ?
			sprintf('facetime:%s', $this->getContact()) :
			sprintf('facetime-audio:%s', $this->getType());
	}
}
?>