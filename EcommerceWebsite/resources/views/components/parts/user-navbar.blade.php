<div class="pt-3 pb-3" style="background-color: #204f8c">
    <ul class="ms-0">
        <li class="d-flex align-items-center" style="list-style: none">
            <img src="{{asset('media/icons/user.svg')}}" style="width: 20px"/>
            <a href="{{url('/dashboard')}}" class="ms-2" style="color: white;text-decoration: none">Profile</a>
        </li>
        <li class="d-flex align-items-center" style="list-style: none">
            <img src="{{asset('media/icons/panier2.svg')}}" style="width: 20px"/>
            <a href="{{url('/dashboard')}}" class="ms-2" style="color: white;text-decoration: none">Panier</a>
        </li>
        <li class="d-flex align-items-center" style="list-style: none">
            <img src="{{asset('media/icons/user.svg')}}" style="width: 20px"/>
            <a href="{{url('/dashboard')}}" class="ms-2" style="color: white;text-decoration: none">Commandes</a>
        </li>
        <li class="mt-3" style="list-style: none">
            <form method="POST" action="{{ route('logout') }}" >
                @csrf
                <img src="{{asset('media/icons/user.svg')}}" style="width: 20px"/>
                <button class="ps-0 ms-2" style="background-color: transparent;border:none;color: white;">
                    {{ __('Se déconnecter ') }}
                </button>
            </form>
        </li>
    </ul>
</div>
