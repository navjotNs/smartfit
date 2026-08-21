<nav class="main-menu noPrint">
    <ul>
        <li><a href="{!! route('dashboard') !!}"><i class="fa fa-home nav_icon"></i><span class="nav-text">Dashboard</span></a></li>
        <!-- 
        <li class="has-subnav"> 
            <a href="{!! route('customer') !!}">
            <i class="fa fa-user" aria-hidden="true"></i><span class="nav-text"> Worker Management</span></a>
        </li> -->
        
        <li class="has-subnav"> 
            <a href="{!! route('article.index') !!}">
            <i class="fa fa-pen" aria-hidden="true"></i><span class="nav-text">Service Management</span></a>
        </li>
        <li class="has-subnav"> 
            <a href="{!! route('projects.index') !!}">
            <i class="fa fa-pen" aria-hidden="true"></i><span class="nav-text">Projects Management</span></a>
        </li>
        <li class="has-subnav"> 
            <a href="{!! route('sliders.index') !!}">
            <i class="fa fa-image" aria-hidden="true"></i><span class="nav-text">Sliders Management</span></a>
        </li>
        <li class="has-subnav"> 
            <a href="{!! route('gallery.index') !!}">
            <i class="fa fa-image" aria-hidden="true"></i><span class="nav-text">Gallery Management</span></a>
        </li>

        <li class="has-subnav"> 
            <a href="{!! route('reviews.index') !!}">
            <i class="fa fa-star" aria-hidden="true"></i><span class="nav-text">Reviews</span></a>
        </li>
        
        <li class="has-subnav"> 
            <a href="{!! route('contact.index') !!}">
            <i class="fa fa-envelope"></i><span class="nav-text">Enquiries</span></a>
        </li>
        
        <!-- <li class="has-subnav"> 
            <a href="{!! route('content-view') !!}">
            <i class="fa fa-pen" aria-hidden="true"></i><span class="nav-text">Content Management</span></a>
        </li> -->
        
        <!--<li class="has-subnav">
            <a href="{!! route('login-logs.index') !!}"><i class="fa fa-user-lock" aria-hidden="true"></i><span class="nav-text">Login Attempts</span></a>
        </li> -->
        </ul>
        </li>
        <li><a href="{!! route('admin-logout') !!}"><i class="icon-off nav-icon"></i><span class="nav-text">Logout</span></a></li>
    </ul>
   
</nav>