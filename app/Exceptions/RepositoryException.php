<?php

namespace App\Exceptions;

/**
 * Class RepositoryException
 * @package App\Exceptions
 */
class RepositoryException extends \Exception
{
    public function render($request)
    {
        $errors = [
            'exception' => $this->getMessage(),
            'message' => $this->getMessage()
        ];

        if (config('app.debug') && !is_null($this->getPrevious())) {
            $errors['detail'] = [
                'message' => $this->getPrevious()->getMessage()
            ];
        }

        return response()->json($errors, 500);
    }

}