<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class BookPolicy
 * @package App\Policies
 */
class BookPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Book $book
     * @return bool
     */
    public function update(User $user, Book $book)
    {
        return $book->user_id == $user->getKey();
    }

    /**
     * @param User $user
     * @param Book $book
     * @return bool
     */
    public function delete(User $user, Book $book)
    {
        return $book->user_id == $user->getKey();
    }
}
