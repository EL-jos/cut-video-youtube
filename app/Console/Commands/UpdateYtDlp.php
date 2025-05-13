<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateYtDlp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'yt-dlp:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Met à jour yt-dlp.exe dans public/tools/yt-dlp avec sauvegarde de l\'ancienne version';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $downloadUrl = 'https://github.com/yt-dlp/yt-dlp/releases/latest/download/yt-dlp.exe';
        $ytDlpPath = public_path('tools/yt-dlp/yt-dlp.exe');
        $backupPath = public_path('tools/yt-dlp/yt-dlp_backup_' . now()->format('Ymd_His') . '.exe');

        $this->info('📥 Début de la mise à jour de yt-dlp.exe...');

        // Vérifier la version actuelle
        if (file_exists($ytDlpPath)) {
            $this->info('📌 Version actuelle :');
            $currentVersion = shell_exec("\"$ytDlpPath\" --version");
            $this->line(trim($currentVersion));

            // Sauvegarde de l'ancien fichier
            File::copy($ytDlpPath, $backupPath);
            $this->info("🔐 Ancienne version sauvegardée : $backupPath");
        } else {
            $this->warn("⚠️ yt-dlp.exe introuvable. Téléchargement comme nouvelle installation.");
        }

        // Télécharger la dernière version
        try {
            $fileData = file_get_contents($downloadUrl);
            if ($fileData === false) {
                $this->error('❌ Échec du téléchargement depuis GitHub.');
                return 1;
            }

            file_put_contents($ytDlpPath, $fileData);
            $this->info('✅ Nouvelle version téléchargée et enregistrée.');

            // Vérification de la version téléchargée
            $this->info('📌 Nouvelle version :');
            $newVersion = shell_exec("\"$ytDlpPath\" --version");
            $this->line(trim($newVersion));

            return 0;
        } catch (\Exception $e) {
            $this->error('❌ Erreur lors de la mise à jour : ' . $e->getMessage());
            return 1;
        }
    }
}
