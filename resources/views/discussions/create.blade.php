@extends('layouts.app')

@section('content')


    <div class="card">
        <div class="card-header"><h5>Ajouter une discussion</h5></div>

        <div class="card-body">
            <form action="{{route('discussion.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="text" name="title" class="form-control" value="">
                </div>

                <div class="form-group">
                    <label for="content">Contenu</label>
                    <input id="content" class="form-control" type="hidden" name="content" value="">
                    <trix-editor input="content"></trix-editor>

                </div>

                <div class="form-group">
                    <label for="channel">Channel</label>
                    <select class="form-control" name="channel" id="channel">
                        @foreach($channels as $channel)
                            <option value="{{$channel->id}}">{{$channel->name}}</option>
                        @endforeach
                    </select>
                </div>

                <button class="btn btn-success" type="submit"><i class="fas fa-plus"></i>&nbsp;Créer une discussion</button>
            </form>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
@endsection
