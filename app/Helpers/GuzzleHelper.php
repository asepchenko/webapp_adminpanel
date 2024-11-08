<?php

namespace App\Helpers;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class GuzzleHelper
{

    public static function apiUrl()
    {
        return config('api.api_url');
    }

    /*public static function getUrl(Request $request)
    {
        $url = str_replace(static::appUrl(), static::apiUrl(), $request->getUri());

        $parseUrl = parse_url($url);
        $firstPath = substr($parseUrl['path'], 0, 4);

        if ($firstPath != '/api') {
            $url = str_replace(static::appUrl(), static::apiUrl() . Config::get('app.prefix_api_url'), $request->getUri());
        }

        return $url;
    }*/

    public static function getHeaders(Request $request)
    {
        $authorization = $request->header('Authorization');
        $token = session('app_token');

        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        if ($authorization !== null) {
            $headers['Authorization'] = $authorization;
        } else  if ($token !== null) {
            $headers['Authorization'] = "Bearer " . $token;
        }

        return $headers;
    }


    public static function post(Request $request, $url)
    {
        $client = new Client();
        $headers = static::getHeaders($request);
        $req = $request->all();
        unset($req['_token']);
        try {
            $gRequest = $client->post(
                $url,
                [
                    'headers' => $headers,
                    'form_params' => $req
                ]
            );

            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();
            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode(); //dd($statusCode);
            return response()->json($errorBody, $statusCode);
        }
    }

