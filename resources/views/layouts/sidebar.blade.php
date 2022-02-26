<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
       <a class="sidebar-brand" href="{{ route('dashboard.index') }}">
       <span class="sidebar-brand-text align-middle">
       Online Tailor
       </span>
       </a>
       <ul class="sidebar-nav">
            <li class="sidebar-header">
                Products
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('product.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Product List</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('product.create') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Add Product</span>
                </a>
            </li>
       </ul>
    </div>
 </nav>