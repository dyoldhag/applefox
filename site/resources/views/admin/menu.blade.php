<ul class="sidebar-menu" data-widget="tree">
  <li class="header">MAIN NAVIGATION</li>
  <li class="{{ Request::is('admin') ? 'active' : '' }}">
    <a href="{{ url('/admin') }}">
      <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
  </li>
  
  @if(Auth::user()->type == 'admin')
  <li class="{{ Request::is('admin/answers') ? 'active' : '' }}">
    <a href="{{ url('/admin/answers') }}">
      <i class="fa fa-question-circle"></i> <span>Answers</span>
    </a>
  </li>
  <li class="{{ Request::is('admin/winners') ? 'active' : '' }}">
    <a href="{{ url('/admin/winners') }}">
      <i class="fa fa-question-circle"></i> <span>Winners - AR</span>
    </a>
  </li>
  <li class="{{ Request::is('admin/appledays') ? 'active' : '' }}">
    <a href="{{ url('/admin/appledays') }}">
      <i class="fa fa-question-circle"></i> <span>Apple day - AR</span>
    </a>
  </li>
  <li class="{{ Request::is('admin/winfridge') ? 'active' : '' }}">
    <a href="{{ url('/admin/winfridge') }}">
      <i class="fa fa-apple"></i> <span>Win Fridge</span>
    </a>
  </li>
  <li class="{{ Request::is('admin/confirmwin') ? 'active' : '' }}">
    <a href="{{ url('/admin/confirmwin') }}">
      <i class="fa fa-trophy"></i> <span>Confirm Win</span>
    </a>
  </li>
  <li class="{{ Request::is('admin/prizes') ? 'active' : '' }}">
    <a href="{{ url('/admin/prizes') }}">
      <i class="fa fa-gift"></i> <span>Prizes</span>
    </a>
  </li>
  <li class="{{ Request::is('admin/baggiveaway') ? 'active' : '' }}">
    <a href="{{ url('/admin/baggiveaway') }}">
      <i class="fa fa-building"></i> <span>Bag Giveaway</span>
    </a>
  </li>
  <li class="{{ Request::is('admin/users') ? 'active' : '' }}">
    <a href="{{ url('/admin/users') }}">
      <i class="fa fa-users"></i> <span>User</span>
    </a>
  </li>
  @endif
</ul>
