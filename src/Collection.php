<?php
namespace Mrlaozhou\Extend;

use Illuminate\Support\Arr;

class Collection extends \Illuminate\Database\Eloquent\Collection
{
    /**
     * @param        $pid
     * @param string $selfKey
     * @param string $pidKey
     *
     * @return \Mrlaozhou\Extend\Collection
     */
    public function toTrees ($pid=0, $selfKey='id', $pidKey='pid')
    {
        $trees          =   [];
        foreach ( $this->items as $key => $item ) {
            if( $item[$pidKey] == $pid ) {
                $item['children']     =   $this->toTrees( $item[$selfKey] );
                $this->forget( $key );
                Arr::set( $trees, $item[$selfKey], $item );
            }
        }
        return new static($trees);
    }

    /**
     * @param int    $pid
     * @param string $selfKey
     * @param string $pidKey
     *
     * @return array
     */
    public function toTreesArray ($pid=0, $selfKey='id', $pidKey='pid')
    {
        $trees          =   new static();
        foreach ( $this->items as $key => $item ) {
            if( $item[$pidKey] == $pid ) {
                $item->children     =   $this->toTreesArray( $item[$selfKey] );
                $this->forget( $key );
                $trees->push( $item );
            }
        }
        return $trees->toArray();
    }

    /**
     * @param int       $pid
     * @param self|null $lists
     * @param int       $level
     * @param string    $selfKey
     * @param string    $pidKey
     *
     * @return \Mrlaozhou\Extend\Collection
     */
    public function toLists ($pid=0 ,self $lists=null, $level=1, $selfKey='id', $pidKey='pid')
    {
        $lists          =   $lists ?: new static([]);
        foreach ( $this->items as $key => $item ) {
            if( $item[$pidKey] == $pid ) {
                $item['level']        =   $level;
                $lists->push( $item );
                $this->forget($key);
                $this->toLists( $item[$selfKey], $lists, $level+1 );
            }
        }
        return $lists;
    }

    /**
     * @param int       $id
     * @param self|null $parentsCollection
     * @param int       $level
     * @param string    $selfKey
     * @param string    $pidKey
     *
     * @return bool|\Mrlaozhou\Extend\Collection
     */
    public function parents (int $id,self $parentsCollection=null, $level=1, $selfKey='id', $pidKey='pid' )
    {
        //  父级元素集
        $parentsCollection      =   $parentsCollection ?: new static();
        //  基础集合
        $baseCollectionKeyById  =   $this->keyBy($selfKey);
        //  元素是否存在
        if( !$current = $baseCollectionKeyById->get( $id ) ) {
            return false;
        }
        //  删除当前元素
        $baseCollectionKeyById->forget( $id );
        //  是否是顶级
        if( ( $pid = $current->{$pidKey} ) == 0 ) {
            return $parentsCollection;
        }
        //  父级是否存在
        if( $parent = $baseCollectionKeyById->get( $pid ) ) {
            //  设置等级
            $parent->level      =   $level;
            //  记录元素
            $parentsCollection->push( $parent );
            //  是否递归
            if( $parent->{$pidKey} == 0 ) {
                return $parentsCollection;
            }
            return $this->parents( $parent->{$selfKey}, $parentsCollection, $level+1, $selfKey, $pidKey );
        }
        return $parentsCollection;
    }

    /**
     * @param int    $pid
     * @param string $selfKey
     * @param string $pidKey
     *
     * @return \Mrlaozhou\Extend\Collection
     */
    public function children ($pid=0, $selfKey='id', $pidKey='pid')
    {
        return  $this->filter( function ($item) use ($pid, $selfKey, $pidKey){
            return $item[$pidKey]   ===  $pid;
        } );
    }
}