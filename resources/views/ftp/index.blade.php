<h1>Showing all Ftps</h1>

@forelse ($ftpList as $ftp)
    <li>{{ $ftp->username }}</li>
@empty
    <p> 'No ftps yet' </p>
@endforelse