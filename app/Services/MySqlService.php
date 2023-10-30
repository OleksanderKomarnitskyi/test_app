<?php


namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class MySqlService
 * @package App\Services\Base
 */
abstract class MySqlService
{
    /**
     * @param Exception $exception
     * @param null $message
     * @param int $code
     * @param bool $withLog
     * @throws
     */
    protected function handleException(Exception $exception, $message = null, $code = 500, $withLog = true): void
    {
        DB::rollBack();

        if ($withLog) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());
        }

        throw new Exception($message ?: $exception->getMessage(), $code, $exception);
    }
}
