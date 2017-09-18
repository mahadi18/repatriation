<?php namespace App\Http\Controllers;

use App\Attachment;
use App\Country;
use App\Http\Requests;
use App\Http\Requests\TwitterRequest;
use App\Http\Controllers\Controller;

use App\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class TweetController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
//		dd(session('user_current_timezone'));

        // Sample to export excel from any Model
		$tweets = Tweet::all();
        $countries = Country::all();
        $attachments = Attachment::all();

        Excel::create('tweets_countries_attachments', function($excel) use($tweets, $countries, $attachments) {
            $excel->sheet('Tweets', function($sheet) use($tweets) {
                $sheet->fromArray($tweets);
            });
            $excel->sheet('Countries', function($sheet) use($countries) {
                $sheet->fromArray($countries);
            });
            $excel->sheet('Attachments', function($sheet) use($attachments) {
                $sheet->fromArray($attachments);
            });
        })->export('xlsx');

//		return view('tweets.index', compact('tweets'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('tweets.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(TwitterRequest $request)
	{
		$tweet = new Tweet;

		$tweet->name = $request->input("name");
		$tweet->sku = $request->input("sku");

        $tweet->save();

        $imageName = $tweet->id . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path() . '/images/catalog', $imageName);

        $tweet->image = '/images/catalog/' . $imageName;
//        $tweet->avatar_file_size = $request->file('image')->getSize();
//        $tweet->avatar_content_type = $request->file('image')->getMimeType();
        $tweet->avatar_file_size = $request->file('image')->getClientSize();
        $tweet->avatar_content_type = $request->file('image')->getClientMimeType();

        $tweet->save();

        return redirect()->route('tweets.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$tweet = Tweet::findOrFail($id);

		return view('tweets.show', compact('tweet'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$tweet = Tweet::findOrFail($id);

		return view('tweets.edit', compact('tweet'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(TwitterRequest $request, $id)
	{
		$tweet = Tweet::findOrFail($id);

        $tweet->name = $request->input("name");
        $tweet->sku = $request->input("sku");

        $imageName = $tweet->id . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path() . '/images/catalog', $imageName);

//        $tweet->image = '/images/catalog/' . $imageName;
        $tweet->avatar_file_size = $request->file('image')->getClientSize();
        $tweet->avatar_content_type = $request->file('image')->getClientMimeType();

        $tweet->save();

		return redirect()->route('tweets.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$tweet = Tweet::findOrFail($id);

        if (File::exists(public_path() . $tweet->image) && $tweet->image != null){
            if(File::delete(public_path() . $tweet->image)){
                $tweet->delete();
            }else{
                $tweet->delete();
                return redirect()->route('tweets.index')->with('message', 'Item deleted successfully, but failed to remove image');
            }
        }else{
            $tweet->delete();
        }

        return redirect()->route('tweets.index')->with('message', 'Item deleted successfully.');
	}

}
