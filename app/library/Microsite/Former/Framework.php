<?php
namespace Microsite\Former;

use HtmlObject\Element;
use Former\Framework\TwitterBootstrap3;
use Former\Traits\Field;

class Framework extends TwitterBootstrap3
{
    /**
     * Add classes to a field
     *
     * @param Field $field
     * @param array $classes The possible classes to add
     *
     * @return Field
     */
    public function getFieldClasses(Field $field, $classes)
    {
        // Add inline class for checkables
        if ($field->isCheckable() and in_array('inline', $classes)) {
            $field->inline();
        }

        // Filter classes according to field type
        if ($field->isButton()) {
            $classes = $this->filterButtonClasses($classes);
        } else {
            $classes = $this->filterFieldClasses($classes);
            $classes[] = 'form-control';
        }

        $field->class(implode(' ', $classes));

        return $field;
    }

    /**
     * Add label classes
     *
     * @return string
     */
    public function getLabelClasses()
    {
        return 'col-lg-2 control-label';
    }

    /**
     * Add actions block class
     *
     * @return string
     */
    public function getActionClasses()
    {
        return 'col-lg-offset-2 col-lg-10';
    }

    /**
     * Wrap a field with potential additional tags
     *
     * @param  Field $field
     *
     * @return string A wrapped field
     */
    public function wrapField($field)
    {
        return Element::create('div', $field)->addClass('col-lg-10 controls');
    }
}