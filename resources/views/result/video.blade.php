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
<!-- FONTAWESOME -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!-- FONTAWESOME -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
<style>
    *{
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
    .el-group-input-number{
        height: 30px;
        position: relative;
        display: flex;
        align-items: center;
        gap: .15rem;
    }.el-group-input-number .el-number{
         display: block;
         height: 100%;
         border: none;
         outline: none;
         width: 30px;
         font-family: var(--font-family);
         text-align: center;
         font-size: 1rem;
         background-color: transparent;
         color: #666;
     }.el-group-input-number .el-controls{
          display: flex;
          flex-direction: column;
          gap: 1px;
      }.el-group-input-number .svg-inline--fa,
       .el-group-input-number .fas{
           font-size: .7rem;
           transition: .3s;
           cursor: pointer;
           color: #666;
       }.el-group-input-number .svg-inline--fa:hover,
        .el-group-input-number .fas:hover{
            color: #000;
            transform: scale(1.5);
        }.el-container-time{
             display: flex;
             align-items: center;
             gap: .5rem;
             padding-top: .12rem;
         }.el-group-input-number button{
              outline: none;
              border: none;
              background: none;
          }#el-time-input{
               display: flex;
               flex-direction: column;
               align-items: center;
               gap: 1rem;
               width: fit-content;
               border: 1px solid rgba(0, 0, 0, .15);
               padding: .5rem 1rem;
               border-radius: 10px;
               box-shadow: inset 0 0 20px rgba(0, 0, 0, .15)
           }#el-time-input h3{
                font-size: .9rem
            }
</style>
<!-- VIDEO.JS -->
<script src="https://vjs.zencdn.net/8.16.1/video.min.js"></script>
<div @if(!isset($exist)) style="max-width: none;" @endif id="el-video" class="el-video-area">
    <img src="{{ asset('assets/images/tab_2.png')}}" alt="">
    <div class="el-title">
        <h5>{{ $title ?? "Aucun vidéo n'est disponible, veillez coller un lien pour télécharger la vidéo" }}</h5>
        <p>{{ $duration ?? '00:00:00' }}</p>
    </div>
    <video src="{{ $url ?? '' }}" controls id="el-video-js" class="video-js vjs-theme-city"
           preload="auto" width="100%" height="264" data-setup="{}">

        <p class="vjs-no-js">
            Pour visionner cette vidéo, veuillez activer JavaScript et envisagez de passer à une version plus récente du navigateur web qui
            <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
        </p>

    </video>
    @if(isset($visible) && $visible)
        <a href="javascript:;" onclick="document.getElementById('el-form-download').submit()" class="el-video-btn el-download el-box-center">
            <form id="el-form-download" action="{{ route('download.video') }}" method="POST">
                @csrf
                <input type="hidden" value="{{ $url }}" name="url" readonly required />
            </form>
            <div class="el-inner-1">
                <div class="el-inner-2">
                    Télécharger le fichier
                </div>
            </div>
        </a>
    @endif
</div>

