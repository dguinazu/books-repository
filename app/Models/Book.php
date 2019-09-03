<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Book
 * @package App\Models
 */
class Book extends Model
{
    use SoftDeletes;

    protected $table = 'books';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'isbn',
        'description',
        'user_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
