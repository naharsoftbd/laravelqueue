<?php
   
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\BirthdayWish;
use App\Mail\RegistrationMailSuccess;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserReportEmail;
use App\Jobs\SendMailJob;
    
class UserController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::find(1);
  
        $messages["hi"] = "Hey, Happy Birthday {$user->name}";
        $messages["wish"] = "On behalf of the entire company I wish you a very happy birthday and send you my best wishes for much happiness in your life.";
          
        $user->notify(new BirthdayWish($messages));
  
        dd('Done');
    }

    // Job and Queue
    public function create()
    {
        return view('auth.register-demo');
    }

    public function store(Request $request): RedirectResponse
    {
        //$order = Order::findOrFail($request->order_id);
 
        // Ship the order...
        $user = User::find(1);
       // dd($request->all());
        dispatch(new SendMailJob((object)$request->all()));
 
        return redirect('/user-notify');
    }
}
