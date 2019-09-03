<?php

namespace App\Repositories;

use App\Contracts\EloquentRepository;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BooksRepository
 * @package App\Repositories
 */
class BooksRepository extends EloquentRepository
{
    /**
     * BooksRepository constructor.
     * @param Book $model
     */
    public function __construct(Book $model)
    {
        parent::__construct($model);
    }

    /**
     * @param User $user
     * @param array $data
     * @return Model
     * @throws \App\Exceptions\RepositoryException
     */
    public function createBook(User $user, array $data): Model
    {
        $data['user_id'] = $user->getKey();
        return $this->create($data);
    }
}