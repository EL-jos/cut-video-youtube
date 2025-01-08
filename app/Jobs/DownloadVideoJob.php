<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DownloadVideoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $url;
    protected $outputVideo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $url, string $outputVideo)
    {
        $this->url = $url;
        $this->outputVideo = $outputVideo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $ytDlpPath = public_path('tools/yt-dlp/yt-dlp.exe');
        $commandDownload = "$ytDlpPath -o {$this->outputVideo} {$this->url}";

        shell_exec($commandDownload);
    }
}
