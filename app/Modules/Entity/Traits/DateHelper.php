<?php
namespace Modules\Entity\Traits;
use Jenssegers\Date\Date;
use App\Helper\CurrentLang;

trait DateHelper {

    public function getCreatedCoolAttribute(){
        if (! $this->created_at)
            return '';
        Date::setLocale(CurrentLang::get());
        $d = Date::createFromFormat('Y-m-d H:i:s', $this->created_at);

        return $d->diffForHumans();
    }

    public function getCreatedDateAttribute(){
        return $this->created_at->format('d.m.Y');
    }

    
    
    public function getCreatedFullAttribute(){
        return $this->created_at->format('d-m-Y H:i:s');
    }

    public function getCreatedTimeAttribute(){
        return $this->created_at->format('h:i:s');
    }

    public function getUpdatedCoolAttribute(){
        if (! $this->updated_at)
            return '';
        Date::setLocale(CurrentLang::get());
        $d = Date::createFromFormat('Y-m-d H:i:s', $this->updated_at);

        return $d->diffForHumans();
    }

    public function getUpdatedDateAttribute(){
        return $this->updated_at->format('d.m.Y');
    }

    public function getUpdatedFullAttribute(){
        return $this->updated_at->format('d-m-Y H:i:s');
    }

    public function getUpdatedTimeAttribute(){
        return $this->updated_at->format('h:i:s');
    }

    
}

?>
