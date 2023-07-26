@php
    $activePageLevelOne = $active_page_level_one ?? "";
    $activePageLevelTwo = $active_page_level_two ?? "";
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel d-flex">
            <div class="info">
                <a href="{{ route('admin.home') }}" class="d-block pt-3 pb-3">
                    <h5 style="margin-bottom: 0;">Admin</h5>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.home') }}" class="nav-link 
                        @if(strpos(\URL::current(), "home") !== false)
                            active
                        @endif
                    ">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Home</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link 
                        @if(strpos(\URL::current(), "user_management") !== false)
                        active
                        @endif
                    ">
                        <i class="nav-icon fas fa-user"></i>
                        <p>User Management</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.products.index') }}" class="nav-link 
                        @if(strpos(\URL::current(), "stock_management") !== false)
                        active
                        @endif
                    ">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Stok Management</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.menu.index') }}" class="nav-link 
                        @if(strpos(\URL::current(), "menu") !== false)
                        active
                        @endif
                    ">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Menu</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.orders.index') }}" class="nav-link 
                        @if(strpos(\URL::current(), "transaction_management") !== false)
                        active
                        @endif
                    ">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>Orders</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" id='logoutForm'>
                        @csrf
                    </form>
                    <script type="text/javascript">
                        function confirmLogout() {
                            if(confirm("Are you sure you want to log out?")) {
                                document.getElementById('logoutForm').submit();
                            }
                        }
                    </script>
                    <a href="#" class="nav-link" onclick='confirmLogout()'>
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Log Out</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>