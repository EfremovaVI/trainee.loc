<?php
/**
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi;

class Autoload
{
    protected $namespaceMap = [];

    /**
     * @param $namespace
     * @param $dir
     *
     * @return bool
     */
    public function addNamespace($namespace, $dir)
    {
        if (is_dir($dir)) {
            $this->namespaceMap[$namespace] = $dir;
            return true;
        }
        return false;
    }

    /**
     *
     */
    public function register()
    {
        spl_autoload_register([$this, 'autoload']);
    }

    /**
     * @param $class
     *
     * @return bool
     * @throws \Exception
     */
    protected function autoload($class)
    {
        $pathParts = explode('\\', $class);
        if (is_array($pathParts)) {
            $namespace = array_shift($pathParts);
            if (!empty($this->namespaceMap[$namespace])) {
                $filePath = implode('/', $pathParts) . '.php';
                require_once $filePath;
                return true;
            }
        }
        return false;
    }
}