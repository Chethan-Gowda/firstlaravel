@include('nav')

<h2>Dashboard </h2>

{{-- <h3> Hi {{  Auth::user()->name }} welcome to Dashboard</h3> --}}

<h3> Hi {{  Auth::guard('web')->user()->name }} welcome to Dashboard</h3>