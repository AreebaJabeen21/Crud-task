<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">

       </div>
    <div class="sidebar-brand-text mx-3">Student Management</div>
</a>
<hr class="sidebar-divider my-0">

<li class="nav-item active">
    <a class="nav-link" href="{{ route('student.create') }}">
        <i class="fa-solid fa-house"></i>
        <span>Students</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('courses') }}">
        <i class="fa-solid fa-crosshairs"></i>
        <span>Courses</span></a>
</li>

<hr class="sidebar-divider d-none d-md-block">

<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
</ul>
