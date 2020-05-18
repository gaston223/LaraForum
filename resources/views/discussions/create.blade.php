@extends('layouts.app')

@section('content')


    <div class="card">
        <div class="card-header"><h5>Ajouter une discussion</h5></div>

        <div class="card-body">
            <form action="{{route('discussion.store')}}">
                @csrf
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="text" name="title" class="form-control" value="">
                </div>

                <div class="form-group">
                    <label for="content">Contenu</label>
                    <textarea class="form-control" name="content" id="content" cols="5" rows="5" ></textarea>
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
