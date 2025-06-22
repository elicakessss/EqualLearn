<x-auth-layout>
    <h2>Sign in to your account</h2>

    @if(session('status'))
        <div class="alert" style="border-left-color: #4FB0C6;">
            {{ session('status') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Email address</label>
            <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}" placeholder="Enter your email address">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required placeholder="Enter your password">
        </div>        <button type="submit" class="btn">Sign In</button>
    </form>

    <p class="text-muted">
        Don't have an account yet?
        <a href="{{ route('register') }}" class="link">
            Create an account
        </a>
    </p>
</x-auth-layout>
