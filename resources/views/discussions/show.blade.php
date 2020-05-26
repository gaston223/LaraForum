@extends('layouts.app')

@section('content')

        <div class="card mb-5">
            @include('partials.discusssion-header')

            <div class="card-body">
                <div class="text-center">
                    <strong>
                        {{$discussion->title}}
                    </strong>
                </div>

                <hr>
                {!! $discussion->content !!}

                @if($discussion->bestReply)
                    <div class="card border-success my-5">
                        <div class="card-header">
                           <div class="d-flex justify-content-between">
                               <div>
                                   <img width="40px" style="border-radius: 50%" src="{{Gravatar::src($discussion->bestReply->owner->email)}}" alt="">
                                   <strong>
                                       &nbsp;{{$discussion->bestReply->owner->name}}
                                   </strong>
                               </div>
                               <div class="">
                                    <strong >Meilleure réponse</strong> &nbsp;<i class="fa fa-check-square"></i>
                               </div>
                           </div>
                        </div>
                        <div class="card-body">
                            {!! $discussion->bestReply->content !!}
                        </div>

                    </div>
                    a été marquée comme la meilleure réponse
                @endif

            </div>
        </div>
        <h4>Réponses :</h4>
        @foreach($discussion->reply()->paginate(3) as $reply)
            <div class="card my-5">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <img width="40px" style="border-radius: 50%" src="{{Gravatar::src($reply->owner->email)}}" alt="">
                            <span>{{$reply->owner->name}}</span>
                        </div>
                        <div>
                            @auth
                                @if(auth()->user()->id === $discussion->user_id )
                                    <form action="{{route('discussions.best-reply',['discussion' =>$discussion->slug, 'reply' => $reply->id])}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success">
                                            <i class="fa fa-thumbs-up"></i>&nbsp;
                                            Marquer comme meilleure solution
                                        </button>
                                    </form>
                                @endif
                             @endauth
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {!! $reply->content !!}

                </div>
            </div>
        @endforeach
        {{$discussion->reply()->paginate(3)->links()}}

        <div class="card">
            <div class="card-header">
                Ajouter une réponse
            </div>
            <div class="card-body">
                @auth()

                    <form action="{{route('replies.store', $discussion->slug)}}" method="POST">
                        @csrf
                        <input type="hidden" name="content" id="content">
                        <trix-editor input="content"></trix-editor>
                        <button type="submit" class="btn btn-success my-2"><i class="fa fa-send"></i>&nbsp; Ajouter une réponse</button>
                    </form>
            </div>

                @else
                <a href="{{route('login')}}" class="btn btn-info"> <i class="fa fa-sign-in"></i>&nbsp;Connectez-vous pour ajouter une réponse</a>
            @endauth

        </div>

@endsection


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
@endsection
