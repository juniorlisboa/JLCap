<?php
/**
 * JLCap - Class for captcha
 *
 * @author Junior Lisboa <juniorlisboaaju@gmail.com>
 * @link http://juniorlisboa.com/
 */
class JLCap {
 
var $captchacode = '';
var $dirassets = '../dist/';
var $size = 8;
var $alphabet = 'abcdefghijklmnopqrstuvwxyz0123456789';
var $type_header = 'image/png';

var $rgbcolor = array(66,66,11);
 
var $images_dir = array(
 						"default" =>"blue.png",
 						"confuse" =>"confuse.png",
 						"ball" =>"ball.png",
 						"dotted" =>"dotted.png",
 					);
 
 	
var $fonts_dir = array(
 						"default" =>"anonymous.gdf",
 					);
 
 	
 	function JLCap($cd = false)
	{
		if($cd)
			$this->captchacode = $cd ;
		

		//FONT AND IMAGE DEFAULT
		$this->imageCap = imagecreatefrompng($this->dirassets."img/".$this->images_dir['default']);
		$this->fontCap =  imageloadfont($this->dirassets."font/".$this->fonts_dir['default']);
	}

	function randomCaptcha()
	{
				
		$this->captchacode = '';

		for ($i = $this->size; $i > 0; --$i) {
			// Sorteando uma posicao do alfabeto
			$posicao_sorteada = mt_rand(0, (strlen($this->alphabet) - 1));
			// Obtendo o simbolo correspondente do alfabeto
			$caractere_sorteado = $this->alphabet[$posicao_sorteada];
			// Incluindo o simbolo na sequencia
			$this->captchacode .= $caractere_sorteado;
		}											

		return $this->captchacode;		
	}


	function loadImageBackground($image){
		$this->imageCap = imagecreatefrompng($this->dirassets."img/".$this->images_dir[$image]);
	}

	function loadFontText($font){
		$this->fontCap =  imageloadfont($this->dirassets."font/".$this->fonts_dir[$font]);
	}

	function headerType(){
			header("Content-type: image/png");//.$this->type_header);
	}

	function captchaShow(){
		
		if($this->captchacode =='')
				$this->randomCaptcha();

		$this->colorCap = imagecolorallocate($this->imageCap,$this->rgbcolor[0],$this->rgbcolor[1],$this->rgbcolor[2]);
		 
		imagestring( $this->imageCap,
					 $this->fontCap,
					 15,5,
					 $this->captchacode,
					 $this->colorCap
					 );
		
		$this->headerType();
 		$this->openImage();
 		$this->destroyImage();

 		return $this->captchacode;		
	}

	function openImage(){

		imagepng($this->imageCap);
	}

	function destroyImage(){

		imagedestroy($this->imageCap);
	}



}

?>