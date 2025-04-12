<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ApiTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:api-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Chamada real à API local (caso esteja rodando um servidor)
        $response = Http::get('http://localhost:8000/api/videos');

        dd($response);

        if ($response->successful()) {
            $this->info("Resposta da API:");
            $this->line(json_encode($response->json(), JSON_PRETTY_PRINT));
        } else {
            $this->error("Erro ao acessar a API: " . $response->status());
            $this->line($response->body());
        }
    }
}
