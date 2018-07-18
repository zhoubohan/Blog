---
layout: post
title: 面试总结(链家)
description: 每天都是新开始，不积跬步无以至千里。
category: blog

---

## 1.判断IPV4的IP是否合法(两种方法255.255.255.255)
1. 自行写函数
```php
function checkIp(string $ip)
{
   $arr = explode('.', $ip);
   if (count($arr) ! = 4) {
       return false;
   } else {
       foreach ($arr as $v) {
           if (($v < '0' || $v > '255')) {
               return false;
           }
       }
   }

   return true;
}
```
2. 使用php5.2.0之后的内置函数
- 判断是否为合法IP
```php
if (filter_var($ip, FILTER_VALIDATE_IP)) {
    //it's valid
}else {
   //it's not valid 
}
```
- 判断是否为合法IPV4 IP
```php
if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
    //it's valid
}else {
   //it's not valid 
}
```
- 判断是否是合法的公共IPv4地址，192.168.1.1这类的私有IP地址将会排除在外
```php
if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4| FILTER_FLAG_NO_PRIV_RANGE)) {
    //it's valid
}else {
   //it's not valid 
}
```
- 判断是否是合法的IPv6地址
```php
if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_RES_RANGE)) {
    //it's valid
}else {
   //it's not valid 
}
```
- 判断是否是合法公共的IPv6地址或者IPV4地址
```php
if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_RES_RANGE|FILTER_FLAG_NO_PRIV_RANGE)) {
    //it's valid
}else {
   //it's not valid 
}
```

## 2. MySQL索引问题（联合索引或者单独索引是否生效）
