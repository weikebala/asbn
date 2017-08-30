<?php

//decode by QQ:45300551 http://www.iseasoft.cn/
if (!defined('IN_IA')) {
    die('Access Denied');
}
class Processor extends WeModuleProcessor
{
    public function respond()
    {
        $rule = pdo_fetch('select * from ' . tablename('rule') . ' where id=:id limit 1', array(':id' => $this->rule));
        if (empty($rule)) {
            return false;
        }
        $names = explode(':', $rule['name']);
        $plugin = isset($names[1]) ? $names[1] : '';
        if (!empty($plugin)) {
            $processor_file = sea_PLUGIN . $plugin . '/processor.php';
            if (is_file($processor_file)) {
                require $processor_file;
                $processor_class = ucfirst($plugin) . 'Processor';
                $proc = new $processor_class($plugin);
                if (method_exists($proc, 'respond')) {
                    return $proc->respond($this);
                }
            }
        }
    }
}