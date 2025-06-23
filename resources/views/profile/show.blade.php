<x-app-layout>
    <div style="max-width: 800px; margin: 0 auto;">
        <!-- Back Button -->
        <div style="margin-bottom: 20px;">
            <a href="{{ url('/account') }}" style="display: inline-flex; align-items: center; gap: 8px; color: #8a95a9; text-decoration: none; font-weight: 500; transition: all 0.3s ease; hover:color: #fe8a8b;" onmouseover="this.style.color='#fe8a8b'" onmouseout="this.style.color='#8a95a9'">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Dashboard</span>
            </a>
        </div>

        <!-- Page Header -->
        <div style="margin-bottom: 30px;">
            <h1 style="font-size: 2rem; font-weight: 700; color: #55565a; font-family: 'Quicksand', sans-serif; margin-bottom: 8px;">Profile Settings</h1>
            <p style="color: #8a95a9; font-size: 16px;">Manage your account information and security settings</p>
        </div>

        <!-- Profile Information Section -->
        <div style="background: #fff; border-radius: 20px; padding: 30px; box-shadow: 0 6px 20px rgba(0,0,0,0.04); border: 1px solid rgba(227, 231, 240, 0.8); margin-bottom: 25px;">
            <div style="display: flex; align-items: center; margin-bottom: 25px;">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #ffd5de 0%, #d0e6fa 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #fe8a8b; font-size: 24px; margin-right: 20px;">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div>
                    <h2 style="font-size: 1.4rem; font-weight: 600; color: #55565a; margin-bottom: 4px;">{{ $user->name }}</h2>
                    <p style="color: #8a95a9; font-size: 14px;">{{ $user->email }}</p>
                    <span style="background: #effbf7; color: #0cc396; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; text-transform: capitalize;">
                        @if($user->hasRole('admin'))
                            Administrator
                        @elseif($user->hasRole('creator'))
                            Content Creator
                        @else
                            Student
                        @endif
                    </span>
                </div>
            </div>

            <h3 style="font-size: 1.1rem; font-weight: 600; color: #55565a; margin-bottom: 20px; font-family: 'Quicksand', sans-serif;">Update Profile Information</h3>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PATCH')

                <div style="margin-bottom: 20px;">
                    <label for="name" style="display: block; font-weight: 600; color: #55565a; margin-bottom: 8px; font-size: 14px;">Full Name</label>
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name', $user->name) }}"
                           required
                           style="width: 100%; padding: 12px 16px; border: 1px solid #e3e7f0; border-radius: 12px; font-size: 15px; color: #55565a; background: #f8f9fc; transition: all 0.3s ease; outline: none;"
                           onfocus="this.style.borderColor='#fe8a8b'; this.style.background='#fff';"
                           onblur="this.style.borderColor='#e3e7f0'; this.style.background='#f8f9fc';">
                    @error('name')
                        <span style="color: #fe8a8b; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-bottom: 25px;">
                    <label for="email" style="display: block; font-weight: 600; color: #55565a; margin-bottom: 8px; font-size: 14px;">Email Address</label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email', $user->email) }}"
                           required
                           style="width: 100%; padding: 12px 16px; border: 1px solid #e3e7f0; border-radius: 12px; font-size: 15px; color: #55565a; background: #f8f9fc; transition: all 0.3s ease; outline: none;"
                           onfocus="this.style.borderColor='#fe8a8b'; this.style.background='#fff';"
                           onblur="this.style.borderColor='#e3e7f0'; this.style.background='#f8f9fc';">
                    @error('email')
                        <span style="color: #fe8a8b; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" style="background: #fe8a8b; color: white; border: none; padding: 12px 24px; border-radius: 12px; font-weight: 600; font-size: 15px; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 10px rgba(254, 138, 139, 0.2);" onmouseover="this.style.background='#ff7b7c'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#fe8a8b'; this.style.transform='translateY(0)'">
                    <i class="fas fa-save" style="margin-right: 8px;"></i>
                    Update Profile
                </button>
            </form>
        </div>

        <!-- Password Update Section -->
        <div style="background: #fff; border-radius: 20px; padding: 30px; box-shadow: 0 6px 20px rgba(0,0,0,0.04); border: 1px solid rgba(227, 231, 240, 0.8);">
            <h3 style="font-size: 1.1rem; font-weight: 600; color: #55565a; margin-bottom: 20px; font-family: 'Quicksand', sans-serif;">Change Password</h3>

            <form action="{{ route('profile.password') }}" method="POST">
                @csrf
                @method('PATCH')

                <div style="margin-bottom: 20px;">
                    <label for="current_password" style="display: block; font-weight: 600; color: #55565a; margin-bottom: 8px; font-size: 14px;">Current Password</label>
                    <input type="password"
                           id="current_password"
                           name="current_password"
                           required
                           style="width: 100%; padding: 12px 16px; border: 1px solid #e3e7f0; border-radius: 12px; font-size: 15px; color: #55565a; background: #f8f9fc; transition: all 0.3s ease; outline: none;"
                           onfocus="this.style.borderColor='#fe8a8b'; this.style.background='#fff';"
                           onblur="this.style.borderColor='#e3e7f0'; this.style.background='#f8f9fc';">
                    @error('current_password')
                        <span style="color: #fe8a8b; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="password" style="display: block; font-weight: 600; color: #55565a; margin-bottom: 8px; font-size: 14px;">New Password</label>
                    <input type="password"
                           id="password"
                           name="password"
                           required
                           style="width: 100%; padding: 12px 16px; border: 1px solid #e3e7f0; border-radius: 12px; font-size: 15px; color: #55565a; background: #f8f9fc; transition: all 0.3s ease; outline: none;"
                           onfocus="this.style.borderColor='#fe8a8b'; this.style.background='#fff';"
                           onblur="this.style.borderColor='#e3e7f0'; this.style.background='#f8f9fc';">
                    @error('password')
                        <span style="color: #fe8a8b; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-bottom: 25px;">
                    <label for="password_confirmation" style="display: block; font-weight: 600; color: #55565a; margin-bottom: 8px; font-size: 14px;">Confirm New Password</label>
                    <input type="password"
                           id="password_confirmation"
                           name="password_confirmation"
                           required
                           style="width: 100%; padding: 12px 16px; border: 1px solid #e3e7f0; border-radius: 12px; font-size: 15px; color: #55565a; background: #f8f9fc; transition: all 0.3s ease; outline: none;"
                           onfocus="this.style.borderColor='#fe8a8b'; this.style.background='#fff';"
                           onblur="this.style.borderColor='#e3e7f0'; this.style.background='#f8f9fc';">
                </div>

                <button type="submit" style="background: #3b82f6; color: white; border: none; padding: 12px 24px; border-radius: 12px; font-weight: 600; font-size: 15px; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 10px rgba(59, 130, 246, 0.2);" onmouseover="this.style.background='#2563eb'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#3b82f6'; this.style.transform='translateY(0)'">
                    <i class="fas fa-lock" style="margin-right: 8px;"></i>
                    Update Password
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
