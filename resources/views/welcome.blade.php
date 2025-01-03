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

    <label for="start">Start Time (in seconds):</label><br>
    <input type="number" id="start" name="start" required><br><br>

    <label for="end">End Time (in seconds):</label><br>
    <input type="number" id="end" name="end" required><br><br>

    <button type="submit">Download</button>
</form>
</body>
</html>
