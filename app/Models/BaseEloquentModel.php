<?php namespace App\Models;

use Eloquent;
use Exception;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;
use Illuminate\Database\Eloquent\SoftDeletes;


class BaseEloquentModel extends Eloquent implements DatabaseModelInterface {

    use SoftDeletes;
    
    public $timestamps = true;
	
	public function __construct(array $attributes = array())
	{
		parent::__construct($attributes);
		$this->save();
		return $this;
	}
    
	public function __destruct(...$parentAttributes)
	{
		$this->save();
		return parent::__destruct($parentAttributes);
	}
	
    /**
     * Define a belongs-to-through relationship.
     *
     * @param string $related
     * @param string|array $through
     * @param string|null $localKey Primary Key (Default: id)
     * @param string $prefix Foreign key prefix
     *
     * @throws \Exception
     *
     * @return \App\Models\BelongsToThrough
     */
    public function belongsToThrough($related, $through, $localKey = null, $prefix = '')
    {
        if (!$this instanceof Model)
        {
            throw new Exception('belongsToThrough can used on ' . Model::class . ' only.');
        }
        /** @var \Illuminate\Database\Eloquent\Model $relatedModel */
        $relatedModel = new $related();
        $models = [];
        foreach ((array)$through as $key => $model)
        {
            $object = new $model();
            if (!$object instanceof Model)
            {
                throw new InvalidArgumentException('Through model should be instance of ' . Model::class . '.');
            }
            $models[] = $object;
        }
        if (empty($through))
        {
            throw new InvalidArgumentException('Provide one or more through model.');
        }
        $models[] = $this;
        
        return new BelongsToThrough($relatedModel->newQuery(), $this, $models, $localKey, $prefix);
    }
    
}