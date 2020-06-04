<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Http\Requests\CreateDiscussionRequest;
use App\Reply;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DiscussionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        //dd(Discussion::filterByChannels()->paginate(5));

        return view('discussions.index', [
            'discussions' => Discussion::filterByChannels()->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('discussions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateDiscussionRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateDiscussionRequest $request)
    {
        auth()->user()->discussions()->create([
          'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' =>$request->content,
            'channel_id' =>$request->channel,
        ]);

        session()->flash('success' , 'Message ajouté !');
        return redirect(route('discussions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Discussion $discussion
     * @return Factory|View
     */
    public function show(Discussion $discussion)
    {
        return view('discussions.show', ['discussion' => $discussion]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function reply(Discussion $discussion, Reply $reply)
    {
        $discussion->markAsBestReply($reply);
        session()->flash('success', 'Marquée comme meilleure solution !');

        return redirect()->back();
    }
}
