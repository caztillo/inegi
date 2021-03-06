<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {

        // 404 page when a model is not found
        if ($e instanceof ModelNotFoundException)
        {
            if ( $request->ajax() || $request->wantsJson() )
            {
                return response()->json([ 'error' => 404, 'mensaje' => 'Recurso no encontrado' ], 404);
            }

            return response()->view('errors.404', [], 404);
        }



        if ($this->isHttpException($e))
        {
            if ( $request->ajax() || $request->wantsJson() )
            {
                return response()->json([ 'error' => 404, 'mensaje' => 'Recurso no encontrado!' ], 404);

            }

            return $this->renderHttpException($e);
        }
        else
        {

            // Custom error 500 view on production
            if (app()->environment() == 'production')
            {
                if ( $request->ajax() || $request->wantsJson() )
                {

                    return response()->json(
                        ['error' =>
                            [
                                'exception' => class_basename( $e ) . ' in ' . basename( $e->getFile() ) . ' line ' . $e->getLine() . ': ' . $e->getMessage(),
                            ]
                        ], 500 );
                }


                return response()->view('errors.500', [], 500);
            }
            return parent::render($request, $e);
        }
    }
}
