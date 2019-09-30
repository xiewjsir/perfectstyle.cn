<?php

namespace App\Exceptions;

use App\Facades\ElasticSearchClient;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Jobs\ElasticSearchLog as JElasticSearchLog;
use Log;

class Handler extends ExceptionHandler
{
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
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)){
            app('sentry')->captureException($exception);
        }

        try {
            $logs = ElasticSearchClient::getLogs();
            // 需要判断是否有日志
            if (count($logs) > 0) {
                dispatch(new JElasticSearchLog($logs));
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }
}
