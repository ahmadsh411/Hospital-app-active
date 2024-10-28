<x-guest-layout>
    <form method="POST" action="{{ route('get.password') }}">
        @csrf
        <label for="email">Enter your email to recover your account:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Send Verification Code</button>
    </form>

</x-guest-layout>
