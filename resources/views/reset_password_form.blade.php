@include('nav')

<h2> Reset Password </h2>
<form action="{{  route('changePassword') }}" method="POST">
    @csrf
    <div>Password <input type="password" name="password"></div>
    <div>Confirm Password <input type="password" name="reset_password"></div>
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ $email }}">
    <div> <input type="submit"></div>
</form>