<?php

namespace App\Console\Commands;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use Illuminate\Console\Command;

class GuzzCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */



    protected $signature = 'guzz:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $client = new Client([
    'base_uri' => 'http://raptor-scraper.herokuapp.com/result/',
    'defaults' => [
        'headers' => ['Authorization' => 'Token 0c2b0f89716d5fda5b2d2cfabefdffe803eb1297' ,
                'content-type'=>'application/json'],
        
    ]
]);

        $response = $client->request('POST', '', [
    'form_params' => [
       'url' => 'https://erp.aktu.ac.in/webpages/oneview/OVEngine.aspx?enc=NnCOpTxI4+e2v6OtxoLaIWqv0HDB71D2J6h4wqQYRIPFd0GGQNonqh1Xf9Tsrc3u',
        'roll_no' => '1709110106',
        ]
    ]);






//         $client = new Client(['base_uri' => 'http://raptor-scraper.herokuapp.com/result/']);

//         $response = $client->request('POST', 'http://raptor-scraper.herokuapp.com/result/', [
//     'form_params' => [
//        'url' => 'https://erp.aktu.ac.in/webpages/oneview/OVEngine.aspx?enc=NnCOpTxI4+e2v6OtxoLaIWqv0HDB71D2J6h4wqQYRIPFd0GGQNonqh1Xf9Tsrc3u',
//         'roll_no' => '1709110106',
//         ],
//         'headers'        => ['Authorization' => 'Token 0c2b0f89716d5fda5b2d2cfabefdffe803eb1297' ,
//                 'content-type'=>'application/json',
//             ]
//     ]
// );





        // $r = $client->request('POST', 'http://raptor-scraper.herokuapp.com/result/', ['url' => 'https://erp.aktu.ac.in/webpages/oneview/OVEngine.aspx?enc=NnCOpTxI4+e2v6OtxoLaIWqv0HDB71D2J6h4wqQYRIPFd0GGQNonqh1Xf9Tsrc3u',
        //         'roll_no' => '170242',
        //         'headers'        => ['Authorization' => 'Token 0c2b0f89716d5fda5b2d2cfabefdffe803eb1297' ,
        //         'content-type'=>'application/json',
        //     ]]);

        echo $response;
    }
}
