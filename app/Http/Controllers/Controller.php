<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function uploadFile($file, $type, $dimensions = null)
    {
        $destinationPath = public_path('/storage/' . $type); // upload path
        $fileName = Str::uuid() .  '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $fileName);

        return $fileName;
    }
}
