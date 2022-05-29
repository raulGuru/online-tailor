<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
       <a class="sidebar-brand" href="{{ route('dashboard.index') }}">
       <span class="sidebar-brand-text align-middle">
       Customize Tailor
       </span>
       </a>
       <ul class="sidebar-nav">
            <li class="sidebar-header">
                Products
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('product.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Material List</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('product.create') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Add Material</span>
                </a>
            </li>
            <li class="sidebar-header">
                Tailors
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('tailors.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Tailor List</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('tailors.create') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Add Tailor</span>
                </a>
            </li>
       </ul>
    </div>
 </nav>