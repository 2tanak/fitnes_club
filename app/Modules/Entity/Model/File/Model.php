<?php
namespace Modules\Entity\Model\File;
use Modules\Entity\ModelParent;
use Modules\Entity\Traits\CheckTrans;
use App\Models\User;

class Model extends ModelParent {
    protected $table = 'files';
	//protected $with = ['files'];
	protected $fillable
        = [
            'disk',
            'path',
            'mime_type',
            'dir',
            'description',
            'name',
            'size',
			'small',
			'large',
			'medium',
			'fileable_type',
			'fileable_id'
        ];
	
	protected $filter_class = Filter::class; 
    use Presenter;
	
	public function fileable()
    {
        return $this->morphTo();
    }
	

}
