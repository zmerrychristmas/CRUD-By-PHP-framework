<li class="{{ Request::is('classes*') ? 'active' : '' }}">
    <a href="{!! route('classes.index') !!}"><i class="fa fa-edit"></i><span>Classes</span></a>
</li>

<li class="{{ Request::is('people*') ? 'active' : '' }}">
    <a href="{!! route('people.index') !!}"><i class="fa fa-edit"></i><span>People</span></a>
</li>

