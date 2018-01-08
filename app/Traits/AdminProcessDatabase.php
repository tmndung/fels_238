<?php

namespace App\Traits;

use App\Models\Category;

trait AdminProcessDatabase
{
    public function getCategoriesParent()
    {
        $arrCategories = Category::where('parent_id', '=', config('setting.default_parent_id'))->pluck('name', 'id');
        $arrCategories[0] =  trans('lang.none');

        return $arrCategories;
    }
} 
