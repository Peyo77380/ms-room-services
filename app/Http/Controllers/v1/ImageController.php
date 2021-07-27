<?php

namespace App\Http\Controllers\v1;

use App\Libs\ImageLib;
use GuzzleHttp\Client;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    use ApiResponder;

    /**
     * Return an array of all the images in the database
     *
     * @return void
     */
    function get()
    {
        $img = new ImageLib();
        return $img->getImages();
    }

    /**
     * Return an image by ID
     *
     * @param $id
     * @return void
     */
    function getById($id)
    {
        $img = new ImageLib();
        return $img->getImageById($id);
    }


    function store(Request $request)
    {
        $img = new ImageLib();
        return $img->saveImage($request);
    }

    // /**
    //  * Store a submitted image in database and return the object
    //  *
    //  * @param Request $request
    //  * @return void
    //  */
    // function store(Request $request)
    // {
    //     $validatedData = $this->imageSubmissionValidator($request);
    //     if ($validatedData->fails()) {
    //         return $this->jsonError($validatedData->errors()->all(), 400);
    //     }

    //     $imgArray = $this->setImagesToArray($request);
    //     if ($imgArray->getStatusCode() === 415) {
    //         return $imgArray;
    //     }

    //     $image = new Image();
    //     $image->type = $request->input('type');
    //     $image->targetId = $request->input('targetId');
    //     $image->image = $imgArray;

    //     if (!$image->save()) {
    //         return $this->jsonError('Server failed storing image upload', 500);
    //     }

    //     return $this->jsonSuccess($image, 'Successfully saved');
    // }


    // /**
    //  * Destroy existing item in database by Id
    //  *
    //  * @param $id
    //  * @return void
    //  */
    // function destroy($id)
    // {
    //     // TODO : en attente de MS-Custom-Fields la route n'est pas encore dispo.
    //     $response = $this->client->request('DELETE', 'image/'.$id);

    //     if ($response->getStatusCode() == 204) {
    //         return $this->jsonSuccessNoDatas('Successfully deleted');
    //     }

    //     return $this->jsonError('nein', 500);
    // }

}

