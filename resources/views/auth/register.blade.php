<x-auth-layout>
    <h2>{{ __('messages.auth.create_account') }}</h2>
    @if($errors->any())
        <div class="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">{{ __('messages.auth.name_question') }}</label>
            <input id="name" name="name" type="text" required value="{{ old('name') }}" placeholder="{{ __('messages.auth.name_placeholder') }}">
            @error('name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">{{ __('messages.auth.email_address') }}</label>
            <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}" placeholder="{{ __('messages.auth.email_type_placeholder') }}">
            @error('email')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">{{ __('messages.auth.create_password') }}</label>
            <input id="password" name="password" type="password" required placeholder="{{ __('messages.auth.create_password_placeholder') }}">
            @error('password')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation">{{ __('messages.auth.confirm_password') }}</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required placeholder="{{ __('messages.auth.confirm_password_placeholder') }}">
        </div>
        <div class="form-group">
            <label for="role">{{ __('messages.auth.join_as') }}</label>
            <select id="role" name="role" required>
                <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>{{ __('messages.auth.student_option') }}</option>
                <option value="creator" {{ old('role') == 'creator' ? 'selected' : '' }}>{{ __('messages.auth.creator_option') }}</option>
            </select>
            @error('role')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn">{{ __('messages.auth.create_account') }}</button>
    </form>
    <p class="text-muted">
        {{ __('messages.auth.already_account') }}
        <a href="{{ route('login') }}" class="link">{{ __('messages.auth.sign_in_here') }}</a>
    </p>
</x-auth-layout>
