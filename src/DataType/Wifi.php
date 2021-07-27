<?php
namespace Larc\QrCodeGen\DataType;

use Larc\QrCodeGen\Interfaces\dataTypeInterface;

final class Wifi implements dataTypeInterface
{
	public const WEP 		= 'WEP';
	public const WPA 		= 'WPA';
	public const WPA2EAP	= 'WPA2-EAP';
	public const NOPASS		= 'nopass';
	private $authType;
	private $ssid;
	private $password;
	private $hidden;

    /**
     * @return string
     */
    public function getAuthType()
    {
        return $this->authType;
    }

    /**
     * @param string $authType
     *
     * @return self
     */
    public function setAuthType( string $authType = Wifi::WPA )
    {
        $this->authType = $authType;

        return $this;
    }

    /**
     * @return string
     */
    public function getSsid()
    {
        return $this->ssid;
    }

    /**
     * @param string $ssid
     *
     * @return self
     */
    public function setSsid( string $ssid )
    {
        $this->ssid = $ssid;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return self
     */
    public function setPassword( string $password )
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getHidden()
    {
        return $this->hidden;
    }

    /**
     * @param string $hidden
     *
     * @return self
     */
    public function setHidden( string $hidden = 'false' )
    {
        $this->hidden = $hidden;

        return $this;
    }

     /**
	 * Devuelve la información
	 * @return string Data formateada
	 */
	public function getData(): string
	{
		return sprintf('WIFI:T:%s;S:%s;P:%s;H:%s;', $this->getAuthType(), $this->getSsid(), $this->getPassword(), $this->getHidden() );
	}
}
?>