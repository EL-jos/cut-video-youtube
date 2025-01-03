<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class VideoController extends Controller
{
    //Version 3.1.1
    /*public function download(Request $request)
    {
        $url = $request->get('url');  // URL YouTube

        // Récupérer les heures, minutes et secondes de début
        $startHour = (int)$request->get('start_hour');
        $startMinute = (int)$request->get('start_minute');
        $startSecond = (int)$request->get('start_second');

        // Récupérer les heures, minutes et secondes de fin
        $endHour = (int)$request->get('end_hour');
        $endMinute = (int)$request->get('end_minute');
        $endSecond = (int)$request->get('end_second');

        // Convertir les heures, minutes et secondes en secondes totales
        $startTime = ($startHour * 3600) + ($startMinute * 60) + $startSecond;
        $endTime = ($endHour * 3600) + ($endMinute * 60) + $endSecond;

        // Définir les chemins vers yt-dlp et FFmpeg
        $ytDlpPath = public_path('tools/yt-dlp/yt-dlp.exe');
        $ffmpegPath = public_path('tools/ffmpeg/ffmpeg.exe');

        // Télécharger la vidéo avec yt-dlp
        $outputVideo = public_path('mp4/video.mp4');
        $commandDownload = "$ytDlpPath -o $outputVideo $url";
        shell_exec($commandDownload);

        // Vérifier si la vidéo a bien été téléchargée
        if (!file_exists($outputVideo)) {
            return response()->json(['error' => 'Échec du téléchargement de la vidéo'], 500);
        }

        // Découper la vidéo avec FFmpeg
        $duration = $endTime - $startTime;
        $trimmedVideo = public_path('mp4/trimmed_output.mp4');
        $commandTrim = "$ffmpegPath -i $outputVideo -ss $startTime -t $duration -c copy $trimmedVideo";
        shell_exec($commandTrim);

        // Vérifier si la vidéo a été découpée
        if (!file_exists($trimmedVideo)) {
            return response()->json(['error' => 'Échec de la découpe de la vidéo'], 500);
        }

        // Supprimer la vidéo originale après le découpage
        if (file_exists($outputVideo)) {
            unlink($outputVideo);  // Suppression de la vidéo téléchargée
        }

        // Récupérer le format souhaité par l'utilisateur
        $format = $request->get('format');
        if ($format != 'mp4') {
            // Convertir la vidéo découpée au format choisi
            $convertedFile = public_path("mp4/converted_output.$format");
            $commandConvert = "$ffmpegPath -i $trimmedVideo $convertedFile";
            shell_exec($commandConvert);

            // Supprimer le fichier temporaire après conversion
            unlink($trimmedVideo);

            // Vérifier si la vidéo a été convertie
            if (!file_exists($convertedFile)) {
                return response()->json(['error' => 'Échec de la conversion de la vidéo'], 500);
            }

            // Télécharger le fichier converti
            return response()->download($convertedFile)->deleteFileAfterSend(true);
        }

        // Télécharger directement la vidéo découpée si aucun format spécifique n'est choisi
        return response()->download($trimmedVideo)->deleteFileAfterSend(true);
    }*/

    //Version 3.1.0
    /*public function download(Request $request)
    {
        $url = $request->get('url');  // URL YouTube

        // Récupérer les minutes et secondes de début
        $startMinute = (int)$request->get('start_minute');
        $startSecond = (int)$request->get('start_second');

        // Récupérer les minutes et secondes de fin
        $endMinute = (int)$request->get('end_minute');
        $endSecond = (int)$request->get('end_second');

        // Convertir les minutes et secondes en secondes totales
        $startTime = ($startMinute * 60) + $startSecond;
        $endTime = ($endMinute * 60) + $endSecond;

        // Définir les chemins vers yt-dlp et FFmpeg
        $ytDlpPath = public_path('tools/yt-dlp/yt-dlp.exe');
        $ffmpegPath = public_path('tools/ffmpeg/ffmpeg.exe');

        // Télécharger la vidéo avec yt-dlp
        $outputVideo = public_path('videos/video.mp4');
        $commandDownload = "$ytDlpPath -o $outputVideo $url";
        shell_exec($commandDownload);

        // Vérifier si la vidéo a bien été téléchargée
        if (!file_exists($outputVideo)) {
            return response()->json(['error' => 'Échec du téléchargement de la vidéo'], 500);
        }

        // Découper la vidéo avec FFmpeg
        $duration = $endTime - $startTime;
        $trimmedVideo = public_path('videos/trimmed_output.mp4');
        $commandTrim = "$ffmpegPath -i $outputVideo -ss $startTime -t $duration -c copy $trimmedVideo";
        shell_exec($commandTrim);

        // Vérifier si la vidéo a été découpée
        if (!file_exists($trimmedVideo)) {
            return response()->json(['error' => 'Échec de la découpe de la vidéo'], 500);
        }

        // Récupérer le format souhaité par l'utilisateur
        $format = $request->get('format');
        if ($format != 'mp4') {
            // Convertir la vidéo découpée au format choisi
            $convertedFile = public_path("mp4/converted_output.$format");
            $commandConvert = "$ffmpegPath -i $trimmedVideo $convertedFile";
            shell_exec($commandConvert);

            // Supprimer le fichier temporaire après conversion
            unlink($trimmedVideo);

            // Vérifier si la vidéo a été convertie
            if (!file_exists($convertedFile)) {
                return response()->json(['error' => 'Échec de la conversion de la vidéo'], 500);
            }

            // Télécharger le fichier converti
            return response()->download($convertedFile)->deleteFileAfterSend(true);
        }

        // Télécharger directement la vidéo découpée si aucun format spécifique n'est choisi
        return response()->download($trimmedVideo)->deleteFileAfterSend(true);
    }*/

    //Version 3.0.0
    /*public function download(Request $request)
    {
        $url = $request->input('url');  // URL YouTube

        // Récupérer les heures, minutes et secondes de début
        $startHour = (int)$request->input('start_hour');
        $startMinute = (int)$request->input('start_minute');
        $startSecond = (int)$request->input('start_second');

        // Récupérer les heures, minutes et secondes de fin
        $endHour = (int)$request->input('end_hour');
        $endMinute = (int)$request->input('end_minute');
        $endSecond = (int)$request->input('end_second');

        // Convertir les heures, minutes et secondes en secondes totales
        $startTime = ($startHour * 3600) + ($startMinute * 60) + $startSecond;
        $endTime = ($endHour * 3600) + ($endMinute * 60) + $endSecond;

        // Définir les chemins vers yt-dlp et FFmpeg
        $ytDlpPath = public_path('tools/yt-dlp/yt-dlp.exe');
        $ffmpegPath = public_path('tools/ffmpeg/ffmpeg.exe');

        // Télécharger la vidéo avec yt-dlp
        $outputVideo = public_path('mp4/temp_video.mp4');
        $commandDownload = "$ytDlpPath -o $outputVideo $url";
        shell_exec($commandDownload);

        // Vérifier si la vidéo a bien été téléchargée
        if (!file_exists($outputVideo)) {
            return response()->json(['error' => 'Échec du téléchargement de la vidéo'], 500);
        }

        // Découper la vidéo avec FFmpeg
        $duration = $endTime - $startTime;
        $trimmedVideo = public_path('mp4/temp_trimmed.mp4');
        $commandTrim = "$ffmpegPath -i $outputVideo -ss $startTime -t $duration -c copy $trimmedVideo";
        shell_exec($commandTrim);

        // Vérifier si la vidéo a été découpée
        if (!file_exists($trimmedVideo)) {
            return response()->json(['error' => 'Échec de la découpe de la vidéo'], 500);
        }

        // Si l'utilisateur veut un autre format, on le convertit
        $format = $request->input('format');
        if ($format != 'mp4') {
            $convertedFile = public_path("mp4/converted_output.$format");
            $commandConvert = "$ffmpegPath -i $trimmedVideo $convertedFile";
            shell_exec($commandConvert);

            // Supprimer le fichier temporaire après conversion
            unlink($trimmedVideo);

            // Vérifier si la vidéo a été convertie
            if (!file_exists($convertedFile)) {
                return response()->json(['error' => 'Échec de la conversion de la vidéo'], 500);
            }

            // Télécharger le fichier converti
            return response()->download($convertedFile)->deleteFileAfterSend(true);
        }

        // Télécharger la vidéo découpée en MP4
        return response()->download($trimmedVideo)->deleteFileAfterSend(true);
    }*/

    //Version 2.0.0
    /*public function download(Request $request)
    {
        $url = $request->get('url');  // URL YouTube

        // Récupérer les minutes et secondes de début
        $startMinute = (int)$request->get('start_minute');
        $startSecond = (int)$request->get('start_second');

        // Récupérer les minutes et secondes de fin
        $endMinute = (int)$request->get('end_minute');
        $endSecond = (int)$request->get('end_second');

        // Convertir les minutes et secondes en secondes totales
        $startTime = ($startMinute * 60) + $startSecond;
        $endTime = ($endMinute * 60) + $endSecond;

        // Définir les chemins vers yt-dlp et FFmpeg
        $ytDlpPath = public_path('tools/yt-dlp/yt-dlp.exe');
        $ffmpegPath = public_path('tools/ffmpeg/ffmpeg.exe');

        // Télécharger la vidéo avec yt-dlp
        $outputVideo = public_path('videos/video.mp4');
        $commandDownload = "$ytDlpPath -o $outputVideo $url";
        shell_exec($commandDownload);

        // Vérifier si la vidéo a bien été téléchargée
        if (!file_exists($outputVideo)) {
            return response()->json(['error' => 'Échec du téléchargement de la vidéo'], 500);
        }

        // Découper la vidéo avec FFmpeg
        $duration = $endTime - $startTime;
        $trimmedVideo = public_path('videos/trimmed_output.mp4');
        $commandTrim = "$ffmpegPath -i $outputVideo -ss $startTime -t $duration -c copy $trimmedVideo";
        shell_exec($commandTrim);

        // Vérifier si la vidéo a été découpée
        if (!file_exists($trimmedVideo)) {
            return response()->json(['error' => 'Échec de la découpe de la vidéo'], 500);
        }

        // Télécharger la vidéo découpée
        return response()->download($trimmedVideo)->deleteFileAfterSend(true);
    }*/

    //Version 1.0.0
    /*public function download(Request $request){

        //dd($request->all());

        $url = escapeshellarg($request->get('url'));
        $startTime = escapeshellarg($request->get('start'));
        $endTime = escapeshellarg($request->get('end'));

        // Définir les chemins vers yt-dlp et FFmpeg
        $ytDlpPath = public_path('tools/yt-dlp/yt-dlp.exe');
        $ffmpegPath = public_path('tools/ffmpeg/ffmpeg.exe');

        // Télécharger la vidéo avec yt-dlp
        $outputVideo = public_path('videos/video.mp4');
        $commandDownload = "$ytDlpPath -o $outputVideo $url";
        shell_exec($commandDownload);

        // Vérifier si la vidéo a bien été téléchargée
        if (!file_exists($outputVideo)) {
            return response()->json(['error' => 'Échec du téléchargement de la vidéo'], 500);
        }

        // Découper la vidéo avec FFmpeg
        $duration = $endTime - $startTime;
        $trimmedVideo = public_path('videos/trimmed_output.mp4');
        $commandTrim = "$ffmpegPath -i $outputVideo -ss $startTime -t $duration -c copy $trimmedVideo";
        shell_exec($commandTrim);

        // Vérifier si la vidéo a été découpée
        if (!file_exists($trimmedVideo)) {
            return response()->json(['error' => 'Échec de la découpe de la vidéo'], 500);
        }

        // Télécharger la vidéo découpée
        return response()->download($trimmedVideo)->deleteFileAfterSend(true);

    }*/
}
