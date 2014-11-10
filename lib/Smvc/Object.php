<?php

class Smvc_Object
{
    protected $__data = array();
    
    /**
     * Retrieves data from the object
     *
     * If $key is empty will return all the data as an array
     * Otherwise it will return value of the attribute specified by $key
     *
     * @param string|array $key
     * @return mixed
     */
    public function getData($key = '')
    {
        if ('' === $key) {
            return $this->__data;
        }
        
        if (is_array($key)) {
            $data = array();
            foreach ($key as $keyValue) {
                if ('' === $keyValue) {
                    return $this->__data;
                }
                
                $data[$keyValue] = array_key_exists($keyValue, $this->__data) ?
                    $this->__data[$keyValue] :
                    null;
            }
            
            return $data;
        }
        
        return array_key_exists($key, $this->__data) ? $this->__data[$key] : null;
    }
    
    /**
     * Sets data in the object.
     *
     * $key can be string or array.
     * If $key is string, the data value will be overwritten by $value
     *
     * If $key is an array, eack $key element will overwrite proper data value.
     *
     * @param string|array $key
     * @param mixed $value
     * @return Smvc_Object
     */
    public function setData($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $keyIndex => $keyValue) {
                if ('' === $keyIndex) {
                    $this->__data = $key;
                    return $this;
                }
                
                if (is_string($keyIndex)) {
                    $this->__data[$keyIndex] = $keyValue;
                }
            }
            
            return $this;
        }
        
        if (is_string($key)) {
            $this->__data[$key] = $value;
        }
        
        return $this;
    }
}