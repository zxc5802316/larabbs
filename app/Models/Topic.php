<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = [
        'title', 'body', 'category_id', 'excerpt', 'slug',"tag_id"
    ];

    /** 一对一 关联 关联 category 一个话题属于一个分类；
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(){
        return $this->belongsTo(Category::class);
    }

    /** 一对一 关联 关联 tag 一个话题属于一个标签；
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag(){
        return $this->belongsTo(Tag::class);
    }
    /**一对一 关联 关联 User 一个话题拥有一个作者。
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**一篇帖子下有多条回复
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function scopeWithOrder($query,$order){
        switch ($order){
            case "recent":
                $query->recent();
                break;
            default:
                $query->recentReplied();
            break;

        }
        return $query->with("user","category");
    }
    public function scopeRecentReplied($query)
    {
        // 当话题有新回复时，我们将编写逻辑来更新话题模型的 reply_count 属性，
        // 此时会自动触发框架对数据模型 updated_at 时间戳的更新
        return $query->orderBy('updated_at', 'desc');
    }

    public function scopeRecent($query)
    {
        // 按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }

    public function link($params = []){
        return route("topics.show",array_merge([$this->id,$this->slug],$params));
    }

    public function updateReplyCount(){
        $this->reply_count = $this->replies->count();
        $this->save();
    }

    public function updateTagCount($tag_id){
        $this->tag->topic_count = $this->where("tag_id",$tag_id)->count();
        $this->tag->save();
    }
}
