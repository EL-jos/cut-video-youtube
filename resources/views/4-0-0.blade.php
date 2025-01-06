<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download YouTube Video</title>
    <script src="https://unpkg.com/htmx.org@2.0.4" integrity="sha384-HGfztofotfshcF7+8n44JQL2oJmowVChPTg48S+jvZoztPfvwD79OC/LTtG6dMp+" crossorigin="anonymous"></script>
    <style>
        .htmx-indicator{
            display:none;
        }
        .htmx-request .htmx-indicator{
            display:inline;
        }
        .htmx-request.htmx-indicator{
            display:inline;
        }
    </style>
</head>
<body>
<h1>Download a portion of a YouTube video</h1>

    <form method="POST" action="{{ route('search.video') }}"
          hx-post="{{ route('search.video') }}" hx-trigger="submit"
          hx-swap="innerHTML transition:true" hx-target="#el-result"
          hx-indicator="#indicator">
        @csrf
        <div>
            <label for="url">URL de la vidéo YouTube :</label>
            <input type="text" name="url" id="url" required />
        </div>


        <button type="submit">
            Chercher la vidéo
        </button>
    </form>

    <section style="margin-top: 1rem; display: flex; justify-content: center; align-items: center;" id="el-result">
        <img width="100px" id="indicator" class="htmx-indicator" src="{{ asset('assets/svg/loading.svg') }}" />
    </section>

    <script>
        // Gestion de la barre de progression
        document.addEventListener('htmx:progress', function(event) {

        });
    </script>
</body>
</html>
