<h3>{{config('app.name')}}</h3>
<p>Seu cadastro na nossa plataforma foi realizado com sucesso!</p>
<p>
    Para verificar a sua conta clique
    <a href="{{ $link = route('email-verification.check', $user->verification_token) . '?email=' . urlencode($user->email) }}">
        aqui
    </a>
</p>
<p>Obs: Não responda este email, ele é gerado automaticamente.</p>