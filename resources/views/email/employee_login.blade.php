<h2>Your Account Created</h2>

<p>Hello {{ $user->name }}</p>

<p>Your account has been created.</p>

<p>

    Login Email: {{ $user->email }}

    <br>

    Password: {{ $password }}

</p>

<p>

    Login Here:

    <a href="{{ url('/login') }}">
        Login
    </a>

</p>
