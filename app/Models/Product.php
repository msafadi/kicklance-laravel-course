<?php

namespace App\Models;

use App\Observers\ProductObserver;
use App\Scopes\PublishedScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'category_id', 'description', 'price',
        'sale_price', 'image', 'quantity', 'user_id',
    ];

    protected $appends = [
        'final_price', 'image_url'
    ];

    protected $hidden = [
        'image'
    ];

    // saving, saved, creating, created, updating, updated
    // deleting, deleted, restoring, restored

    protected static function booted()
    {
        /*static::addGlobalScope('published', function(Builder $builder) {
            $builder->where('status', 'published');
        });*/
        static::addGlobalScope(new PublishedScope);

        /*static::forceDeleted(function($product) {
            if ($product->image) {
                Storage::disk('images')->delete($product->image);
            }
        });*/
        static::observe(ProductObserver::class);
    }

    public function scopeWithDraft(Builder $builder)
    {
        //$builder->whereIn('status', ['published', 'draft']);
        //$builder->withoutGlobalScope('published');
        $builder->withoutGlobalScope(PublishedScope::class);
    }

    public function scopeFeatured(Builder $builder)
    {
        $builder->where('featured', 1);
    }

    public function scopePopular(Builder $builder, $views, $sales = 0)
    {
        $builder->where('views', '>', $views);
        if ($sales) {
            $builder->where('sales', '>', $sales);
        }
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('images/' . $this->image);
        }

        return asset('images/default-image.png');
    }

    public function getFinalPriceAttribute()
    {
        if ($this->sale_price > 0) {
            return $this->sale_price;
        }
        return $this->price;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,         // Related Model
            'product_tag',      // Pivot Table
            'product_id',       // F.K. in the pivot table for the current model
            'tag_id',           // F.K. in the pivot table for related model
            'id',               // P.K in the current model
            'id'                // P.K. in the related model
        );
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products')
            ->using(OrderProduct::class)
            ->withPivot([
                'price', 'quantity'
            ]);
    }

    public function ratings()
    {
        return $this->morphToMany(User::class, 'rateable', 'ratings')
            ->withPivot([
                'rating', 'created_at', 'updated_at'
            ]);
    }

    public function favouriteUsers()
    {
        return $this->belongsToMany(User::class, 'favourites');
    }
}
