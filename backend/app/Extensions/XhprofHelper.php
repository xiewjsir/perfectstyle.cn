<?php

namespace App\Extensions;

class XhprofHelper {
    const LOG_FILE_TYPE = 'xlog';
    const XHPROF_LOG_PATH = '/var/www/perfectlystyle.cn/backend/storage/logs/xhprof.log';


    /**
     * @param int $rate 频率，程序框架还未载入完成，此时还不能用env
     * @return mixed|null
     */
    static public function beginXhprof($rate = 100) {
        if (extension_loaded('xhprof') &&
            file_exists(self::XHPROF_LOG_PATH)
        ) {
            xhprof_enable(XHPROF_FLAGS_NO_BUILTINS | XHPROF_FLAGS_CPU | XHPROF_FLAGS_MEMORY);
            return microtime();
        }

        return null;
    }

    /**
     * @param null $xhprofBeginTime
     * @param string $appName
     * @param int $minTime 记录的响应事件最小值，超过该值才记录
     */
    static public function endXhprof($xhprofBeginTime = null, $appName = 'test', $minTime = 200) {
        echo 'ccccccccc';exit;
        if (empty($xhprofBeginTime)) {
            return;
        }

        $xhprofData = xhprof_disable();

        $interval = intval((microtime() - $xhprofBeginTime) * 1000);

        if ($interval > $minTime) {
            self::saveRun($xhprofData, sprintf('%s-%s-%sms',
                $appName,
                date('YmdHis'),
                $interval));
        }
    }

    /**
     * 保存结果，到指定文件夹
     */
    static private function saveRun($xhprofData, $runId) {
        $xhprofData = serialize($xhprofData);

        $file = fopen(sprintf('%s/%s.%s', self::XHPROF_LOG_PATH, $runId, self::LOG_FILE_TYPE), 'w');
        if ($file) {
            fwrite($file, $xhprofData);
            fclose($file);
        } else {
            logger('Could not open ' . $runId);
        }

        return $runId;
    }
}