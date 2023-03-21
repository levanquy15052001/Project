<div class="">
@if (\Session::has('success'))
<ul class="notifications">
    <li class=" toast success">
        <div class="column">
        <i class="fa-solid fa-circle-info"></i>
        <span>{!! \Session::get('success') !!}</span>
        </div>
    </li>
</ul>
@endif
@if (\Session::has('errortext'))
<ul class="notifications">
    <li class=" toast error">
        <div class="column">
        <i class="fa-solid fa-circle-info"></i>
        <span>{!! \Session::get('errortext') !!}</span>
        </div>
    </li>
</ul>
@endif
@if (\Session::has('warning'))
<ul class="notifications">
    <li class=" toast warning">
        <div class="column">
        <i class="fa-solid fa-circle-info"></i>
        <span>{!! \Session::get('warning') !!}</span>
        </div>
    </li>
</ul>
@endif
@if (\Session::has('info'))
<ul class="notifications">
    <li class=" toast info">
        <div class="column">
        <i class="fa-solid fa-circle-info"></i>
        <span>{!! \Session::get('done') !!}</span>
        </div>
    </li>
</ul>
@endif


</div>
