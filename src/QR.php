<?php
namespace Larc\QrCodeGen;

use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Color\{Rgb, Gray};
use BaconQrCode\Renderer\Image\{SvgImageBackEnd, ImagickImageBackEnd, EpsImageBackEnd};
use BaconQrCode\Renderer\Eye\{SimpleCircleEye, SquareEye, CompositeEye, ModuleEye, EyeInterface};
use BaconQrCode\Renderer\Module\{DotsModule, RoundnessModule};
use BaconQrCode\Renderer\RendererStyle\{RendererStyle, Fill};
use BaconQrCode\Writer;
use Larc\QrCodeGen\Output;
use Larc\QrCodeGen\Common\Base64;
use Larc\QrCodeGen\Output\Destination;

final class QR
{
	private $data;
	private $size;
	private $margin;
	private $extension;
	private $typeImage;

	/**
	 * Define las especificaciones del QR
	 * @param Object      $data   Data
	 * @param int|integer $size   Tamaño del QR. Default: 500
	 * @param int|integer $margin Margen del QR. Defatul: 1
	 */
	function __construct( Object $data, int $size = 300, int $margin = 1 )
	{
		$this->data 	= $data->getData();
		$this->size		= $size;
		$this->margin 	= $margin;
	}

	private function ImageRenderer( $format )
	{
		$backgroundColor 	= new Rgb(255,255,255);
		$foregroundColor	= new Rgb(0,0,0);
		$qrColor 			= Fill::uniformColor($backgroundColor, $foregroundColor);


		$RendererStyle		= new RendererStyle( $this->size, $this->margin, null, null, $qrColor);
		$ImageRenderer 		= new ImageRenderer( $RendererStyle, $format );

		return $ImageRenderer;
	}

	/**
	 * Convierte a PNG
	 * @param  int|integer $quality Calidad de la imagen. Default: 100
	 * @return void
	 */
	public function toPNG( int $quality = 100 ): void
	{
		$this->extension 	= '.png';
		$this->typeImage 	= new ImagickImageBackEnd( 'png', $quality );
	}

	/**
	 * Convierte a JPG
	 * @param  int|integer $quality Calidad de la imagen. Default: 100
	 * @return void
	 */
	public function toJPG( int $quality = 100 ): void
	{
		$this->extension 	= '.jpg';
		$this->typeImage 	= new ImagickImageBackEnd( 'jpg', $quality );
	}

	/**
	 * Convierte a SVG
	 * @return void
	 */
	public function toSVG(): void
	{
		$this->extension 	= '.svg';
		$this->typeImage 	= new SvgImageBackEnd();
	}

	/**
	 * Convierte a EPS
	 * @return void
	 */
	public function toEPS(): void
	{
		$this->extension 	= '.eps';
		$this->typeImage 	= new EpsImageBackEnd();
	}

	/**
	 * Output
	 */
	public function Output( string $destination = Destination::STRING_RETURN, string $filename = '' )
	{
		$writer = new Writer( $this->ImageRenderer( $this->typeImage ) );

		switch ( $destination ) {
			case 'S':
				return Base64::encode( $writer->writeString( $this->data ), $this->extension );
				break;

			case 'F':
				$writer->writeFile( $this->data, $filename . $this->extension );
				break;
		}
	}
}
?>