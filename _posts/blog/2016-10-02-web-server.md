---
layout: post
title:  webserver架构演变
description: 系统架构的演化过程
category: blog

---
## 系统架构演变初始阶段
![webserver-1](/images/webserver/webserver-1.png)
* 应用程序，文件，数据库等所有资源都在一台服务器上，类似lnmp

## 系统架构演变：应用程序与数据服务的分离
![webserver-2](/images/webserver/webserver-2.png)
* 随着系统访问量的增加，webserver机器的压力在高峰期会上升到一个高度，这时候增加webserver是一个很好的选择，将应用程序，文件，数据库分别部署在独立的资源上，将应用和数据分离，并发处理能力和数据的存储空间会获得很大改善。

## 系统架构演变：引入缓存改善性能
![webserver-3](/images/webserver/webserver-3.png)
