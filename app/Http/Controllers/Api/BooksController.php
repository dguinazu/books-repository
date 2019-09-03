<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\User;
use App\Repositories\BooksRepository;

class BooksController extends Controller
{
    /**
     * @var BooksRepository
     */
    protected $repository;

    /**
     * BookController constructor.
     * @param BooksRepository $repository
     */
    public function __construct(BooksRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $collection = $this->repository->get(['user']);

        return BookResource::collection($collection);
    }

    /**
     * @param BookRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\RepositoryException
     */
    public function store(BookRequest $request)
    {
        /** @var User $user */
        $user = $request->user();
        $data = $request->all();

        $book = $this->repository->createBook($user, $data);

        return (new BookResource($book))->response()->setStatusCode(201);
    }

    /**
     * @param Book $book
     * @return BookResource
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * @param BookRequest $request
     * @param Book $book
     * @return BookResource
     * @throws \App\Exceptions\RepositoryException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(BookRequest $request, Book $book)
    {
        $this->authorize('update', $book);

        $data = $request->all();
        $book = $this->repository->update($book->getKey(), $data);

        return new BookResource($book);
    }

    /**
     * @param Book $book
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);

        $deleted = $this->repository->delete($book->getKey());

        $status = ($deleted) ? 204 : 200;

        return response('', $status);
    }
}
