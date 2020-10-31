<?php


namespace Api\V1\Articles\Models;


use Api\V1\Articles\QueryBuilders\ArticleQueryBuilder;
use App\Events\CreateArticleEvent;
use Cocur\Slugify\Slugify;
use Api\V1\Users\Models\User;
use Api\V1\Categories\Models\Category;
use Database\Factories\ArticleFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentTaggable\Taggable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory, Sluggable, Taggable;


    protected $table = "articles";

    protected $fillable = [
        "title",
        "slug",
        "cover_image",
        "content",
        "category_id",
        "writer_id"
    ];

    public $timestamps = true;

    protected static function newFactory()
    {
        return ArticleFactory::new();
    }

    public function newEloquentBuilder($query) : ArticleQueryBuilder
    {
        return new ArticleQueryBuilder($query);
    }

    protected $dispatchesEvents = [
        'created' => CreateArticleEvent::class,
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)
            ->select("id", "title", "slug");
    }

    public function writer(): BelongsTo
    {
        return $this->belongsTo(User::class, "writer_id")
            ->select("id", "name", "email");
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
