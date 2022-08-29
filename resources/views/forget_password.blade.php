@include('nav')

<h2> Forget Password </h2>
<form action="{{  route('forgetPassword') }}" method="POST">
    @csrf
    <div>Email <input type="text" name="email"></div>
    
    <div> <input type="submit"></div>
</form>