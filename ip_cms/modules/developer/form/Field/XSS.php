<?php
/**
 * @package ImpressPages
 *
 */

/**
 * 
 * Add this field to your form to prevent XSS.
 * It adds hidden field with security token.
 * Form class adds this field by default in constructor.
 * 
 * 
 * @author Mangirdas
 *
 */
namespace Modules\developer\form\Field;


class XSS extends Blank{
    
    public function __construct($options = array()) {
        parent::__construct($options);
        $this->addValidator('XSS');
    }
    
    public function render($doctype) {
        $session = \Ip\ServiceLocator::getSession();
        return '
<input '.$this->getAttributesStr($doctype).' style="display: none;" class="ipmControlBlank '.implode(' ',$this->getClasses()).'" name="'.htmlspecialchars($this->getName()).'"  '.$this->getValidationAttributesStr($doctype).' type="text" value="'.addslashes($session->getSecurityToken()).'" />
';
    }
    

    public function getType() {
        return self::TYPE_SYSTEM;
    }
    

}