<form style="display: flex; flex-direction: column; gap: 1rem;" class="el-container-controls-video"
      method="POST" action="{{ route('cut.video') }}"
      hx-post="{{ route('cut.video') }}" hx-trigger="submit"
      hx-swap="outerHTML transition:true" hx-target="#el-response">
        @csrf
    @if(isset($exist) && $exist === true)
            {{--<time-input
                start-hour="00"
                start-minute="00"
                start-second="00"
                end-hour="17"
                end-minute="45"
                end-second="00">
            </time-input>--}}
            <div id="el-time-input">
                <div class="el-container-start">
                    <h3>Début</h3>
                    <div id="el-start" class="el-container-time">
                        <div class="el-group-input-number">
                            <input type="text" name="start_hour" min="0" max="23" placeholder="HH" class="el-number" />
                            <div class="el-controls">
                                <button type="button" class="el-up">
                                    <i class="fas fa-chevron-up"></i>
                                </button>

                                <button type="button" class="el-down">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </div>
                        </div>
                        <div class="el-group-input-number">
                            <input type="text" name="start_minute" min="0" max="59" placeholder="MM" class="el-number" />
                            <div class="el-controls">
                                <button type="button" class="el-up">
                                    <i class="fas fa-chevron-up"></i>
                                </button>
                                <button type="button" class="el-down">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </div>
                        </div>
                        <div class="el-group-input-number">
                            <input type="text" name="start_second" min="0" max="59" placeholder="SS" class="el-number" />
                            <div class="el-controls">
                                <button type="button" class="el-up">
                                    <i class="fas fa-chevron-up"></i>
                                </button>
                                <button type="button" class="el-down">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="el-container-end">
                    <h3>Fin</h3>
                    <div id="el-end" class="el-container-time">
                        <div class="el-group-input-number">
                            <input type="text" name="end_hour" min="0" max="23" placeholder="HH" class="el-number" />
                            <div class="el-controls">
                                <button type="button" class="el-up">
                                    <i class="fas fa-chevron-up"></i>
                                </button>
                                <button type="button" class="el-down">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </div>
                        </div>
                        <div class="el-group-input-number">
                            <input type="text" name="end_minute" min="0" max="59" placeholder="MM" class="el-number" />
                            <div class="el-controls">
                                <button type="button" class="el-up">
                                    <i class="fas fa-chevron-up"></i>
                                </button>
                                <button type="button" class="el-down">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </div>
                        </div>
                        <div class="el-group-input-number">
                            <input type="text" name="end_second" min="0" max="59" placeholder="SS" class="el-number" />
                            <div class="el-controls">
                                <button type="button" class="el-up">
                                    <i class="fas fa-chevron-up"></i>
                                </button>
                                <button type="button" class="el-down">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="el-select">
                <div class="el-container">
                    <span>Convertir en format ?</span>
                </div>
                <div class="el-content">
                    <div data-value="mp4">
                        <h3>MP4</h3>
                        <span>Vidéo</span>
                    </div>
                    <div data-value="avi">
                        <h3>AVI</h3>
                        <span>Vidéo</span>
                    </div>
                    <div data-value="mov">
                        <h3>MOV</h3>
                        <span>Vidéo</span>
                    </div>
                    <div data-value="mkv">
                        <h3>MKV</h3>
                        <span>Vidéo</span>
                    </div>
                    <div data-value="mp3">
                        <h3>MP3</h3>
                        <span>Audio</span>
                    </div>
                    <div data-value="wav">
                        <h3>WAV</h3>
                        <span>Audio</span>
                    </div>
                    <div data-value="aac">
                        <h3>AAC</h3>
                        <span>Audio</span>
                    </div>
                    <div data-value="flac">
                        <h3>FLAC</h3>
                        <span>Audio</span>
                    </div>
                </div>
                <div class="el-arrow"></div>
                <select style="display: none;" name="format" id="format"></select>
            </div>
            <button style="margin-top: 4.7rem; background-color: transparent; outline: none; border: none" type="submit" class="el-video-btn el-active el-box-center">
                <div class="el-inner-1">
                    <div class="el-inner-2">
                        Couper
                    </div>
                </div>
            </button>
    @endif

</form>


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

