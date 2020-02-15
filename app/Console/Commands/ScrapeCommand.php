<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
//use Goutte\Client;
use GuzzleHttp\Client;


class ScrapeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string

     */

    protected $signature = 'scraper:start';

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

          $url= 'http://raptor-scraper.herokuapp.com/result/';
            // dd($url);
            $postData = [
                
                 'url' => 'https://erp.aktu.ac.in/webpages/oneview/OVEngine.aspx?enc=NnCOpTxI4+e2v6OtxoLaIWqv0HDB71D2J6h4wqQYRIPFd0GGQNonqh1Xf9Tsrc3u',
                'roll_no' => '1709110106',
            ];
            $headers=array(
            'Authorization'=>'Token 0c2b0f89716d5fda5b2d2cfabefdffe803eb1297',

            'content-type'=>'application/json' ,
            );

            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $postData ,
                CURLOPT_HTTPHEADER => $headers,

            ));

            
            //Ignore SSL certificate verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            

                    //get response
            $output = curl_exec($ch);
            if ($output === false)
            {
                // throw new Exception('Curl error: ' . curl_error($crl));
                print_r('Curl error: ' . curl_error($ch));
            }

            dd($output);
            // return json_encode($output);        
                    //Print error if any
            //dd(curl_error($ch));
            if (curl_errno($ch)) {
                echo 'error:' . curl_error($ch);
            }

            curl_close($ch);
            // dd($ch);

            // $arr = json_decode($output, true);
            // echo $arr;

        //
    }
}
