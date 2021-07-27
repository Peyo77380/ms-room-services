<?php

namespace App\Libs;

use GuzzleHttp\Client;
use App\Traits\ApiResponder;


class ImageLib
{
    use ApiResponder;

    /**
     * Initialize guzzle client
     */
    public function __construct ()
    {
        $this->client = new Client([
            'base_uri' => 'http://172.21.0.1:80/api/'
        ]);
    }


    /**
     * Get all images from MS CustomFields
     */
    public function getImages ()
    {
        $response = $this->client->request('GET', 'image');

        if ($response->getStatusCode() == 200 && $datas = $response->getBody()->getContents()) {
            return $this->jsonSuccess(json_decode($datas)->datas, 'Successfully got the images');
        }

        return $this->jsonError('Could not get the images list', 500);
    }


    /**
     * get one image by id
     */
    public function getImageById ($id)
    {
        $response = $this->client->request('GET', 'image/'.$id);

        if ($response->getStatusCode() == 200 && $datas = $response->getBody()->getContents()) {
            return $this->jsonSuccess(json_decode($datas)->datas, 'Successfully got the image');
        }

        return $this->jsonError('Could not get the image', 500);
    }

    public function saveImage ($imageSubmission)
    {
        $response = $this->client->request('post', 'image', $this->__prepareMultipartFormData($imageSubmission));

        if ($response->getStatusCode() == 201 && $datas = $response->getBody()->getContents()) {
            return $this->jsonSuccess(json_decode($datas)->datas, 'Successfully created the image');
        }

        return $this->jsonError('Could not get the image', 500);
    }

    private function __prepareMultipartFormData ($data)
    {
        return [
            'headers' => [],
            'multipart' => [
                [
                    'Content-type' => 'multipart/form-data',
                    'name' => 'body',
                    'contents' => json_encode($data->all())
                ],
                [
                    'Content-type' => 'multipart/form-data',
                    'name' => 'file',
                    'contents' => fopen($data->file()['file'], 'r')
                ]
            ]
        ];
    }
}
