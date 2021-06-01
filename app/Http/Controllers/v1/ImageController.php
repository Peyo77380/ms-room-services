<?php

namespace App\Http\Controllers\v1;

use App\Models\Image;

use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


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
        if (!$images = Image::get()) {
            return $this->jsonError('Unable to reach database', 400);
        }
        return $this->jsonSuccess($images);
    }

    /**
     * Return an image by ID
     *
     * @param $id
     * @return void
     */
    function getById($id)
    {
        if (!$image = Image::find($id)) {
            return $this->jsonError('Unable to find request item', 404);
        }
        return $this->jsonById($id, $image);
    }

    /**
     * Store a submitted image in database and return the object
     *
     * @param Request $request
     * @return void
     */
    function store(Request $request)
    {
        $validatedData = $this->imageSubmissionValidator($request);
        if ($validatedData->fails()) {
            return $this->jsonError($validatedData->errors()->all(), 400);
        }

        $imgArray = $this->setImagesToArray($request);
        if ($imgArray->getStatusCode() === 415) {
            return $imgArray;
        }

        $image = new Image();
        $image->type = $request->input('type');
        $image->targetId = $request->input('targetId');
        $image->image = $imgArray;

        if (!$image->save()) {
            return $this->jsonError('Server failed storing image upload', 500);
        }

        return $this->jsonSuccess($image, 'Successfully saved');
    }

    /**
     * Update existing item in database
     *
     * @param Request $request
     * @param $id
     * @return json
     */
    function update(Request $request, $id)
    {

        $validatedData = $this->imageSubmissionValidator($request);
        if ($validatedData->fails()) {
            return $this->jsonError($validatedData->errors()->all(), 400);
        }

        $imgArray = $this->setImagesToArray($request);
        if ($imgArray->getStatusCode() === 415) {
            return $imgArray;
        }


        $image = Image::find($id);
        if (!$image) {
            return $this->jsonError('Could not find the requested ID', 404);
        }

        $image->type = $request->input('type');
        $image->targetId = $request->input('targetId');
        $image->image = $imgArray;

        if (!$image->update($id)) {
            return $this->jsonError('Server failed storing image upload', 500);
        }

        return $this->jsonSuccess($image, 'Successfully saved');
    }

    /**
     * Destroy existing item in database by Id
     *
     * @param $id
     * @return void
     */
    function destroy($id)
    {
        // TODO : Vérifier avec le client s'il faut supprimer le fichier du serveur une fois supprimé
        if (!Image::destroy($id)) {
            return $this->jsonError('Server could not delete the object from database, please check the ID', 400);
        }

        return $this->jsonSuccess($id, 'Successfully deleted from database');
    }

    function setImagesToArray ($request)
    {
        // TODO : Verifier avec le front quel ojet sera renvoyé par la soumission et l'update
        // TODO : Vérifier avec les clients si le titre sur chaque photo

        $files = [];
        foreach($request->file('images') as $key => $file) {
            $imgFile = [];
            $imgFile['file'] = $file;
            $imgFile['path'] = $request->file('images')[$key]->store('public/images');
            $imgFile['title'] = $request->input('imagesTitles')[$key];

            $validatedImages = $this->imageDetailsValidator($imgFile);
            if ($validatedImages->fails()) {
                return $this->jsonError($validatedImages->errors()->all(), 415);
            }

            array_push($files, ['path' => $imgFile['path'], 'title' => $imgFile['title']]);
        }

        return $this->jsonSuccess($files);
    }

    /**
     * Validate upload image form
     *
     * @param Request $request
     * @return
     */
    function imageSubmissionValidator ($request)
    {
        $validator = Validator::make($request->all(),
            $rules = [
                'imagesTitles' => 'required|array',
                'images' => 'required|array',
                'type' => 'required|integer|min:0|max:4',
                'targetId' => 'required',
            ],
            $messages = [
                'required' => 'The :attribute field is required',
            ]);

        return $validator;
    }

    /**
     * Validate uploaded images format
     *
     * @param array $fileInfo
     * @return void
     */
    function imageDetailsValidator (array $fileInfo)
    {
        $validator = Validator::make($fileInfo,
            $rules = [
                // TODO : Vérifier avec les clients la taill des images, et les formats potentiels.
                'file' => 'required|image|mimes:jpg,png,jpeg|max:512',
                'title' => 'required|string|min:5'
            ],
            $messages = [
                'required' => 'The :attribute field is required',
                'string' => 'The :attribute field should be a string',
                'image' => 'The uploaded file is not an image',
                'mimes' => 'The image should be a jpg, a jpeg or a png file',
                'max:512' => 'The file is too large. (Max : 512MO)'
            ]
            );

        return $validator;
    }

}

