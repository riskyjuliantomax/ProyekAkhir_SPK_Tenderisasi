<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View PDF</title>
    <style>
        body {
            margin: 0;
            /* Reset default margin */
        }

        body {
            margin: 0;
            /* Reset default margin */
        }

        iframe {
            display: block;
            /* iframes are inline by default */
            background: #000;
            border: none;
            /* Reset default border */
            height: 100vh;
            /* Viewport-relative units */
            width: 100vw;
        }
    </style>
</head>

<body style="margin:0px;padding:0px;overflow:hidden">
    {{-- {{ $data->dokumen_perusahaan }} --}}
    <iframe src="{{ asset('storage/dokumenTender/' . $data->dokumen_perusahaan) }}">
</body>

</html>
