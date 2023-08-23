<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;
use RalphJSmit\Laravel\SEO\Support\HasSEO;

/**
 * @property string $name
 */
class Article extends Model
{
    use HasFactory;
    use HasSEO;

    protected $fillable = [
        'title',
        'slug',
        'status',
        'image',
        'video',
        'content',
        'author_id',
    ];

    public function getDynamicSEOData(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->content,
            'author' => $this->author->name,
        ];
    }

    /**
     * Set the article slug
     *
     * @return Attribute
     */
    public function slug(): Attribute
    {
        return Attribute::make(
            set: function (string $value) {
                $originalSlug = Str::slug($this->attributes['title']);
                $slug = $originalSlug;
                $counter = 1;
                while (static::whereSlug($slug)->where('id', '<>', $this->id)->exists()) {
                    $slug = "{$originalSlug}-{$counter}";
                    $counter++;
                }
                return $slug;
            },
        );
    }

    /**
     * @return Attribute
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            set: fn(?string $value) => $value == null ? null : url('storage/' . $value),
        );
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id')->where('status', 'active');
    }

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'article_category', 'article_id', 'category_id')->whereStatus(
            'active'
        )->withTimestamps();
    }

    /**
     * @return MorphMany
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'article_tag', 'article_id', 'tag_id')->whereStatus(
            'active'
        )->withTimestamps();
    }
}
