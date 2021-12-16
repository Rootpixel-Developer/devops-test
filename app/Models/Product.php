<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property string $name
 * @property float $price
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property ProductModule[] $productModules
 */
class Product extends Model
{
    use SoftDeletes;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'price', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modules()
    {
        return $this->hasMany(\App\Models\ProductModule::class);
    }

    public function getProductModuleAttribute()
    {
        $modules = [];
        foreach ($this->modules()->get() as $module) {
            if (!in_array($module->name, $modules)) {
                array_push($modules, $module->module_name);
            }
        }
        return implode(', ', $modules);
    }
}
