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
        $uri = $request->getUri();

        if (in_array($uri, config('bucket.exceptUri'))) {
            return;
        }
        $this->createRequestInfo($request, $response);
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
            'client_time' => $request->input('request_time')
        ];

        BucketRequest::create($params);
    }



    protected  function getImei($request)
    {
        $userAgent = $request->userAgent();
        $imeiKey = config('bucket.imei');
        $imei = $request->header($imeiKey) ?: $userAgent[$imeiKey];

        return $imei;
    }

    protected  function getParams($request)
    {
        $userAgent = $request->userAgent();
        $imeiKey = config('bucket.imei');
        $imei = $request->header($imeiKey) ?: $userAgent[$imeiKey];
        return $imei;
    }
}
