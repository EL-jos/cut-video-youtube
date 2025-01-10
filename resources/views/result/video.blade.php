{{--@if($format === "video")
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
@endif--}}
<!-- VIDEO.JS -->
<script src="https://vjs.zencdn.net/8.16.1/video.min.js"></script>
<div id="el-video" class="el-video-area">
    <img src="{{ asset('assets/images/tab_2.png')}}" alt="">
    <div class="el-title">
        <h5>{{ $title ?? "Aucun vidéo n'est disponible, veillez coller un lien pour télécharger la vidéo" }}</h5>
        <p>{{ $duration ?? 0 }}</p>
    </div>
    <video src="{{ $url ?? '' }}" controls id="el-video-js" class="video-js vjs-theme-city"
           preload="auto" width="100%" height="264" data-setup="{}">

        <p class="vjs-no-js">
            Pour visionner cette vidéo, veuillez activer JavaScript et envisagez de passer à une version plus récente du navigateur web qui
            <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
        </p>

    </video>
</div>

<script>
    videojs('el-video-js', {
        autoplay: 'play',
        controls: true,
        muted: false,
        loop: false,
        preload: 'auto',
        //src: '',
        enableSmoothSeeking: true,
        experimentalSvgIcons: true,
        fluid: true,
        inactivityTimeout: 0,
        language: 'fr',
        playbackRates: [0.5, 1, 1.5, 2],
        playsinline: true,
        preferFullWindow: true
    });
</script>
