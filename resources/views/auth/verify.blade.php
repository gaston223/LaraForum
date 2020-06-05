@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">{{ __('Verify Your Email Address') }}</div>

        <div class="card-body">
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('Un mail de verification vient d\'être envoyé !') }}
                </div>
            @endif

            {{ __('Avant de créer une discussion, Veuillez confirmer votre adresse email grâce au mail de confirmation que vous avez reçu') }}
            {{ __('Si vous n\'avez pas recu de mail :') }},
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('cliquez ici pour recevoir un autre email de verification') }}</button>.
            </form>
        </div>
    </div>
</div>
@endsection
