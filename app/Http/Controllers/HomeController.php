<?php

namespace App\Http\Controllers;

use App\Services\ComicService;
use Illuminate\Http\Request;
use App\Models\Comic;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistered;
use DB;
use Mailgun\Mailgun;


class HomeController extends Controller
{
    private $comicService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ComicService $comicService)
    {
        //$this->middleware('auth');
        if(isset($comicService)){
            $this->comicService = $comicService;
        }
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

        /*$popularComics = DB::table('comics')
            ->join('likes', 'comics.id', '=', 'likes.comic_id')
            ->leftJoin('users', 'comics.user_id', '=', 'users.id')
            ->groupBy('id')
            ->select(DB::raw('comics.*, count(likes.user_id) as user_count, users.name as author_name, users.image as author_image'))
            ->orderBy('user_count', 'desc')
            ->get();

         DB::table('comics')
            ->orderBy('rating')
            ->limit(13)
            ->get();

        $newComics = DB::table('comics')
            ->latest()
            ->limit(15)
            ->get();*/
        $popularComics = $this->getPopular(14);
        $newComics = $this->getNew(15);
        $ongoingComics = $this->getOngoing(12);

        return view('home', [
            'popularComics' => $popularComics,
            'newComics' => $newComics,
            'ongoingComics' => $ongoingComics
        ]);
    }


    /*
     * footer links
     */
    public function showAbout(){
        return view('other.about');
    }

    public function showContact(){
        return view('other.contact');
    }

    public function showTerms(){
        return view('other.terms');
    }

    public function showHelp(){
        return view('other.help');
    }

    /*
     * header links
     */
    public function popularList(){
        //TODO  pagination
        $popularComics = $this->getPopular();

        return view('popular', [
            'popularComics' => $popularComics
        ]);
    }

    public function newList(){
        //TODO  pagination
        $newComics = $this->getNew();

        return view('new', [
            'newComics' => $newComics
        ]);
    }

    public function ongoingList(){
        //TODO  pagination

        $ongoingComics = $this->getOngoing();

        return view('ongoing', [
            'ongoingComics' => $ongoingComics
        ]);
    }

    private function getPopular($limit = 0){
        $popularComics = ($limit > 0 ) ? Comic::with('genres', 'user')->withCount('comments', 'subscribers')->orderBy('rating', 'desc')->take($limit)->get() : Comic::with('genres')->withCount('comments')->orderBy('rating', 'desc')->get();

        $popularComics = $this->comicService->getComicsPreviewData($popularComics);
        $popularComics = $this->comicService->checkMatureComics($popularComics);

        return $popularComics;
    }

    private function getNew($limit = 0){
        $newComics = ($limit > 0 ) ? Comic::with('genres', 'user')->withCount('comments', 'subscribers')->orderBy('created_at', 'desc')->take($limit)->get() : Comic::with('genres')->withCount('comments')->orderBy('updated_at', 'desc')->get();

        $newComics = $this->comicService->getComicsPreviewData($newComics);
        $newComics = $this->comicService->checkMatureComics($newComics);

        return $newComics;
    }

    private function getOngoing($limit = 0){
        $ongoingComics = ($limit > 0 ) ? Comic::with('genres', 'user')->withCount('comments', 'subscribers')->orderBy('updated_at', 'desc')->take($limit)->get() : Comic::with('genres')->withCount('comments')->orderBy('updated_at', 'desc')->get();

        $ongoingComics = $this->comicService->getComicsPreviewData($ongoingComics);
        $ongoingComics = $this->comicService->checkMatureComics($ongoingComics);

        return $ongoingComics;
    }

    public function testEmail(Request $request){

        Mail::to($request->user())->send(new UserRegistered('http://comicats.herokuapp.com/FAKELINK'));


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
