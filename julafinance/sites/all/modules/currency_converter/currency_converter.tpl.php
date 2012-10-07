<?php
// $Id: currency_converter.tpl.php,v 1.1 2011/02/13 13:00:06 spleshka Exp $ 

/**
 * @file currency_converter.tpl.php
 * Default theme implementation for displaying a money informer form within a block region.
 *
 * Available variables:
 * - $body: The complete form ready for print.
 * - $time: Date of last update
 * - $developers: link to developers' site
 *  
 *
 * @see template_preprocess_currency_converter_block_form()
 */
?>
<div id = "currency_converter">
	
	<div class = "top"></div>
	
	<div class = "center">

		<?php echo $body; ?>
		
		<div class = "additional">		    
			<span><?php echo $time; ?></span>
			<?php echo $developers; ?>
		</div>		

	</div>
	
	<div class = "bottom"></div>

</div>