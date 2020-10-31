<?php


namespace Api\V1\Categories\Models;


use Cocur\Slugify\Slugify;
use Api\V1\Articles\Models\Article;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentTaggable\Taggable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Category extends Model
{
    use HasFactory, Sluggable, Taggable;

    protected $table = "categories";

    protected $fillable = [
        "title",
        "slug",
    ];

    public $timestamps = true;

    protected static function newFactory()
    {
        return CategoryFactory::new();
    }


    public function tags(): MorphToMany
    {
        $model = config('taggable.model');
        $table = config('taggable.tables.taggable_taggables', 'taggable_taggables');
        return $this->morphToMany($model, 'taggable', $table, 'taggable_id', 'tag_id');
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }


    public function customizeSlugEngine(Slugify $engine, $attribute)
    {
        return $engine->activateRuleset('turkish');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
