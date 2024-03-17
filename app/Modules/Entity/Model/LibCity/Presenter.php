<?php 
namespace Modules\Entity\Model\LibCity;

use Modules\Entity\Model\LibCountry\LibCountry;

trait Presenter {
    function getCountryAr(){
        return LibCountry::pluck('name', 'id')->toArray();
    }

    function getEditedUserNameAttribute(){
        return ($this->relEditedUser ?  $this->relEditedUser->name : '');
    }

    function getCountryNameAttribute(){
        return ($this->relCountry ?  $this->relCountry->name : '');
    }

    function getNameAttribute($v){
        return $this->getTransField('name', $v);
    }

}

