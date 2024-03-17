<?php

namespace App\Services;

use Image;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Modules\Entity\Model\File\Model;


/**
 * Class реализация загрузки изображения в базу и сохранение в storage
 */
class UploadPhoto
{
  const SIZES = [
	    'small' => 2000,
	    'large' => 1000,
        'medium' => 500,
        
		
    ];
    public static function upload($file)
    {
		
        $dir       = sprintf('/%s/%s', '/images/original', Carbon::now()->format('Y/m/d'));
        $disk = 'public';
        $path = $file->store($dir, $disk);
		
        foreach (self::SIZES as $key => $size) {
		$destFile = str_replace('original',$key,$path);
		
		$resize[] = $destFile;
		$image = Image::make(Storage::disk('public')->path($path))->resize($size, null, function($constraint) {
            $constraint->aspectRatio();
            //$constraint->upsize();
            });
		
	
	   $image->encode();
		   Storage::disk('public')->put( $destFile, $image);
		}
		
          $file = new Model([
            'disk'          => $disk,
            'dir'           => $dir,
			'small'         => $resize[0],
			'large'         => $resize[1],
			'medium'        => $resize[2],
		    'path'          => $path,
            'size'          => $file->getSize(),
            'mime_type'     => $file->getClientMimeType(),
            'name'          => ltrim($path, $dir),
            
        ]);
        return $file;
    }
}
