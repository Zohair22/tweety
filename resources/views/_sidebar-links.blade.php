


<ul class="list-unstyled text-info">
    <li>
       <a href="{{ route('home') }}" class="font-weight-bold text-primary display-5 text-decoration-none d-block mb-3" >Home</a>
    </li>
    <li>
       <a href="#" class="font-weight-bold text-primary display-5 text-decoration-none d-block mb-3" >Explore</a>
    </li>
    <li>
       <a href="{{ auth()->user()->path() }}" class="font-weight-bold text-primary display-5 text-decoration-none d-block mb-3" >Profile</a>
    </li>
 </ul>
