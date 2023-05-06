<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    protected function invalidJson($request, ValidationException $exception): \Illuminate\Http\JsonResponse
    {
        $errors = [];
        foreach ($exception->errors() as $field => $messages) {
            $error[$field] = [];
            foreach ($messages as $message) {
                $error[$field][] = $message;
            }
            $errors = array_merge($errors, $error);
        }

        return response()->json([
            'status' => false,
            "data" => [],
            "message" => $exception->getMessage(),
            "errors" => $errors
        ], $exception->status);
    }
}
