<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class PostFilter extends AbstractFilter
{   
    public const TITLE = 'title';
    public const DESCRIPRION = 'description';
    public const PUBLISHED = 'published';
    public const USER_ID = 'user_id';
    public const TAG_ID = 'tag_id';

    protected function getCallbacks(): array
    {
        return [
            self::TITLE => [$this, 'title'],
            self::DESCRIPRION => [$this, 'description'],
            self::PUBLISHED => [$this, 'published'],
            self::USER_ID => [$this, 'user_id'],
            self::TAG_ID => [$this, 'tag_id'],
        ];
    }

    public function title(Builder $builder, $value)
    {
        $builder->where('title', 'like', "%{$value}%");
    }

    public function description(Builder $builder, $value)
    {
        $builder->where('description', 'like', "%{$value}%");
    }

    public function published(Builder $builder, $value)
    {
        $builder->where('published', $value);
    }

    public function user_id(Builder $builder, $value)
    {
        $builder->where('user_id', $value);
    }

    public function tag_id(Builder $builder, $value)
    {
        $builder->where('tag_id', $value);
    }
}