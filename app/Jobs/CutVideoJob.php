<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CutVideoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $startTime;
    protected $duration;
    protected $outputVideo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $startTime, int $duration, string $outputVideo)
    {
        $this->startTime = $startTime;
        $this->duration = $duration;
        $this->outputVideo = $outputVideo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $ffmpegPath = public_path('tools/ffmpeg/ffmpeg.exe');
        //$commandTrim = "$ffmpegPath -i $inputVideo -ss {$this->startTime} -t $duration -c:v libx264 -c:a aac -movflags +faststart -reset_timestamps 1 $outputVideo";
        $commandTrim = "$ffmpegPath -i {$this->outputVideo} -ss {$this->startTime} -t {$this->duration} -c:v libx264 -c:a aac -movflags +faststart -reset_timestamps 1 {$this->outputVideo}";

        shell_exec($commandTrim);
    }
}
