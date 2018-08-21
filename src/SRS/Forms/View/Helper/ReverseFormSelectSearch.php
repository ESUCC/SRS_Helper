<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Form
 */

namespace Makersoft\Forms\View\Helper;

use Zend\Form\View\Helper\FormSelect;
use Zend\Form\ElementInterface;
use Zend\Form\Exception;

/**
 * @category   Zend
 * @package    Zend_Form
 * @subpackage View
 */
class ReverseFormSelectSearch extends FormSelect
{

    public function render(ElementInterface $element)
    {

        $name = $element->getName();
        if (empty($name) && $name !== 0) {
            throw new Exception\DomainException(sprintf(
                '%s requires that the element has an assigned name; none discovered',
                __METHOD__
            ));
        }

        $options = $element->getValueOptions();
        /*echo "<pre>";
        print_r($options);
        die("</pre>");*/
        if (empty($options)) {
            throw new Exception\DomainException(sprintf(
                '%s requires that the element %s has "value_options"; none found',
                __METHOD__, $name
            ));
        }

        if (($emptyOption = $element->getEmptyOption()) !== null) {
            $options = array('' => $emptyOption) + $options;
        }

        $attributes = $element->getAttributes();
        $value      = $this->validateMultiValue($element->getValue(), $attributes);

        $attributes['name'] = $name;
        /*if (array_key_exists('multiple', $attributes) && $attributes['multiple']) {
            $attributes['name'] .= '[]';
        }*/
        $this->validTagAttributes = $this->validSelectAttributes;
        $extended = $element->getOption('extended');
        /*echo '<pre>';
        print_r($extended);
        echo '</pre>';*/
        
        return sprintf(
            '<select %s>%s</select>',
            $this->createAttributesString($attributes),
                (isset($extended['grouped']) && $extended['grouped']) 
                    ? $this->renderGroupedOptions($options, is_array($value) ? $value : explode(',', $value))
                    : $this->renderOptions($options, is_array($value) ? $value : explode(',', $value))
            );
    }
    
   public function renderGroupedOptions($options, $selected_values){
        $options_string = "";
        if(isset($extended['showEmpty']) && $extended['showEmpty'] === TRUE)
            $options_string .= "<option></option>";
        
        foreach($options as $group_name => $values){
            $options_string .= '<optgroup label="'.$group_name.'">';
            foreach($values as $key => $value){
                $options_string .= '<option value="'.$key.'" '.(in_array($key, $selected_values) ? 'selected="selected"' : '').'>'.$value.'</option>';
            }
            $options_string .= '</optgroup>';
        }
        
        return $options_string;
    }

}
