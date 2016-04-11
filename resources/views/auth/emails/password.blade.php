{{-- resources/views/emails/password.blade.php --}}
 
Haz click aca para reiniciar tu contraseña: <a href="{{ url('password/reset/'.$token) }}">{{ url('password/reset/'.$token) }}</a>