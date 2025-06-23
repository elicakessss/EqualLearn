<x-app-layout>
    <div style="max-width: 900px; margin: 0 auto; text-align: center;">
        <!-- Hero Section -->
        <div style="background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 40%, #ffd5de 70%, #fff7c2 100%); border-radius: 25px; padding: 60px 40px; margin-bottom: 40px; box-shadow: 0 12px 32px rgba(255, 154, 158, 0.15);">
            <div style="font-size: 4rem; margin-bottom: 20px;">💖</div>
            <h1 style="font-family: 'Quicksand', sans-serif; font-size: 2.5rem; font-weight: 700; color: white; margin-bottom: 16px; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">Support Equal Learn!</h1>
            <p style="font-size: 1.2rem; color: rgba(255, 255, 255, 0.9); margin-bottom: 0; line-height: 1.6;">Help us create amazing educational content for children around the world</p>
        </div>

        <!-- Coming Soon Section -->
        <div style="background: white; border-radius: 20px; padding: 50px 40px; margin-bottom: 40px; box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06); border: 1px solid rgba(227, 231, 240, 0.8);">
            <div style="font-size: 3rem; margin-bottom: 24px;">🚀</div>
            <h2 style="font-family: 'Quicksand', sans-serif; font-size: 2rem; font-weight: 600; color: #55565a; margin-bottom: 20px;">Coming Soon!</h2>
            <p style="font-size: 1.1rem; color: #8a95a9; line-height: 1.7; margin-bottom: 30px; max-width: 600px; margin-left: auto; margin-right: auto;">
                We're working hard to bring you exciting ways to support Equal Learn's mission. Soon you'll be able to contribute to our platform and help us expand educational opportunities for children everywhere.
            </p>

            <!-- Feature Preview Cards -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 24px; margin-top: 40px;">
                <div style="background: #f8f9fc; border-radius: 16px; padding: 30px 20px; border: 1px solid #e3e7f0;">
                    <div style="font-size: 2rem; margin-bottom: 16px;">🎯</div>
                    <h3 style="font-family: 'Quicksand', sans-serif; font-weight: 600; color: #55565a; margin-bottom: 12px;">Premium Content</h3>
                    <p style="color: #8a95a9; font-size: 14px; line-height: 1.5;">Access exclusive educational videos and advanced learning materials</p>
                </div>

                <div style="background: #f8f9fc; border-radius: 16px; padding: 30px 20px; border: 1px solid #e3e7f0;">
                    <div style="font-size: 2rem; margin-bottom: 16px;">💝</div>
                    <h3 style="font-family: 'Quicksand', sans-serif; font-weight: 600; color: #55565a; margin-bottom: 12px;">Donations</h3>
                    <p style="color: #8a95a9; font-size: 14px; line-height: 1.5;">Support our mission with one-time or monthly contributions</p>
                </div>

                <div style="background: #f8f9fc; border-radius: 16px; padding: 30px 20px; border: 1px solid #e3e7f0;">
                    <div style="font-size: 2rem; margin-bottom: 16px;">🏆</div>
                    <h3 style="font-family: 'Quicksand', sans-serif; font-weight: 600; color: #55565a; margin-bottom: 12px;">Sponsorships</h3>
                    <p style="color: #8a95a9; font-size: 14px; line-height: 1.5;">Partner with us to sponsor educational content for specific regions</p>
                </div>
            </div>
        </div>

        <!-- Newsletter Signup -->
        <div style="background: linear-gradient(135deg, #effbf7 0%, #d4f5e9 100%); border-radius: 20px; padding: 40px; box-shadow: 0 6px 20px rgba(12, 195, 150, 0.1);">
            <h3 style="font-family: 'Quicksand', sans-serif; font-size: 1.5rem; font-weight: 600; color: #55565a; margin-bottom: 16px;">Stay Updated!</h3>
            <p style="color: #8a95a9; margin-bottom: 24px;">Be the first to know when our support features go live</p>
            
            <div style="max-width: 400px; margin: 0 auto;">
                <form style="display: flex; gap: 12px; align-items: center;">
                    <input type="email" 
                           placeholder="Enter your email" 
                           style="flex: 1; padding: 12px 16px; border: 1px solid #e3e7f0; border-radius: 12px; font-size: 15px; outline: none; background: white;"
                           onfocus="this.style.borderColor='#0cc396'"
                           onblur="this.style.borderColor='#e3e7f0'">
                    <button type="submit" 
                            style="background: #0cc396; color: white; border: none; padding: 12px 20px; border-radius: 12px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;"
                            onmouseover="this.style.background='#0bb389'"
                            onmouseout="this.style.background='#0cc396'">
                        Notify Me
                    </button>
                </form>
            </div>
        </div>

        <!-- Back to Home -->
        <div style="margin-top: 40px;">
            <a href="{{ route('home') }}" 
               style="display: inline-flex; align-items: center; gap: 8px; color: #8a95a9; text-decoration: none; font-weight: 500; transition: all 0.3s ease;"
               onmouseover="this.style.color='#fe8a8b'"
               onmouseout="this.style.color='#8a95a9'">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Home</span>
            </a>
        </div>
    </div>

    <style>
        @media (max-width: 768px) {
            .hero-section {
                padding: 40px 20px !important;
            }
            
            .hero-section h1 {
                font-size: 2rem !important;
            }
            
            .coming-soon-section {
                padding: 30px 20px !important;
            }
            
            .feature-grid {
                grid-template-columns: 1fr !important;
                gap: 16px !important;
            }
            
            .newsletter-section {
                padding: 30px 20px !important;
            }
            
            .newsletter-form {
                flex-direction: column !important;
                gap: 12px !important;
            }
        }
    </style>
</x-app-layout>
