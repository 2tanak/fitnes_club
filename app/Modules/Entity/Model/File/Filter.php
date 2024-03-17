<?php
namespace Modules\Entity\Model\Blog;
use Modules\Entity\ModelParent;
use Modules\Entity\Traits\CheckTrans;
use App\Models\User;
use App\Models\File;
use Modules\Entity\Observers\NewsObserver;
use App\Models\Lang;
//use App\Observers\NewsObserver;


class Model extends ModelParent {
    protected $table = 'files';
	//protected $with = ['files'];
	protected $fillable = [
	  'disk ',
	  'path',
	  'large',
	  'medium ',
	  'small',
	 ];
	
	protected $filter_class = Filter::class; 
    use Presenter;
	
}
