<?php
namespace App\Services;
use Storage;
use Image;
use Intervention\Image\Facades\Image as ImageInt;
use Carbon\Carbon;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use App\Models\File as FlieSave;
use Router;
class UploadPhoto {
	const SIZES = [
	    'thumbs2000' => 2000,
	    'thumbs1000' => 1000,
	    'thumbs700' => 700,
        'thumbs300' => 300,
        'thumbs170' => 170,
		
    ];
	
	//в каких разделах можно ставить водяной знак
	const water_mark =['none'];
	
	//содержимое водяного знака
	const text ='adresska.ru';
	
	//цвет водяного знака
	const color_water_mark =[0,0,0, 0.3];
	
	//размер шрифта водяного знака
	const size_water_mark = 50;
	
	//угол шрифта водяного знака
	const angle_water_mark = 45;
	
    static function upload($file, $compress = true){
		
	if (!$file){ return null;}
      
	 $file_name = time().rand(0,9).'.'.$file->getClientOriginalExtension();
	 
	 $folder= Router::get_current_page(1);
	
	 $dir = sprintf('/%s/%s', ltrim('/'.$folder.'/original', '/'), Carbon::now()->format('Y/m/d'));
	 $disk = 'public';
	 $path = $file->store($dir, $disk);
	 $resize=[];
	
	 foreach (self::SIZES as $key => $size) {
		$destFile = str_replace('original','resize_'.$key,$path);
		$resize[] = $destFile;
		$image = Image::make(Storage::disk('public')->path($path))->resize($size, null, function($constraint) {
            $constraint->aspectRatio();
            //$constraint->upsize();
            });
		if(count(self::water_mark) > 0 ){
			
		}
		if(in_array($folder,self::water_mark)){
			
			$image->text(self::text, $image->width()/2, $image->height()/2, function($font) { 
			 $font->file(public_path('OpenSans.ttf'));
			 $font->size(self::size_water_mark);  
             //$font->color(array('#ccc','0.3'));
             $font->color(self::color_water_mark);			 
             $font->align('center');  
             //$font->valign('bottom');
			 $font->angle(self::angle_water_mark);
			});
			
	 }
	 $image->encode();
		//dd($image->width());
			Storage::disk('public')->put( $destFile, $image);
		}
		
		
		Storage::disk('public')->deleteDirectory($folder.'/original');
		
	
	
	   $file = FlieSave::create([
            'disk'          => $disk,
            'dir'           => $dir,
			//'original' => $path,
			'size_2000'         => $resize[0],
			'extralarge'         => $resize[1],
			'large'   => $resize[2],
			'medium'  => $resize[3],
			'small'  => $resize[4],
            'path'          => $path,
            'size'          => $file->getSize(),
            'mime_type'     => $file->getClientMimeType(),
            'name'          => ltrim($path, $dir),
            'original_name' => $file->getClientOriginalName(),
        ]);
		
	     return $file;
	 }
	

}
