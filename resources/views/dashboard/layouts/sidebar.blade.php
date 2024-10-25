<section id="sidebar">
    <a href="#" class="brand dropdown-bar-toggle" id="">
        <i class='bx bxs-smile'></i>
        <span class="text">AdminHub</span>
</a>


    
    <ul class="side-menu top">
        <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
            <a href="/dashboard">
                <i class='bx bxs-dashboard'></i>
                <span class="text">Dashboard</span>
            </a>
        </li>
        <li class="{{ request()->is('dashboard-admin*') ? 'active' : '' }}">
            <a href="/dashboard-admin">
                <i class='bx bxs-shopping-bag-alt'></i>
                <span class="text">Admin</span>
            </a>
        </li>
        <li class="{{ request()->is('dashboard-muatype*') ? 'active' : '' }}">
            <a href="/dashboard-muatype">
                <i class='bx bxs-doughnut-chart'></i>
                <span class="text">MUA Type</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bxs-message-dots'></i>
                <span class="text">Message</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bxs-group'></i>
                <span class="text">Team</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li>
            <a href="#">
                <i class='bx bxs-cog'></i>
                <span class="text">Settings</span>
            </a>
        </li>
        <li>
            <a href="/logout" class="logout">
                <i class='bx bxs-log-out-circle'></i>
                <span class="text">Logout</span>
            </a>
        </li>
    </ul>
</section>
