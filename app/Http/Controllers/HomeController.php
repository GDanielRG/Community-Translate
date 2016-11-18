<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\GlobalFunctions;
use App\Http\MainFunctions;
use App\Http\RequestedTranslationsFunctions;
use App\Message;
use App\User;
use App\Key;
use App\TranslationPetition;
use App\Jobs\FeedbackSender;
use App\Jobs\MessagesSender;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // Test register
        //$mainFunctions = new MainFunctions("facebook", "54", "daniel kako");
        //$mainFunctions->register();
        // $mainFunctions = new MainFunctions("slack", "45", "alfhh hinojosa");
        // $mainFunctions->register();
        // $mainFunctions = new MainFunctions("facebook", "44", "Spanish");
        // $mainFunctions->addLanguage();

        // Test mute
        // $mainFunctions = new MainFunctions("facebook", "44", "");
        // $mainFunctions->muteMessages();

        // $mainFunctions = new MainFunctions("facebook", "44", "");
        // $mainFunctions->unmuteMessages();

        //echo("<p style='white-space: pre-wrap;'>Available commands:\n\n#mute\nChanges your current state to muted\n\n#unmute\nChanges your current state to unmuted\n\n#addLanguage {name|code}\nAdds a new language to your list of known languages\n\t-name: Name of the language\n\t-code: ISO: 693-2 language code\n\n#register {username} {password}\nRegisters a new app to your account\n\t-username: Your ID\n\t-password: Your password\n\n#changeLanguage {name|code}\nChanges the language of the app\n\t-name: Name of the language\n\t-code: ISO: 693-2 language code\n</p>");

        // echo("<p style='white-space: pre-wrap;'>Comandos disponibles:\n\n#mute\nCambia tu estado actual a silenciado\n\n#unmute\nCambia tu estado actual a no silenciado\n\n#addLanguage {name|code}\nAgrega un nuevo lenguage a tu lista de lenguages conocidos\n\t-name: Nombre del lenguage\n\t-code: ISO: 693-2 codigo del lenguage\n\n#register {username} {password}\nRegistra una nueva aplicacion a tu cuenta\n\t-username: Tu ID\n\t-password: Tu contraseña\n\n#changeLanguage {name|code}\nCambia el lenguaje de la aplicacion\n\t-name: Nombre del lenguage\n\t-code: ISO: 693-2 codigo del lenguage\n</p>");

        // $mainFunctions = new MainFunctions("facebook", "44", "");
        // $mainFunctions->askHelp();

        //$mainFunctions = new MainFunctions("slack", "45", "Japanese this is the jap file");
        //$mainFunctions->createRequest();

        TranslationPetition::create([
                'user_id' => 2,
                'language_id' => 51,
                'translation_request_id' => 3
            ]);

        return 'done';
    }

    public function receiveImage(Request $request)
    {
        \Log::info($request->all());
    }

    public function receiveText(Request $request)
    {
        $text =$request->get('message')["data"]["text"];
        $id = $request->get('message')["data"]["id"];
        $service = $request->get('message')["service"];
        \Log::info($text);
        \Log::info($id);
        \Log::info($service);
        if(substr($text, 0, strlen('#register')) === "#register" && $text['9'] = " ")
        {
            $mainFunctions = new MainFunctions($service, $id, substr($text, 10));
            return $mainFunctions->register();
        }
        if(substr($text, 0, strlen('#iknow')) === "#iknow" && $text['6'] = " ")
        {
            $mainFunctions = new MainFunctions($service, $id, substr($text, 7));
            return $mainFunctions->addLanguage();
        }
        if(substr($text, 0, strlen('#language')) === "#language" && $text['9'] = " ")
        {
            $mainFunctions = new MainFunctions($service, $id, substr($text, 10));
            return $mainFunctions->addLanguage();
        }
        if(substr($text, 0, strlen('#mute')) === "#mute" && $text['9'] = " ")
        {
            $mainFunctions = new MainFunctions($service, $id, substr($text, 10));
            return $mainFunctions->mute();
        }
        if(substr($text, 0, strlen('#unmute')) === "#unmute" && $text['9'] = " ")
        {
            $mainFunctions = new MainFunctions($service, $id, substr($text, 10));
            return $mainFunctions->unmute();
        }
    }

    public function activateJobs()
    {
        dispatch(new FeedbackSender());
        dispatch(new MessagesSender());
        return 'listo';
    }
}
