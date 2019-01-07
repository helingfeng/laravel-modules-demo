# Laravel-Modules-Demo
Laravel 框架前后端模块化开发脚手架

## 模块安装步骤

### 项目依赖 `composer-merge-plugin` 依赖

```shell
$ composer require composer-merge-plugin
```

### 修改项目 `composer.json` 文件，支持 `merge plugin composer.json`

```markdown
"extra": {
    "merge-plugin": {
      "include": [
        "modules/*/composer.json"
      ],
      "recurse": false,
      "replace": true,
      "ignore-duplicates": true,
      "merge-dev": true,
      "merge-extra": true,
      "merge-extra-deep": false
    }
},
```

### 克隆插件模块代码到 `modules` 目录

```shell
$ cd modules
$ git clone https://github.com/Chester-Hee/LaravelModulesDemo.git
```

### 项目配置依赖

修改 `app.conf` 手工添加 `provider`，`Laravel 5.5` 支持 `auto discover`，但是 `composer-merge-plugin` 下，无法正在执行，所以暂时使用手工添加配置

```markdown
"providers" => [
    "LaravelModulesDemo\Backend\Providers\TestProvider::class"
]
```
执行 composer install
```shell
$ cd laravel
$ composer install
```

### 前端构建

```shell
$ cd modules/LaravelModulesDemo/Frontend
$ cnpm install
$ webpack
```

### 发布静态文件

```shell
$ php artisan vendor:publish --provider="LaravelModulesDemo\Backend\Providers\TestProvider"
```

### 访问路由入口

- https://127.0.0.1/test/plugin




