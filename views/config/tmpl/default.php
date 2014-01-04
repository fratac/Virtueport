<?php
/*------------------------------------------------------------------------
# VirtuePort
# ------------------------------------------------------------------------
# Copyright (C) 2011 Francesco Tacconi. All Rights Reserved.
# Website: http://www.francescotacconi.it
-------------------------------------------------------------------------*/
// no direct access
defined('_JEXEC') or die('Restricted access');
?> 
<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
		// do field validation
		if (form.gsitename.value == "") {
			alert( "<?php echo JText::_( 'Il nome del sito è obbligatorio', true ); ?>" );
		} else {
			submitform( pressbutton );
		}
		if (form.gdescription.value == "") {
			alert( "<?php echo JText::_( 'Una descrizione è obbligatoria', true ); ?>" );
		} else {
			submitform( pressbutton );
		}
	}
</script>
<style type="text/css">
	td.configsectionhead {font-weight: bold; margin-top: 10px; color: #000; height: 30px; vertical-align: bottom;}
</style>
<form action="" method="post" name="adminForm" id="adminForm">
<table width="100%">
		<h3><?php echo JText::_('Configurazione');?></h3>
		
		<table class="admintable" style="float:left;width:48.9%">
			<tr>
				<td class="configsectionhead" colspan="2"><?php echo JText::_('Linea di controllo');?></td>
			</tr>
			<tr>
				<td align="right" class="key">
					<?php echo JText::_('Nome Sito');?>
				</td>
				<td>
					<input class="text_area" type="text" name="gsitename" id="gsitename" size="50" maxlength="50" value="<?php echo $this->row->gsitename; ?>" />
				</td>
			</tr>
			<tr>
				<td align="right" class="key">
					<?php echo JText::_('Descrizione');?>
				</td>
				<td>
					<input class="text_area" type="text" name="gdescription" id="gdescription" size="50" maxlength="50" value="<?php echo $this->row->gdescription; ?>" />
				</td>
			</tr>
					
		
		
			<tr>
				<td align="right" class="key">
					<?php echo JText::_('categorie');?>
				</td>
				<td>
                	<input type="radio" name="default_category" id="default_category"  value="0" <?php if($this->row->default_category == 0) echo 'checked="checked"'; ?> class="inputbox">
                	<label for="category"><?php echo JText::_('NO'); ?></label>
                	<input type="radio" name="default_category" id="default_category" value="1"  <?php if($this->row->default_category == 1) echo 'checked="checked"'; ?> class="inputbox">
                	<label for="category"><?php echo JText::_('SI'); ?></label>
				</td>
			</tr>
			<tr>
				<td align="right" class="key">
					<?php echo JText::_('Produttore');?>
				</td>
				<td>
                	<input type="radio" name="default_manufacturer" id="default_manufacturer"  value="0" <?php if($this->row->default_manufacturer == 0) echo 'checked="checked"'; ?> class="inputbox">
                	<label for="manufacturer"><?php echo JText::_('NO'); ?></label>
                	<input type="radio" name="default_manufacturer" id="default_manufacturer" value="1" <?php if($this->row->default_manufacturer == 1) echo 'checked="checked"'; ?>  class="inputbox">
                	<label for="manufacturer"><?php echo JText::_('SI'); ?></label>
				</td>
			</tr>
				<td align="right" class="key">
					<?php echo JText::_('Quantità');?>
				</td>
				<td>
                	<input type="radio" name="default_quantite" id="default_quantite"  value="0" <?php if($this->row->default_quantite == 0) echo 'checked="checked"'; ?> class="inputbox">
                	<label for="quantite"><?php echo JText::_('NO'); ?></label>
                	<input type="radio" name="default_quantite" id="default_quantite" value="1"  <?php if($this->row->default_quantite == 1) echo 'checked="checked"'; ?> class="inputbox">
                	<label for="quantite"><?php echo JText::_('SI'); ?></label>
				</td>
			</tr>
			
			
			 
		
			
			
		</table>
		
   </table>
	
	 <input type="hidden" name="option" value="com_virtueport" />
    <input type="hidden" name="task" value="save" />
	<input type="hidden" name="controller" value="config" />
<input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
</form>
