@extends('admin_layout')
@section('admin_content')

<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
      <li class="active"><a href="{{ URL::to('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ URL::to('/all-category') }}"><i class="fa fa-bar-chart-o"></i> All Category</a></li>
      <li><a href="{{ URL::to('/add-category') }}"><i class="fa fa-table"></i> Add Category</a></li>
      <li><a href="{{ URL::to('/all-manufacture') }}"><i class="fa fa-edit"></i> All Manufacture</a></li>
      <li><a href="{{ URL::to('/add-manufacture') }}"><i class="fa fa-font"></i> Add Manufacture</a></li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Products <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="{{ URL::to('/add-product') }}">Add Product</a></li>
          <li><a href="{{ URL::to('/all-product') }}">All Products</a></li>
          {{-- <li><a href="#">Third Item</a></li>
          <li><a href="#">Last Item</a></li> --}}
        </ul>
      </li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Slider <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="{{ URL::to('/add-slider') }}">Add Slider</a></li>
          <li><a href="{{ URL::to('/all-slider') }}">All Slider</a></li>
          {{-- <li><a href="#">Third Item</a></li>
          <li><a href="#">Last Item</a></li> --}}
        </ul>
      </li>

      {{-- <li><a href="bootstrap-elements.html"><i class="fa fa-desktop"></i> Slider</a></li> --}}
      <li><a href="{{ URL::to('/manage-order') }}"><i class="fa fa-wrench"></i> Manage Order</a></li>
      <li><a href="blank-page.html"><i class="fa fa-file"></i> Shop Name</a></li>
      <li><a href="tables.html"><i class="fa fa-table"></i> Delivery Man</a></li>
      <li><a href="tables.html"><i class="fa fa-table"></i> Add Category</a></li>
    </ul>

    <ul class="nav navbar-nav navbar-right navbar-user">
      <li class="dropdown messages-dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Messages <span class="badge">7</span> <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li class="dropdown-header">7 New Messages</li>
          <li class="message-preview">
            <a href="#">
              <span class="avatar"><img src="http://placehold.it/50x50"></span>
              <span class="name">John Smith:</span>
              <span class="message">Hey there, I wanted to ask you something...</span>
              <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
            </a>
          </li>
          <li class="divider"></li>
          <li class="message-preview">
            <a href="#">
              <span class="avatar"><img src="http://placehold.it/50x50"></span>
              <span class="name">John Smith:</span>
              <span class="message">Hey there, I wanted to ask you something...</span>
              <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
            </a>
          </li>
          <li class="divider"></li>
          <li class="message-preview">
            <a href="#">
              <span class="avatar"><img src="http://placehold.it/50x50"></span>
              <span class="name">John Smith:</span>
              <span class="message">Hey there, I wanted to ask you something...</span>
              <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
            </a>
          </li>
          <li class="divider"></li>
          <li><a href="#">View Inbox <span class="badge">7</span></a></li>
        </ul>
      </li>
      <li class="dropdown alerts-dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> Alerts <span class="badge">3</span> <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Default <span class="label label-default">Default</span></a></li>
          <li><a href="#">Primary <span class="label label-primary">Primary</span></a></li>
          <li><a href="#">Success <span class="label label-success">Success</span></a></li>
          <li><a href="#">Info <span class="label label-info">Info</span></a></li>
          <li><a href="#">Warning <span class="label label-warning">Warning</span></a></li>
          <li><a href="#">Danger <span class="label label-danger">Danger</span></a></li>
          <li class="divider"></li>
          <li><a href="#">View All</a></li>
        </ul>
      </li>
      <li class="dropdown user-dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Session::get('admin_name') }} John Smith <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
          <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
          <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
          <li class="divider"></li>
          <li><a href="{{ URL::to('/logout') }}"><i class="fa fa-power-off"></i> Log Out</a></li>
        </ul>
      </li>
    </ul>
  </div><!-- /.navbar-collapse -->

@endsection
