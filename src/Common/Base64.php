<?php
declare(strict_types = 1);

namespace Larc\QrCodeGen\Common;

class Base64
{
	/**
	 * Codifica string a base64
	 * @param  string $string Binario
	 * @param  string $format Formato para establecer el MIME
	 * @return string         String formateada
	 */
	public static function encode( string $string, string $format ): string
	{
		switch ( $format ) {
			case '.png':
				return sprintf('data:image/png;base64,%s', base64_encode($string));
				break;

			case '.jpg':
				return sprintf('data:image/jpeg;base64,%s', base64_encode($string));
				break;
		}
	}

	/**
	 * Decodificar string desde base64
	 * @param  string $string String en Base64
	 * @return string         Binario
	 */
	public static function decode( string $string ): string
	{
		return base64_decode( $string );
	}
}
?>