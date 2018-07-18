<?php

/*
*依赖注入，控制反转
*/

class Ioc 
{
    //获得类的实例对象
    public static function getInstance($className)
    {
        $paramArr = self::getMethodParams($className);
        return (new ReflectionClass($className))->newInstanceArgs($paramArr);
    }

    /** 
     * 执行类的方法
     */
    public static function make($className, $methodsName, $params = [])
    {
        //获取类的实例
        $instance = self::getInstance($className);
        //获取该方法需要依赖注入的参数
        $paramArr = self::getMethodParams($className, $methodsName);

        return $instance->{$methodsName}(...array_merge($paramArr, $params));
    }

    /**
     * 获得类的方法参数，只获得有类型的参数
     */
    protected static function getMethodParams($className, $methodsName = '__construct')
    {
        //通过反射获得该类
        $class = new ReflectionClass($className);
        $paramArr = []; //记录参数和参数类型

        //判断该类是否有构造类
        if ($class->hasMethod($methodsName)) {
            //获得构造函数
            $contruct = $class->getMethod($methodsName);
            //判断构造函数是否有参数
            $params = $contruct->getParameters();

            if (count($params) > 0) {
                //判断参数类型
                foreach ($params as $key => $param) {
                    if ($paramClass = $param->getClass()) {
                        //获得参数类型名称
                        $paramClassName = $paramClass->getName();

                        //获取参数类型
                        $args = self::getMethodParams($paramClassName);
                        $paramArr[] = (new ReflectionClass($paramClass->getName()))->newInstanceArgs($args);
                    }
                }
            }
        }

        return $paramArr;
    }
}

class A
{
    protected $cObj;

    /** 
     * 用于测试多级依赖注入B依赖A，A依赖C
     */
    
    public function __construct(C $c)
    {
        $this->cObj = $c;

    }

    public function aa()
    {
        echo 'this is A-test';
    }

    public function aac()
    {
        $this->cObj->cc();
    }
}


class B
{
    protected $aObj;

    /** 
     * 用于测试多级依赖注入B依赖A，A依赖C
     */
    
    public function __construct(A $a)
    {
        $this->aObj = $a;

    }

    public function bb(C $c, $b)
    {
        $c->cc();
        echo "\r\n";
        echo 'params:'.$b;
    }

    public function bbb()
    {
        $this->aObj->aac();
    }
}

class C
{
    public function cc()
    {
        echo 'this is C->cc';
    }
}


$bObj = Ioc::getInstance('B');
$bObj->bbb();

var_dump($bObj);
