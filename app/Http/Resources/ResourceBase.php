<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ResourceBase extends JsonResource
{
    private bool $success;
    private string $msg;
    private array $errors;

    /**
     * Resource constructor.
     * @param $resource
     * @param bool $success
     * @param string $msg
     * @param array $errors
     */
    public function __construct($resource, bool $success, string $msg, array $errors = [])
    {
        parent::__construct($resource);
        $this->success = $success;
        $this->msg = $msg;
        $this->errors = $errors;
    }

    /**
     * Get any additional data that should be returned with the resource array.
     *
     * @param Request $request
     * @return array
     */
    public function with($request): array
    {
        $response = [
            'success' => $this->success,
            'message' => $this->msg,
            'url' => url()->full(),
        ];

        $this->setErrors($response);

        return Arr::sortRecursive($response);
    }

    /**
     * Inclui os erros ao response
     *
     * @param array $response
     */
    private function setErrors(array &$response): void
    {
        if (!empty($this->errors)) {
            $response['errors'] = $this->errors;
        }
    }
}
