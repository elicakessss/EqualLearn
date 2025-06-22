<x-auth-layout>
    <h2>Create your account</h2>
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
            <label for="name">What's your name?</label>
            <input id="name" name="name" type="text" required value="{{ old('name') }}" placeholder="Type your name here">
            @error('name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Your email address</label>
            <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}" placeholder="Type your email here">
            @error('email')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Create a secret password</label>
            <input id="password" name="password" type="password" required placeholder="Create your password">
            @error('password')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation">Type your password again</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required placeholder="Confirm your password">
        </div>
        <div class="form-group">
            <label for="role">I want to join as a:</label>
            <select id="role" name="role" required>
                <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student - I want to learn</option>
                <option value="creator" {{ old('role') == 'creator' ? 'selected' : '' }}>Creator - I want to teach</option>
            </select>
            @error('role')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn">Create Account</button>
    </form>
    <p class="text-muted">
        Already have an account?
        <a href="{{ route('login') }}" class="link">Sign in here</a>
    </p>
</x-auth-layout>
