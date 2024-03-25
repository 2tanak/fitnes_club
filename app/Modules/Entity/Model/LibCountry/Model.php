<?php
namespace Modules\Entity\Model\LibCountry;

use Modules\Entity\ModelParent;
use Modules\Entity\Traits\CheckTrans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Model extends ModelParent {
    protected $table = 'lib_country';
    protected $fillable = [ 'name'];
    protected $filter_class = Filter::class; 
    use Presenter, HasFactory;
    
    function relEditedUser(){
        return $this->belongsTo('App\User', 'edited_user_id');
    }
      
    function relContinent(){
        return $this->belongsTo('Modules\Entity\Model\LibContinent\LibContinent', 'continent_id');
    }

    function relTrans(){
        return $this->hasOne('Modules\Entity\Model\TransLib\TransLib', 'el_id')->where('table_name', $this->getTable());
    }

    function getTransTableNameAttribute(){
        return $this->getTable();
    }

    function getElIdAttribute(){
        return $this->id;
    }
}
