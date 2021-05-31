<?php

namespace App\Http\Controllers\v1;

use App\Models\UploadImage;

use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class UploadImageController extends Controller
{
    use ApiResponder;

    function store(Request $request)
    {
        $validatedData = $this->imageSubmissionValidator($request);
        if ($validatedData->fails()) {
            return $this->jsonError('Invalid data', 400);
        }

        $image = new UploadImage();
        $image->type = $request->input('type');
        $image->targetId = $request->input('targetId');
        $image->title = $request->input('title');
        $image->image = $request->file('image');
        $image->path = $request->file('image')->store('public/images');

        if (!$image->save()) {
            return $this->jsonError('Server failed storing image upload', 500);
        }

        return $this->jsonSuccess($image, 'Successfully saved');
    }

    function imageSubmissionValidator ($request)
    {
        $validator = Validator::make($request->all(),
            $rules = [
                'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
                'type' => 'required|integer|min:0|max:4',
                'targetId' => 'required',
                'title' => 'required|string'
            ],
            $messages = [
                'required' => 'The :attribute field is required',
            ]);



        return $validator;
    }
}
