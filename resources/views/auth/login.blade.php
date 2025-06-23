<x-auth-layout>
    <h2>{{ __('messages.auth.sign_in_account') }}</h2>

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
            <label for="email">{{ __('messages.auth.email') }}</label>
            <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}" placeholder="{{ __('messages.auth.email_placeholder') }}">
        </div>

        <div class="form-group">
            <label for="password">{{ __('messages.auth.password') }}</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required placeholder="{{ __('messages.auth.password_placeholder') }}">
        </div>        <button type="submit" class="btn">{{ __('messages.auth.sign_in') }}</button>
    </form>

    <p class="text-muted">
        {{ __('messages.auth.no_account') }}
        <a href="{{ route('register') }}" class="link">
            {{ __('messages.auth.create_account') }}
        </a>
    </p>
</x-auth-layout>
