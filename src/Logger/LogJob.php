<?php

namespace Yeofan\Logger;

use think\facade\Log;
use think\queue\Job;

class LogJob
{

    public function fire(Job $job, $data){
        $time = '【'.date('Y-m-d H:i:s').'】';
        //检查任务重试次数
        if ($job->attempts() > 3) {
            Log::write($time."job has been retried more that 3 times");
            $job->delete(); // 删除任务
        }

        Log::record($data['msg'],$data['level']);
        $job->delete();
    }

    public function failed($data)
    {
        // ...任务达到最大重试次数后，失败了
        Log::error('任务达到最大重试次数后，失败了');
    }
}