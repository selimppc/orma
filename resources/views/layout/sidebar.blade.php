<li>
    <a class="active" href="{{ URL::route('home-dashboard') }}">
        <i class="icon-dashboard"></i>
        <span>Dashboard</span>
    </a>
</li>
@if(Session::has('user_type'))
    @if(Session::get('user_type')=='sagent'|| Session::get('user_type')=='csagent')
        <li class="sub-menu">
            <a href={{URL::to('my-order-list')}}>
                <i class="icon-sort-by-attributes"></i>
                <span>My Order</span>
            </a>
        </li>
        <li>
            <a class="" href="{{ URL::route('order-list-all') }}">
                <i class="icon-sort-by-attributes"></i>
                <span> All Orders</span>
            </a>
        </li>

    @endif
@endif



@if(Session::has('user_type'))
    @if(Session::get('user_type')=='admin')
        <li>
            <a class="" href="{{ URL::route('order-list-all') }}">
                <i class="icon-sort-by-attributes"></i>
                <span> All Orders</span>
            </a>
        </li>
        <li class="sub-menu">
            <a href={{URL::to('user/user-list')}}>
                <i class="icon-user-md"></i>
                <span>User List</span>
            </a>
        </li>
        <li class="sub-menu">
            <a href={{URL::to('user/request')}}>
                <i class="icon-trello"></i>
                <span>Invitation</span>
            </a>
        </li>
    @endif
@endif




