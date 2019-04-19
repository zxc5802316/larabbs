@extends('layouts.app')

@section('title', $topic->title)
@section('description', $topic->excerpt)
@section('content')

  <div class="row">

    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs author-info">
      <div class="card ">
        <div class="card-body">
          <div class="text-center">
            作者：{{ $topic->user->name }}
          </div>
          <hr>
          <div class="media">
            <div align="center">
              <a href="{{ route('users.show', $topic->user->id) }}">
                <img class="thumbnail img-fluid" src="{{ $topic->user->avatar }}" width="300px" height="300px">
              </a>
            </div>
          </div>
        </div>
      </div>
      @if (count($usertopics))
        <div class="card mt-4">
          <div class="card-body pt-2">
            <div class="text-center mt-1 mb-0 text-muted">最近文章</div>
            <hr class="mt-2 mb-3">
            @foreach ($usertopics as $usertopic)
              <a class="media mt-1" href="{{ $usertopic->title }}">
                <div class="media-body">
                  <span class="badge badge-secondary" style="background: #dddddd">{{$usertopic->created_at->diffForHumans()}}</span><span class="media-heading text-muted">{{ $usertopic->title }}</span>
                </div>
              </a>
              <hr>
            @endforeach

          </div>
        </div>
      @endif
    </div>

    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 topic-content">
      <div class="card ">
        <div class="card-body">
          <h1 class="text-center mt-3 mb-3">
            {{ $topic->title }}
          </h1>

          <div class="article-meta text-center text-secondary">
            {{ $topic->created_at->diffForHumans() }}
            ⋅
            <i class="far fa-comment"></i>
            {{ $topic->reply_count }}
          </div>

          <div class="topic-body mt-4 mb-4">
            {!! $topic->body !!}
          </div>

          @can('update', $topic)
            <div class="operate">
              <hr>
              <a href="{{ route('topics.edit', $topic->id) }}" class="btn btn-outline-secondary btn-sm" role="button">
                <i class="far fa-edit"></i> 编辑
              </a>
              <form action="{{ route('topics.destroy', $topic->id) }}" method="post"
                    style="display: inline-block;"
                    onsubmit="return confirm('您确定要删除吗？');">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-outline-secondary btn-sm">
                  <i class="far fa-trash-alt"></i> 删除
                </button>
              </form>
            </div>
          @endcan

        </div>
      </div>
      {{-- 用户回复列表 --}}
      <div class="card topic-reply mt-4">
        <div class="card-body">
          @includeWhen(Auth::check(), 'topics._reply_box', ['topic' => $topic])
          @include('topics._reply_list', ['replies' => $topic->replies()->with('user')->get()])
        </div>
      </div>
    </div>
  </div>
@stop
@section("scripts")
  <script>
    var codes = document.getElementsByClassName('hljs');
    for(let item of codes){
      window.hljs.highlightBlock(item);
    }
    var maths = document.getElementsByClassName('math');
    for(let item of maths){
      window.katex.render(item.innerHTML, item, {
        throwOnError: true
      });
    }
  </script>
  @stop
