<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Email</title>

    </head>
    <body style="font-family:'verdana'; margin:10px;background-color:#252423 ">
            <h1 style="text-align:center; color:white;">Automation</h1>
            <p style="color:white;">Hi Oliver,</p>
            <p style="color:white;">We want to inform you about the current status of the jobs.</p>
            @if (empty($details['wjn_priority']) && empty($details['ojn_priority']) && empty($details['wjn_routine']) && empty($details['ojn_routine']))
                <div style="margin-top:50px;background-color:#252423">
                    <p style="color: white">No warning and overdue jobs</p>
                </div>
            @endif

            @if (!empty($details['wjn_priority']))
                <div style="margin-top:50px;background-color:#252423">
                    <h3 style="color:orange;">Warning Jobs - Priority ({{count($details['wjn_priority'])}})</h3>
                    <table style="background-color:#252423; color:white;">
                        <thead>
                            <tr>
                                <th colspan="10">Job Numbers</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $previousName = null;
                                $columnCount = 0;
                            @endphp

                            @foreach($details['wjn_priority'] as $index => $detail)
                                @if($detail[0] !== $previousName)
                                    @if($previousName !== null)
                                        </tr>
                                    @endif
                                    <tr>
                                        <td colspan="10" style="color:blue;"> <h3>{{ $detail[0] }}</h3></td>
                                    </tr>
                                    <tr>
                                    @php
                                        $previousName = $detail[0];
                                        $columnCount = 0;
                                    @endphp
                                @endif

                                <td>{{ $detail[1] }}</td>

                                @php
                                    $columnCount++;
                                    if($columnCount == 10) {
                                        $columnCount = 0;
                                        echo '</tr><tr>';
                                    }
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            @if (!empty($details['ojn_priority']))
                <div style="margin-top:50px;background-color:#252423">
                    <h3 style="color:red;">Overdue Jobs - Priority ({{count($details['ojn_priority'])}})</h3>
                    <table style="background-color:#252423; color:white;">
                        <thead>
                            <tr>
                                <th colspan="10">Job Numbers</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $previousName = null;
                                $columnCount = 0;
                            @endphp

                            @foreach($details['ojn_priority'] as $index => $detail)
                                @if($detail[0] !== $previousName)
                                    @if($previousName !== null)
                                        </tr>
                                    @endif
                                    <tr>
                                        <td colspan="10" style="color:blue;"> <h3>{{ $detail[0] }}</h3></td>
                                    </tr>
                                    <tr>
                                    @php
                                        $previousName = $detail[0];
                                        $columnCount = 0;
                                    @endphp
                                @endif

                                <td>{{ $detail[1] }}</td>

                                @php
                                    $columnCount++;
                                    if($columnCount == 10) {
                                        $columnCount = 0;
                                        echo '</tr><tr>';
                                    }
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            @if (!empty($details['wjn_routine']))
                <div style="margin-top:50px;background-color:#252423">
                    <h3 style="color:orange;">Warning Jobs - Routine ({{count($details['wjn_routine'])}})</h3>
                    <table style="background-color:#252423; color:white;">
                        <thead>
                            <tr>
                                <th colspan="10">Job Numbers</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $previousName = null;
                                $columnCount = 0;
                            @endphp

                            @foreach($details['wjn_routine'] as $index => $detail)
                                @if($detail[0] !== $previousName)
                                    @if($previousName !== null)
                                        </tr>
                                    @endif
                                    <tr>
                                        <td colspan="10" style="color:blue;"> <h3>{{ $detail[0] }}</h3></td>
                                    </tr>
                                    <tr>
                                    @php
                                        $previousName = $detail[0];
                                        $columnCount = 0;
                                    @endphp
                                @endif

                                <td>{{ $detail[1] }}</td>

                                @php
                                    $columnCount++;
                                    if($columnCount == 10) {
                                        $columnCount = 0;
                                        echo '</tr><tr>';
                                    }
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            @if (!empty($details['ojn_routine']))
                <div style="margin-top:50px;background-color:#252423">
                    <h3 style="color:red;">Overdue Jobs - Routine ({{count($details['ojn_routine'])}})</h3>
                    <table style="background-color:#252423; color:white;">
                        <thead>
                            <tr>
                                <th colspan="10">Job Numbers</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $previousName = null;
                                $columnCount = 0;
                            @endphp

                            @foreach($details['ojn_routine'] as $index => $detail)
                                @if($detail[0] !== $previousName)
                                    @if($previousName !== null)
                                        </tr>
                                    @endif
                                    <tr>
                                        <td colspan="10" style="color:blue;"> <h3>{{ $detail[0] }}</h3></td>
                                    </tr>
                                    <tr>
                                    @php
                                        $previousName = $detail[0];
                                        $columnCount = 0;
                                    @endphp
                                @endif

                                <td>{{ $detail[1] }}</td>

                                @php
                                    $columnCount++;
                                    if($columnCount == 10) {
                                        $columnCount = 0;
                                        echo '</tr><tr>';
                                    }
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            <p style=" font-style:italic;color:white;margin-top:50px;">This is autogenerated email.</p>
    </body>
</html>
