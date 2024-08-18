{{-- logout.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    {{-- Include any additional stylesheets or scripts here --}}
</head>
<body>
    {{-- Your page content here --}}
    <form action="/logout" method="GET">
        @csrf
        <button type="submit" >Logout</button>
    </form>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logoutForm = document.getElementById('logoutForm');
            if (logoutForm) {
                logoutForm.addEventListener('submit', function(event) {
                    event.preventDefault();
                    this.submit();
                });
            }
        });

    </script> --}}
</body>
</html>