@if(isset($exist) && $exist)
    <script>
        let el_select = document.querySelector('.el-select');
        el_select.addEventListener('click', () => {
            el_select.classList.toggle('el-active');
        });

        document.addEventListener('DOMContentLoaded', function () {
            const elContent = el_select.querySelector('.el-content');
            const spanText = el_select.querySelector('.el-container span');
            const selectElement = el_select.querySelector('#format');

            // Remplir le select avec les options
            const options = elContent.querySelectorAll('div');
            options.forEach(option => {
                const value = option.getAttribute('data-value');
                const optionElement = document.createElement('option');
                optionElement.value = value;
                optionElement.textContent = option.querySelector('h3').textContent;
                selectElement.appendChild(optionElement);
            });

            // Ajouter l'événement de clic sur chaque élément de .el-content
            elContent.addEventListener('click', function (e) {
                const selectedElement = e.target.closest('div[data-value]');
                if (selectedElement) {
                    const selectedValue = selectedElement.getAttribute('data-value');
                    // Mettre à jour le select
                    selectElement.value = selectedValue;
                    // Modifier le texte du span
                    spanText.textContent = `Convertir en format ${selectedValue}`;
                }
            });
        });
    </script>
    <script>
        function setupForContainer(container) {
            const inputs = container.querySelectorAll('.el-number');
            inputs.forEach(input => {
                const controls = input.parentElement.querySelector('.el-controls');
                const incrementBtn = controls.querySelector('.el-up');
                const decrementBtn = controls.querySelector('.el-down');

                console.log(incrementBtn, decrementBtn);

                incrementBtn.addEventListener('click', () => updateValue(input, 1));
                decrementBtn.addEventListener('click', () => updateValue(input, -1));

                // Gérer la saisie directe par l'utilisateur
                input.addEventListener('input', () => validateInput(input));
                input.addEventListener('blur', () => validateInput(input));
            });
        }

        function updateValue(input, step) {
            let value = parseInt(input.value) || 0;
            const name = input.getAttribute('name');

            if (name.includes('hour')) {
                value = (value + step + 24) % 24;
            } else if (name.includes('minute') || name.includes('second')) {
                value += step;
                if (value > 59) {
                    value = 0;
                    incrementParent(input, name);
                } else if (value < 0) {
                    value = 59;
                    decrementParent(input, name);
                }
            }

            input.value = value.toString().padStart(2, '0');

            // Vérifier si le temps de fin est supérieur au temps de début
            if (name.includes('end')) {
                checkTimeOrder();
            }
        }

        function validateInput(input) {
            let value = parseInt(input.value) || 0;
            const name = input.getAttribute('name');

            if (name.includes('hour')) {
                value = Math.min(Math.max(value, 0), 23);
            } else if (name.includes('minute') || name.includes('second')) {
                value = Math.min(Math.max(value, 0), 59);
            }

            input.value = value.toString().padStart(2, '0');
            checkTimeOrder();
        }

        function checkTimeOrder() {
            const startHour = parseInt(document.querySelector('input[name="start_hour"]').value) || 0;
            const startMinute = parseInt(document.querySelector('input[name="start_minute"]').value) || 0;
            const startSecond = parseInt(document.querySelector('input[name="start_second"]').value) || 0;

            const endHour = parseInt(document.querySelector('input[name="end_hour"]').value) || 0;
            const endMinute = parseInt(document.querySelector('input[name="end_minute"]').value) || 0;
            const endSecond = parseInt(document.querySelector('input[name="end_second"]').value) || 0;

            if (
                endHour < startHour ||
                (endHour === startHour && endMinute < startMinute) ||
                (endHour === startHour && endMinute === startMinute && endSecond <= startSecond)
            ) {
                document.querySelector('input[name="end_hour"]').value = startHour.toString().padStart(2, '0');
                document.querySelector('input[name="end_minute"]').value = startMinute.toString().padStart(2, '0');
                document.querySelector('input[name="end_second"]').value = (startSecond + 1).toString().padStart(2, '0');
            }
        }

        function incrementParent(input, name) {
            if (name.includes('second')) {
                const minuteInput = name.includes('start')
                    ? document.querySelector('input[name="start_minute"]')
                    : document.querySelector('input[name="end_minute"]');
                updateValue(minuteInput, 1);
            } else if (name.includes('minute')) {
                const hourInput = name.includes('start')
                    ? document.querySelector('input[name="start_hour"]')
                    : document.querySelector('input[name="end_hour"]');
                updateValue(hourInput, 1);
            }
        }

        function decrementParent(input, name) {
            if (name.includes('second')) {
                const minuteInput = name.includes('start')
                    ? document.querySelector('input[name="start_minute"]')
                    : document.querySelector('input[name="end_minute"]');
                updateValue(minuteInput, -1);
            } else if (name.includes('minute')) {
                const hourInput = name.includes('start')
                    ? document.querySelector('input[name="start_hour"]')
                    : document.querySelector('input[name="end_hour"]');
                updateValue(hourInput, -1);
            }
        }

        const container = document.querySelector('#el-time-input');
        setupForContainer(container);
    </script>
@endif
