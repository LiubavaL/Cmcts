<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@if (! empty($greeting))
            {{ $greeting }}
        @else
            @if ($level == 'error')
                Whoops!
            @else
                Hello!
            @endif
        @endif
    </title>
</head>
<body>
<table style="border-spacing:0;border-collapse:collapse;font-family:proxima-nova,'helvetica neue',helvetica,arial,geneva,sans-serif;height:100%!important;width:100%!important;color:#4c4c4c;font-size:15px;line-height:150%;background:#ffffff;margin:0;padding:0;border:0">
    <tbody><tr style="vertical-align:top;padding:0">
        <td align="center" valign="top" style="vertical-align:top;padding:0">
            <table style="border-spacing:0;border-collapse:collapse;font-family:proxima-nova,'helvetica neue',helvetica,arial,geneva,sans-serif;height:100%;width:600px;color:#4c4c4c;font-size:15px;line-height:150%;background:#ffffff;margin:40px 0;padding:0;border:0">
                <tbody><tr style="vertical-align:top;padding:0">
                    <td align="center" valign="top" style="vertical-align:top;padding:0 40px">
                        <table style="border-spacing:0;border-collapse:collapse;font-family:proxima-nova,'helvetica neue',helvetica,arial,geneva,sans-serif;height:100%;width:100%;color:#4c4c4c;background:#ffffff;margin:0;padding:0;border:0">
                            <tbody>
                            <tr style="vertical-align:top;padding:0">
                                <td style="vertical-align:top;text-align:left;padding:0" align="left" valign="top">
                                    <h1 style="color:#999999;display:block;font-family:hybrea,proxima-nova,'helvetica neue',helvetica,arial,geneva,sans-serif;font-size:32px;font-weight:200;text-align:left;margin:0 0 40px" align="left">Password Reset</h1>

                                     <!-- Intro -->
                                     @foreach ($introLines as $line)
                                        <p style="margin:20px 0">
                                            {{ $line }}
                                        </p>
                                    @endforeach

                                    <!-- Action Button -->
                                    @if (isset($actionText))
                                        <table style="color:#4c4c4c" align="center" width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="center">
                                                    <a href="{{ $actionUrl }}"
                                                       style="color:#f60066"
                                                       class="button"
                                                       target="_blank">
                                                        {{ $actionText }}
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                        @endif

                                        </p>
                                        <!-- Outro -->
                                        @foreach ($outroLines as $line)
                                            <p style="margin:20px 0">
                                                {{ $line }}
                                            </p>
                                            @endforeach

                                                    <!-- Salutation -->
                                            <p style="margin:20px 0">
                                                Regards,<br>{{ config('app.name') }} Team
                                            </p>

                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr style="vertical-align:top;padding:0">
                    <td align="center" valign="top" style="vertical-align:top;padding:0 40px">
                        <table style="border-spacing:0;border-collapse:collapse;font-family:proxima-nova,'helvetica neue',helvetica,arial,geneva,sans-serif;height:100%;width:100%;border-top-style:solid;border-top-color:#ebeaef;color:#999999;font-size:12px;background:#ffffff;margin:0;padding:0;border-width:1px 0 0">
                            <tbody><tr style="vertical-align:top;padding:0">
                                <td valign="top" style="vertical-align:top;text-align:left;padding:0" align="left">
                                    <p style="margin:20px 0">
                                        If you’re having trouble clicking the "{{ $actionText }}" button,
                                        copy and paste the URL below into your web browser:
                                    </p>
                                    <p style="margin:20px 0">
                                        <a style="color:#444444" href="{{ $actionUrl }}" target="_blank">
                                            {{ $actionUrl }}
                                        </a>
                                    </p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>