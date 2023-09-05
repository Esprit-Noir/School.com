@component('mail::message')
    Salut {{$user->name}}
    <p>Nous comprenons ce qui se passe.</p>
    @component('mail::button', ['url' => url('auth/reset-password/'.$user->remember_token)])
        Réinitialiser votre mot de passe.
    @endcomponent
    <p>Dans le cas ou vous n'avez aucune issue pour retrouver votre compte, contactez nous. </p>
    Merci <br>
    {{config('app.name')}}
@endcomponent
