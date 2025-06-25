<x-app-layout>    <div class="py-12 text-center">        <!-- Combined Hero & About Us Section -->
        <div style="background: linear-gradient(135deg, #fff7c2 0%, #ffd5de 100%); border-radius: 20px; padding: 30px; margin-bottom: 40px; box-shadow: 0 8px 25px rgba(254, 138, 139, 0.08); border: 1.5px solid #f6e6e6; max-width: 1200px; margin-left: auto; margin-right: auto; transition: transform 0.18s cubic-bezier(.4,2,.6,1), box-shadow 0.18s;" onmouseover="this.style.transform='translateY(-6px) scale(1.02)'; this.style.boxShadow='0 12px 32px 0 rgba(254, 138, 139, 0.14), 0 2px 10px 0 rgba(208, 230, 250, 0.12)';" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 8px 25px rgba(254, 138, 139, 0.08)';">
            <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 40px; align-items: center;">
                <!-- Left side: Image -->
                <div style="text-align: center;">
                    <img src="{{ asset('images/landing.png') }}" 
                         alt="EqualLearn" 
                         style="max-width: 100%; height: auto; border-radius: 15px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
                </div>
                  <!-- Right side: Text Content -->
                <div style="text-align: left;">
                    <h1 style="font-family: 'Quicksand', sans-serif; font-size: 2.2rem; font-weight: 700; color: #fe8a8b; margin-bottom: 12px; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">Support EqualLearn!</h1>
                    <p style="font-size: 1.1rem; color: #55565a; margin-bottom: 20px; line-height: 1.6;">Help us create amazing educational content for children around the world</p>
                    
                    <p style="font-size: 1rem; color: #55565a; line-height: 1.6; margin-bottom: 0;">
                        This system was made possible by students of <strong>St. Paul University Philippines</strong> and <strong>Hayek Global College</strong>. EqualLearn is dedicated to bringing quality educational content to rural areas for grade schoolers, bridging the educational gap between urban and remote communities. We believe every child deserves equal access to education, and we gratefully accept donations and funding from supporters who share our vision.
                    </p>
                </div>
            </div>
        </div>        <!-- Two Column Layout -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; max-width: 1200px; margin: 0 auto 40px auto;">
            <!-- Donation Section -->
            <div style="background: linear-gradient(135deg, #fff7c2 0%, #ffd5de 100%); border-radius: 20px; box-shadow: 0 6px 24px 0 rgba(254, 138, 139, 0.08), 0 1px 6px 0 rgba(208, 230, 250, 0.10); border: 1.5px solid #f6e6e6; padding: 24px; text-align: center; transition: transform 0.18s cubic-bezier(.4,2,.6,1), box-shadow 0.18s;" onmouseover="this.style.transform='translateY(-6px) scale(1.02)'; this.style.boxShadow='0 12px 32px 0 rgba(254, 138, 139, 0.14), 0 2px 10px 0 rgba(208, 230, 250, 0.12)';" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 6px 24px 0 rgba(254, 138, 139, 0.08), 0 1px 6px 0 rgba(208, 230, 250, 0.10)';">
                <div style="font-size: 2rem; margin-bottom: 8px;">💝</div>
                <h2 style="font-family: 'Quicksand', sans-serif; font-size: 1.25rem; font-weight: 600; color: #1c1e21; margin-bottom: 8px;">Donation and Sponsorship</h2>
                <p style="font-size: 0.9rem; color: #65676b; line-height: 1.4; margin-bottom: 12px;">
                    Help us continue providing free educational content to children in rural areas.
                </p>
                <div style="background: rgba(255, 255, 255, 0.6); border-radius: 8px; padding: 12px; border: 1px solid #ffd5de;">
                    <p style="font-size: 0.8rem; color: #1c1e21; margin-bottom: 6px; font-weight: 600;">Payment Details:</p>                    <p style="font-size: 0.75rem; color: #65676b; margin: 2px 0; line-height: 1.3;">
                        <strong>GCash:</strong> 09157607995 - Catherine Tejano
                    </p>
                    <p style="font-size: 0.75rem; color: #65676b; margin: 2px 0; line-height: 1.3;">
                        <strong>BDO Bank:</strong> 0120 3023 4873
                    </p>
                </div>
            </div>            <!-- Premium Access Section -->
            <div style="background: linear-gradient(135deg, #fff7c2 0%, #ffd5de 100%); border-radius: 20px; box-shadow: 0 6px 24px 0 rgba(254, 138, 139, 0.08), 0 1px 6px 0 rgba(208, 230, 250, 0.10); border: 1.5px solid #f6e6e6; padding: 24px; text-align: center; transition: transform 0.18s cubic-bezier(.4,2,.6,1), box-shadow 0.18s;" onmouseover="this.style.transform='translateY(-6px) scale(1.02)'; this.style.boxShadow='0 12px 32px 0 rgba(254, 138, 139, 0.14), 0 2px 10px 0 rgba(208, 230, 250, 0.12)';" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 6px 24px 0 rgba(254, 138, 139, 0.08), 0 1px 6px 0 rgba(208, 230, 250, 0.10)';">
                <div style="font-size: 2rem; margin-bottom: 8px;">⭐</div>
                <h2 style="font-family: 'Quicksand', sans-serif; font-size: 1.25rem; font-weight: 600; color: #1c1e21; margin-bottom: 8px;">Premium Access</h2>
                <p style="font-size: 0.9rem; color: #65676b; line-height: 1.4; margin-bottom: 12px;">
                    Get access to premium educational content.
                </p>
                <div style="background: linear-gradient(45deg, #ff6b6b, #feca57); color: white; padding: 8px 16px; border-radius: 20px; font-size: 0.85rem; font-weight: 700; text-shadow: 0 1px 2px rgba(0,0,0,0.2); box-shadow: 0 3px 10px rgba(255, 107, 107, 0.3); animation: pulse 2s infinite;">
                    🚀 Coming Soon!
                </div>
            </div>
        </div>

        <!-- Newsletter Signup -->
        <div style="background: linear-gradient(135deg, #effbf7 0%, #d4f5e9 100%); border-radius: 20px; padding: 40px; margin-bottom: 40px; box-shadow: 0 6px 20px rgba(12, 195, 150, 0.1); max-width: 900px; margin-left: auto; margin-right: auto; margin-bottom: 40px;">
            <h3 style="font-family: 'Quicksand', sans-serif; font-size: 1.5rem; font-weight: 600; color: #55565a; margin-bottom: 16px;">Stay Updated!</h3>
            <p style="color: #8a95a9; margin-bottom: 24px;">Be the first to know when premium features and new content become available</p>
            
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
    </div>    <style>
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        @media (max-width: 768px) {
            /* Make the hero section single column on mobile */
            div[style*="grid-template-columns: 1fr 1.5fr"] {
                grid-template-columns: 1fr !important;
                gap: 20px !important;
                text-align: center !important;
            }
            
            /* Mobile responsive for donation/premium sections */
            div[style*="grid-template-columns: 1fr 1fr"] {
                grid-template-columns: 1fr !important;
                gap: 20px !important;
            }            div[style*="padding: 24px"] {
                padding: 20px !important;
            }
            
            div[style*="padding: 30px"] {
                padding: 20px !important;
            }
            
            h1[style*="font-size: 2.2rem"] {
                font-size: 1.8rem !important;
            }            h2[style*="font-size: 1.25rem"] {
                font-size: 1.1rem !important;
            }
            
            div[style*="display: flex; gap: 12px"] {
                flex-direction: column !important;
                gap: 12px !important;
            }
            
            /* Make text left-aligned on mobile */
            div[style*="text-align: left"] {
                text-align: center !important;
            }
        }
    </style>
</x-app-layout>
