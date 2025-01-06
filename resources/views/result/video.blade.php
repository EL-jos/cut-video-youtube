@if($format === "video")
    <video controls width="500">
        <source src="{{ $url }}" type="video/mp4" />
    </video>
@elseif($format === "audio")
    <audio controls src="{{ $url }}"></audio>
@elseif($format === "image")
    <img src="{{ $url }}" decoding="async" loading="lazy" alt="">
@endif

@if(isset($visible) && $visible === true)
    @include('result.form')
@endif

@if(isset($download))
    <a href="javascript:;" onclick="document.getElementById('el-download').submit()">
        Télécharger
        <form id="el-download" method="POST" action="{{ route('download.video', ['url' => $url]) }}">
            @csrf
            <input type="hidden" name="url" value="{{ $url }}" />
        </form>
    </a>
@endif
