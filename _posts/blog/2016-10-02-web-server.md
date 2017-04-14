---
layout: post
title:  webserver架构演变
description: 系统架构的演化过程
category: blog

---
## 系统架构演变初始阶段
![webserver-1](/images/webserver/webserver-1.PNG)

* 应用程序，文件，数据库等所有资源都在一台服务器上，类似lnmp

## 系统架构演变：应用程序与数据服务的分离
![webserver-2](/images/webserver/webserver-2.PNG)

* 随着系统访问量的增加，webserver机器的压力在高峰期会上升到一个高度，这时候增加webserver是一个很好的选择，将应用程序，文件，数据库分别部署在独立的资源上，将应用和数据分离，并发处理能力和数据的存储空间会获得很大改善。

## 系统架构演变：引入缓存改善性能
![webserver-3](/images/webserver/webserver-3.PNG)

*将数据库中较集中的一小部分数据存储在缓存服务器上，减少数据库的访问次数，降低数据库的访问压力，缓存分为本地缓存和远程分布式缓存两种，本地虽然快但是能缓存的数据数量有限，同时存在与应用程序争用内存情况。

## 系统架构演变：使用应用服务器集群
![webserver-4](/images/webserver/webserver-4.PNG)

* 当访问量继续增加时，会发现服务器会阻塞很多请求，通过使用负载均衡同时向外部提供服务，解决单台服务器处理能力和存储空间上的限的问题。

## 系统架构演变：数据库主从服务器实现读写分离
![webserver-5](/images/webserver/webserver-5.PNG)

* 当访问量持续增加，发现数据库写入、更新的这些操作的部分数据库连接的资源竞争非常激烈，导致了系统变慢。这是设置数据库主从服务器，经常需要改动的数据存在主服务器里，其他存在从服务器里，使数据库服务器压力得到缓解。

