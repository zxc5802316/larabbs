<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Fresh Air') }}</title>
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    @include('Smartmd::head')
    <style>
        body {
            background: white;
        }
    </style>
</head>
<body>
<div id="app">
    <div class="container">
        <div class="row justify-content-center p-5">
            <div class="col-10 mb-4 text-center">
                <img src="https://xiaoqingxin.site/images/default_img.jpg" alt="im" class="col-12">
            </div>
            <div class="col-10">
                <div class="editor">
                <textarea id="editor" placeholder="请使用 Markdown 语法输入内容，支持拖放上传图片"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  new Smartmd({
    el: "#editor",
    height: "80vh",
    autoSave: {
      uuid: 1,
      delay: 5000
    },
    isFullScreen: true,
    isPreviewActive: true,
    uploads: {
      type: ['jpeg', 'png', 'bmp', 'gif', 'jpg'],
      maxSize: 4096,
      typeError: 'Image support format {type}.',
      sizeError: 'Image size is more than {maxSize} kb.',
      serverError: 'Upload failed on {msg}'
    }
  });
</script>
</body>
