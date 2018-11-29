<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;

class Product extends Model
{
    const IS_NEW = 1;
    const NUMBER_VIEWS = 0;
    const STATUS_OUT_OF_STOCK = 0;
    const STATUS_STOCKING = 1;

    /**
    * Default values for attributes
    * @var  array an array with attribute as key and default as value
    */
    protected $attributes = [
        'is_new' => self::IS_NEW,
        'views' => self::NUMBER_VIEWS,
        'status' => self::STATUS_STOCKING,
        // 'created_at' => date('Y-m-d'),
        // 'updated_at' => date('Y-m-d'),
        // 'alias' => getAliasFormatAttribute()
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'category_id',
        'summary',
        'detail',
        'price',
        'discount',
        'image',
        'alias'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
     protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Moves uploaded file and returns the new filename
     * @param  Symfony\Component\HttpFoundation\File\UploadedFile $file upladed file
     * @return string            new name returned
     */
    public function handleFile($request) {
        if ($request->hasFile('image_product')) {
            if ($request->file('image_product')->isValid()) {
                $file = $request->file('image_product');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $fileName = time() . '.' . $extension;
                $image_resize = Image::make($file->getRealPath());
                $image_resize->resize(300, 300);
                $image_resize->save(public_path('images/san_pham/' . $fileName));
            }
        } else {
            $fileName = '';
        }
        return $fileName;
    }

    /**
     * The product that belong to the category.
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class,'category_id', 'id');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'alias';
    }

    public function getImageFormatAttribute()
    {
        if ($this->image) {
            return $this->image;
        }
        return 'no_image.jpg';
    }

    public function getAliasFormatAttribute()
    {
        if ($this->name) {
            return str_slug($this->name, '-');
        }
        return '';
    }
}
