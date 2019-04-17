@section('styles')
  <link href="{{asset("vendor/laravel-smartmd/smartmd.min.css")}}" rel="stylesheet">

  {{--use cdn or load local--}}
  <link href="{{asset("vendor/laravel-smartmd/font-awesome.min.css")}}" rel="stylesheet">
  <link href="{{asset("vendor/laravel-smartmd/katex.min.css")}}" rel="stylesheet">
  <script src="{{asset("vendor/laravel-smartmd/highlight.min.js")}}"></script>
  <script src="{{asset("vendor/laravel-smartmd/mermaid.min.js")}}"></script>
  <script src="{{asset("vendor/laravel-smartmd/katex.min.js")}}"></script>

  <script src="{{asset("vendor/laravel-smartmd/smartmd.min.js")}}"></script>
@stop



<div class="form-group">
  <textarea id="editor" name="body" class="form-control" rows="6" required placeholder="请使用 Markdown 语法输入内容，支持拖放上传图片">{{ old('body', $topic->body ) }}</textarea>
</div>

@section('scripts')
  <script type="text/javascript" src="{{ asset('js/module.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/hotkeys.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/uploader.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/simditor.js') }}"></script>

  <script>

    new Smartmd({
      el: "#editor",
      height: "40vh",
      autoSave: {
        uuid: 1,
        delay: 5000
      },
      uploads: {
        url: './upload',
        type: ['jpeg', 'png', 'bmp', 'gif', 'jpg'],
        maxSize: 4096,
        typeError: 'Image support format {type}.',
        sizeError: 'Image size is more than {maxSize} kb.',
        serverError: 'Upload failed in {msg}'
      }
    });
  </script>
@stop