<?php namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Str;

/**
 * This file belongs to server.
 *
 * Author: Rahul Kadyan, <hi@znck.me>
 * Find license in root directory of this project.
 *
 * @author: https://github.com/znck/belongs-to-through
 */
class BelongsToThrough extends Relation {
    
    /**
     * Column alias for matching eagerly loaded models.
     *
     * @var string
     */
    const RELATED_THROUGH_KEY = '__deep_related_through_key';
    
    /**
     * List of intermediate model instances.
     *
     * @var \Illuminate\Database\Eloquent\Model[]
     */
    protected $models;
    
    /**
     * The local key on the relationship.
     *
     * @var string
     */
    protected $localKey;
    
    /**
     * @var string
     */
    private $prefix;
    
    /**
     * Create a new instance of relation.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Database\Eloquent\Model $parent
     * @param array $models
     * @param string|null $localKey
     * @param string $prefix
     */
    public function __construct(Builder $query, Model $parent, array $models, $localKey = null, $prefix = '')
    {
        $this->models = $models;
        $this->localKey = $localKey ?: $parent->getKeyName();
        $this->prefix = $prefix;
        
        parent::__construct($query, $parent);
    }
    
    /**
     * Set the base constraints on the relation query.
     */
    public function addConstraints()
    {
        $this->setJoins();
        
        $this->getQuery()->select([$this->getRelated()->getTable() . '.*']);
        
        if (static::$constraints)
        {
            $this->getQuery()->where($this->getQualifiedParentKeyName(), '=', $this->parent[$this->localKey]);
            $this->setSoftDeletes();
        }
    }
    
    /**
     * Set the required joins on the relation query.
     */
    protected function setJoins()
    {
        $one = $this->getRelated()->getQualifiedKeyName();
        $prev = $this->getForeignKey($this->getRelated());
        $lastIndex = count($this->models) - 1;
        foreach ($this->models as $index => $model)
        {
            if ($lastIndex === $index)
            {
                $prev = $this->prefix . $prev;
            }
            $other = $model->getTable() . '.' . $prev;
            $this->getQuery()->leftJoin($model->getTable(), $one, '=', $other);
            
            $prev = $this->getForeignKey($model);
            $one = $model->getQualifiedKeyName();
        }
    }
    
    /**
     * Get the underlying query for the relation.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function getQuery()
    {
        return $this->query;
    }
    
    /**
     * Set the soft deleting constraints on the relation query.
     */
    protected function setSoftDeletes()
    {
        foreach ($this->models as $model)
        {
            if ($this->hasSoftDeletes($model))
            {
                $this->getQuery()->whereNull($model->getQualifiedDeletedAtColumn());
            }
        }
    }
    
    /**
     * Get foreign key column name for the model.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return string
     */
    protected function getForeignKey(Model $model)
    {
        return Str::singular($model->getTable()) . '_id';
    }
    
    /**
     * Determine whether the model uses Soft Deletes.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return bool
     */
    public function hasSoftDeletes(Model $model)
    {
        return in_array(SoftDeletingTrait::class, class_uses_recursive(get_class($model)));
    }
    
    /**
     * Set the constraints for an eager load of the relation.
     *
     * @param array $models
     */
    public function addEagerConstraints(array $models)
    {
        $this->getQuery()->addSelect([
            $this->getParent()->getQualifiedKeyName() . ' as ' . self::RELATED_THROUGH_KEY,
        ]);
        
        $this->getQuery()->whereIn($this->getParent()->getQualifiedKeyName(), $this->getKeys($models, $this->localKey));
    }
    
    /**
     * Add the constraints for a relationship count query.
     *
     * @param \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder $parent
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function getRelationCountQuery(Builder $query, Builder $parent)
    {
        $query->select(new Expression('count(*)'));
        
        $one = $this->getRelated()->getQualifiedKeyName();
        $prev = $this->getForeignKey($this->getRelated());
        $alias = null;
        $lastIndex = count($this->models);
        foreach ($this->models as $index => $model)
        {
            if ($lastIndex === $index)
            {
                $prev = $this->prefix . $prev;
            }
            if ($this->getParent()->getTable() == $model->getTable())
            {
                $alias = $model->getTable() . '_' . time();
                $other = $alias . '.' . $prev;
                $query->leftJoin(new Expression($model->getTable() . ' as ' . $alias), $one, '=', $other);
            }
            else
            {
                $other = $model->getTable() . '.' . $prev;
                $query->leftJoin($model->getTable(), $one, '=', $other);
            }
            
            $prev = $this->getForeignKey($model);
            $one = $model->getQualifiedKeyName();
        }
        
        $key = $this->wrap($this->getQualifiedParentKeyName());
        
        $query->where(new Expression($alias . '.' . $this->getParent()->getKeyName()), '=', new Expression($key));
        
        return $query;
    }
    
    /**
     * Get the results of the relationship.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getResults()
    {
        return $this->getQuery()->first();
    }
    
    /**
     * Initialize the relation on a set of models.
     *
     * @param \Illuminate\Database\Eloquent\Model[] $models
     * @param string $relation
     *
     * @return array
     */
    public function initRelation(array $models, $relation)
    {
        foreach ($models as $model)
        {
            $model->setRelation($relation, $this->getRelated());
        }
        
        return $models;
    }
    
    /**
     * Match the eagerly loaded results to their parents.
     *
     * @param \Illuminate\Database\Eloquent\Model[] $models
     * @param \Illuminate\Database\Eloquent\Collection $results
     * @param string $relation
     *
     * @return array
     */
    public function match(array $models, Collection $results, $relation)
    {
        $dictionary = $this->buildDictionary($results);
        
        foreach ($models as $model)
        {
            $key = $model->{$this->localKey};
            
            if (isset($dictionary[$key]))
            {
                $model->setRelation($relation, $dictionary[$key]);
            }
        }
        
        return $models;
    }
    
    /**
     * Build model dictionary keyed by the relation's foreign key.
     *
     * @param \Illuminate\Database\Eloquent\Collection $results
     *
     * @return array
     */
    protected function buildDictionary(Collection $results)
    {
        $dictionary = [];
        
        foreach ($results as $result)
        {
            $dictionary[$result->{static::RELATED_THROUGH_KEY}] = $result;
            unset($result[static::RELATED_THROUGH_KEY]);
        }
        
        return $dictionary;
    }
}