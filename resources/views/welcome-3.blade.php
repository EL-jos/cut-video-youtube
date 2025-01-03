<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download YouTube Video</title>
</head>
<body>
<h1>Download a portion of a YouTube video</h1>
<form action="{{ route('download.video') }}" method="POST">
    @csrf
    <label for="url">YouTube URL:</label><br>
    <input type="text" id="url" name="url" required><br><br>

    <h3>Start Time</h3>
    <label for="start_hour">Hour:</label>
    <input type="number" id="start_hour" name="start_hour" min="0" required>
    <label for="start_minute">Minute:</label>
    <input type="number" id="start_minute" name="start_minute" min="0" required>
    <label for="start_second">Second:</label>
    <input type="number" id="start_second" name="start_second" min="0" max="59" required><br><br>

    <h3>End Time</h3>
    <label for="end_hour">Hour:</label>
    <input type="number" id="end_hour" name="end_hour" min="0" required>
    <label for="end_minute">Minute:</label>
    <input type="number" id="end_minute" name="end_minute" min="0" required>
    <label for="end_second">Second:</label>
    <input type="number" id="end_second" name="end_second" min="0" max="59" required><br><br>

    <h3>Select File Format</h3>
    <select name="format" id="format">
        <option value="mp4">MP4</option>
        <option value="avi">AVI</option>
        <option value="mp3">MP3</option>
    </select><br><br>

    <button type="submit">Download</button>
</form>
</body>
</html>
