@include('nav')

<h2>Registration</h2>
<form action="{{ route('register') }}" method="post">
    @csrf
    <div>Name <input type="text" name="name"></div>
    <div>Email <input type="text" name="email"></div>
    <div>Password <input type="password" name="password"></div>

    <div> <input type="submit" ></div>
</form>