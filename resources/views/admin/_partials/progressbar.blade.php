<div class="col-md-12 px-0">
    <div class="container px-0">
        <ul class="progressbar">
            @if ($step == 'basic')
            <li class="active">
                <a class="a-cutom" href="{{route('pharmacies.create', ['step' => 'basic'])}}">
                    <u>
                    Basic Details
                    </u>
                </a>
            </li>
            @else
            <li><u>Basic Details</u></li>
            @endif
            @if ($step == 'images')
            <li class="active">
                <a class="a-cutom" href="{{route('pharmacies.create', ['step' => 'images'])}}">
                    <u>
                    Logo and Images
                    </u>
                </a>
            </li>
            @else
            <li><u>Logo and Images</u></li>
            @endif
            @if ($step == 'contact')
            <li class="active">
                <a class="a-cutom" href="{{route('pharmacies.create', ['step' => 'contact'])}}">
                    <u>
                        Contact Information 
                    </u>
                </a>
            </li>
            @else
            <li><u>Contact Information </u></li>
            @endif
            
        </ul>
    </div>
    <hr class="mt-5 mt-lg-3">
</div>
