<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Content
 * @package App
 */
class Content extends Model
{

    protected $fillable = ['user_id', 'title', 'body', 'image','template','friendlyurl','status'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }



}
