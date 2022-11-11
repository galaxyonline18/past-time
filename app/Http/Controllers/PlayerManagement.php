<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


use DB;
use File;
use App\Models\Player;
use App\Http\Requests\CreateValidationRequest;



class PlayerManagement extends Controller
{
    public function index()
    {
    	return view('players.players_mgmt');
    }



    public function getPlayers(Request $request)
    {
    	$data = Player::orderBy('player_id','desc')->get();
    	$count = $data->count();
      // dd($data);

    	return  response()->json(['array' => $data, 'cnt' => $count],200);
    }


    public function store(CreateValidationRequest $request)
    {

        $validator = $request->validated();

        if (str_contains($request->profpic, 'base64')) { 
            $dta = $this->saveWebcamImage($request);
            $this->savePlayerData($request,$dta);
        }


    }


    public function show($id)
    {
        $dta = Player::findOrFail($id);
        return  view('players.player_profile', compact('dta'));
    }

    private function savePlayerData($request,$imgfilename)
    {
        $validid_type2 = $request->input('valididtype2');

        if ($validid_type2 == 'Select one') {
          $validid_type2 = '';
        }

        $player = new Player();
        $player->first_name = $request->input('firstname');
        $player->middle_name = $request->input('middlename');
        $player->last_name = $request->input('lastname');
        $player->date_of_birth = date_format(date_create($request->input('dateofbirth')),"Y-m-d");
        $player->age = $request->input('age');
        $player->gender = $request->input('gender');
        $player->civil_status = $request->input('civilstatus');
        $player->nationality = $request->input('nationality');
        $player->contact_number = $request->input('contactnumber');
        $player->street_address1 = $request->input('streetaddress1');
        $player->street_address2 = $request->input('streetaddress2');
        $player->city = $request->input('city');
        $player->state = $request->input('state');
        $player->postal_code = $request->input('postalcode');
        $player->occupation = $request->input('occupation');
        $player->income_source = $request->input('incomesource');
        $player->validid_type1 = $request->input('valididtype1');
        $player->validid_number1 = $request->input('validid1');
        $player->validid_type2 = $validid_type2;
        $player->validid_number2 = $request->input('validid2');
        $player->profile_image = $imgfilename;
        $player->isBanned = 0;
        if ($player->save()) {
          return  response()->json(['message' => 'New player details have been saved.'],200);
        } 
        else {
          return  response()->json(['message' => 'We couldn’t save the player details at the moment. Please try again'],500);
        }
    }

    private function saveWebcamImage($request)
    {
        $img = $request->profpic;
        $folderPath = "public/img/";
        
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $request->input('firstname').'_'.$request->input('lastname').'_'.microtime(true). '.png';
        
        $file = $folderPath . $fileName;
        $isUploaded = Storage::put($file, $image_base64);

        if ($isUploaded) {
            return $fileName;
        } else {
            return response()->json(['message' => 'There is a problem uploading Webcam image. Please try again'],500);
        }
    }
}
