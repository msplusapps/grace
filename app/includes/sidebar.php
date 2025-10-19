<!-- Sidebar -->
<div class="bg-white border-end" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-light">
        <a href="/" class="navbar-brand">
            <i data-feather="book" class="me-2"></i>
            <strong>EduPay Nexus</strong>
        </a>
    </div>
    <div class="list-group list-group-flush">
        <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo ($page == 'dashboard') ? 'active' : ''; ?>" href="/dashboard">
            <i data-feather="home" class="me-2"></i> Dashboard
        </a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo ($page == 'students') ? 'active' : ''; ?>" href="/students">
            <i data-feather="users" class="me-2"></i> Students
        </a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo ($page == 'payments') ? 'active' : ''; ?>" href="/payments">
            <i data-feather="credit-card" class="me-2"></i> Payments
        </a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo ($page == 'reports') ? 'active' : ''; ?>" href="/reports">
            <i data-feather="pie-chart" class="me-2"></i> Reports
        </a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo ($page == 'settings') ? 'active' : ''; ?>" href="/settings">
            <i data-feather="settings" class="me-2"></i> Settings
        </a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo ($page == 'school_info') ? 'active' : ''; ?>" href="/school_info">
            <i data-feather="info" class="me-2"></i> School Info
        </a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo ($page == 'profile') ? 'active' : ''; ?>" href="/profile">
            <i data-feather="user" class="me-2"></i> Profile
        </a>
    </div>
</div>
