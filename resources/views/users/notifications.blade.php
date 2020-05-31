@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">Notifications</div>

        <div class="card-body">
            <ul class="list-group">
                @foreach($notifications as $notification)
                    <li class="list-group-item">
                        @if($notification->type === 'App\Notifications\NewReplyAdded')
                            Une nouvelle réponse a été rajoutée à votre discussion :
                        <strong>
                            {{ $notification->data['discussion']['title']}}
                        </strong>
                            <a href="{{route('discussions.show', $notification->data['discussion']['slug'])}}" class="btn btn-sm btn-info float-right"><i class="fa fa-eye"></i> &nbsp; Voir la discussion</a>
                        @endif
                    </li>

                @endforeach
            </ul>

        </div>
    </div>
@endsection
