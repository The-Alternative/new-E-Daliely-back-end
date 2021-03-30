<?php


namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;



class StoreScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->join('store_translations', 'store_translations.store_id', '=', 'stores.id')
            ->where('store_translations.local','=',get_current_local())
            ->select(['stores.*','store_translations.*']);
    }
}