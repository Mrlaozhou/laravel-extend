## 安装
```bash
compsoer require mrlaozhou/laravel-extend
```
## 介绍
### Collection
```php
// 实例化
$collecttion = new\Mrlaozhou\Extend\Collection($data);
// 列表结构
$collection->toList();
// 树形结构
$collection->toTree();
```

### Eloquent
`use  trait \Mrloazhou\Extend\Unlimitedable`
```php
<?php namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;
use Mrlaozhou\Extend\Unlimitedable;

class Category extends Model
{
    use Unlimitedable;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('parent_id');
        $this->setOrderColumn('weight');
        $this->setTitleColumn('name');
    }
   
	 /**
	 * 缓存key
	 * @return string
	 */
    protected static function unlimitedCacheKey()
    {
        return 'category.topic';
    }

    /**
     * @return \Mrlaozhou\Extend\Collection
     */
    public static function topic()
    {
        return static::unlimitedCollectionByKeyword('topic');
    }
}
```
使用
```php
// 获取结合
Category::unlimitedCollection();
// 根据主键ID获取无限极下级结合
Category::unlimitedCollectionById($id);
// 根据关键词获取无限极下级集合
Category::unlimitedCollectionByKeyword($keyword);
// 根据ID获取单一数据
Category::unlimitedCollectionByKeyword($id);
// 根据关键词获取单一数据
Category::unlimitedSingleByKeyword($keyword);
```