<?php

namespace cactu\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
          
        // enviar por mensaje
      try {
        $basic  = new \Vonage\Client\Credentials\Basic("4c46a3a0", "cLk1nYZNbiKCHhJr");
        $client = new \Vonage\Client($basic);
        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("593998808775", 'CACTU', 'A text message sent using the Nexmo SMS API')
        );
        
        $message = $response->current();
        
        if ($message->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }

        $message = $response->current();

        if ($message->getStatus() == 0) {
            return "The message was sent successfully\n";
        } else {
            return "The message failed with status: " . $message->getStatus() . "\n";
        }

      } catch (\Throwable $th) {
        return $th->getMessage();
      }


        //return view('home');
    }
}
