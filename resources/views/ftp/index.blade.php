<h1>Showing all Ftp Accounts</h1>

@forelse ($ftpList as $ftp)
    <li>{{ $ftp['user'] }}</li>
@empty
    <p> 'No ftp accounts yet' </p>
@endforelse