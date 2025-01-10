<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- VIDEO.JS -->
    <link href="https://vjs.zencdn.net/8.16.1/video-js.css" rel="stylesheet" />
    <link href="https://unpkg.com/@videojs/themes@1/dist/city/index.css" rel="stylesheet" />
    <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
    <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- WEB COMPONENT -->
    <script src="{{ asset('assets/js/components/timeInput.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <script src="https://unpkg.com/htmx.org@2.0.4" integrity="sha384-HGfztofotfshcF7+8n44JQL2oJmowVChPTg48S+jvZoztPfvwD79OC/LTtG6dMp+" crossorigin="anonymous"></script>
</head>
<body>

<div class="app_panel">
    <div class="left_middle">
        <div class="right_middle">
            <div class="left_top">
                <div class="left_bottom">
                    <div class="right_top">
                        <div class="right_bottom">
                            <div class="main_middle">
                                <div class="main_top">
                                    <div class="main_bottom">
                                        <div class="clear_margins">
                                            <div class="screen">
                                                <section id="el-section-one">
                                                    <div class="txt_shadow_1 circle_step el-box-center">1</div>
                                                    <form action="" method="post" class="el-form-search" id="el-form-search"
                                                          method="POST" action="{{ route('search.video') }}"
                                                          hx-post="{{ route('search.video') }}" hx-trigger="submit"
                                                          hx-swap="outerHTML transition:true" hx-target="#el-video">
                                                        @csrf
                                                        @include('result.progress-bar', ['width' => '0%'])
                                                        <button style="background-color: transparent; outline: none; border: none" class="el-video-btn el-rounded el-box-center">
                                                            <div class="el-inner-1">
                                                                <div class="el-inner-2">
                                                                    Analyser
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </form>
                                                </section>
                                                <div class="el-divider"></div>
                                                <section id="el-section-two">
                                                    <div class="txt_shadow_1 circle_step el-box-center">2</div>
                                                    @include('result.video')
                                                    <div style="display: flex; flex-direction: column; gap: 1rem;" class="el-container-controls-video">
                                                        <time-input
                                                            start-hour="00"
                                                            start-minute="00"
                                                            start-second="00"
                                                            end-hour="17"
                                                            end-minute="45"
                                                            end-second="00">
                                                        </time-input>
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
                                                        <a style="margin-top: 4.7rem;" href="javascript:;" class="el-video-btn el-active el-box-center">
                                                            <div class="el-inner-1">
                                                                <div class="el-inner-2">
                                                                    Couper
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>

                                                </section>
                                                <div class="el-divider"></div>
                                                <section id="el-section-three">
                                                    <div class="txt_shadow_1 circle_step el-box-center">3</div>
                                                    <a href="javascript:;" class="el-video-btn el-download el-box-center">
                                                        <div class="el-inner-1">
                                                            <div class="el-inner-2">
                                                                Télécharger le fichier
                                                            </div>
                                                        </div>
                                                    </a>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FONTAWESOME -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

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

    const url = new URL("http://localhost:3000/.well-known/mercure");
    url.searchParams.append('topic', `{{ env('APP_URL') }}/progress/{{ $userId }}`);

    const eventSource = new EventSource(url);
    eventSource.onmessage = e => {

        //let response = JSON.parse(e.data);
        console.log(e.data)
        document.getElementById("el-result").innerHTML = e.data
    }

    window.addEventListener('beforeunload', () => {
        if(eventSource != null){
            eventSource.close();
        }
    })
</script>

</body>
</html>
