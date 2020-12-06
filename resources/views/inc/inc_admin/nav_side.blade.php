<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="index.html">
                <i class="ti-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                <i class="ti-clipboard menu-icon"></i>
                <span class="menu-title">Insert</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{route('category.create')}}">Add Category</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('product.create')}}">Add Product</a></li>
                    <li class="nav-item"><a class="nav-link" href="validation.html">Add Slider</a></li>
                    <li class="nav-item"><a class="nav-link" href="wizard.html">Wizard</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <i class="ti-layout menu-icon"></i>
                <span class="menu-title">Tables</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('category.index')}}">Category</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('product.index')}}">Product</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('order.index')}}">Order</a></li>
                    <li class="nav-item"> <a class="nav-link" href="sortable-table.html">Slider</a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
