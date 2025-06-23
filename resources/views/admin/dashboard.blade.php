<x-app-layout>
    <style>
        .dashboard-header {
            background: linear-gradient(135deg, #fff7c2 0%, #ffd5de 50%, #d0e6fa 100%);
            border-radius: 28px;
            padding: 40px;
            margin-bottom: 32px;
            box-shadow: 0 8px 32px 0 rgba(254, 138, 139, 0.08);
            border: 1.5px solid #f6e6e6;
        }
        
        .dashboard-header h1 {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: #55565a;
            margin-bottom: 12px;
            text-align: center;
        }
        
        .dashboard-header p {
            color: #8a95a9;
            font-size: 1.1rem;
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
        }

        .admin-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
        }

        .admin-card {
            background: linear-gradient(135deg, #fff 0%, #fef7f7 100%);
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 8px 32px 0 rgba(254, 138, 139, 0.08);
            border: 1.5px solid #f6e6e6;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-align: center;
        }

        .admin-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 48px 0 rgba(254, 138, 139, 0.15);
        }

        .admin-card-icon {
            font-size: 2.5rem;
            margin-bottom: 16px;
            display: block;
        }

        .admin-card h3 {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: #55565a;
            margin-bottom: 12px;
        }

        .admin-card p {
            color: #8a95a9;
            font-size: 1rem;
            line-height: 1.6;
        }

        .section-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: #55565a;
            margin-bottom: 24px;
            text-align: center;
        }
    </style>

    <div class="dashboard-header">
        <h1>Admin Dashboard ⚙️</h1>
        <p>Welcome to the admin control panel! Manage users, categories, and monitor system activities to keep EqualLearn running smoothly.</p>
    </div>

    <div>
        <h2 class="section-title">Admin Functions</h2>
        <div class="admin-grid">
            <div class="admin-card">
                <span class="admin-card-icon">👥</span>
                <h3>User Management</h3>
                <p>View all users, change roles (student, creator, admin), and manage permissions to ensure proper access control.</p>
            </div>

            <div class="admin-card">
                <span class="admin-card-icon">📚</span>
                <h3>Category Management</h3>
                <p>Create, edit, and delete video categories. Categories help organize content and appear in the sidebar for easy navigation.</p>
            </div>

            <div class="admin-card">
                <span class="admin-card-icon">📊</span>
                <h3>System Logs</h3>
                <p>Track actions performed in the system for auditing, troubleshooting, and maintaining platform security.</p>
            </div>
        </div>
    </div>
</x-app-layout>
