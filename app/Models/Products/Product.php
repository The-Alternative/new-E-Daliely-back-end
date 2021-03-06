<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaravelLocalization;


class Product extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id';
    protected $table ='products';

    protected $fillable = [
        
        'trans_lang','trans_of','title',
        'slug','brand_id','barcode','image',
        'meta','is_active',
        'is_appear','short_des','description'
];
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    protected $casts = [
        'is_active' => 'boolean'
    ];

    /****ــــــ This Local Scopes For Products ــــــ  ***
     * @param $query
     * @return
     */
    public function scopeSelection($query)
    {
        return $query->select('trans_lang','trans_of','title',
        'slug','brand_id','barcode','image',
        'meta','is_active',
        'is_appear','short_des','description');
    }
    public function scopeSelectionUpdate($query)
    {
        return $query->select('trans_lang','trans_of','title',
        'slug','brand_id','barcode','image',
        'meta','is_active',
        'is_appear','short_des','description')
        ->where('trans_of',$id);
    }


    public function scopeSelectActiveValue($query)
    {
        return $query->select('trans_lang','trans_of','title',
        'slug','brand_id','barcode','image',
        'meta','is_active',
        'is_appear','short_des','description')
        ->where('is_active',1)
        ->get();
    }

    /****ــــــ End Of Scopes For Products ــــــ  ****/

    /****ــــــ This Accessors And Mutators For Products ــــــ  ****/
    public function getIsActiveAttribute($value)
    {
       return $value==1 ? 'Active' : 'Not Active';
    }
    public function scopeDefaultProduct($query){
        return  $query->where('trans_of',0);
    }


      // get all translation products
    public function products()
    {
        return $this->hasMany(self::class,'trans_of');
    }

//    public function customfields()
//    {
//        return $this->belongsToMany(Custom_Field::class)
//        ->withTimestamps()
//        ->withPivot(['value','description']);
//    }
public function language()
{
    return $this->belongsToMany(language::class);
}
    public function categories(){
        return $this->belongsToMany(category::class)
        ->withTimestamps()
        ->withPivot(['description']);
    }

    public function stores(){
        return $this->belongsToMany(store::class)
        ->withTimestamps()
        ->withPivot(['is_active','is_approve','price','qty']);
    }

    public function product_images(){
        return $this->hasMany(product_image::class);
    }
    public function brand(){
        return $this->belongsTo(brand::class);
    }

    public function product_store_ratings(){
        return $this->hasMany(Product_Store_Rating::class);
    }

    public function order_details(){
        return $this->hasMany(Order_Details::class);
    }
}
