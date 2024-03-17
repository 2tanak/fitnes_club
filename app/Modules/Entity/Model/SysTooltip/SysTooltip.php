<?php
namespace Modules\Entity\Model\SysTooltip;

use Illuminate\Database\Eloquent\Model;

class SysTooltip extends Model {
    protected $table = 'sys_tooltip';
    protected $fillable = [ 'module', 'prop', 'note'];
    

    
}
