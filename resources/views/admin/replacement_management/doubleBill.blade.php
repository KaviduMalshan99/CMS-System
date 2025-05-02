<!DOCTYPE html>
<html>

    <head>
        <title>Open Bill Windows</title>
    </head>

    <body>
        <script>
            // Open the normal bill in a new tab
            window.open("{{ $billUrl }}", '_blank');
            // Open the tax invoice in a new tab
            window.open("{{ $taxInvoiceUrl }}", '_blank');
            // Optionally, redirect the current window to a fallback page
            window.location.href = "{{ route('replacements.index') }}";
        </script>
    </body>

</html>
