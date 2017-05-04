<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comic;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistered;
use DB;
use Mailgun\Mailgun;


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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*SELECT authors.id, authors.fio, books_authors.id_book AS book,
GROUP_CONCAT(books_authors.id_book)
FROM
  authors
  INNER JOIN
  books_authors
    ON authors.id = books_authors.id_author
  GROUP BY fio
    Comic::with('likes')->*/

        $comics = DB::table('comics')
            ->join('likes', 'comics.id', '=', 'likes.comic_id')
            ->leftJoin('users', 'comics.user_id', '=', 'users.id')
            ->groupBy('id')
            ->select(DB::raw('comics.*, count(likes.user_id) as user_count, users.name as author_name, users.image as author_image'))
            ->orderBy('user_count', 'desc')
            ->get();
        //dd($comics);

        return view('home', ['comics' => $comics]);
    }

    public function testEmail(Request $request){
        $user = $request->user();

        Mail::to($user)->send(new UserRegistered($user, 'http://comicats.herokuapp.com/FAKELINK'));


        /*$mgClient = new Mailgun(env('MAILGUN_SECRET'));
        $domain =  env('MAILGUN_DOMAIN');

        $result = $mgClient->sendMessage($domain, array(
            'from'    => env('MAIL_FROM'),
            'to'      => 'luviiilove@gmail.com',
            'subject' => 'Hello',
            'text'    => 'Testing some Mailgun awesomness!'
        ));

        $result = json_decode(json_encode($result), true);

        if($result['http_response_code'] == 200){
            return view('confirm-email', ['comics' => $comics]);
        }*/

        /* ОТвет успешная отправки выглядит так
         * object(stdClass)#327 (2) { ["http_response_body"]=> object(stdClass)#322 (2) { ["id"]=> string(90) "<20170504211057.6837.3096097D299A30EA@sandboxdf4c2203b6b34e879e3061129343a97e.mailgun.org>" ["message"]=> string(18) "Queued. Thank you." } ["http_response_code"]=> int(200) }
         * */

    }
}
