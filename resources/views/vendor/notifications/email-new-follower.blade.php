@extends('vendor.notifications.base-layout.email-base-layout')

@section('title', 'New Notification!')

@section('content')
    <p style="margin:20px 0">
        <a href="https://comicats.heroku.com/profile/{{$follower->id}}" style="color:#f60066">{{$follower->name}}</a> is now following you!
    </p>
@endsection

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{ config('app.name') }} Notification</title>
</head>
<body>
<table style="border-spacing:0;border-collapse:collapse;font-family:proxima-nova,'helvetica neue',helvetica,arial,geneva,sans-serif;height:100%!important;width:100%!important;color:#4c4c4c;font-size:15px;line-height:150%;background:#ffffff;margin:0;padding:0;border:0">
    <tbody><tr style="vertical-align:top;padding:0">
        <td align="center" valign="top" style="vertical-align:top;padding:0">
            <table style="border-spacing:0;border-collapse:collapse;font-family:proxima-nova,'helvetica neue',helvetica,arial,geneva,sans-serif;height:100%;width:600px;color:#4c4c4c;font-size:15px;line-height:150%;background:#ffffff;margin:40px 0;padding:0;border:0">
                <tbody><tr style="vertical-align:top;padding:0">
                    <td align="center" valign="top" style="vertical-align:top;padding:0 40px">
                        <table style="border-spacing:0;border-collapse:collapse;font-family:proxima-nova,'helvetica neue',helvetica,arial,geneva,sans-serif;height:100%;width:100%;background:#ffffff;margin:0;padding:0;border:0">
                            <tbody>
                            <tr style="vertical-align:top;padding:0">
                                <td style="vertical-align:top;text-align:left;padding:0" align="left" valign="top">
                                    <h1 style="color:#f60066;display:block;font-family:hybrea,proxima-nova,'helvetica neue',helvetica,arial,geneva,sans-serif;font-size:32px;font-weight:200;text-align:left;margin:0 0 40px" align="left">
                                        <img src="http://comicats.herokuapp.com/images/logo.png" alt="comicats" width="200" height="auto" style="outline:none;text-decoration:none;border:0">
                                    </h1>

                                    <p style="margin:20px 0">
                                        <a href="https://comicats.heroku.com/profile/{{$follower->id}}" style="color:#f60066">{{$follower->name}}</a> is now following you!
                                    </p>

                                    <p></p>
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
                                        {{ config('app.name') }} is the place for comic artists.
                                    </p>
                                    <p style="margin:20px 0">
                                        To learn more about {{ config('app.name') }} and all its features, check out <a href="https://comicats.heroku.com/about" style="color:#666666" target="_blank">our guide</a>.
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