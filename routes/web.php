<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
use App\Mail\ThankMail;
use App\Mail\DonationMail;
use App\Mail\CallingVolunteerMail;
use App\Models\Campaign;
use Illuminate\Support\Facades\Mail;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// $router->get('/email', function () use ($router) {
//     $item = (object)[
//         "id_campaign" => 1,
//         "name" => "John",
//         "email" => "john@example.com",
//         "amount" => 250000,
//         "phone_number" => "082154567893",
//         "qrcode_url" => (object)["qrcode" => "https://res.cloudinary.com/aql-peduli/image/upload/v1608630934/Mandiri_5151_cropped_8bb2d93c43.jpg"],
//         "account_number" => [
//             (object)[
//                 "id" => 0,
//                 "bank" => "Bank Swasta",
//                 "norek" => "6789012 3726 328",
//                 "an" => "John Doe",
//             ],
//             (object)[
//                 "id" => 1,
//                 "bank" => "Bank Negeri",
//                 "norek" => "3231209 3726 328",
//                 "an" => "John Doe",
//             ]
//         ]
//     ];
//     // $campaign_name = Campaign::find($item->id_campaign)->campaign_name;
//     $campaign_name = "Bangun Istana Surga di Kp. Nanggewer";
//     $data = [
//         'campaign' => $campaign_name,
//         'name' => $item->name,
//         'amount' => number_format($item->amount, 0, ',', '.'),
//         'banks' => $item->account_number,
//         'qrcode' => $item->qrcode_url->qrcode
//     ];
//     return new DonationMail($data); 
// });

// $router->get('/thankemail', function () use ($router){
//     $item = (object)[
//         "id_campaign" => 1,
//         "name" => "John",
//         "email" => "john@example.com",
//         "amount" => 250000,
//         "phone_number" => "082154567893"
//     ];
//     // $campaign_name = Campaign::find($item->id_campaign)->campaign_name;
//     $campaign_name = "Bangun Istana Surga di Kp. Nanggewer";
//     $data = [
//         'campaign' => $campaign_name,
//         'name' => $item->name,
//         'amount' => number_format($item->amount, 0, ',', '.')
//     ];
//     return new ThankMail($data); 
// });

// $router->get('/callingmail', function () use ($router){
//     $item = (object)[
//         "id_campaign" => 1,
//         "name" => "John",
//         "email" => "john@example.com",
//         "amount" => 250000,
//         "phone_number" => "082154567893"
//     ];
//     // $campaign_name = Campaign::find($item->id_campaign)->campaign_name;
//     $campaign_name = "(Bangun Istana Surga di Kp. Nanggewer  Terima kasih) <-- dinamis";
//     $data = [
//         'message' => $campaign_name,
//         'name' => $item->name
//     ];
//     return new CallingVolunteerMail($data); 
// });

// $router->get('/getPaidDonation', 'MainController@getPaidDonation');
// $router->get('/getDonation', 'MainController@getDonation');
// $router->get('/getCampaign', 'MainController@getCampaign');
// $router->post('/addCampaign', 'MainController@addCampaign');
// $router->put('/setPaidDonation', 'MainController@setPaidDonation');
// $router->put('/setUnPaidDonation', 'MainController@setUnPaidDonation');
// $router->delete('/deleteDonation', 'MainController@deleteDonation');
// $router->delete('/deleteCampaign', 'MainController@deleteCampaign');

// $router->get('/getVolunteer', 'VolunteerController@getVolunteer');
// $router->put('/editVolunteer', 'VolunteerController@editVolunteer');
// $router->delete('/deleteVolunteer', 'VolunteerController@deleteVolunteer');

$router->post('/addDonation', 'MainController@addDonation');
$router->post('/addVolunteer', 'VolunteerController@addVolunteer');
$router->post('/login', 'JwtController@login');

$router->group(['middleware' => 'auth'], function ($router) {
    $router->get('/api', 'JwtController@me'); 
    $router->post('/api/logout', 'JwtController@logout'); 
    $router->post('/api/save', 'JwtController@save');

    $router->get('/api/getPaidDonation', 'MainController@getPaidDonationAuth');
    $router->get('/api/getDonation', 'MainController@getDonationAuth');
    $router->get('/api/getCampaign', 'MainController@getCampaignAuth');
    $router->post('/api/addDonation', 'MainController@addDonationAuth');
    $router->post('/api/addCampaign', 'MainController@addCampaignAuth');
    $router->put('/api/editCampaign', 'MainController@editCampaignAuth');
    $router->put('/api/setPaidDonation', 'MainController@setPaidDonationAuth');
    $router->put('/api/setUnPaidDonation', 'MainController@setUnPaidDonationAuth');
    $router->delete('/api/deleteDonation', 'MainController@deleteDonationAuth');
    $router->delete('/api/deleteCampaign', 'MainController@deleteCampaignAuth');

    $router->get('/api/getVolunteer', 'VolunteerController@getVolunteerAuth');
    $router->post('/api/addVolunteer', 'VolunteerController@addVolunteerAuth');
    $router->put('/api/editVolunteer', 'VolunteerController@editVolunteerAuth');
    $router->delete('/api/deleteVolunteer', 'VolunteerController@deleteVolunteerAuth');
    $router->post('/api/volunteerEmailBlast', 'VolunteerController@volunteerEmailBlastAuth');
}); 