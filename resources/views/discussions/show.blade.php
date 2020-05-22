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
            </div>
        </div>
        <h4>Commentaires :</h4>
        @foreach($discussion->reply()->paginate(3) as $reply)
            <div class="card my-5">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <img width="40px" style="border-radius: 50%" src="{{Gravatar::src($reply->owner->email)}}" alt="">
                            <span>{{$reply->owner->name}}</span>
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
