# 安装

1、git 安装

```
git clone https://github.com/zxc5802316/larabbs.git
```

2、composer 安装

```
composer create-project zxc5802316/larabbs
```

## 安装composer 包

```
1、 cd larabbs
2、 composer install
```

### 发布配置文件

~~~
cp .env.example .env
~~~

### 配置数据库

~~~
DB_DATABASE=larabbs   //数据库名称
DB_USERNAME=homestead //用户名
DB_PASSWORD=secret    //密码
~~~

#### 重新生成唯一key值

~~~
php artisan key:generate
~~~

##### 执行数据迁移并数据填充

~~~
php artisan migrate --seed
~~~

所有数据都配置好了，你可以访问你的网站了!嘻嘻