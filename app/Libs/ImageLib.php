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
            return json_decode($datas);
        }

        return ['error' => 'Could not get images'];
    }


    /**
     * get one image by id
     */
    public function getImageById ($id)
    {
        $response = $this->client->request('GET', 'image/'.$id);

        if ($response->getStatusCode() == 200 && $datas = $response->getBody()->getContents()) {
            return json_decode($datas)->datas;
        }

        return ['error' => 'Could not get image'];
    }

    public function saveImage ($imageSubmission)
    {
        $response = $this->client->request('post', 'image', $this->__prepareMultipartFormData($imageSubmission));

        if ($response->getStatusCode() == 201 && $datas = $response->getBody()->getContents()) {
            return json_decode($datas)->datas;
        }

        return false;
    }

    private function __prepareMultipartFormData ($data)
    {
        return [
            'headers' => [],
            'multipart' => [
                [
                    'Content-type' => 'multipart/form-data',
                    'name' => 'body',
                    'contents' => json_encode([$data->input('user'),$data->input('wl'),$data->input('caption')])
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
