<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}
if (!class_exists('TradeareaModel')) {
	class TradeareaModel extends PluginModel
	{

		public function perms()
        {
            return array(
                'tradeasrea' => array(
                    'text' => $this->getName(),
                    'isplugin' => true,
                    'child' => array(
                        'set' => array(
                            'text' => '设置',
                            'view' => '浏览',
                            'save' => '更改设置-log'
                        ),
                        'index' => array(
                            'text' => '商圈',
                            'view' => '浏览',
                            'add' => '添加-log',
                            'edit' => '修改-log',
                            'delete' => '删除-log'
                        ),
                        'deliver' => array(
                            'text' => '配送员',
                            'view' => '浏览',
                            'add' => '添加-log',
                            'edit' => '修改-log',
                            'delete' => '删除-log'
                        )
                    )
                )
            );
        }

	}
}
