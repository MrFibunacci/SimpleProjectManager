<?php

namespace Tests;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;

abstract class ModelTestCase extends \Tests\TestCase
{
    /**
     * @param Model $model
     * @param array $fillable
     * @param array $guarded
     * @param array $hidden
     * @param array $visible
     * @param array $casts
     * @param array $dates
     * @param string $collectionClass
     * @param null $table
     * @param string $primaryKey
     * @param null $connection
     *
     * - `$fillable` -> `getFillable()`
     * - `$guarded` -> `getGuarded()`
     * - `$table` -> `getTable()`
     * - `$primaryKey` -> `getKeyName()`
     * - `$connection` -> `getConnectionName()`: in case multiple connections exist.
     * - `$hidden` -> `getHidden()`
     * - `$visible` -> `getVisible()`
     * - `$casts` -> `getCasts()`: note that method appends incrementing key.
     * - `$dates` -> `getDates()`: note that method appends `[static::CREATED_AT, static::UPDATED_AT]`.
     * - `newCollection()`: assert collection is exact type. Use `assertEquals` on `get_class()` result, but not `assertInstanceOf`.
     */
    protected function runConfigurationAssertions(
        Model  $model,
        array  $fillable = [],
        array  $hidden = [],
        array  $guarded = ['*'],
        array  $visible = [],
        array  $casts = ['id' => 'int'],
        array  $dates = ['created_at', 'updated_at'],
        string $collectionClass = Collection::class,
               $table = null,
        string $primaryKey = 'id',
               $connection = null
    ): void
    {
        $this->assertEquals($fillable, $model->getFillable());
        $this->assertEquals($guarded, $model->getGuarded());
        $this->assertEquals($hidden, $model->getHidden());
        $this->assertEquals($visible, $model->getVisible());
        $this->assertEquals($casts, $model->getCasts());
        $this->assertEquals($dates, $model->getDates());
        $this->assertEquals($primaryKey, $model->getKeyName());

        $c = $model->newCollection();
        $this->assertEquals($collectionClass, get_class($c));
        $this->assertInstanceOf(Collection::class, $c);

        if ($connection !== null) {
            $this->assertEquals($connection, $model->getConnectionName());
        }

        if ($table !== null) {
            $this->assertEquals($table, $model->getTable());
        }
    }

    /**
     * @param HasMany $relation
     * @param Model $model
     * @param Model $related
     * @param string|null $key
     * @param string|null $parent
     * @param Closure|null $queryCheck
     *
     * - `getQuery()`: assert query has not been modified or modified properly.
     * - `getForeignKey()`: any `HasOneOrMany` or `BelongsTo` relation, but key type differs (see documentation).
     * - `getQualifiedParentKeyName()`: in case of `HasOneOrMany` relation, there is no `getLocalKey()` method, so this one should be asserted.
     */
    protected function assertHasManyRelation($relation, Model $model, Model $related, string $key = null, string $parent = null, Closure $queryCheck = null): void
    {
        $this->assertInstanceOf(HasMany::class, $relation);

        if (!is_null($queryCheck)) {
            $queryCheck($relation->getQuery(), $model, $relation);
        }

        if (is_null($key)) {
            $key = $model->getForeignKey();
        }

        $this->assertEquals($key, $relation->getForeignKeyName());

        if (is_null($parent)) {
            $parent = $model->getKeyName();
        }

        $this->assertEquals($model->getTable().'.'.$parent, $relation->getQualifiedParentKeyName());
    }

    /**
     * @param BelongsToMany $relation
     * @param Model $model
     * @param Model $related
     * @param string $key
     * @param string|null $owner
     * @param Closure|null $queryCheck
     *
     * - `getQuery()`: assert query has not been modified or modified properly.
     * - `getForeignKey()`: any `HasOneOrMany` or `BelongsTo` relation, but key type differs (see documentation).
     * - `getOwnerKey()`: `BelongsTo` relation and its extending.
     */
    protected function assertBelongsToManyRelation($relation, Model $model, Model $related, string $key, string $owner = null, Closure $queryCheck = null): void
    {
        $this->assertInstanceOf(BelongsToMany::class, $relation);

        if (!is_null($queryCheck)) {
            $queryCheck($relation->getQuery(), $model, $relation);
        }

        $this->assertEquals($key, $relation->getForeignPivotKeyName());

//        if (is_null($owner)) {
//            $owner = $related->getKeyName();
//        }

//        $this->assertEquals($owner, $relation->getOwnerKey());
    }
}
