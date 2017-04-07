<?php namespace Shell\Offers\Classes;

use Illuminate\Routing\Controller;
use Input;
use DB;
use Mail;
use Shell\Offers\Models\Offer;
use Shell\Offers\Models\Settings;
use Shell\Offers\Models\Application;

class ApplicationsController extends Controller
{

    public function save()
    {
        // print_r($_POST); 
        // print_r($_FILES); 
        // print_r(Request::all()); 
        // print_r(Input::file('file_1'));
        // exit;

        $offer = Offer::with('station')
                ->with('job_title')
                ->get()
                ->find(Input::get('offerId'));
        if (!$offer) return;

        // dump($offer); exit;

        // $html = file_get_contents(__DIR__.'/../views/mail/application.htm');

        $vars = [];
        $vars['station'] = $offer->station->full_name;
        $vars['job_title'] = $offer->job_title->name;
        $vars['firstname'] = Input::get('firstname');
        $vars['lastname'] = Input::get('lastname');
        $vars['email_'] = Input::get('email');
        $vars['tel'] = Input::get('tel');
        $vars['province'] = Input::get('province');
        $vars['city'] = Input::get('city');
        $vars['message_'] = nl2br(Input::get('message'));

        $result = Mail::send('shell.offers::mail.application', $vars, function($message) use ($offer) {

            $message->to($offer->station->email);
            // $message->to('kuba.markiewicz@gmail.com');
            // $message->to('m.palak@wp.pl');

            for ($i = 1; $i <= 2; $i++) {
                @$fileData = $_FILES['file_'.$i];
                if ($fileData) {
                    if ($fileData['size'] <= 5200000) { // validate filesize
                        $message->attach($fileData['tmp_name'], ['as' => $fileData['name'], 'mime' => $fileData['type']]);
                    }
                }
            }

        });

        $application = new Application();
        $application->date = date("Y-m-d H:i:s");
        $application->offer_id = Input::get('offerId');
        $application->save();

        return response()->json($result, 200, array(), JSON_PRETTY_PRINT);
    }

}