    public static function postComproService(Request $request, $url)
    {
        $client = new Client();
        $headers = static::getHeaders($request);

        unset($headers['Content-Type']);
        $multipart = [];

        $multipart[] = [
            'name' => 'title',
            'contents' => $request->title,
        ];

        $multipart[] = [
            'name' => 'description',
            'contents' => $request->description,
        ];

        $multipart[] = [
            'name' => 'is_active',
            'contents' => $request->is_active,
        ];

        if (!empty($request->image)) {
            $multipart[] = [
                'name' => 'image',
                'contents' => !empty($request->image) ? fopen($request->image->getPathName(), 'r') : '',
                'filename' => !empty($request->image) ? $request->image->getClientOriginalName() : ''
            ];
        }
        // echo "<pre>";print_r($multipart);die;
        try {
            $gRequest = $client->post(
                $url,
                [
                    'headers' => $headers,
                    'multipart' => $multipart
                ]
            );

            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();

            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }

    public static function putComproService(Request $request, $url)
    {
        $client = new Client();
        $headers = static::getHeaders($request);
        unset($headers['Content-Type']);
        $multipart = [];

        $multipart[] = [
            'name' => '_method',
            'contents' => 'put',
        ];

        
        $multipart[] = [
            'name' => 'title',
            'contents' => $request->title,
        ];

        $multipart[] = [
            'name' => 'description',
            'contents' => $request->description,
        ];

        $multipart[] = [
            'name' => 'is_active',
            'contents' => $request->is_active,
        ];
        
        if (!empty($request->image)) {
            $multipart[] = [
                'name' => 'image',
                'contents' => !empty($request->image) ? fopen($request->image->getPathName(), 'r') : '',
                'filename' => !empty($request->image) ? $request->image->getClientOriginalName() : ''
            ];
        }
        // echo "<pre>";print_r($multipart);die;
        try {
            $gRequest = $client->post(
                $url,
                [
                    'headers' => $headers,
                    'multipart' => $multipart
                ]
            );

            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();

            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }

    public static function postComproGallery(Request $request, $url)
    {
        $client = new Client();
        $headers = static::getHeaders($request);

        unset($headers['Content-Type']);
        $multipart = [];

        $multipart[] = [
            'name' => 'description',
            'contents' => $request->description,
        ];

        if (!empty($request->image)) {
            $multipart[] = [
                'name' => 'image',
                'contents' => !empty($request->image) ? fopen($request->image->getPathName(), 'r') : '',
                'filename' => !empty($request->image) ? $request->image->getClientOriginalName() : ''
            ];
        }
        // echo "<pre>";print_r($multipart);die;
        try {
            $gRequest = $client->post(
                $url,
                [
                    'headers' => $headers,
                    'multipart' => $multipart
                ]
            );

            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();

            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }

    public static function putComproGallery(Request $request, $url)
    {
        $client = new Client();
        $headers = static::getHeaders($request);
        unset($headers['Content-Type']);
        $multipart = [];

        $multipart[] = [
            'name' => '_method',
            'contents' => 'put',
        ];

        $multipart[] = [
            'name' => 'description',
            'contents' => $request->description,
        ];

        if (!empty($request->image)) {
            $multipart[] = [
                'name' => 'image',
                'contents' => !empty($request->image) ? fopen($request->image->getPathName(), 'r') : '',
                'filename' => !empty($request->image) ? $request->image->getClientOriginalName() : ''
            ];
        }
        // echo "<pre>";print_r($multipart);die;
        try {
            $gRequest = $client->post(
                $url,
                [
                    'headers' => $headers,
                    'multipart' => $multipart
                ]
            );

            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();

            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }

    public static function postComproBanner(Request $request, $url)
    {
        $client = new Client();
        $headers = static::getHeaders($request);

        unset($headers['Content-Type']);
        $multipart = [];
        
        $multipart[] = [
            'name' => 'caption',
            'contents' => $request->caption,
        ];

        $multipart[] = [
            'name' => 'start_date',
            'contents' => $request->start_date,
        ];

        $multipart[] = [
            'name' => 'end_date',
            'contents' => $request->end_date,
        ];

        if (!empty($request->image)) {
            $multipart[] = [
                'name' => 'image',
                'contents' => !empty($request->image) ? fopen($request->image->getPathName(), 'r') : '',
                'filename' => !empty($request->image) ? $request->image->getClientOriginalName() : ''
            ];
        }
        // echo "<pre>";print_r($multipart);die;
        try {
            $gRequest = $client->post(
                $url,
                [
                    'headers' => $headers,
                    'multipart' => $multipart
                ]
            );

            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();

            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }

    public static function putComproBanner(Request $request, $url)
    {
        $client = new Client();
        $headers = static::getHeaders($request);
        unset($headers['Content-Type']);
        $multipart = [];

        $multipart[] = [
            'name' => '_method',
            'contents' => 'put',
        ];

        $multipart[] = [
            'name' => 'caption',
            'contents' => $request->caption,
        ];

        $multipart[] = [
            'name' => 'start_date',
            'contents' => $request->start_date,
        ];

        $multipart[] = [
            'name' => 'end_date',
            'contents' => $request->end_date,
        ];

        if (!empty($request->image)) {
            $multipart[] = [
                'name' => 'image',
                'contents' => !empty($request->image) ? fopen($request->image->getPathName(), 'r') : '',
                'filename' => !empty($request->image) ? $request->image->getClientOriginalName() : ''
            ];
        }
        // echo "<pre>";print_r($multipart);die;
        try {
            $gRequest = $client->post(
                $url,
                [
                    'headers' => $headers,
                    'multipart' => $multipart
                ]
            );

            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();

            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }

    public static function postComproMainBanner(Request $request, $url)
    {
        $client = new Client();
        $headers = static::getHeaders($request);

        unset($headers['Content-Type']);
        $multipart = [];
        
        $multipart[] = [
            'name' => 'sequence',
            'contents' => $request->sequence,
        ];

        $multipart[] = [
            'name' => 'title',
            'contents' => $request->title,
        ];

        $multipart[] = [
            'name' => 'subtitle',
            'contents' => $request->subtitle,
        ];

        if (!empty($request->image)) {
            $multipart[] = [
                'name' => 'image',
                'contents' => !empty($request->image) ? fopen($request->image->getPathName(), 'r') : '',
                'filename' => !empty($request->image) ? $request->image->getClientOriginalName() : ''
            ];
        }
        // echo "<pre>";print_r($multipart);die;
        try {
            $gRequest = $client->post(
                $url,
                [
                    'headers' => $headers,
                    'multipart' => $multipart
                ]
            );

            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();

            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }

    public static function putComproMainBanner(Request $request, $url)
    {   
        $client = new Client();
        $headers = static::getHeaders($request);
        unset($headers['Content-Type']);
        $multipart = [];

        $multipart[] = [
            'name' => '_method',
            'contents' => 'put',
        ];

        $multipart[] = [
            'name' => 'sequence',
            'contents' => $request->sequence,
        ];

        $multipart[] = [
            'name' => 'title',
            'contents' => $request->title,
        ];

        $multipart[] = [
            'name' => 'subtitle',
            'contents' => $request->subtitle,
        ];

        if (!empty($request->image)) {
            $multipart[] = [
                'name' => 'image',
                'contents' => !empty($request->image) ? fopen($request->image->getPathName(), 'r') : '',
                'filename' => !empty($request->image) ? $request->image->getClientOriginalName() : ''
            ];
        }
        // echo "<pre>";print_r($multipart);die;
        try {
            $gRequest = $client->post(
                $url,
                [
                    'headers' => $headers,
                    'multipart' => $multipart
                ]
            );

            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();

            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }

    public static function postOrderRefImportExcel(Request $request, $url)
    {   
        $client = new Client();
        $headers = static::getHeaders($request);
        unset($headers['Content-Type']);
        $multipart = [];

        if (!empty($request->file)) {
            $multipart[] = [
                'name' => 'file',
                'contents' => !empty($request->file) ? fopen($request->file->getPathName(), 'r') : '',
                'filename' => !empty($request->file) ? $request->file->getClientOriginalName() : ''
            ];
        }
        // echo "<pre>";print_r($multipart);die;
        try {
            $gRequest = $client->post(
                $url,
                [
                    'headers' => $headers,
                    'multipart' => $multipart
                ]
            );

            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();

            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }

    public static function postComproPost(Request $request, $url)
    {
        $client = new Client();
        $headers = static::getHeaders($request);

        unset($headers['Content-Type']);
        $multipart = [];
        
        $multipart[] = [
            'name' => 'title',
            'contents' => $request->title,
        ];

        $multipart[] = [
            'name' => 'slug',
            'contents' => $request->slug,
        ];

        $multipart[] = [
            'name' => 'content',
            'contents' => $request->content,
        ];

        $multipart[] = [
            'name' => 'status',
            'contents' => $request->status,
        ];

        if (!empty($request->image)) {
            $multipart[] = [
                'name' => 'image',
                'contents' => !empty($request->image) ? fopen($request->image->getPathName(), 'r') : '',
                'filename' => !empty($request->image) ? $request->image->getClientOriginalName() : ''
            ];
        }
        // echo "<pre>";print_r($multipart);die;
        try {
            $gRequest = $client->post(
                $url,
                [
                    'headers' => $headers,
                    'multipart' => $multipart
                ]
            );

            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();

            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }

    public static function putComproPost(Request $request, $url)
    {
        $client = new Client();
        $headers = static::getHeaders($request);
        unset($headers['Content-Type']);
        $multipart = [];

        $multipart[] = [
            'name' => '_method',
            'contents' => 'put',
        ];

        $multipart[] = [
            'name' => 'title',
            'contents' => $request->title,
        ];

        $multipart[] = [
            'name' => 'slug',
            'contents' => $request->slug,
        ];

        $multipart[] = [
            'name' => 'content',
            'contents' => $request->content,
        ];

        $multipart[] = [
            'name' => 'status',
            'contents' => $request->status,
        ];
        
        if (!empty($request->image)) {
            $multipart[] = [
                'name' => 'image',
                'contents' => !empty($request->image) ? fopen($request->image->getPathName(), 'r') : '',
                'filename' => !empty($request->image) ? $request->image->getClientOriginalName() : ''
            ];
        }
        // echo "<pre>";print_r($multipart);die;
        try {
            $gRequest = $client->post(
                $url,
                [
                    'headers' => $headers,
                    'multipart' => $multipart
                ]
            );

            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();

            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }


    public static function postDownload(Request $request, $url)
    {
        $client = new Client();

        $headers = static::getHeaders($request);

        unset($headers['Content-Type']);
        $multipart = [];

        $multipart[] = [
            'name' => 'ip_address',
            'contents' => $request->ip_address,
        ];

        $multipart[] = [
            'name' => 'browser',
            'contents' => $request->browser,
        ];

        $multipart[] = [
            'name' => 'device',
            'contents' => $request->device,
        ];

        try {
            $gRequest = $client->post(
                $url,
                [
                    'headers' => $headers,
                    'multipart' => $multipart
                ]
            );

            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();

            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }

    public static function put(Request $request, $url)
    {
        $client = new Client();
        $headers = static::getHeaders($request);
        $req = $request->all();
        $req['_method'] = "put";
        try {
            $gRequest = $client->post(
                $url,
                [
                    'headers' => $headers,
                    'form_params' => $req
                ]
            );

            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();
            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode(); //dd($statusCode);
            return response()->json($errorBody, $statusCode);
        }
    }

    public static function get(Request $request, $url)
    {
        $client = new Client();


        $headers = static::getHeaders($request);

        try {
            $gRequest = $client->get(
                $url,
                [
                    'headers' => $headers
                ]
            );

            $response = json_decode($gRequest->getBody());
            $statusCode = $gRequest->getStatusCode();
            return $response;
            //return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            /*$errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
            */
            $response = json_decode($response->getBody());
            return $response;
        }
    }

    public static function getPhoto(Request $request, $url)
    {
        $client = new Client();

        $headers = static::getHeaders($request);

        unset($headers['Accept']);
        unset($headers['Content-Type']);

        try {
            $gRequest = $client->get(
                $url,
                [
                    'headers' => $headers
                ]
            );

            return $gRequest->getBody()->getContents();
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }


    public static function del(Request $request, $url)
    {
        $client = new Client();
        $headers = static::getHeaders($request);
        try {
            $gRequest = $client->delete(
                $url,
                [
                    'headers' => $headers
                ]
            );
            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();
            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();
            return response()->json($errorBody, $statusCode);
        }
    }


    public static function postCreateClipping(Request $request, $url)
    {
        $client = new Client();

        $headers = static::getHeaders($request);


        unset($headers['Content-Type']);
        $multipart = [];

        $multipart[] = [
            'name' => 'title',
            'contents' => $request->title,
        ];

        $multipart[] = [
            'name' => 'slug',
            'contents' => $request->slug,
        ];

        $multipart[] = [
            'name' => 'description',
            'contents' => $request->description,
        ];

        $multipart[] = [
            'name' => 'is_allow_comment',
            'contents' => $request->is_allow_comment,
        ];


        $multipart[] = [
            'name' => 'clipping_status_id',
            'contents' => $request->clipping_status_id,
        ];

        $multipart[] = [
            'name' => 'clipping_category_id',
            'contents' => $request->clipping_category_id,
        ];

        $multipart[] = [
            'name' => 'is_allow_like',
            'contents' => $request->is_allow_like,
        ];

        $multipart[] = [
            'name' => 'is_allow_download',
            'contents' => $request->is_allow_download,
        ];

        $multipart[] = [
            'name' => 'is_allow_shared',
            'contents' => $request->is_allow_shared,
        ];

        $multipart[] = [
            'name' => 'filepath',
            'contents' => !empty($request->filepath) ? fopen($request->filepath->getPathName(), 'r') : '',
            'filename' => !empty($request->filepath) ? $request->filepath->getClientOriginalName() : ''
        ];

        try {
            $gRequest = $client->post(
                $url,
                [
                    'headers' => $headers,
                    'multipart' => $multipart
                ]
            );

            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();

            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }

    public static function postUpdateClipping(Request $request, $url)
    {
        $client = new Client();

        $headers = static::getHeaders($request);


        unset($headers['Content-Type']);
        $multipart = [];

        // $multipart[] = [
        //     'name' => 'id',
        //     'contents' => $request->id,
        // ];

        $multipart[] = [
            'name' => 'title',
            'contents' => $request->title,
        ];

        $multipart[] = [
            'name' => 'slug',
            'contents' => $request->slug,
        ];

        $multipart[] = [
            'name' => 'description',
            'contents' => $request->description,
        ];

        $multipart[] = [
            'name' => 'is_allow_comment',
            'contents' => $request->is_allow_comment,
        ];

        $multipart[] = [
            'name' => 'clipping_status_id',
            'contents' => $request->clipping_status_id,
        ];

        $multipart[] = [
            'name' => 'filepath',
            'contents' => !empty($request->filepath) ? fopen($request->filepath->getPathName(), 'r') : '',
            'filename' => !empty($request->filepath) ? $request->filepath->getClientOriginalName() : ''
        ];

        $multipart[] = [
            'name' => 'clipping_category_id',
            'contents' => $request->clipping_category_id,
        ];

        $multipart[] = [
            'name' => 'is_allow_like',
            'contents' => $request->is_allow_like,
        ];

        $multipart[] = [
            'name' => 'is_allow_download',
            'contents' => $request->is_allow_download,
        ];

        $multipart[] = [
            'name' => 'is_allow_shared',
            'contents' => $request->is_allow_shared,
        ];

        try {
            $gRequest = $client->post(
                $url,
                [
                    'headers' => $headers,
                    'multipart' => $multipart
                ]
            );

            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();

            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }

    public static function getFile(Request $request, $url = null)
    {
        $client = new Client();

        if ($url == null) {
            $url = static::getUrl($request);
        } else {
            $url = static::apiUrl() . $url;
        }

        $headers = static::getHeaders($request);

        unset($headers['Accept']);
        unset($headers['Content-Type']);

        try {
            $gRequest = $client->get(
                $url,
                [
                    'headers' => $headers
                ]
            );

            return $gRequest->getBody();
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }

    public static function postCreateAboutUsCategories(Request $request, $url)
    {
        $client = new Client();

        $headers = static::getHeaders($request);

        unset($headers['Content-Type']);
        $multipart = [];

        $multipart[] = [
            'name' => 'category_name',
            'contents' => $request->category_name,
        ];

        $multipart[] = [
            'name' => 'category_code',
            'contents' => $request->category_code,
        ];

        $multipart[] = [
            'name' => 'description',
            'contents' => $request->description,
        ];

        if (isset($request->banner_image)) {
            $multipart[] = [
                'name' => 'banner_image',
                'contents' => fopen($request->banner_image->getPathName(), 'r'),
                'filename' => $request->banner_image->getClientOriginalName()
            ];
        }

        try {
            $gRequest = $client->post(
                $url,
                [
                    'headers' => $headers,
                    'multipart' => $multipart
                ]
            );

            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();

            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }

    public static function postMediaFile(Request $request, $url)
    {
        $client = new Client();
        $headers = static::getHeaders($request);

        unset($headers['Content-Type']);
        $multipart = [];

        $multipart[] = [
            'name' => 'caption',
            'contents' => $request->caption,
        ];

        $multipart[] = [
            'name' => 'slug',
            'contents' => $request->slug,
        ];

        $multipart[] = [
            'name' => 'description',
            'contents' => $request->description,
        ];

        // $multipart[] = [
        //     'name' => 'media_type_id',
        //     'contents' => $request->media_type_id,
        // ];

        $multipart[] = [
            'name' => 'is_allow_comment',
            'contents' => $request->is_allow_comment,
        ];

        $multipart[] = [
            'name' => 'is_allow_like',
            'contents' => $request->is_allow_like,
        ];

        $multipart[] = [
            'name' => 'is_allow_download',
            'contents' => $request->is_allow_download,
        ];

        $multipart[] = [
            'name' => 'is_allow_shared',
            'contents' => $request->is_allow_shared,
        ];

        // $multipart[] = [
        //     'name' => 'sort',
        //     'contents' => $request->sort,
        // ];

        $multipart[] = [
            'name' => 'media_gallery_status_id',
            'contents' => $request->media_gallery_status_id,
        ];

        if (!empty($request->gallery_id)) {
            $multipart[] = [
                'name' => 'gallery_id',
                'contents' => $request->gallery_id,
            ];
        }

        if (!empty($request->filepath)) {
            $multipart[] = [
                'name' => 'filepath',
                'contents' => !empty($request->filepath) ? fopen($request->filepath->getPathName(), 'r') : '',
                'filename' => !empty($request->filepath) ? $request->filepath->getClientOriginalName() : ''
            ];
        }
        // echo "<pre>";print_r($multipart);die;
        try {
            $gRequest = $client->post(
                $url,
                [
                    'headers' => $headers,
                    'multipart' => $multipart
                ]
            );

            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();

            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }

    public static function postCreateAboutUsSection(Request $request, $url)
    {
        $client = new Client();

        $headers = static::getHeaders($request);
        unset($headers['Content-Type']);
        $multipart = [];

        $multipart[] = [
            'name' => 'about_us_category_id',
            'contents' => $request->about_us_category_id,
        ];

        $multipart[] = [
            'name' => 'section_name',
            'contents' => $request->section_name,
        ];

        $multipart[] = [
            'name' => 'slug',
            'contents' => $request->slug,
        ];

        if (isset($request->card_image)) {
            $multipart[] = [
                'name' => 'card_image',
                'contents' => fopen($request->card_image->getPathName(), 'r'),
                'filename' => $request->card_image->getClientOriginalName()
            ];
        }

        $multipart[] = [
            'name' => 'content',
            'contents' => $request->content,
        ];

        $multipart[] = [
            'name' => 'card_color',
            'contents' => $request->card_color,
        ];

        $multipart[] = [
            'name' => 'card_title_color',
            'contents' => $request->card_title_color,
        ];

        try {
            $gRequest = $client->post(
                $url,
                [
                    'headers' => $headers,
                    'multipart' => $multipart
                ]
            );

            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();

            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }

    public static function getPhotoBckp(Request $request, $url)
    {
        $client = new Client();

        $headers['Accept'] = 'image/jpeg';
        $headers['Content-Type'] = 'image/jpeg';
        // unset($headers['Accept']);
        // unset($headers['Content-Type']);

        try {
            $gRequest = $client->get(
                $url,
                [
                    'headers' => $headers
                ]
            );

            return $gRequest->getBody()->getContents();
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }
    
    //custom
    public static function postCreateCustomerMou(Request $request, $url)
    {
        $client = new Client();
        $headers = static::getHeaders($request);

        unset($headers['Content-Type']);
        $multipart = [];

        $multipart[] = [
            'name' => 'customer_id',
            'contents' => $request->customer_id,
        ];

        $multipart[] = [
            'name' => 'is_generate_mou',
            'contents' => $request->is_generate_mou,
        ];

        if (isset($request->mou_file)) {
            $multipart[] = [
                'name' => 'mou_file',
                'contents' => !empty($request->mou_file) ? fopen($request->mou_file->getPathName(), 'r') : '',
                'filename' => !empty($request->mou_file) ? $request->mou_file->getClientOriginalName() : ''
            ];
        }

        $multipart[] = [
            'name' => 'mou_start_date',
            'contents' => $request->mou_start_date,
        ];

        $multipart[] = [
            'name' => 'mou_end_date',
            'contents' => $request->mou_end_date,
        ];

        // echo "<pre>";print_r($multipart);die;
        try {
            $gRequest = $client->post(
                $url,
                [
                    'headers' => $headers,
                    'multipart' => $multipart
                ]
            );

            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();

            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }

    public static function postUpdateCustomerMou(Request $request, $url)
    {
        $client = new Client();
        $headers = static::getHeaders($request);

        unset($headers['Content-Type']);
        $multipart = [];

        $multipart[] = [
            'name' => '_method',
            'contents' => 'put',
        ];
        
        $multipart[] = [
            'name' => 'customer_id',
            'contents' => $request->customer_id,
        ];

        $multipart[] = [
            'name' => 'is_generate_mou',
            'contents' => $request->is_generate_mou,
        ];

        if (isset($request->mou_file)) {
            $multipart[] = [
                'name' => 'mou_file',
                'contents' => !empty($request->mou_file) ? fopen($request->mou_file->getPathName(), 'r') : '',
                'filename' => !empty($request->mou_file) ? $request->mou_file->getClientOriginalName() : ''
            ];
        }

        $multipart[] = [
            'name' => 'mou_start_date',
            'contents' => $request->mou_start_date,
        ];

        $multipart[] = [
            'name' => 'mou_end_date',
            'contents' => $request->mou_end_date,
        ];

        // echo "<pre>";print_r($multipart);die;
        try {
            $gRequest = $client->post(
                $url,
                [
                    'headers' => $headers,
                    'multipart' => $multipart
                ]
            );

            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();

            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }

    public static function postCreateAgent(Request $request, $url)
    {
        $client = new Client();
        $headers = static::getHeaders($request);

        unset($headers['Content-Type']);
        $multipart = [];

        $multipart[] = [
            'name' => 'agent_name',
            'contents' => $request->agent_name,
        ];

        $multipart[] = [
            'name' => 'address',
            'contents' => $request->address,
        ];

        $multipart[] = [
            'name' => 'city_id',
            'contents' => $request->city_id,
        ];

        $multipart[] = [
            'name' => 'area_id',
            'contents' => $request->area_id,
        ];

        /*$multipart[] = [
            'name' => 'email',
            'contents' => $request->email,
        ];*/

        $multipart[] = [
            'name' => 'phone_number',
            'contents' => $request->phone_number,
        ];

        if (!empty($request->mou_file)) {
            $multipart[] = [
                'name' => 'mou_file',
                'contents' => !empty($request->mou_file) ? fopen($request->mou_file->getPathName(), 'r') : '',
                'filename' => !empty($request->mou_file) ? $request->mou_file->getClientOriginalName() : ''
            ];
        }

        $multipart[] = [
            'name' => 'mou_start_date',
            'contents' => $request->mou_start_date,
        ];

        $multipart[] = [
            'name' => 'mou_end_date',
            'contents' => $request->mou_end_date,
        ];

        $multipart[] = [
            'name' => 'tax_number',
            'contents' => $request->tax_number,
        ];

        $multipart[] = [
            'name' => 'tax',
            'contents' => $request->tax,
        ];
        // echo "<pre>";print_r($multipart);die;
        try {
            $gRequest = $client->post(
                $url,
                [
                    'headers' => $headers,
                    'multipart' => $multipart
                ]
            );

            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();

            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }

    public static function postUpdateAgent(Request $request, $url)
    {
        $client = new Client();
        $headers = static::getHeaders($request);

        unset($headers['Content-Type']);
        $multipart = [];

        $multipart[] = [
            'name' => '_method',
            'contents' => 'put',
        ];

        $multipart[] = [
            'name' => 'agent_name',
            'contents' => $request->agent_name,
        ];

        $multipart[] = [
            'name' => 'address',
            'contents' => $request->address,
        ];

        $multipart[] = [
            'name' => 'city_id',
            'contents' => $request->city_id,
        ];

        $multipart[] = [
            'name' => 'area_id',
            'contents' => $request->area_id,
        ];

        /*$multipart[] = [
            'name' => 'email',
            'contents' => $request->email,
        ];*/

        $multipart[] = [
            'name' => 'phone_number',
            'contents' => $request->phone_number,
        ];

        if (!empty($request->mou_file)) {
            $multipart[] = [
                'name' => 'mou_file',
                'contents' => !empty($request->mou_file) ? fopen($request->mou_file->getPathName(), 'r') : '',
                'filename' => !empty($request->mou_file) ? $request->mou_file->getClientOriginalName() : ''
            ];
        }

        $multipart[] = [
            'name' => 'mou_start_date',
            'contents' => $request->mou_start_date,
        ];

        $multipart[] = [
            'name' => 'mou_end_date',
            'contents' => $request->mou_end_date,
        ];

        $multipart[] = [
            'name' => 'tax_number',
            'contents' => $request->tax_number,
        ];

        $multipart[] = [
            'name' => 'tax',
            'contents' => $request->tax,
        ];
        // echo "<pre>";print_r($multipart);die;
        try {
            $gRequest = $client->post(
                $url,
                [
                    'headers' => $headers,
                    'multipart' => $multipart
                ]
            );

            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();

            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }

    public static function postOrderTracking(Request $request, $url)
    {
        $client = new Client();
        $headers = static::getHeaders($request);

        unset($headers['Content-Type']);
        $multipart = [];

        $multipart[] = [
            'name' => 'status',
            'contents' => $request->status,
        ];

        $multipart[] = [
            'name' => 'agent',
            'contents' => $request->agent,
        ];

        $multipart[] = [
            'name' => 'recipient',
            'contents' => $request->recipient,
        ];

        $multipart[] = [
            'name' => 'tracking_date',
            'contents' => $request->tracking_date,
        ];

        $multipart[] = [
            'name' => 'tracking_time',
            'contents' => $request->tracking_time,
        ];

        if (!empty($request->transit_city_id)) {
            $multipart[] = [
                'name' => 'transit_city_id',
                'contents' => $request->transit_city_id,
            ];
        }

        $multipart[] = [
            'name' => 'order_number',
            'contents' => $request->order_number,
        ];

        $multipart[] = [
            'name' => 'description',
            'contents' => $request->description,
        ];

        //if (!empty($request->filename)) {
            $multipart[] = [
                'name' => 'filename',
                'contents' => $request->filename,
            ];
        //}

        /*if (!empty($request->filename)) {
            $multipart[] = [
                'name' => 'filename',
                'contents' => !empty($request->filename) ? fopen($request->filename->getPathName(), 'r') : '',
                'filename' => !empty($request->filename) ? $request->filename->getClientOriginalName() : ''
            ];
        }*/
        // echo "<pre>";print_r($multipart);die;
        try {
            $gRequest = $client->post(
                $url,
                [
                    'headers' => $headers,
                    'multipart' => $multipart
                ]
            );

            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();

            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }

    public static function postManifestTracking(Request $request, $url)
    {
        $client = new Client();
        $headers = static::getHeaders($request);

        unset($headers['Content-Type']);
        $multipart = [];

        $multipart[] = [
            'name' => 'status',
            'contents' => $request->status,
        ];

        $multipart[] = [
            'name' => 'agent',
            'contents' => $request->agent,
        ];

        $multipart[] = [
            'name' => 'recipient',
            'contents' => $request->recipient,
        ];

        if (!empty($request->transit_city_id)) {
            $multipart[] = [
                'name' => 'transit_city_id',
                'contents' => $request->transit_city_id,
            ];
        }

        $multipart[] = [
            'name' => 'manifest_number',
            'contents' => $request->manifest_number,
        ];

        $multipart[] = [
            'name' => 'description',
            'contents' => $request->description,
        ];

        //if (!empty($request->filename)) {
            $multipart[] = [
                'name' => 'filename',
                'contents' => $request->filename,
            ];
        //}

        /*if (!empty($request->filename)) {
            $multipart[] = [
                'name' => 'filename',
                'contents' => !empty($request->filename) ? fopen($request->filename->getPathName(), 'r') : '',
                'filename' => !empty($request->filename) ? $request->filename->getClientOriginalName() : ''
            ];
        }*/
        // echo "<pre>";print_r($multipart);die;
        try {
            $gRequest = $client->post(
                $url,
                [
                    'headers' => $headers,
                    'multipart' => $multipart
                ]
            );

            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();

            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }

    public static function postInvoicePay(Request $request, $url)
    {
        $client = new Client();
        $headers = static::getHeaders($request);

        unset($headers['Content-Type']);
        $multipart = [];

        $multipart[] = [
            'name' => 'id',
            'contents' => $request->id,
        ];

        $multipart[] = [
            'name' => 'payment_date',
            'contents' => $request->payment_date,
        ];

        $multipart[] = [
            'name' => 'invoice_number',
            'contents' => $request->invoice_number,
        ];

        if (!empty($request->filename)) {
            $multipart[] = [
                'name' => 'filename',
                'contents' => !empty($request->filename) ? fopen($request->filename->getPathName(), 'r') : '',
                'filename' => !empty($request->filename) ? $request->filename->getClientOriginalName() : ''
            ];
        }
        // echo "<pre>";print_r($multipart);die;
        try {
            $gRequest = $client->post(
                $url,
                [
                    'headers' => $headers,
                    'multipart' => $multipart
                ]
            );

            $response = json_decode($gRequest->getBody()->getContents());
            $statusCode = $gRequest->getStatusCode();

            return response()->json($response, $statusCode);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $errorBody = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();

            return response()->json($errorBody, $statusCode);
        }
    }
}
