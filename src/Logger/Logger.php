<?php

namespace Yeofan\Logger;

use think\facade\Log;
use Yeofan\Support\SegregatedStorage;

class Logger
{
    public static function add($msg,$level='info',$async=true){
        $logId = SegregatedStorage::get('logId');

        $msg = '[' . ($logId ? $logId : '') . ']【'.date('Y-m-d H:i:s').'】'.$msg;

        if($async){
            $res['msg'] = $msg;
            $res['level'] = $level;


            $jobHandlerClassName = 'Yeofan\Logger\LogJob';
            \think\facade\Queue::push($jobHandlerClassName, $res);
        }else{
            Log::write($msg,$level);
        }

    }

}