<?php
/**
* @version 			SEBLOD 3.x Core
* @package			SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				http://www.seblod.com
* @editor			Octopoos - www.octopoos.com
* @copyright		Copyright (C) 2009 - 2016 SEBLOD. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;
JCckDev::initScript( 'live', $this->item );

$db = JFactory::getDBO();
$query = "SELECT template FROM #__template_styles WHERE client_id = 0 AND home = 1";
$db->setQuery($query);
$defaultemplate = $db->loadResult();

$path   = JPATH_SITE.'/templates/'.$defaultemplate.'/dyndefault.php';
?>

<div class="seblod">
	<?php echo JCckDev::renderLegend( JText::_( 'COM_CCK_CONSTRUCTION' ), JText::_( 'PLG_CCK_FIELD_LIVE_'.$this->item->name.'_DESC' ) ); ?>
	<ul class="adminformlist adminformlist-2cols">
		<?php
		    echo JCckDev::renderForm( 'core_dev_text', '', $config, array( 'label'=>'Function Name', 'storage_field'=>'functionname' ) );
            echo JCckDev::renderForm( 'core_bool', '', $config, array( 'label'=>'Send Default Parameter', 'description'=>'adv_description','storage_field'=>'sendparam' ) );
            echo JCckDev::renderForm( 'core_dev_text', '', $config, array( 'label'=>'Custom Path','defaultvalue'=>$path,'description'=>'filepath_description', 'storage_field'=>'filepath' ) );
        
		?>
	</ul>
    <?php
    echo JText::_( 'COM_CCK_PATHHELPER' );
    echo "<br/>Root: ".JPATH_SITE;
    echo "<br/>Templates: ".JPATH_SITE.'/templates/'.$defaultemplate.'/';
    ?>
</div>


<script type="text/javascript">
 //   jQuery(document).ready(function($) {
       // $('#custompath').isVisibleWhen('adv_setting','1');
       // $('#variable,#default_value,#crypt').isVisibleWhen('multiple','0');
  //  });
</script>