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

        $offer = Offer::with('station')
                ->with('job_title')
                ->get()
                ->find(Input::get('offerId'));
        if (!$offer) return;


        $application = new Application();
        $application->date = date("Y-m-d H:i:s");
        $application->offer_id = Input::get('offerId');
        $application->save();


        // send email ---------------------------------------------------------------------

        $vars = [];
        $vars['application_id'] = $application->id;
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

            for ($i = 1; $i <= 2; $i++) {
                @$fileData = $_FILES['file_'.$i];
                if ($fileData) {
                    if ($fileData['size'] <= 5200000) { // validate filesize
                        $message->attach($fileData['tmp_name'], ['as' => $fileData['name'], 'mime' => $fileData['type']]);
                    }
                }
            }

        });

        return response()->json($result, 200, array(), JSON_PRETTY_PRINT);
    }

}