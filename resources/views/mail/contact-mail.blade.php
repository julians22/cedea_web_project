<html>

<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>[Cedea website] {{ $data->subject }}</title>
</head>

<body bgcolor="#fff" style="margin: 0 !important; padding: 0 !important;">

    <div
        style="padding: 0 20px 20px;display: flex;flex-direction: column;margin: 0 auto;justify-content: center;align-items: center;">
        <div
            style="display:inline-flex; flex-direction: column;  font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, 'Lucida Grande', sans-serif;  font-size: 100%; line-height: 1.6;">
            <div aria-label="Cedea logo"
                style="text-align: center; display: block;  margin-bottom:20px; max-width: 100px;">
                <x-logo />
            </div>
            <table bgcolor="#fafafa"
                style="padding:10px; border-radius:10px; max-width:600px; margin:0 auto; display:block;">
                @foreach ($data->getAttributes() as $key => $value)
                    @if (!in_array($key, ['updated_at', 'created_at', 'id']) && !empty($value) && $value !== null)
                        <tr>
                            <td
                                style="padding-bottom: 10px; font-weight: 200; font-size: 16px; margin: 20px 0; color: #333333;">
                                <strong style="font-weight: bold;">{{ ucfirst($key) }}:</strong>
                                @if ($key === 'purpose')
                                    {{ \App\Enums\ContactPurposes::from($value)->getLabel() }}
                                @else
                                    {{ $value }}
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </table>
        </div>
    </div>
</body>

</html>
