<?php
namespace Modules\Entity\Model\Blog;
use Modules\Entity\ModelParent;
use Modules\Entity\Traits\CheckTrans;
use App\Models\User;
use Modules\Entity\Model\File\Model as File;
use Modules\Entity\Observers\NewsObserver;
use App\Models\Lang;
//use App\Observers\NewsObserver;


class Model extends ModelParent {
    protected $table = 'articles';
	protected $with = ['files'];
	protected $fillable = ['name','text','img','file_id','description','publish'];
	
	protected $filter_class = Filter::class; 
    use Presenter;
	
	  public function files()
      {
        return $this->morphOne(File::class, 'fileable');
      }
	
	

  

}
