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

use Joomla\Utilities\ArrayHelper;

// Plugin
class plgCCK_Field_LiveDx_Dyndefault extends JCckPluginLive
{
	protected static $type	=	'dx_dyndefault';
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Prepare
	
	// onCCK_Field_LivePrepareForm
	public function onCCK_Field_LivePrepareForm( &$field, &$value = '', &$config = array() )
	{
		if ( self::$type != $field->live ) {
			return;
		}
		//Language
        $lang = JFactory::getLanguage();
        $extension="PLG_CCK_FIELD_LIVE_DX_DYNDEFAULT";
        $base_dir = JPATH_ADMINISTRATOR;
        $language_tag=$lang->getTag();
        $reload=true;
        $lang->load($extension, $base_dir, $language_tag, $reload);

		// Init
		$app		=	JFactory::getApplication();
		$live		=	'';
		$options	=	parent::g_getLive( $field->live_options );
		
		// Prepare
        $functionname			=	$options->get( 'functionname', '' );
        $sendparam=$options->get('sendparam','0');
        $path=$options->get('filepath','');

        if(file_exists($path)) {
            require_once($path);
            if(function_exists($functionname)) {
                if($sendparam==0) {
                    $value = $functionname();
                }else{
                    $value =$functionname($field, $value, $config);
                }
            }else{
                JFactory::getApplication()->enqueueMessage(JText::_('PLG_CCK_FIELD_LIVE_GROUP_NO_FUNCTIONFOUND'), 'error');
            }
        }else{
            JFactory::getApplication()->enqueueMessage(JText::_('PLG_CCK_FIELD_LIVE_GROUP_NO_DYNAMICDEFAULT'), 'error');
        }
	}


}

?>