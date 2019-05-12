<?php
namespace Mrlaozhou\Extend;

use Illuminate\Support\Facades\Cache;

/**
 * Trait UnlimitedCacheService
 *
 * @method static \Illuminate\Database\Eloquent\Builder query()
 */
trait Unlimitedable
{
    protected static $pkFieldName = 'id';

    protected static $keywordFieldName = 'keyword';

    protected static $pidFieldName = 'parent_id';

    /**
     * 获取所有数据
     *
     * @return \Mrlaozhou\Extend\Collection
     */
    public static function unlimitedCollection()
    {
        return static::unlimitedDataCollection();
    }

    /**
     * 根据ID获取子集
     *
     * @param int $id
     *
     * @return \Mrlaozhou\Extend\Collection
     */
    public static function unlimitedCollectionById(int $id)
    {
        if( $parent = static::unlimitedSingleById($id) ) {
            return static::unlimitedCollection()->toLists(
                $parent->getKey(), null, 1, static::$pkFieldName, static::$pidFieldName
            );
        }
        return new Collection();
    }

    /**
     * 根据keyword获取子集
     *
     * @param string $keyword
     *
     * @return \Mrlaozhou\Extend\Collection
     */
    public static function unlimitedCollectionByKeyword(string $keyword)
    {
        if( $parent = static::unlimitedSingleByKeyword($keyword) ) {
            return static::unlimitedCollection()->toLists(
                $parent->getKey(), null, 1, static::$pkFieldName, static::$pidFieldName
            );
        }
        return new Collection();
    }

    /**
     * 通过ID获取单一数据
     * @param int $id
     *
     * @return static|\Illuminate\Database\Eloquent\Model
     */
    public static function unlimitedSingleById(int $id)
    {
        return static::unlimitedCollection()->where('id', $id)->first();
    }

    /**
     * 通过keyword获取单一数据
     * @param string $keyword
     *
     * @return static
     */
    public static function unlimitedSingleByKeyword(string $keyword)
    {
        return static::unlimitedCollection()->where(static::$keywordFieldName, $keyword)->first();
    }

    /**
     * @return int|null
     */
    public function unlimitedId()
    {
        return $this->getKey();
    }

    /**
     * @return int|null
     */
    public function unlimitedPid()
    {
        return $this->{static::$pidFieldName};
    }

    /**
     * @return string|null
     */
    public function unlimitedName()
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function unlimitedKeyword()
    {
        return $this->{static::$keywordFieldName};
    }

    /**
     * 原始数据集
     *
     * @return \Mrlaozhou\Extend\Collection
     */
    protected static function unlimitedDataCollection()
    {
        return new Collection(
            Cache::remember( static::unlimitedCacheKey(), 3600, function () {
                return static::query()
                    ->select('id', 'name', static::$keywordFieldName, static::$pidFieldName)
                    ->get();
            } )
        );
    }

    /**
     * 获取缓存标识
     *
     * @return string
     */
    abstract protected static function unlimitedCacheKey();
}