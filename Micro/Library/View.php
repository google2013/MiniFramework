<?php
// +------------------------------------------------------------
// | Micro Framework
// +------------------------------------------------------------
// | Source: https://github.com/jasonweicn/MicroFramework
// +------------------------------------------------------------
// | Author: Jason.wei <jasonwei06@hotmail.com>
// +------------------------------------------------------------

class View
{
    /**
     * 渲染模板
     * 
     * @var string
     */
    private $_render;
    
    protected $_app;
    
    protected $_baseUrl;
    
    /**
     * 构造
     * 
     * @param string $controller
     * @param string $action
     * @return View
     */
    function __construct($controller, $action)
    {
        $file = APP_PATH . DIRECTORY_SEPARATOR .  'Views' . DIRECTORY_SEPARATOR . strtolower($controller) . DIRECTORY_SEPARATOR . $action . '.php';
        
        if (file_exists($file)) {
            $this->_render = $file;
        } else {
            throw new Exception('View ' . $action . ' does not exist.');
        }
        
        $this->_app = App::getInstance();
    }
    
    public function baseUrl()
    {
        if ($this->_baseUrl === null) {
            $this->_baseUrl = $this->_app->_baseUrl;
        }
        return $this->_baseUrl;
    }
    
    public function __set($variable, $value)
    {
        $this->assign($variable, $value);
    }

    /**
     * 接收来自于控制器的变量
     * 
     * @param string $variable
     * @param mixed $value
     */
    public function assign($variable, $value)
    {
        if (substr($variable, 0, 1) != '_') {
            $this->$variable = $value;
            return true;
        }
        return false;
    }
    
    /**
     * 渲染
     * 
     */
    public function display()
    {
        include($this->_render);
    }
}