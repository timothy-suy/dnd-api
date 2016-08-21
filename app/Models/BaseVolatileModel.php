<?php namespace App\Models;

/**
 * Basic implementation of a model that has no persistence, similar to Eloquent Model
 * Class BaseVolatileModel
 *
 * @package App\Models
 */
class BaseVolatileModel {
    
    protected $attributes = [];
    
    /**
     * Create a volatile model with some attributes
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        foreach ($attributes as $attributeName => $value)
        {
            $this->setAttribute($attributeName, $value);
        }
    }
    
    /**
     * Create a volatile model with some attributes
     *
     * @param array $attributes
     *
     * @return static
     */
    static public function create(array $attributes = [])
    {
        return new static($attributes);
    }
    
    /**
     * Dynamically retrieve attributes on the model.
     *
     * @param  string $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        return $this->getAttribute($key);
    }
    
    /**
     * Dynamically set attributes on the model.
     *
     * @param  string $key
     * @param  mixed $value
     *
     * @return void
     */
    public function __set($key, $value)
    {
        $this->setAttribute($key, $value);
    }
    
    /**
     * Determine if an attribute exists on the model.
     *
     * @param  string $key
     *
     * @return bool
     */
    public function __isset($key)
    {
        return (isset($this->attributes[$key]) || ($this->hasGetMutator($key) && !is_null($this->getAttributeValue($key))));
    }
    
    /**
     * Unset an attribute on the model.
     *
     * @param  string $key
     *
     * @return void
     */
    public function __unset($key)
    {
        unset($this->attributes[$key]);
    }
    
    /**
     * Get an attribute from the model.
     *
     * @param  string $key
     *
     * @return mixed
     */
    public function getAttribute($key)
    {
        $inAttributes = array_key_exists($key, $this->attributes);
        
        // If the key references an attribute, we can just go ahead and return the
        // plain attribute value from the model. This allows every attribute to
        // be dynamically accessed through the _get method without accessors.
        if ($inAttributes || $this->hasGetMutator($key))
        {
            return $this->getAttributeValue($key);
        }
    }
    
    /**
     * Get all the attributes
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
    
    /**
     * Set a given attribute on the model, and cast if the type is specified by applied attributes
     * (eg: $integers, $booleans, ...)
     *
     * @param  string $key
     * @param  mixed $value
     *
     * @return void
     */
    public function setAttribute($key, $value)
    {
        // Check $booleans
        if (in_array($key, $this->booleans))
        {
            // Strict casting of boolean (also see ContextualValidator::$STRICT_BOOLEAN_RULE)
            $value = $value === true || $value === 'true' || $value === 1 || $value === '1';
        }
        
        // TODO: Check $integers & $dates
        
        // Check for the presence of a mutator for the set operation
        if ($this->hasSetMutator($key))
        {
            $method = 'set' . studly_case($key) . 'Attribute';
            
            return $this->{$method}($value); // Call the mutator, it will set the local attribute (return to discontinue and avoid setting un-mutated attribute)
        }
        
        $this->attributes[$key] = $value;
    }
    
    /**
     * Set multiple attributes
     *
     * @param $attributeValues
     * @param bool $truncate
     */
    public function setAttributes($attributeValues, $truncate = false)
    {
        if ($truncate)
        {
            $this->attributes = [];
        }
        
        foreach ($attributeValues as $attribute => $value)
        {
            $this->setAttribute($attribute, $value);
        }
    }
    
    /**
     * Determine if a get mutator exists for an attribute.
     *
     * @param  string $key
     *
     * @return bool
     */
    public function hasGetMutator($key)
    {
        return method_exists($this, 'get' . studly_case($key) . 'Attribute');
    }
    
    /**
     * Determine if a set mutator exists for an attribute.
     *
     * @param  string $key
     *
     * @return bool
     */
    public function hasSetMutator($key)
    {
        return method_exists($this, 'set' . studly_case($key) . 'Attribute');
    }
    
    
    
    /**
     * Loop over the $integers array and convert all of those keys to integers.
     *
     * @param string $key
     *
     * @return int|mixed
     */
    protected function getAttributeValue($key)
    {
        $value = array_get($this->attributes, $key);
        
        if (in_array($key, $this->integers))
        {
            return (int)$value;
        }
        
        if (in_array($key, $this->booleans))
        {
            // Strict casting of boolean (also see ContextualValidator::$STRICT_BOOLEAN_RULE)
            return $value === true || $value === 'true' || $value === 1 || $value === '1';
        }
        
        return $value;
    }
    
    /**
     * Convert the Model to an array of it's attributes
     *
     * @return array
     */
    public function toArray()
    {
        $array = [];
        foreach ($this->attributes as $attributeName => $value)
        {
            $array[$attributeName] = $this->getAttributeValue($attributeName);
        }
        
        return $array;
    }
    
    /**
     * Convert the model to its string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }
    
    /**
     * Convert the model to JSON notation
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }
    
}