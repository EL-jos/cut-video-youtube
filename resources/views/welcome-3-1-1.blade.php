<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download YouTube Video</title>
</head>
<body>
<h1>Download a portion of a YouTube video</h1>

<form method="POST" action="{{ route('download.video') }}">
    @csrf
    <div>
        <label for="url">URL de la vidéo YouTube :</label>
        <input type="text" name="url" id="url" required />
    </div>

    <!-- Heures, minutes et secondes de début -->
    <div>
        <label for="start_hour">Heure de début :</label>
        <input type="number" name="start_hour" id="start_hour" min="0" max="23" placeholder="HH" required />
        <label for="start_minute">Minute de début :</label>
        <input type="number" name="start_minute" id="start_minute" min="0" max="59" placeholder="MM" required />
        <label for="start_second">Seconde de début :</label>
        <input type="number" name="start_second" id="start_second" min="0" max="59" placeholder="SS" required />
    </div>

    <!-- Heures, minutes et secondes de fin -->
    <div>
        <label for="end_hour">Heure de fin :</label>
        <input type="number" name="end_hour" id="end_hour" min="0" max="23" placeholder="HH" required />
        <label for="end_minute">Minute de fin :</label>
        <input type="number" name="end_minute" id="end_minute" min="0" max="59" placeholder="MM" required />
        <label for="end_second">Seconde de fin :</label>
        <input type="number" name="end_second" id="end_second" min="0" max="59" placeholder="SS" required />
    </div>

    <!-- Sélection du format de fichier -->
    <div>
        <label for="format">Choisir le format :</label>
        <select name="format" id="format">
            <optgroup label="Vidéo">
                <option value="mp4">MP4</option>
                <option value="avi">AVI</option>
                <option value="mov">MOV</option>
                <option value="mkv">MKV</option>
                <option value="webm">WEBM</option>
                <option value="flv">FLV</option>
                <option value="wmv">WMV</option>
                <option value="ogv">OGV</option>
                <option value="mpg">MPG</option>
                <option value="3gp">3GP</option>
                <option value="ts">TS</option>
                <option value="f4v">F4V</option>
                <option value="mpeg">MPEG</option>
            </optgroup>

            <optgroup label="Audio">
                <option value="mp3">MP3</option>
                <option value="wav">WAV</option>
                <option value="aac">AAC</option>
                <option value="flac">FLAC</option>
                <option value="ogg">OGG</option>
                <option value="m4a">M4A</option>
                <option value="opus">OPUS</option>
                <option value="wma">WMA</option>
                <option value="alac">ALAC</option>
            </optgroup>

            <optgroup label="Image">
                <option value="jpg">JPG</option>
                <option value="png">PNG</option>
                <option value="bmp">BMP</option>
                <option value="gif">GIF</option>
            </optgroup>
        </select>
    </div>

    <button type="submit">Télécharger</button>
</form>

</body>
</html>
