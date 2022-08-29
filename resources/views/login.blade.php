@include('nav')

<h2> Login </h2>
<form action="{{  route('loginCheck') }}" method="POST">
    @csrf
    <div>Email <input type="text" name="email"></div>
    <div>Password <input type="password" name="password"></div>
    <div> <input type="submit"></div>
</form>

<a href="{{ route('forgetPassword') }}" class="btn btn-danger">Forget Password</a>