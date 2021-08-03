<?php

namespace Bucket;

use Bucket\Models\BucketRequest;

use Closure;

class GetAllUrlInfo
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        //判断是否需要进行拦截分析
        if (!$this->shouldRecord($request)) {
            return;
        };
        $this->createRequestInfo($request, $response);
    }


    protected function shouldRecord($request)
    {
        $url = $request->getUri();

        if (in_array($url, config('bucket.except_uri'))) {
            return false;
        }

        if (preg_match(config('bucket.except_pattern'), $url)) {
            return false;
        }

        if (config('bucket.need_record_uri') && !in_array($url, config('bucket.need_record_uri'))) {
            return false;
        }

        if (!preg_match(config('bucket.need_record_pattern'), $url)) {
            return false;
        }
        return true;
    }

    protected function createRequestInfo($request, $response)
    {
        $endTime = microtime(true);
        $response = json_encode(json_decode($response->getContent()), JSON_UNESCAPED_UNICODE);
        $params = [
            'imei' => $this->getImei($request),
            'ip'   => $request->ip(),
            'client' => CLIENT,
            'fullUrl' => $request->getUri(),
            'api' => $request->getPathInfo(),
            'method' => $request->getMethod(),
            'timeIn' => date('Y-m-d H:i:s', LARAVEL_START),
            'timeOut' => date('Y-m-d H:i:s', $endTime),
            'timeUsed' => ($endTime - LARAVEL_START) * 1000,
            'response' => $response,
            'params' => json_encode($request->all(), JSON_UNESCAPED_UNICODE),
            'request_time' => $request->header('client_time')
        ];

        BucketRequest::create($params);
    }



    protected  function getImei($request)
    {
        // $userAgent = $request->userAgent();
        // $imeiKey = config('bucket.imei');
        // $imei = $request->header($imeiKey) ?: $userAgent[$imeiKey];

        // return $imei;
        return IMEI;
    }
}
