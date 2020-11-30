<?php

namespace App\Http\Controllers;

use App\GeneralSettings;
use App\UserWallet;
use Carbon\Carbon;
use App\Invest;
use App\Investyield;
use App\User;
use Illuminate\Support\Facades\Request;

class CronController extends Controller
{

    public function cron()
    {
        $now = Carbon::now();


            $invest = Invest::whereStatus(1)->where('next_time','<=',$now)->get();


        $gnl = GeneralSettings::first();

        foreach ($invest as $data)
        {
            $user = User::find($data->user_id);
            $userInterestWallet = UserWallet::where('user_id',$data->user_id)->where('type','interest_wallet')->first();
            $next_time = Carbon::parse($now)->addHours($data->hours);

            $in = Invest::find($data->id);
            $in->return_rec_time = $data->return_rec_time + 1;
            $in->next_time = $next_time;
            $in->last_time = $now;

            if ($data->period == '-1')
            {
                $in->status = 1;
                $in->save();

                $new_balance = $userInterestWallet->balance + $data->interest;
                $userInterestWallet->balance = $new_balance;

                Investyield::create([
                    'user_id' => $user->id,
                    'amount' => $data->interest,
					'invest_id' => $data->id,
                    'main_amo' => $new_balance,
                    'charge' => 0,
                    'type' => '+',
                    'remark' => 'interest',
                    'title' => 'Interest Return '.$data->interest.' '.$gnl->currency.' Added on Your '.str_replace('_', ' ', $userInterestWallet->type).' Balance',
                    'trx' => rand(000000, 999999) . rand(000000, 999999),
                ]);
                $userInterestWallet->save();

               


            }else{

                if ($data->capital_status == 1)
                {

                    if ($in->return_rec_time >= $data->period){
                        $bonus = $data->interest + $data->amount;
                        $new_balance = $userInterestWallet->balance + $bonus;
                        $userInterestWallet->balance = $new_balance;
                        $in->status = 0;
                    }else{
                        $bonus = 0;
                        $new_balance =  $userInterestWallet->balance + $data->interest;
                        $userInterestWallet->balance = $new_balance;
                        $in->status = 1;
                    }

                    $in->save();



                    if ($bonus != 0){

                        Investyield::create([
                            'user_id' => $user->id,
                            'amount' => $data->interest,
							'invest_id' => $data->id,
                            'main_amo' => $new_balance,
                            'charge' => 0,
                            'type' => '+',
                            'remark' => 'interest',
                            'title' => 'Interest Return '.$data->interest.' '.$gnl->currency.' Added on Your '.str_replace('_', ' ', $userInterestWallet->type).' Balance',
                            'trx' => rand(000000, 999999) . rand(000000, 999999),
                        ]);

                        

                    }else{
                        Investyield::create([
                            'user_id' => $user->id,
                            'amount' => $data->interest,
							'invest_id' => $data->id,
                            'main_amo' => $new_balance,
                            'charge' => 0,
                            'type' => '+',
                            'remark' => 'interest',
                            'title' => 'Interest & Capital Return '.$bonus.' '.$gnl->currency.' Added on Your '.str_replace('_', ' ', $userInterestWallet->type).' Wallet',
                            'trx' => rand(000000, 999999) . rand(000000, 999999),
                        ]);

                        

                    }


                    $userInterestWallet->save();



                }else{

                    if ($in->return_rec_time >= $data->period){
                        $in->status = 0;
                    }else{
                        $in->status = 1;
                    }

                    $in->save();

                    $new_balance =  $userInterestWallet->balance + $data->interest;
                    $userInterestWallet->balance = $new_balance;
                    $userInterestWallet->save();
                    Investyield::create([
                        'user_id' => $user->id,
                        'amount' => $data->interest,
						'invest_id' => $data->id,
                        'main_amo' => $new_balance,
                        'charge' => 0,
                        'type' => '+',
                        'remark' => 'interest',
                        'title' => 'Interest Return '.$data->interest.' '.$gnl->currency.' Added on Your '.str_replace('_', ' ', $userInterestWallet->type).' Wallet',
                        'trx' => rand(000000, 999999) . rand(000000, 999999),  
                    ]);

 

                }

            }

        }



    }

}
