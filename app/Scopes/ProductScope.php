<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;



class ProductScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->join('product_translations', 'product_translations.product_id', '=', 'products.id')
            ->where('product_translations.locale','=',get_current_local())
            ->select(['products.*','product_translations.*']);
    }
}
