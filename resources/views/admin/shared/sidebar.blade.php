 <!-- Main Sidebar Container -->
 <aside class="main-sidebar elevation-4 sidebar-dark-warning">
   <!-- Brand Logo -->
   <a href="{{route('dashboard')}}" class="brand-link">
     <img src="{{ asset('img/logo.png') }}" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
     <span class="brand-text font-weight-light">Click-Store Admin</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition">
     <div class="os-resize-observer-host observed">
       <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
     </div>
     <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
       <div class="os-resize-observer"></div>
     </div>
     <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 613px;"></div>
     <div class="os-padding">
       <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
         <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
           <!-- Sidebar user panel (optional) -->
           <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
               <img src="{{ asset('img/profilepic/1.jpg') }}" class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info">
               <a href="{{route('dashboard')}}" class="d-block">Hi {{ Auth::user()->name }}!</a>
             </div>
           </div>


           <!-- Sidebar Menu -->
           <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
               <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item menu-is-opening menu-open">
                 <a href="{{route('dashboard')}}" class="nav-link active">
                   <i class="nav-icon fas fa-tachometer-alt"></i>
                   <p> Dashboard </p>
                 </a>
               </li>

               <li class="nav-header">Products Section</li>
               <li class="nav-item">
                 <a href="{{ route('ManageProducts') }}" class="nav-link">
                   <i class="nav-icon fas fa-shopping-bag"></i>
                   <p>Products</p>
                 </a>
               </li>

               <li class="nav-item">
                 <a href="{{ route('AddCategory') }}" class="nav-link">
                   <i class="nav-icon fas fa-sort-amount-down"></i>
                   <p>Category</p>
                 </a>
               </li>

               <li class="nav-item">
                 <a href="{{ route('AddBrand') }}" class="nav-link">
                   <i class="nav-icon fas fa-copyright"></i>
                   <p>Brands</p>
                 </a>
               </li>

               <li class="nav-item">
                 <a href="{{ route('ViewContacts') }}" class="nav-link">
                   <i class="nav-icon fas fa-comment-alt"></i>
                   <p>Contacts</p>
                 </a>
               </li>
             </ul>
           </nav>
           <!-- /.sidebar-menu -->
         </div>
       </div>
     </div>
     <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
       <div class="os-scrollbar-track">
         <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px);"></div>
       </div>
     </div>
     <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
       <div class="os-scrollbar-track">
         <div class="os-scrollbar-handle" style="height: 51.1433%; transform: translate(0px);"></div>
       </div>
     </div>
     <div class="os-scrollbar-corner"></div>
   </div>
   <!-- /.sidebar -->
 </aside>