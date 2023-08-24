<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class DropzoneController extends Controller
{

    public function index()
    {
        return view('dropzone');
    }
    function upload(Request $request)
    {
        try {
            // Handle File Upload
            $image = $request->file('file');
            $input['file'] = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/thumbnail');
            $imgFile = Image::make($image->getRealPath());
            $imgFile->resize(1024, 768, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['file']);
            $destinationPath = public_path('/uploads');
            $image->move($destinationPath, $input['file']);

            //create post
            $post = new Gallery;
            $post->foldername = $request->input('foldername');
            $post->filename = $request->input('filename');
            $post->caption = $request->input('caption');
            $post->parent_id = $request->input('parent_id');
            // $post->sort = $request->input('sort');
            $post->created_at = auth()->user()->id;
            $post->image = $input['file'];
            // $post->is_active = $request->input('is_active');
            $post->save();


            return response()->json([
                'success' => $input['file'],
                'message' => 'Images Saved Successfully..'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error', $e->getMessage()]);
        }
    }

    function fetch(string $id)
    {
        $images = DB::table('galleries')
            ->select('id', 'foldername', 'is_active', 'image', 'filename', 'caption')
            ->where('image', '<>', '')
            ->where('id', $id)
            ->get();
        $output = '<div class="row">';
        foreach ($images as $image) {
            $output .= '
  <div class="col-md-2" style="margin-bottom:16px;" align="center">
            <img src="' . asset('thumbnail/' . $image->image) . '" class="img-thumbnail" width="175" height="175" style="height:175px;" />
            <button type="button" class="btn btn-link remove_image" id="' . $image->image . '">Remove</button>
        </div>
  ';
        }
        $output .= '</div>';
        echo $output;
    }

    function delete(Request $request)
    {

        if ($request->get('name')) {
            $name = $request->name;
            $image_thumbnail_path = public_path('thumbnail/' . $name);
            $image_upload_path = public_path('uploads/' . $name);
            if (file_exists($image_thumbnail_path) || file_exists($image_upload_path)) {
                unlink($image_thumbnail_path);
                unlink($image_upload_path);
            }
           Gallery::where('image', $name)->firstorfail()->delete();
        }
    }


}
