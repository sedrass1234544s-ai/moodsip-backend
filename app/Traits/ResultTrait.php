<?php
namespace App\Traits;

trait ResultTrait
{
    // public function successResponse($data = null, string $message = '', $code = 200)
    // {
    //     return response()->json([
    //         'status' => true,
    //         'msg' => $message ?? __('messages.success'),
    //         'data' => $data,
    //     ], $code);
    // }

    public function successResponse($data = null, string $message = '', $code = 200)
    {
        if (
            $data instanceof \Illuminate\Http\Resources\Json\ResourceCollection  &&
            $data->resource instanceof \Illuminate\Pagination\LengthAwarePaginator
        ) {
            $responseArray = $data->toResponse(request())->getData(true);

            return response()->json([
                'status'         => true,
                'msg'            => $message ?? __('messages.success'),
                'data'           => $responseArray['data'],
                'links'          => $responseArray['links'],
                'total_count'    => $responseArray['meta']['total'] ?? 0,
                'count_per_page' => count($responseArray['data']),
                // 'meta' => $responseArray['meta'],
            ], $code);
        }

        $response = [
            'status' => true,
            'msg'    => $message ?? __('messages.success'),
            'data'   => $data,
        ];

        // Only include total_count for sequential arrays (lists) and collections
        if (is_array($data) && array_is_list($data)) {
            $response['total_count'] = count($data);
        } elseif (
            is_object($data) &&
            ($data instanceof \Illuminate\Support\Collection  || $data instanceof \Illuminate\Database\Eloquent\Collection)
        ) {
            $response['total_count'] = $data->count();
        }

        return response()->json($response, $code);
    }

    public function errorResponse(string $message = '', $data = null, $code = 500)
    {
        return response()->json([
            'status' => false,
            'msg'    => $message ?? __('messages.error'),
            'data'   => $data,
        ], $code);
    }

    public function notFoundResponse(string $message = '')
    {
        return response()->json([
            'status' => false,
            'msg'    => $message ?? __('messages.not_found'),
            'data'   => null,
        ], 404);
    }
}
