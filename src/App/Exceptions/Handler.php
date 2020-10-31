<?php

namespace App\Exceptions;


use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Support\ApiResponseFactory\ResponseFactoryV1;
use Illuminate\Contracts\Container\Container;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;


class Handler extends ExceptionHandler
{
    /**
     * @var ResponseFactoryV1
     */
    private ResponseFactoryV1 $responseFactory;

    public function __construct(Container $container, ResponseFactoryV1 $responseFactory)
    {
        parent::__construct($container);

        $this->responseFactory = $responseFactory;
    }

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function render($request, Throwable $e)
    {
//        return parent::render($request, $e);
        return $this->handleException($request, $e);
    }

    public function handleException($request, Exception $exception)
    {

        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->responseFactory
                ->getErrorResponse('İstek için belirtilen method geçersiz', 405);
        }

        if ($exception instanceof NotFoundHttpException) {
            return $this->responseFactory
                ->getErrorResponse('İstekte bulunduğunuz URL geçersiz.', 404);
        }

        if ($exception instanceof HttpException) {
            return $this->responseFactory
                ->getErrorResponse($exception->getMessage(), $exception->getStatusCode());
        }

        if ($exception instanceof ModelNotFoundException) {
            return $this->responseFactory
                ->getErrorResponse(__("Aranılan kayıt bulunamadı."), 405);
        }

        if ($exception instanceof ValidationException) {
            return $this->responseFactory
                ->setErrors((array)$exception->errors())
                ->getErrorResponse(__("Validasyon hatası."), 404);
        }

        if ($exception instanceof AuthenticationException) {
            return $this->responseFactory
                ->getErrorResponse(__("Bearer token verisi geçersiz."), 404);
        }

//        return $exception;
        return $this->responseFactory
            ->getErrorResponse('Beklenmeyen bir hata oluştu.', 500);

    }
}
