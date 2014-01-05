<?php

class Selector_SearchParameter
{
    /**
     * The parameter name.
     * 
     * @var string
     */
    private $_sParameter;

    /**
     * The value to compare to.
     * 
     * @var mixed
     */
    private $_mValue;

    /**
     * The condition.
     * 
     * @var string
     */
    private $_sCondition;

    /**
     * There might be a seletor set set method that must be used.
     *
     * @var string|null
     */
    private $_sSetMethod;

    /**
     * Getter for the condition.
     *
     * @return string
     */
    function getCondition()
    {
        return $this->_sCondition;
    }

    /**
     * Getter for the parameter name.
     *
     * @return string
     */
    function getParameterName()
    {
        return $this->_sParameter;
    }

    /**
     * Getter for the parameter value.
     *
     * @return mixed
     */
    function getParameterValue()
    {
        return $this->_mValue;
    }

    /**
     * Gets the set method.
     *
     * @return string|null
     */
    function getSetMethod()
    {
        return $this->_sSetMethod;
    }

    /**
     * Init with query data.
     * 
     * @param string $a_sParameter
     * @param mixed $a_mValue
     * @param string $a_sCondition
     * @param string|null $a_sSetMethod
     * @return Selector_SearchParameter
     */
    function __construct($a_sParameter, $a_mValue, $a_sCondition, $a_sSetMethod = null)
    {
        $this->_sParameter  = $a_sParameter;
        $this->_mValue      = $a_mValue;
        $this->_sCondition  = $a_sCondition;
        $this->_sSetMethod  = $a_sSetMethod;
    }

    /**
     * Generate the condition.
     * 
     * @return string
     */
    function __toString()
    {
        if (is_bool($this->_mValue)) { 
            $this->_mValue = $this->_mValue ? '1' : '0';
        }
        
        // undo any escaping that might have been done on this field
        $sQueryCondition = str_replace("\\", '',"($this->_sParameter ");

        if (($this->_sCondition === Selector::CONDITION_IN || $this->_sCondition === Selector::CONDITION_NOT_IN)) {
            // array param here
            if (is_array($this->_mValue) && count($this->_mValue)) {
                // generated condition
                $sQueryCondition .= " $this->_sCondition ('" . implode("','", $this->_mValue) . "'))";
            } else {
                // IN/NOT IN condition already comma separated
                $sQueryCondition .= " $this->_sCondition $this->_mValue ";
            }
        } else {
            // regular parameter
            switch ($this->_sCondition) {
                case Selector::CONDITION_EQUALS_NO_QUOTE:
                case Selector::CONDITION_EQUALS:
                        $sQueryCondition .= "=";
                        break;
                case Selector::CONDITION_LTE:
                        $sQueryCondition .= "<=";
                        break;
                case Selector::CONDITION_GTE:
                        $sQueryCondition .= ">=";
                        break;
                case Selector::CONDITION_GT:
                        $sQueryCondition .= ">";
                        break;
                case Selector::CONDITION_LT:
                        $sQueryCondition .= "<";
                        break;
                case Selector::CONDITION_LIKE_LEFT:
                    $this->_mValue = "%$this->_mValue";
                    $sQueryCondition .= " LIKE ";
                    break;
                case Selector::CONDITION_LIKE_RIGHT:
                    $this->_mValue = "$this->_mValue%";
                    $sQueryCondition .= " LIKE ";
                    break;
                case Selector::CONDITION_LIKE_LEFT_AND_RIGHT:
                    $this->_mValue = "%$this->_mValue%";
                    $sQueryCondition .= " LIKE ";
                    break;
                case Selector::CONDITION_IS_NULL:
                    $sQueryCondition .= "IS NULL)";
                    break;
            }
            // special logic
            if ($this->_sCondition == Selector::CONDITION_IS_NULL) {
                $this->_mValue = ""; // redundant, really...
            } else if ($this->_sCondition != Selector::CONDITION_EQUALS_NO_QUOTE) {
                $sQueryCondition .= "'{$this->_mValue}')";
            } else {
                $sQueryCondition .= "{$this->_mValue})";
            }
        }

        return $sQueryCondition;
    }
}