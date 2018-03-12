<?php

namespace Vadiasov\TracksAdmin\Controllers;

use App\Album;
use App\Artist;
use App\Genre;
use App\Http\Controllers\Controller;
use App\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Vadiasov\TracksAdmin\Requests\TrackRequest;

class TracksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($albumId)
    {
        $active = 'albums';
        $user   = Auth::user();
        $tracks = Track::whereAlbumId($albumId)->get();
        $genres = Genre::all()->keyBy('id');
        $album  = Album::whereId($albumId)->first();
        $artist = Artist::all()->keyBy('id');
        
        return view('tracks-admin::index', compact(
            'active',
            'user',
            'tracks',
            'genres',
            'album',
            'artist'
        ));
    }
    
    public function edit($albumId, $trackId)
    {
        $active         = 'albums';
        $user           = Auth::user();
        $track          = Track::whereId($trackId)->first();
        $genres         = Genre::all()->keyBy('id');
        $album          = Album::whereId($albumId)->first();
        $artist         = Artist::all()->keyBy('id');
        $genresSelected = json_decode($track->genres);
        
        $arrayJs = '[]';
        if ($genresSelected != '') {
            $arrayJs = '[' . implode(",", $genresSelected) . ']';
        }
        
        if ($track->release_date != '') {
            $track->release_date = date_inverse('-', $track->release_date);
        }
        
        return view('tracks-admin::edit', compact(
            'active',
            'user',
            'track',
            'genres',
            'album',
            'artist',
            'arrayJs'
        ));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param \Vadiasov\TracksAdmin\Requests\TrackRequest $request
     * @param $albumId
     * @param $trackId
     *
     * @return \Illuminate\Http\Response
     */
    public function update(TrackRequest $request, $albumId, $trackId)
    {
        $track = Track::whereId($trackId)->first();
        
        $dateFormatted = date_inverse('-', $request->release_date);
        
        $track->title        = $request->title;
        $track->release_date = $dateFormatted;
        $track->price        = $request->price;
        $track->free         = $request->free;
        $track->donate       = $request->donate;
        $track->genres       = json_encode($request->genres);
        $track->about        = $request->editor1;
        
        $track->save();
        
        return redirect(action('\Vadiasov\TracksAdmin\Controllers\TracksController@index', $albumId))->with('status', 'The Track has been edited!');
    }
    
    public function destroy($albumId, $trackId)
    {
        $track = Track::whereId($trackId)->first();
        
        // first delete file
        $track->delete();
        
        // second delete from disk
        $this->remove($track);
        
        return redirect(action('\Vadiasov\TracksAdmin\Controllers\TracksController@index', $albumId))
            ->with('status', 'The Track has been deleted!');
    }
    
    private function remove($track)
    {
        // delete from disk
        Storage::delete('public/tracks/' . $track->file);
        
        return true;
    }
}
