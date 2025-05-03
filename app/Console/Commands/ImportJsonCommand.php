<?php

namespace App\Console\Commands;

use App\Components\ImportDataClient;
use App\Models\Post;
use Illuminate\Console\Command;

class ImportJsonCommand extends Command
{

    protected $signature = 'import:jsonPlace';

    protected $description = 'Get data from Json';

    public function handle()
    {
       $import = new ImportDataClient();
       $response = $import->client->request('GET', 'posts');
       $data = json_decode($response->getBody()->getContents());
       foreach ($data as $item) {
           Post::firstOrCreate([
               'title' => $item->title,
           ],[
               'title' => $item->title,
               'content' => $item->body,
               'category_id' => 2,
           ]);
       }
       dd('finished');
    }
}
