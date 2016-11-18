<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\LanguageUser;
use App\State;
use App\TranslationPetition;
use App\TranslationRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use App\Http\GlobalFunctions;
use App\Http\MainFunctions;
use App\Jobs\FeedbackSender;
use App\Jobs\MessagesSender;
use App\Jobs\PetitionsCreator;

class PetitionsCreator implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $requests = TranslationRequest::where('closed', false)->get();
        foreach ($requests as $request) {
            if(1)
            {
                // $petitionedUsers = $request->users()->get()->pluck('id');

                $petitions = TranslationPetition::where('translation_request_id', $request->id)->get();
                $petitionedUsers=[];
                foreach ($petitions as $petition) {
                    $petitionedUsers[]=$petition->user->id;
                }

                $languagesNeeded2 = $request->user->languages->where('id', '<>', $request->language_id);
                $languagesNeeded=[];
                foreach ($languagesNeeded2 as $lan) {
                    $languagesNeeded[]=$lan->id;
                }
                $temp = LanguageUser::where('language_id', $request->language_id)->get()->pluck('user_id');

                \Log::info($temp);
                $potentialUsers = User::whereIn('id', $temp)->get();
                \Log::info($potentialUsers);

                foreach ($potentialUsers as $potentialUser) {
                    foreach ($potentialUser->languages as $language) {
                        if(in_array($language->id, $languagesNeeded) && !in_array($potentialUser->id, $petitionedUsers))
                        {
                            if($potentialUser->canReceiveTranslation())
                            {
                                $state = State::where('name', 'receivedPetition')->first();
                                $potentialUser->state_id = $tate->id;
                                $potentialUser->save();
                                $petition = TranslationPetition::create([
                                                                            'user_id' => $potentialUser->id,
                                                                            'translation_request_id' => $request->id,
                                                                            'language_id' => $language->id,
                                                                        ]);
                                $mainFunctions = new MainFunctions(null, null, null);
                                $mainFunctions->receivedPetition($petition->id);
                            }

                        }
                    }
                }
            }
        }
        dispatch(new FeedbackSender());

    }
}
