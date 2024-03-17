<?php
namespace Modules\Entity\Model\SysModelLog;

use Illuminate\Database\Eloquent\Model;

class SysModelLog extends Model {
    protected $table = 'sys_model_log';
    protected $fillable = [ 'user_id', 'table_name', 'el_id', 'note', 'json_el', 'type'];
    

    
}
